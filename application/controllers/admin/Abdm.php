<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Abdm extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Enc_lib');
        $this->load->library('datatables');
        $this->config->load("payroll");
        $this->config->load("image_valid");
        $this->config->load("mailsms");
        $this->load->model('transaction_model');
        $marital_status = $this->config->item('marital_status');
        $bloodgroup     = $this->config->item('bloodgroup');
        $this->load->library('Customlib');
        $this->load->helper('customfield_helper');
        $this->load->helper('custom_helper');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'abdm');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abdm/main-layout', $data);
        $this->load->view('layout/footer', $data);
    }

    public function adhaarMobileOTPVerification()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Decode the raw JSON payload
            $inputData = json_decode(file_get_contents('php://input'), true);

            // Access the data from the decoded JSON
            $verify_by = isset($inputData['verify_by']) ? $inputData['verify_by'] : null;
            $abha_data = isset($inputData['abha_data']) ? $inputData['abha_data'] : null;

            if (!$verify_by || !$abha_data) {
                echo json_encode(array(
                    "success" => false,
                    "error" => "Missing required parameters."
                ));
                exit;
            }

            // Debugging: Print the received data
            //printf("Verify By: %s\n", $verify_by);
            //die();
            // printf("ABHA Data: %s\n", $abha_data);

            $encryptedOutput = getRsaEncryptedOutput($abha_data);

            $url = ABHA_BASE_URL . "/v3/profile/login/request/otp";

            switch ($verify_by) {
                // case "abha_no":
                //     $data = array("scope" => array("abha-login", "aadhaar-verify"), "loginHint" => "abha-number", "loginId" => $encryptedOutput, "otpSystem" => "aadhaar");
                //     break;
                case "mobile_otp":
                    $data = array("scope" => array("abha-login", "mobile-verify"), "loginHint" => "abha-number", "loginId" => $encryptedOutput, "otpSystem" => "abdm");
                    break;

                case "mobile_no":
                    $data = array("scope" => array("abha-login", "mobile-verify"), "loginHint" => "mobile", "loginId" => $encryptedOutput, "otpSystem" => "abdm");
                    break;

                case "aadhaar_no":
                    $data = array("scope" => array("abha-login", "aadhaar-verify"), "loginHint" => "aadhaar", "loginId" => $encryptedOutput, "otpSystem" => "aadhaar");
                    break;

                case "aadhaar_otp":
                    $data = array("scope" => array("abha-login", "aadhaar-verify"), "loginHint" => "abha-number", "loginId" => $encryptedOutput, "otpSystem" => "aadhaar");
                    break;

                    // case "biometric":
                    //     $data = array("scope" => array("abha-login", "aadhaar-bio-verify"), "loginHint" => "abha-number", "loginId" => $encryptedOutput, "otpSystem" => "aadhaar");
                    //     break;
            }

            $random_request_id = generateRequestId();

            $timestamp = time();
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);
            $timestamp = $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

            $accessToken = getAccessToken();

            $headerSet = array(
                "Content-Type:application/json",
                "REQUEST-ID:$random_request_id",
                "TIMESTAMP:$timestamp",
                "Authorization:Bearer $accessToken"
            );

            $response = callAbhaAPI('POST', $url, $headerSet, $data);

            $response_code = $response['response_code'];
            $response_body = $response['response_body'];
            // printf("Response Body: %s\n", $response_body);
            // die();
            $data = json_decode($response_body, true);

            if ($response_code == "200") {
                $transactionId = $data['txnId'];
                $message = $data['message'];
                $this->session->set_userdata('abha_verification_method', $verify_by);
                $this->session->set_userdata('abhaTransactionId', $transactionId);

                echo json_encode(array(
                    "success" => true,
                    "transactionId" => $transactionId,
                    "message" => $message
                ));
            } else if ($response_code == "401") {
                $message = $data['description'];

                echo json_encode(array(
                    "success" => false,
                    "error" => $message
                ));
            } else {
                // print_r($response);
                // die();
                echo json_encode(array(
                    "success" => false,
                    "error" => "Invalid LoginId"
                ));
            }
            exit;
        } else {
            echo json_encode(array(
                "success" => false,
                "error" => "Invalid request method."
            ));
        }
    }

    public function confirmAbha()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Decode the raw JSON payload
            $inputData = json_decode(file_get_contents('php://input'), true);

            // Access the data from the decoded JSON
            $verify_by = isset($inputData['verify_by']) ? $inputData['verify_by'] : null;
            $abha_data = isset($inputData['abha_data']) ? $inputData['abha_data'] : null;

            if (!$verify_by || !$abha_data) {
                echo json_encode(array(
                    "success" => false,
                    "error" => "Missing required parameters."
                ));
                exit;
            }

            // Encrypt the ABHA number
            // $encryptedOutput = getRsaEncryptedOutput($abha_number);

            // Prepare the URL and data for the API request
            $url = ABHA_BASE_URL . "/v3/profile/login/search";
            $data = array(
                "ABHANumber" => $abha_data
            );

            if ($verify_by == "abha_address") {
                $url = ABHA_BASE_URL . "/v3/phr/web/login/abha/search";
                $data = array(
                    "abhaAddress" => $abha_data
                );
            }

            // Generate a random request ID and timestamp
            $random_request_id = generateRequestId();
            $timestamp = time();
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);
            $timestamp = $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

            // Get the access token
            $accessToken = getAccessToken();

            // Set the headers for the API request
            $headerSet = array(
                "Content-Type:application/json",
                "REQUEST-ID:$random_request_id",
                "TIMESTAMP:$timestamp",
                "Authorization:Bearer $accessToken"
            );

            // Call the ABHA API
            $response = callAbhaAPI('POST', $url, $headerSet, $data);
            $response_code = $response['response_code'];
            $response_body = $response['response_body'];
            // print_r($response_body); die();
            // Decode the response body
            $data = json_decode($response_body, true);

            if ($response_code == "200") {
                $message = "User Present";

                // Return success response
                echo json_encode(array(
                    "success" => true,
                    "message" => $message,
                    "data" => $data
                ));
            } else if ($response_code == "400") {
                echo json_encode(array(
                    "success" => false,
                    "error" => $data['ABHANumber']
                ));
            } else {
                // Handle other errors
                echo json_encode(array(
                    "success" => false,
                    "error" => $data['message']
                ));
            }
            exit;
        } else {
            echo json_encode(array(
                "success" => false,
                "error" => "Invalid request method."
            ));
        }
    }

    public function fetchAbhaProfile()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Decode the raw JSON payload
            $inputData = json_decode(file_get_contents('php://input'), true);
            $abha_otp = isset($inputData['abha_otp']) ? $inputData['abha_otp'] : null;

            if (!$abha_otp) {
                echo json_encode(array(
                    "success" => false,
                    "error" => "Missing OTP."
                ));
                exit;
            }

            // Retrieve transaction ID and verification method from session
            $abhaTransactionId = $this->session->userdata('abhaTransactionId');
            $verify_by = $this->session->userdata('abha_verification_method');

            // Encrypt the OTP
            $encryptedOtp = getRsaEncryptedOutput($abha_otp);

            // Step 1: Verify OTP
            $url = ABHA_BASE_URL . "/v3/profile/login/verify";
            $data = array(
                "scope" => array("abha-login", $verify_by === "mobile_otp" || $verify_by === "mobile_no" ? "mobile-verify" : "aadhaar-verify"),
                "authData" => array(
                    "authMethods" => array("otp"),
                    "otp" => array(
                        "txnId" => $abhaTransactionId,
                        "otpValue" => $encryptedOtp
                    )
                )
            );

            $random_request_id = generateRequestId();

            $timestamp = time();
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);
            $timestamp = $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

            $accessToken = getAccessToken();

            $headerSet = array(
                "Content-Type:application/json",
                "REQUEST-ID:$random_request_id",
                "TIMESTAMP:$timestamp",
                "Authorization:Bearer $accessToken"
            );

            $response = callAbhaAPI('POST', $url, $headerSet, $data);
            // print_r($response); die();
            $response_code = $response['response_code'];
            $response_body = $response['response_body'];
            $data = json_decode($response_body, true);
            // print_r($data['authResult']); die();

            if ($response_code != "200" || $data['authResult'] != 'success') {
                $error_message = isset($data['message']) ? $data['message'] : "OTP verification failed.";
                echo json_encode(array(
                    "success" => false,
                    "error" => $error_message
                ));
                exit;
            }

            // Extract token and transaction ID
            $xToken = $data['token'];
            // $refreshToken = $data['refreshToken'];
            $transactionId = $data['txnId'];

            // Step 2: Handle Intermediate Step for Mobile Verification
            if ($verify_by === "mobile_no") {
                $ABHANumber = $data['accounts'][0]['ABHANumber'];
                $url = ABHA_BASE_URL . "/v3/profile/login/verify/user";
                $random_request_id = generateRequestId();

                //date_default_timezone_set('Asia/Kolkata');
                $timestamp = time();  // Unix timestamp (seconds)
                $microseconds = microtime(true) - $timestamp;
                $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
                $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
                $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

                $accessToken = getAccessToken();

                $data = array(
                    "txnId" => $transactionId,
                    "ABHANumber" => $ABHANumber
                );

                $headerSet = array(
                    "Content-Type:application/json",
                    "REQUEST-ID:$random_request_id",
                    "TIMESTAMP:$timestamp",
                    "Authorization:Bearer $accessToken",
                    "T-token:Bearer $xToken"
                );

                $response = callAbhaAPI('POST', $url, $headerSet, $data);
                // print_r($response); die();
                $response_code = $response['response_code'];
                $response_body = $response['response_body'];
                $data = json_decode($response_body, true);

                if ($response_code != "200") {
                    $error_message = isset($data['message']) ? $data['message'] : "Failed to verify user.";
                    echo json_encode(array(
                        "success" => false,
                        "error" => $error_message
                    ));
                    exit;
                }

                // Update xToken with the new token from this step
                $xToken = $data['token'];
            }

            // Step 3: Fetch User Profile
            $url = ABHA_BASE_URL . "/v3/profile/account";
            $random_request_id = generateRequestId();

            $timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

            $accessToken = getAccessToken();
            $headerSet = array(
                "Content-Type:application/json",
                "REQUEST-ID:$random_request_id",
                "TIMESTAMP:$timestamp",
                "Authorization:Bearer $accessToken",
                "X-token:Bearer $xToken"
            );

            $response = callAbhaAPI('GET', $url, $headerSet);
            $response_code = $response['response_code'];
            $response_body = $response['response_body'];
            $profileData = json_decode($response_body, true);

            // $prettyJson = json_encode($data, JSON_PRETTY_PRINT);
            // echo "<pre>$prettyJson</pre>";
            // die();

            if ($response_code != "200") {
                $error_message = isset($profileData['message']) ? $profileData['message'] : "Failed to fetch user profile.";
                echo json_encode(array(
                    "success" => false,
                    "error" => $error_message
                ));
                exit;
            }

            // Return the profile data as JSON
            echo json_encode(array(
                "success" => true,
                "profile" => $profileData
            ));
            exit;
        } else {
            echo json_encode(array(
                "success" => false,
                "error" => "Invalid request method."
            ));
        }
    }

    public function hipInitiateLinking()
    {
        // $this->session->set_userdata('top_menu', 'abha_address_validation');
        // $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;

        // $data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        // $data['sqlMode']      = $this->setting_model->getSqlMode();
        // $data['jsonarr']      = $jsonarr;


        $this->load->view('layout/header', $data);
        $this->load->view('admin/abdm/verification-hip-initiate-linking', $data);
        $this->load->view('layout/footer', $data);
    }

    // public function getAbhaAccessToken()
    // {
    //     $timestamp = time();  // Unix timestamp (seconds)
    //     $microseconds = microtime(true) - $timestamp;
    //     $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
    //     $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
    //     $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';

    //     echo "Access Token : " . getAccessToken() . "\n RequestId: " . generateRequestId() . "\n timestamp: " . $timestamp;
    // }
}

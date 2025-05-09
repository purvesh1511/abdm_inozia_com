<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Abhavalidation extends Admin_Controller
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

    public function abhanumberverification()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		   
            $verify_by=$this->input->post('verify_by');
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
          
            $url=ABHA_BASE_URL."/v3/profile/login/request/otp";
            
            switch($verify_by)
            {
                case "abha_no":
                    $data=array("scope" => array("abha-login","aadhaar-verify"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
                    
                case "mobile_no":
                    $data=array("scope" => array("abha-login","mobile-verify"),"loginHint" => "mobile","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                
                case "aadhar_no":
                    $data=array("scope" => array("abha-login","aadhaar-verify"),"loginHint" => "aadhaar","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
                
                case "biometric":
                    $data=array("scope" => array("abha-login","aadhaar-bio-verify"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$data['txnId'];
                $message=$data['message'];
                $this->session->set_userdata('abha_verification_method',$verify_by);
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);

                redirect(base_url().'admin/abhavalidation/abhaOtpVerification');
            }
            else if($response_code=="401")
            {
                $message=$data['description'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhanumberverification');
            }
            else
            {
                $message="Invalid LoginId";
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
            }
   
            exit;
		}
		
		
        $this->session->set_userdata('top_menu', 'abha_number_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;

        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
    
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/abha-number-validation', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    public function abhaOtpVerification()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/login/verify";
            
            $verify_by=$this->session->userdata('abha_verification_method');
            
            switch($verify_by)
            {
                case "abha_no":
                    $data=array("scope" => array("abha-login","aadhaar-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
                    
                case "mobile_no":
                    $data=array("scope" => array("abha-login","mobile-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
                
                case "aadhar_no":
                    $data=array("scope" => array("abha-login","aadhaar-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
            }
            
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                    $xToken=$data['token'];
                    $message=$data['message'];
                    
                    switch($verify_by)
                    {
                        case "mobile_no":
                            $ABHANumber=$data['accounts'][0]['ABHANumber'];
                            $url=ABHA_BASE_URL."/v3/profile/login/verify/user";
                            $random_request_id=generateRequestId();
                       
                            //date_default_timezone_set('Asia/Kolkata');
                			$timestamp = time();  // Unix timestamp (seconds)
                            $microseconds = microtime(true) - $timestamp;
                            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
                            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
                            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
                    
                            $accessToken=getAccessToken();
                            
                            $data=array("txnId" => $transactionId,"ABHANumber" => $ABHANumber);
                            
                            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","T-token:Bearer $xToken");
                        	$responseTwo=callAbhaAPI('POST',$url,$headerSet,$data);
                        	
                        	$response_codeTwo=$responseTwo['response_code'];
                            $response_bodyTwo=$responseTwo['response_body'];
                            $dataTwo = json_decode($response_bodyTwo, true);
                            
                            if($response_codeTwo=="200")
                            {
                                $xToken=$dataTwo['token'];
                                $this->session->set_userdata('abhaTransactionId',$transactionId);
                                $this->session->set_userdata('abhaXToken',$xToken);
                                $this->session->set_flashdata('success',$message);
                                redirect(base_url().'admin/abhavalidation/abhaprofile');
                            }
                            else
                            {
                                if(isset($dataTwo['ABHANumber']))
                                {
                                    $message="we can not found a valid ABHA number against this mobile number in our records.Please try again.";
                                    $this->session->set_flashdata('error',$message);
                                    redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
                                } 
                                else
                                {
                                    $message=$dataTwo['message'];
                                    $this->session->set_flashdata('error',$message);
                                    redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
                                }
                            }
                        break;
                        
                        default:
                            $this->session->set_userdata('abhaTransactionId',$transactionId);
                            $this->session->set_userdata('abhaXToken',$xToken);
                            $this->session->set_flashdata('success',$message);
                            redirect(base_url().'admin/abhavalidation/abhaprofile');
                        break;
                    }
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/abhaOtpVerification');  
                  
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaOtpVerification');    
            }
            
           exit;    
            
		}
		
        $this->session->set_userdata('top_menu', 'abha_number_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;

       //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
    
        

        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/abha-number-verify-otp', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function abhaprofile()
    {
        $url=ABHA_BASE_URL."/v3/profile/account";
        
        $abhaXToken=$this->session->userdata('abhaXToken');
		   
        $random_request_id=generateRequestId();
               
		$timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
        $accessToken=getAccessToken();
            
        $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        $response=callAbhaAPI('GET',$url,$headerSet);
        
        $response_code=$response['response_code'];
        $response_body=$response['response_body'];
        $resultResponse = json_decode($response_body, true);
          
        if($response_code=="200")
        {
            $data['getProfile']=$resultResponse;
            $data['profile_type']="abhaNumber";
		
            $this->session->set_userdata('top_menu', 'abha_number_validation');
            $this->session->set_userdata('sub_menu', '');
            $role                        = $this->customlib->getStaffRole();
            $role_id                     = json_decode($role)->id;
            $staffid                     = $this->customlib->getStaffID();
            $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
            $data['notifications']       = $notifications;
            $systemnotifications         = $this->notification_model->getUnreadNotification();
            $data['systemnotifications'] = $systemnotifications;
    
            //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
			//$data['sqlMode']      = $this->setting_model->getSqlMode();
			//$data['jsonarr']      = $jsonarr;
		
            
    
            $this->load->view('layout/header', $data);
            $this->load->view('admin/abha/abha-profile', $data);
            $this->load->view('layout/footer', $data);
        }
        elseif($response_code=="404")
        {
            $message=$resultResponse['error']['message'];
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
        }
        else
        {
            $message=$resultResponse['message'];
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
        }
    }
	
	public function downloadAbhaCard()
    {
        $url=ABHA_BASE_URL."/v3/profile/account/abha-card";
        
        $abhaXToken=$this->session->userdata('abhaXToken');
		   
        $random_request_id=generateRequestId();
               
		$timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
        $accessToken=getAccessToken();
            
        $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        $response=callAbhaAPI('GET',$url,$headerSet);
        
       // print_r($response);
        
        $response_code=$response['response_code'];
        $response_body=$response['response_body'];
        $data['abhaCard']=$response_body;
        
        $fileName=time().".png";
        $base64Image = base64_encode($response_body);
        $imagePath = 'uploads/abha-card/'.$fileName; 
        $imageData = base64_decode($base64Image);
        // Check if the decoding is successful
        if ($imageData === false) {
            echo "Base64 decoding failed!";
            exit;
        }
        // Save the image to the specified file
        if (file_put_contents($imagePath, $imageData)) {
            
           // echo "Image has been saved successfully to: " . $imagePath;
            
            
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($imagePath));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            readfile($imagePath);
            
        } else {
            echo "Failed to save the image.";
        }
    }
	
	public function downloadAbhaAddressCard()
    {
        $url=ABHA_BASE_URL."/v3/phr/web/login/profile/abha/phr-card";
        
        $abhaXToken=$this->session->userdata('abhaXToken');
		   
        $random_request_id=generateRequestId();
               
		$timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
        $accessToken=getAccessToken();
            
        $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        $response=callAbhaAPI('GET',$url,$headerSet);
        
       // print_r($response);
        
        $response_code=$response['response_code'];
        $response_body=$response['response_body'];
        $data['abhaCard']=$response_body;
        
        $fileName=time().".png";
        $base64Image = base64_encode($response_body);
        $imagePath = 'uploads/abha-card/'.$fileName; 
        $imageData = base64_decode($base64Image);
        // Check if the decoding is successful
        if ($imageData === false) {
            echo "Base64 decoding failed!";
            exit;
        }
        // Save the image to the specified file
        if (file_put_contents($imagePath, $imageData)) {
            
           // echo "Image has been saved successfully to: " . $imagePath;
            
            
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($imagePath));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            readfile($imagePath);
            
        } else {
            echo "Failed to save the image.";
        }
    }
	
	public function searchAbha()
    {  
        $this->session->set_userdata('top_menu', 'abha_number_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/search-abha', $data);
        $this->load->view('layout/footer', $data);
    }
	
	public function abhaSearchList()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
          
            $url=ABHA_BASE_URL."/v3/profile/account/abha/search";
            
            $data=array("scope" => array("search-abha"),"mobile" => $encryptedOutput);
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $result = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$result[0]['txnId'];
                $abhaList=$result[0]['ABHA'];
                $data['abhaList']=$abhaList;
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_userdata('abhaList',$abhaList); 
            }
            elseif($response_code=="404")
            {
                $message=$result['error']['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('search_error_status',1);
                redirect(base_url().'admin/abhavalidation/searchAbha');   
            }
            else
            {
                $message="Invalid Mobile Number";
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('search_error_status',1);
                redirect(base_url().'admin/abhavalidation/searchAbha'); 
            }
		}
		else
		{
		    $data['abhaList']=$this->session->userdata('abhaList');
		}

        $this->session->set_userdata('top_menu', 'abha_number_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/abha-search-list', $data);
        $this->load->view('layout/footer', $data);
    }
	
	
	public function sendSearchOtp()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
          
            $url=ABHA_BASE_URL."/v3/profile/login/request/otp";
            
            $data=array("scope" => array("abha-login","search-abha","mobile-verify"),"loginHint" => "index","loginId" => $encryptedOutput,"otpSystem" => "abdm","txnId" => $abhaTransactionId);
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
            
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $result = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$result['txnId'];
                $message=$result['message'];
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);
                redirect(base_url().'admin/abhavalidation/searchOtpVerification');
            }
            else if($response_code=="401")
            {
                $message=$result['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('search_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaSearchList');  
            }
            else if($response_code=="404")
            {
                $message=$result['error']['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('search_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaSearchList');  
            }
            else
            {
                $message="Invalid Login Id";
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('search_error_status',1);
                redirect(base_url().'admin/abhavalidation/searchAbha'); 
            }
		}
		else
		{
		    $message="Enter mobile number";
		    $this->session->set_flashdata('error',$message);
            $this->session->set_userdata('search_error_status',1);
            redirect(base_url().'admin/abhavalidation/searchAbha'); 
		}
    }
	
	public function searchOtpVerification()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/login/verify";
          
            $data=array("scope" => array("abha-login","mobile-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));

            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                    $xToken=$data['token'];
                    $message=$data['message'];
                    $this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_userdata('abhaXToken',$xToken);
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'admin/abhavalidation/abhaprofile');
                    
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/searchOtpVerification'); 
                }              
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                else
                {
                    $message="Something went wrong";
                }
                
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/searchOtpVerification');
            }
		}
		
		$this->session->set_userdata('top_menu', 'abha_number_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/verify-search-otp', $data);
        $this->load->view('layout/footer', $data);
    }
	
	
	public function abhaAddressVerification()
    {  
        $this->session->set_userdata('top_menu', 'abha_address_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/abha-address-validation', $data);
        $this->load->view('layout/footer', $data);
    }
	
	public function searchAbhaAddress()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $verify_by=$this->input->post('verify_by');
		    $abha_data=$this->input->post('abha_data');

            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
          
            $url=ABHA_BASE_URL."/v3/phr/web/login/abha/search";
            
            
            $data=array("abhaAddress" => $abha_data);
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
           
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $result = json_decode($response_body, true);
           
            if($response_code=="200")
            {
                $data['getData']=$result;
                $data['verify_by']=$verify_by;
                $this->session->set_userdata('abhaAddressList',$result);
                $this->session->set_userdata('abhaAddressVerify',$verify_by);
            }
            else if($response_code=="400")
            {
                $message=$result[0]['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaAddressVerification');
                exit;
            }
            else if($response_code=="401")
            {
                $message=$result['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaAddressVerification');
                exit;  
            }
            else if($response_code=="404")
            {
                $message=$result['error']['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaAddressVerification');
                exit;  
            }
            else
            {
                $message="Invalid ABHA Address";
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/abhaAddressVerification'); 
                exit;
            }
		}
		else
		{
		    $data['getData']=$this->session->userdata('abhaAddressList');
		    $data['verify_by']=$this->session->userdata('abhaAddressVerify');
		}
		
		$this->session->set_userdata('top_menu', 'abha_address_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/abha-address-list', $data);
        $this->load->view('layout/footer', $data);
    }
	
	public function sendAbhaAddressVerifyOtp()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_data=$this->input->post('abha_data');
		    $verify_by=$this->input->post('verify_by');
		    
		    $this->session->set_userdata('abhaAddressVerify',$verify_by);

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
          
            $url=ABHA_BASE_URL."/v3/phr/web/login/abha/request/otp";
            
            switch($verify_by)
            {
                case "mobile_otp":
                    $data=array("scope" => array("abha-address-login","mobile-verify"),"loginHint" => "abha-address","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                
                case "aadhar_otp":
                    $data=array("scope" => array("abha-address-login","aadhaar-verify"),"loginHint" => "abha-address","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
            
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $result = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$result['txnId'];
                $message=$result['message'];
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);
				redirect(base_url().'admin/abhavalidation/abhaAddressOtpVerification');
            }
            else if($response_code=="404")
            {
                $message=$result['error']['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/searchAbhaAddress');  
            }
            else
            {
                $message=$result[0]['message'];
                $this->session->set_flashdata('error',$message);
                $this->session->set_userdata('abha_address_error_status',1);
                redirect(base_url().'admin/abhavalidation/searchAbhaAddress');
            }
		}
		else
		{
		    $message="Enter mobile number";
		    $this->session->set_flashdata('error',$message);
            $this->session->set_userdata('abha_address_error_status',1);
            redirect(base_url().'admin/abhavalidation/abhaAddressVerification');
		}
    }
	
	
	public function abhaAddressOtpVerification()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    $verify_by=$this->session->userdata('abhaAddressVerify');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/phr/web/login/abha/verify";
            
            switch($verify_by)
            {
                case "mobile_otp":
                    $data=array("scope" => array("abha-address-login","mobile-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
                    
                case "aadhar_otp":
                    $data=array("scope" => array("abha-address-login","aadhaar-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
            }

            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                   // $transactionId=$data['txnId'];
                    $xToken=$data['tokens']['token'];
                    $message=$data['message'];
                   // $this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_userdata('abhaXToken',$xToken);
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'admin/abhavalidation/abhaAddressProfile');
                    
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/abhaAddressOtpVerification');  
                }              
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                else
                {
                    $message=$data['message'];
                }
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaAddressOtpVerification'); 
            }
		}
		
		$this->session->set_userdata('top_menu', 'abha_address_validation');
        $this->session->set_userdata('sub_menu', '');
        $role                        = $this->customlib->getStaffRole();
        $role_id                     = json_decode($role)->id;
        $staffid                     = $this->customlib->getStaffID();
        $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        $data['notifications']       = $notifications;
        $systemnotifications         = $this->notification_model->getUnreadNotification();
        $data['systemnotifications'] = $systemnotifications;
    
        //$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
            
    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/abha/verify-abha-address-otp', $data);
        $this->load->view('layout/footer', $data);
    }
	
	public function abhaAddressProfile()
    {  
        
        $url=ABHA_BASE_URL."/v3/phr/web/login/profile/abha-profile";
        
        $abhaXToken=$this->session->userdata('abhaXToken');
		   
        $random_request_id=generateRequestId();
               
		$timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
        $accessToken=getAccessToken();
            
        $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        $response=callAbhaAPI('GET',$url,$headerSet);
        
        $response_code=$response['response_code'];
        $response_body=$response['response_body'];
        $resultResponse = json_decode($response_body, true);
          
        if($response_code=="200")
        {
            $data['getProfile']=$resultResponse;
            $data['profile_type']="abhaAddress";
			
			$this->session->set_userdata('top_menu', 'abha_address_validation');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/abha-profile', $data);
			$this->load->view('layout/footer', $data);
        }
        elseif($response_code=="404")
        {
            $message=$resultResponse['error']['message'];
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'admin/abhavalidation/abhaAddressVerification'); 
        }
        else
        {
            $message=$resultResponse[0]['message'];
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'admin/abhavalidation/abhaAddressVerification'); 
        }
    }
	
	public function uploadPhoto()
    {
       if($this->input->server('REQUEST_METHOD') === 'POST')
       {
           $cover_image = $_FILES['cover_image']['name'];
           
           if(isset($_FILES["cover_image"]) && !empty($_FILES['cover_image']['name']))
           {
			   $randId=time();
			   $fileInfo    = pathinfo($_FILES["cover_image"]["name"]);
               $newName      = "abha-profile" . $randId . '.' . $fileInfo['extension'];

			   $valid_ext = array('png','jpg','JPG','PNG');

				// Location
				 $location = "uploads/abha-profile/".$newName;

				 // file extension
				 $file_extension = $fileInfo['extension'];
				 $file_extension = strtolower($file_extension);

				 // Check extension
				 if(in_array($file_extension,$valid_ext))
				 {  
                    move_uploaded_file($_FILES["cover_image"]["tmp_name"], $location);
				
                    $img = file_get_contents(base_url().'uploads/abha-profile/'.$newName);

                     // Encode the image string data into base64
                    $encryptedOutput = base64_encode($img);

                     //$encryptedOutput = str_replace('data:image/png;base64,', '', $encryptedOutput);
                
                     $url=ABHA_BASE_URL."/v3/profile/account";
              
                     $data=array("profilePhoto" => $encryptedOutput);
    
                     $random_request_id=generateRequestId();
                   
                    //date_default_timezone_set('Asia/Kolkata');
        			$timestamp = time();  // Unix timestamp (seconds)
                    $microseconds = microtime(true) - $timestamp;
                    $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
                    $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
                    $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
        
                    $accessToken=getAccessToken();
                    $abhaXToken=$this->session->userdata('abhaXToken');
                
                    $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
                	$response=callAbhaAPI('PATCH',$url,$headerSet,$data);
                	
                    $response_code=$response['response_code'];
                    $response_body=$response['response_body'];
                    $data = json_decode($response_body, true);
                    
                    if($response_code=="200")
                    {
                        $this->session->set_flashdata('success',"Profile Photo Updated");
                    }
                    elseif(isset($data['ProfilePhoto']))
                    {
                        $this->session->set_flashdata('error',$data['ProfilePhoto']);
                    }
                    else
                    {
                        $this->session->set_flashdata('error',$data['message']);
                    }
				 }
				 else
				 {
					$this->session->set_flashdata('error','Photo is invalid.');
				 }
                 
                redirect(base_url().'admin/abhavalidation/abhaProfile'); 
           }
           else
           {
               $this->session->set_flashdata('error',"Choose a photo to upload");
               redirect(base_url().'admin/abhavalidation/abhaProfile'); 
           }
       }
    }
	
	public function updateProfile()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $profile_data=$this->input->post('profile_data');
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            $abhaXToken=$this->session->userdata('abhaXToken');
          
            $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
            
            switch($profile_data)
            {
                case "email":
                    $data=array("scope" => array("abha-profile","email-verify"),"loginHint" => "email","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                    
                case "mobile_no":
                    $data=array("scope" => array("abha-profile","mobile-verify"),"loginHint" => "mobile","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$data['txnId'];
                $message=$data['message'];
                $this->session->set_userdata('update_profile_method',$profile_data);
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);
				redirect(base_url().'admin/abhavalidation/verifyOtpUpdateProfile');
            }
            else if($response_code=="401")
            {
                $message=$data['message'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile'); 
            }
            else
            {
                if(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
                elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                else
                {
                    $message=$data['message'];
                }
               
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile');  
            }
           
		}
		else
		{
		    $this->session->set_flashdata('error',"Invalid Login Id");
		    redirect(base_url().'admin/abhavalidation/abhaProfile');
		}
    }
    
    public function verifyOtpUpdateProfile()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
            
            $abhaXToken=$this->session->userdata('abhaXToken');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/account/verify";
            
            $profile_update=$this->session->userdata('update_profile_method');
            
            switch($profile_update)
            {
                case "email":
                    $data=array("scope" => array("abha-profile","email-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
                    
                case "mobile_no":
                    $data=array("scope" => array("abha-profile","mobile-verify"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
            }
            
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                   // $xToken=$data['token'];
                    $message=$data['message'];
                    
                    $this->session->set_userdata('abhaTransactionId',$transactionId);
                    //$this->session->set_userdata('abhaXToken',$xToken);
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'admin/abhavalidation/abhaProfile');
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyOtpUpdateProfile');  
                  
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                else
                {
                    $message="Session Expired";
                }
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyOtpUpdateProfile');    
            }
            
		}

            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-update-profile-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function reKycOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            $abhaXToken=$this->session->userdata('abhaXToken');
          
            $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
            
            $data=array("scope" => array("abha-profile","re-kyc"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$data['txnId'];
                $message=$data['message'];
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);
				redirect(base_url().'admin/abhavalidation/verifyReKycOtp');
            }
            else if($response_code=="401")
            {
                $message=$data['message'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile'); 
            }
            else
            {
                if(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
                elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                else
                {
                    $message=$data['message'];
                }
               
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile');  
            }
           
		}
		else
		{
		    $this->session->set_flashdata('error',"Invalid Login Id");
		    redirect(base_url().'admin/abhavalidation/abhaProfile');
		}
    }
    
    public function verifyReKycOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
            
            $abhaXToken=$this->session->userdata('abhaXToken');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/account/verify";
            
            $data=array("scope" => array("abha-profile","re-kyc"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                   // $xToken=$data['token'];
                    $message=$data['message'];
                    
                    $this->session->set_userdata('abhaTransactionId',$transactionId);
                    //$this->session->set_userdata('abhaXToken',$xToken);
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'admin/abhavalidation/abhaProfile');
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyReKycOtp');  
                  
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                else
                {
                    $message="Session Expired";
                }
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyReKycOtp');    
            }
            
		}

            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-rekyc-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function changePassword()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $new_password=$this->input->post('new_password');
		    $confirm_password=$this->input->post('confirm_password');

            $encryptedNewPassword=getRsaEncryptedOutput($new_password);
            $encryptedConfirmPassword=getRsaEncryptedOutput($confirm_password);
          
            $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
            
            $data=array("scope" => array("abha-profile","change-password"),"loginHint" => "password","loginId" => $encryptedNewPassword,"otpSystem" => "abdm");
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
            
			$abhaXToken=$this->session->userdata('abhaXToken');
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $transactionId=$data['txnId'];
                $message=$data['message'];
                $this->session->set_userdata('abhaTransactionId',$transactionId);
                $this->session->set_flashdata('success',$message);
                redirect(base_url().'admin/abhavalidation/verifyPasswordOtp');
            }
            else if($response_code=="401")
            {
                $message=$data['message'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/changePassword');  
            }
            else
            {
                if(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
                elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                else
                {
                    $message=$data['message'];
                }
               
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/changePassword');  
            }
		}

            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/change-password', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function verifyPasswordOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/account/verify";
          
            $data=array("scope" => array("abha-profile","change-password"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));

            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
	        $abhaXToken=$this->session->userdata('abhaXToken');
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
            $response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                    $message=$data['message'];
                    $this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'admin/abhavalidation/abhaProfile');
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyPasswordOtp');  
                }              
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
                elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                else
                {
                    $message="Something went wrong";
                }
                
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyPasswordOtp'); 
            }
		}
		
            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-password-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function deactivateAccount()
    {
	    if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $verify_by=$this->input->post('verify_by');
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            switch($verify_by)
            {
                case "abha_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
					
                    $data=array("scope" => array("abha-profile","de-activate"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                
                case "aadhar_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
					
                    $data=array("scope" => array("abha-profile","de-activate"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
                    
                case "password":
                    $deactivation_reason=$this->input->post('deactivation_reason');
					
                    $url=ABHA_BASE_URL."/v3/profile/account/verify";
					
                    $data=array("scope" => array("abha-profile","de-activate"),"authData" => array("authMethods" => array("password"),"password" => array("password" => $encryptedOutput)),"reasons" => array($deactivation_reason));
                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
			$abhaXToken=$this->session->userdata('abhaXToken');
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
			    switch($verify_by)
				{
				  case "password":
				    $authResult=$data['authResult'];
					if($authResult=='success')
					{
					  $message=$data['message'];
					  $this->session->set_flashdata('success',$message);
					  redirect(base_url().'admin/abhavalidation/abhaProfile'); 
					}
					else
					{
					    if(isset($data['password']))
						{
							$message=$data['password'];
						}
						elseif(isset($data['newPassword']))
						{
							$message=$data['newPassword'];
						}
						elseif(isset($data['scope']))
						{
							$message=$data['scope'];
						}
						elseif(isset($data['authMethods']))
						{
							$message=$data['authMethods'];
						}
						elseif(isset($data['message']))
						{
							$message=$data['message'];
						}
						$this->session->set_flashdata('error',$message);
						redirect(base_url().'admin/abhavalidation/deactivateAccount'); 
					}
					
				  break;
				  
				  default:
					$transactionId=$data['txnId'];
					$message=$data['message'];
					$this->session->set_userdata('abha_deactivation_verification_method',$verify_by);
					$this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/verifyDeactivateOtp'); 
				  break;
				}
            }
            else if($response_code=="401")
            {
                $message=$data['description'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile');  
            }
            else
            {
			    if(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
				elseif(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
				elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
				else
				{
                    $message="Session expired";
				}
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile');  
            }
           
		}
        
		
            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/deactivate-account', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function verifyDeactivateOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    $deactivation_reason=$this->input->post('deactivation_reason');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/account/verify";
            
            $verify_by=$this->session->userdata('abha_deactivation_verification_method');
            
            $data=array("scope" => array("abha-profile","de-activate"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)),"reasons" => array($deactivation_reason));
            
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
	        $abhaXToken=$this->session->userdata('abhaXToken');
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/abhaProfile'); 
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyDeactivateOtp');  
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                
				$this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyDeactivateOtp');     
            }
            
		}

        
            $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-deactivate-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function deleteAccount()
    {
	    if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $verify_by=$this->input->post('verify_by');
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            switch($verify_by)
            {
                case "abha_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
					
                    $data=array("scope" => array("abha-profile","delete"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                
                case "aadhar_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/account/request/otp";
					
                    $data=array("scope" => array("abha-profile","delete"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
                    
                case "password":
                    $delete_reason=$this->input->post('delete_reason');
					
                    $url=ABHA_BASE_URL."/v3/profile/account/verify";
					
                    $data=array("scope" => array("abha-profile","delete"),"authData" => array("authMethods" => array("password"),"password" => array("password" => $encryptedOutput)),"reasons" => array($delete_reason));
                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
			$abhaXToken=$this->session->userdata('abhaXToken');
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
			    switch($verify_by)
				{
				  case "password":
				    $authResult=$data['authResult'];
					if($authResult=='success')
					{
					  $message=$data['message'];
					  $this->session->set_flashdata('success',$message);
					  redirect(base_url().'admin/abhavalidation/abhanumberverification');
					}
					else
					{
					    if(isset($data['password']))
						{
							$message=$data['password'];
						}
						elseif(isset($data['newPassword']))
						{
							$message=$data['newPassword'];
						}
						elseif(isset($data['scope']))
						{
							$message=$data['scope'];
						}
						elseif(isset($data['authMethods']))
						{
							$message=$data['authMethods'];
						}
						elseif(isset($data['message']))
						{
							$message=$data['message'];
						}
						$this->session->set_flashdata('error',$message);
						redirect(base_url().'admin/abhavalidation/deleteAccount');
					}
					
				  break;
				  
				  default:
					$transactionId=$data['txnId'];
					$message=$data['message'];
					$this->session->set_userdata('abha_delete_verification_method',$verify_by);
					$this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/verifyDeleteOtp');
				  break;
				}
            }
            else if($response_code=="401")
            {
                $message=$data['description'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile'); 
            }
            else
            {
			    if(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
				elseif(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
				elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
				else
				{
                    $message="Session expired";
				}
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/abhaProfile'); 
            }
           
		}
        
		    $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/delete-account', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function verifyDeleteOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		    $delete_reason=$this->input->post('delete_reason');
		    
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/account/verify";
            
            $verify_by=$this->session->userdata('abha_delete_verification_method');
            
            $data=array("scope" => array("abha-profile","delete"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)),"reasons" => array($delete_reason));
            
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
	        $abhaXToken=$this->session->userdata('abhaXToken');
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/abhanumberverification');
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyDeleteOtp');  
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                
				$this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyDeleteOtp');    
            }
            
		}

        $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-delete-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function reactivateAccount()
    {
	    if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $verify_by=$this->input->post('verify_by');
		    $abha_data=$this->input->post('abha_data');

            $encryptedOutput=getRsaEncryptedOutput($abha_data);
            
            switch($verify_by)
            {
                case "aadhar_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/login/request/otp";
					
                    $data=array("scope" => array("abha-login","aadhaar-verify","re-activate"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "aadhaar");
                break;
				
                case "abha_otp":
          
                    $url=ABHA_BASE_URL."/v3/profile/login/request/otp";
					
                    $data=array("scope" => array("abha-login","mobile-verify","re-activate"),"loginHint" => "abha-number","loginId" => $encryptedOutput,"otpSystem" => "abdm");
                break;
                
                    
                case "password":
                    $abha_number=$this->input->post('abha_number');
                
                    $url=ABHA_BASE_URL."/v3/profile/login/verify";
					
                    $data=array("scope" => array("abha-login","password-verify","re-activate"),"authData" => array("authMethods" => array("password"),"password" => array("ABHANumber" => "91-4404-0551-2540","password" => "Shubhra#@12")));

                break;
            }
               
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
            $accessToken=getAccessToken();
			$abhaXToken=$this->session->userdata('abhaXToken');
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);

        	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
			    switch($verify_by)
				{
				  case "password":
				    $authResult=$data['authResult'];
					if($authResult=='success')
					{
					  $message=$data['message'];
					  $this->session->set_flashdata('success',$message);
					  redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
					}
					else
					{
					    if(isset($data['password']))
						{
							$message=$data['password'];
						}
						elseif(isset($data['newPassword']))
						{
							$message=$data['newPassword'];
						}
						elseif(isset($data['scope']))
						{
							$message=$data['scope'];
						}
						elseif(isset($data['authMethods']))
						{
							$message=$data['authMethods'];
						}
						elseif(isset($data['message']))
						{
							$message=$data['message'];
						}
						$this->session->set_flashdata('error',$message);
						redirect(base_url().'admin/abhavalidation/reactivateAccount'); 
					}
					
				  break;
				  
				  default:
					$transactionId=$data['txnId'];
					$message=$data['message'];
					$this->session->set_userdata('abha_reactivation_verification_method',$verify_by);
					$this->session->set_userdata('abhaTransactionId',$transactionId);
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/verifyReactivateOtp'); 
				  break;
				}
            }
            else if($response_code=="401")
            {
                $message=$data['description'];
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/reactivateAccount');  
            }
            else
            {
			    if(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
				elseif(isset($data['loginId']))
                {
                    $message=$data['loginId'];
                }
				elseif(isset($data['loginHint']))
                {
                    $message=$data['loginHint'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
				elseif(isset($data['authMethods']))
				{
					$message=$data['authMethods'];
				}
				elseif(isset($data['password']))
				{
					$message=$data['password'];
				}
				elseif(isset($data['newPassword']))
				{
					$message=$data['newPassword'];
				}
				else
				{
                    $message="Session expired";
				}
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/reactivateAccount');  
            }
           
		}
		
        $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/reactivate-account', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function verifyReactivateOtp()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $abha_otp=$this->input->post('abha_otp');
		   
            $abhaTransactionId=$this->session->userdata('abhaTransactionId');
		   
            $encryptedOutput=getRsaEncryptedOutput($abha_otp);
            
            $url=ABHA_BASE_URL."/v3/profile/login/verify";
            
            $verify_by=$this->session->userdata('abha_reactivation_verification_method');
            
            switch($verify_by)
            {
                case "aadhar_otp":
                    $data=array("scope" => array("abha-login","aadhaar-verify","re-activate"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
            				
                case "abha_otp":
                    $data=array("scope" => array("abha-login","mobile-verify","re-activate"),"authData" => array("authMethods" => array("otp"),"otp" => array("txnId" => $abhaTransactionId,"otpValue" => $encryptedOutput)));
                break;
            }
            
                
            $random_request_id=generateRequestId();
               
            //date_default_timezone_set('Asia/Kolkata');
			$timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
   
            $accessToken=getAccessToken();
            
            $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
        	$response=callAbhaAPI('POST',$url,$headerSet,$data);
        	
           	$response_code=$response['response_code'];
            $response_body=$response['response_body'];
            $data = json_decode($response_body, true);
            
            if($response_code=="200")
            {
                $authResult=$data['authResult'];
                if($authResult=='success')
                {
                    $transactionId=$data['txnId'];
                    $message=$data['message'];
                    $this->session->set_flashdata('success',$message);
					redirect(base_url().'admin/abhavalidation/abhanumberverification'); 
                }
                else
                {
                    $message=$data['message'];
                    $this->session->set_flashdata('error',$message);
                    redirect(base_url().'admin/abhavalidation/verifyReactivateOtp');   
                }
            }
            else
            {
                if(isset($data['txnId']))
                {
                    $message=$data['txnId'];
                }
                elseif(isset($data['otpValue']))
                {
                    $message=$data['otpValue'];
                }
                elseif(isset($data['scope']))
                {
                    $message=$data['scope'];
                }
                elseif(isset($data['authMethods']))
                {
                    $message=$data['authMethods'];
                }
                elseif(isset($data['description']))
                {
                    $message=$data['description'];
                }
				elseif(isset($data['message']))
                {
                    $message=$data['message'];
                }
                
				$this->session->set_flashdata('error',$message);
                redirect(base_url().'admin/abhavalidation/verifyReactivateOtp');     
            }
            
		}

        $this->session->set_userdata('top_menu', '');
			$this->session->set_userdata('sub_menu', '');
			$role                        = $this->customlib->getStaffRole();
			$role_id                     = json_decode($role)->id;
			$staffid                     = $this->customlib->getStaffID();
			$notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
			$data['notifications']       = $notifications;
			$systemnotifications         = $this->notification_model->getUnreadNotification();
			$data['systemnotifications'] = $systemnotifications;
		
			//$data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        //$data['sqlMode']      = $this->setting_model->getSqlMode();
        //$data['jsonarr']      = $jsonarr;
				
		
			$this->load->view('layout/header', $data);
			$this->load->view('admin/abha/verify-reactivate-otp', $data);
			$this->load->view('layout/footer', $data);
    }
	
	public function logout()
    {
        $url=ABHA_BASE_URL."/v3/profile/account/request/logout";
        
        $abhaXToken=$this->session->userdata('abhaXToken');
		   
        $random_request_id=generateRequestId();
               
		$timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
        $accessToken=getAccessToken();
            
        $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken","X-token:Bearer $abhaXToken");
        $response=callAbhaAPI('GET',$url,$headerSet);
        
        $response_code=$response['response_code'];
        $response_body=$response['response_body'];
        $data = json_decode($response_body, true);
        
        if($response_code=="200")
        {
            $message=$data['message'];
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'admin/abhavalidation/abhanumberverification');
        }
        else
        {
            $message=$data['message'];
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'admin/abhavalidation/abhaprofile');
        }
    }
    
    public function abhaRegisterWithAdhar()
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
        $this->load->view('admin/register/abha-register-with-adhar', $data);
        $this->load->view('layout/footer', $data);
    }
}

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Abhacreate extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->config->load("payroll");
        $this->config->load("mailsms");
        $this->notification            = $this->config->item('notification');
        $this->notificationurl         = $this->config->item('notification_url');
        $this->yesno_condition         = $this->config->item('yesno_condition');
        $this->patient_notificationurl = $this->config->item('patient_notification_url');
        $this->search_type             = $this->config->item('search_type');
        $this->load->helper(array('form', 'url'));
        $this->load->library('mailsmsconf');
        $this->load->library('Enc_lib');
        $this->load->library('datatables');
        $this->load->library('system_notification');
        $this->load->model(array('appoint_priority_model', 'onlineappointment_model', 'transaction_model','conference_model'));
        $this->appointment_status = $this->config->item('appointment_status');
        $this->load->helper('customfield_helper');
        $this->time_format = $this->customlib->getHospitalTimeFormat();
        $this->config->load('image_valid');
        $this->payment_mode = $this->config->item('payment_mode');
        $this->load->model('avha_create');
        session_start();
    }

    public function unauthorized()
    {
        $data = array();
        $this->load->view('layout/header', $data);
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/footer', $data);
    }




   /* public function index()
    {
       

        $data["adhar_no"]  = "45645467";
        $data['txns'] = $this->avha_create->getAlldata();
        $this->load->view('layout/header');
        $this->load->view('admin/abhacreate/index', $data);
        $this->load->view('layout/footer');
    }*/


    public function sendadharotp(){
       if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $timestamp = time();  // Unix timestamp (seconds)
            $microseconds = microtime(true) - $timestamp;
            $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
            $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
            $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
          
          $uuid = bin2hex(random_bytes(16));
          $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
           
           $adhar_no = $this->input->post('adhar_no');
           $encval = $this->rsaEncription($adhar_no);
           $sess_token = $this->genrateSession();
          
         //$adhar_chk = $this->avha_create->checkadhar($adhar_no);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/request/otp',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{ 
            "scope": [
                "abha-enrol"
            ],
            "txnId": "",
            "loginHint": "aadhaar",
            "loginId": "'.$encval.'",
            "otpSystem": "aadhaar"
        } ',
          CURLOPT_HTTPHEADER => array(
            'REQUEST-ID: '.$tuuid,
            'TIMESTAMP: '.$timestamp,
            'Authorization: Bearer '.$sess_token,
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

       //print_r($response);exit;

       $res = json_decode($response);
        if(!empty($res->txnId)){
         $data['date'] = date('Y-m-d');
         $data['sId'] = session_id();
         $data['txnId'] = $res->txnId;
         $data['adhar_no'] = $adhar_no;
         $data['type'] = "adhar";
        /* if(sizeof($adhar_chk)>0){
         $this->avha_create->abhatxnSave($data);
         }else{*/
         $this->avha_create->saveadharData($data);
         //}

        die(json_encode(array("status"=>"1","message"=>$res->message))); 
        }else{
       die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
        }

         }
     }


public function verifyadharotp(){
     if ($this->input->server('REQUEST_METHOD') === 'POST') {
          $timestamp = time();  // Unix timestamp (seconds)
          $microseconds = microtime(true) - $timestamp;
          $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
          $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
          $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
        
        $uuid = bin2hex(random_bytes(16));
        $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
         
          $adhar_no = $this->input->post('adhar_no');
          $val = $this->input->post('otp');
          $mobile = $this->input->post('mobile');
          $encval = $this->rsaEncription($val);
          $sess_token = $this->genrateSession();

         $sId = session_id();
         $txn = $this->avha_create->getabhaTxnId($adhar_no);

       if($txn->txnId != ''){
        $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/enrol/byAadhaar',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "authData": {
              "authMethods": [
                  "otp"
              ],
              "otp": {
                  "timeStamp": "'.$timestamp.'",
                  "txnId": "'.$txn->txnId.'",
                  "otpValue": "'.$encval.'",
                  "mobile": "'.$mobile.'"
              }
          },
          "consent": {
              "code": "abha-enrollment",
              "version": "1.4"
          }
      }',
        CURLOPT_HTTPHEADER => array(
          'REQUEST-ID: '.$tuuid,
          'TIMESTAMP: '.$timestamp,
          'Authorization: Bearer '.$sess_token,
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);

      $res = json_decode($response);
    if(isset($res->error)){
    die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
    }else{
     $data['txnId'] = $res->txnId; 
     $data['firstName'] = $res->ABHAProfile->firstName; 
     $data['lastName'] = $res->ABHAProfile->lastName;
     $data['dob'] = $res->ABHAProfile->dob;
     $data['gender'] = $res->ABHAProfile->gender;
     $data['photo'] = $res->ABHAProfile->photo;
     $data['avha_address'] = $res->ABHAProfile->phrAddress[0];
     $data['avha_no'] = str_replace("-", "", $res->ABHAProfile->ABHANumber);
     $data['districtCode'] = $res->ABHAProfile->districtCode;
     $data['stateCode'] = $res->ABHAProfile->stateCode;
     $data['response'] = $response;
     $data['sId'] = session_id();
     $this->avha_create->abhainfoSave($data);
     $data['ava_no'] = str_replace("-", "", $res->ABHAProfile->ABHANumber); 
     $data['preferredAbhaAddress'] = $res->ABHAProfile->phrAddress[0];
     $this->avha_create->customavaSavedb($data);

      $data['patient_name'] = $res->ABHAProfile->firstName.''.''.$res->ABHAProfile->lastName;
      $data['dob'] = $res->ABHAProfile->dob;
      $data['mobileno'] = $mobile;
      $data['gender'] = $res->ABHAProfile->gender;
      $data['address'] = $res->ABHAProfile->address;
      $this->avha_create->avadataSaveOpd($data);

     die(json_encode(array("status"=>"1","message"=>$res->message))); 
    }
     }else{
    die(json_encode(array("status"=>"0","message"=>"Please send otp again !!")));  
     }
     }
  }



public function verifymobileensendotp(){
   if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
      
        $uuid = bin2hex(random_bytes(16));
         $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
       
        $mobile = $this->input->post('mobile');
        $adhar_no = $this->input->post('adhar_no');
        $encval = $this->rsaEncription($mobile);
        $sess_token = $this->genrateSession();

        $sId = session_id();
        $txn = $this->avha_create->getabhaTxnId($adhar_no);
        
         if($txn->txnId != ''){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/request/otp',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "txnId": "'.$txn->txnId.'",
                "scope": [
                "abha-enrol",
                "mobile-verify"
                ],
                "loginHint": "mobile",
                "loginId": "'.$encval.'",
                "otpSystem": "abdm"
                }',
          CURLOPT_HTTPHEADER => array(
            'REQUEST-ID: '.$tuuid,
            'TIMESTAMP: '.$timestamp,
            'Authorization: Bearer '.$sess_token,
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
       $res = json_decode($response);
       if(!empty($res->txnId)){
         $data['txnId'] = $res->txnId; 
         $data['adhar_no'] = $adhar_no;

        $this->avha_create->abhamobVebtxnSave($data);

        die(json_encode(array("status"=>"1","message"=>$res->message))); 
       }else{
        die(json_encode(array("status"=>"0","message"=>$res->error->message)));  
       }

 }
}
}


public function verifymobileotpverify(){
   if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $timestamp = time();  // Unix timestamp (seconds)
      $microseconds = microtime(true) - $timestamp;
      $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
      $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
      $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
    
      $uuid = bin2hex(random_bytes(16));
       $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
     
      $otp = $this->input->post('otp1');
      $adhar_no = $this->input->post('adhar_no');
      $encval = $this->rsaEncription($otp);
      $sess_token = $this->genrateSession();

      $sId = session_id();
      $txn = $this->avha_create->getabhaTxnId($adhar_no);

      if($txn->txnId != ''){
     $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/auth/byAbdm',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
                "scope": [
                "abha-enrol",
                "mobile-verify"
                ],
                "authData": {
                "authMethods": [
                "otp"
                ],
                "otp": {
                "timeStamp": "'.$timestamp.'",
                "txnId": "'.$txn->txnId.'",
                "otpValue":"'.$encval.'"
              }
            }
          }',
        CURLOPT_HTTPHEADER => array(
          'REQUEST-ID: '.$tuuid,
          'TIMESTAMP: '.$timestamp,
          'Authorization: Bearer '.$sess_token,
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      $res = json_decode($response);
    if(!empty($res->txnId)){

       $data['txnId'] = $res->txnId; 
       $data['adhar_no'] = $adhar_no;

        $this->avha_create->abhamobVebtxnSave($data);

      die(json_encode(array("status"=>"1","message"=>$res->message))); 
     }else{
      die(json_encode(array("status"=>"0","message"=>$res->error->message)));  
     }
    }
    }
  }

public function customavaCreate(){
  if ($this->input->server('REQUEST_METHOD') === 'POST') {
       $timestamp = time();  // Unix timestamp (seconds)
      $microseconds = microtime(true) - $timestamp;
      $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
      $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
      $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
    
      $uuid = bin2hex(random_bytes(16));
       $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);

      $ava_address = $this->input->post('ava_address');
      $adhar_no = $this->input->post('adhar_no');
      //$encval = $this->rsaEncription($otp);
      $sess_token = $this->genrateSession();

      $sId = session_id();
      $txn = $this->avha_create->getabhaTxnId($adhar_no);

     if($txn->txnId != ''){
     $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/enrol/abha-address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
              "txnId":"'.$txn->txnId.'",
              "abhaAddress":"'.$ava_address.'",
              "preferred": 1
          }',
        CURLOPT_HTTPHEADER => array(
          'REQUEST-ID: '.$tuuid,
          'TIMESTAMP: '.$timestamp,
          'Authorization: Bearer '.$sess_token,
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      $res = json_decode($response);
      
      if(isset($res->txnId)){
       $data['txnId'] = $res->txnId; 
       $data['ava_no'] = str_replace("-", "", $res->healthIdNumber); 
       $data['preferredAbhaAddress'] = $res->preferredAbhaAddress;
       $this->avha_create->customavaSavedb($data);
       //die(json_encode(array("status"=>"1","message"=>$res->message)));   
       die(json_encode(array("status"=>"1","message"=>"Abha Address Created Successfully"))); 
     }else{
      die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
     }
  }

}
}


public function sendotpdl(){
  if ($this->input->server('REQUEST_METHOD') === 'POST') {
    $timestamp = time();  // Unix timestamp (seconds)
    $microseconds = microtime(true) - $timestamp;
    $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
    $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
    $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
  
    $uuid = bin2hex(random_bytes(16));
     $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
   
      $mobile = $this->input->post('mobile');
       $encval = $this->rsaEncription($mobile);
       $sess_token = $this->genrateSession();

      $check_mob = $this->avha_create->checkdlmobiledata($mobile);

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/request/otp',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "scope": [
              "abha-enrol",
              "mobile-verify",
              "dl-flow"
          ],
          "loginHint":"mobile",
          "loginId":"'.$encval.'",
          "otpSystem": "abdm"
      }',
        CURLOPT_HTTPHEADER => array(
          'REQUEST-ID: '.$tuuid,
          'TIMESTAMP: '.$timestamp,
          'Authorization: Bearer '.$sess_token,
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
   
   $res = json_decode($response);
    if(!empty($res->txnId)){
       $data['adhar_no'] = $this->input->post('mobile');
       $data['date'] = date('Y-m-d');
       $data['sId'] = session_id();
       $data['txnId'] = $res->txnId;
       $data['type'] = "driving";
      if(sizeof($check_mob)>0){
       $this->avha_create->updatedharData($data); 
      }else{
      $this->avha_create->saveadharData($data);  
      }
    
    die(json_encode(array("status"=>"1","message"=>$res->message))); 
    }else{
     die(json_encode(array("status"=>"0","message"=>$res->message))); 
    }

 }
}


public function sendotpverifydl(){
  if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $timestamp = time();  // Unix timestamp (seconds)
        $microseconds = microtime(true) - $timestamp;
        $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
        $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
        $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
      
      $uuid = bin2hex(random_bytes(16));
      $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
       
        $val = $this->input->post('otp');
        $mobile = $this->input->post('mobile');
        $encval = $this->rsaEncription($val);
        $sess_token = $this->genrateSession();

       $sId = session_id();
       $txn = $this->avha_create->getabhaTxnIddriving($mobile);

     if($txn->txnId != ''){
      $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/auth/byAbdm',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "scope": [
            "abha-enrol",
            "mobile-verify",
            "dl-flow"
        ],
        "authData": {
            "authMethods": [
                "otp"
            ],
            "otp": {
                "timeStamp": "'.$timestamp.'",
                "txnId": "'.$txn->txnId.'",
                "otpValue": "'.$encval.'"
            }
        }
    }',
      CURLOPT_HTTPHEADER => array(
        'REQUEST-ID: '.$tuuid,
        'TIMESTAMP: '.$timestamp,
        'Authorization: Bearer '.$sess_token,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
   $res = json_decode($response);
   //print_r($response);exit;
  if(isset($res->error)){
  die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
  }else{
   $data['response'] = $response;
  $data['txnId'] = $res->txnId;
   $data['mobile'] = $mobile;

   $this->avha_create->abhainfodlresponseSave($data);

   die(json_encode(array("status"=>"1","message"=>$res->message))); 
  }
   }else{
  die(json_encode(array("status"=>"0","message"=>"Please send otp again !!")));  
   }

 }
}



public function avhadrivingenrolment(){
     if ($this->input->server('REQUEST_METHOD') === 'POST') {
          $timestamp = time();  // Unix timestamp (seconds)
          $microseconds = microtime(true) - $timestamp;
          $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
          $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
          $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
        
        $uuid = bin2hex(random_bytes(16));
        $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);

        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['max_width']     = 1024;
        //$config['max_height']    = 768;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

       if ($this->upload->do_upload('fontside')) {
        $uploadData = $this->upload->data();
        $filePath = $uploadData['full_path']; // ✅ make sure this is a string
        $base64String = $this->abha_base_image_string_convert($filePath);
       } else {
        echo "Front Side Upload Error: " . $this->upload->display_errors();
        }

       $this->upload->initialize($config);
      if($this->upload->do_upload('backside')) {
         $uploadData1 = $this->upload->data();
        $filePath1 = $uploadData1['full_path']; // ✅ make sure this is a string
        $base64backphoto = $this->abha_base_image_string_convert($filePath1);
       } else {
        echo "Front Side Upload Error: " . $this->upload->display_errors();
        }



        $val = $this->input->post('dlicence_no');
        $mobile = $this->input->post('mobile');
        $firstName = $this->input->post('firstName');
        $middleName = $this->input->post('middleName');
        $lastName = $this->input->post('lastName');
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $address = $this->input->post('address');
        $state = $this->input->post('state');
        $district = $this->input->post('district');
        $pinCode = $this->input->post('pinCode');
        
          
        //$val = "712202998125";
        $encval = $this->rsaEncription($val);
        $sess_token = $this->genrateSession();

        //$image = $request->file('image');
        //$base64String = $this->abha_base_image_string_convert($data2['front_side']['full_path']);
        //$image1 = $request->file('image1');
        //$base64backphoto = $this->abha_base_image_string_convert_back($data3['back_side']['full_path']);

       //$sId = session_id();
       $txn = $this->avha_create->getabhaTxnIddriving($mobile);
       if($txn->txnId != ''){
       $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://abhasbx.abdm.gov.in/abha/api/v3/enrollment/enrol/byDocument',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "txnId": "'.$txn->txnId.'",
      "documentType": "DRIVING_LICENCE",
      "documentId": "'.$val.'",
      "firstName": "'.$firstName.'",
      "middleName": "'.$middleName.'",
      "lastName": "'.$lastName.'",
      "dob": "'.$dob.'",
      "gender": "'.$gender.'",
      "frontSidePhoto": "'.$base64String.'",
      "backSidePhoto": "'.$base64backphoto.'",
      "address": "'.$address.'",
      "state": "'.$state.'",
      "district": "'.$district.'",
      "pinCode": "'.$pinCode.'",
      "consent": {
        "code": "abha-enrollment",
        "version": "1.4"
      }
    }',
     CURLOPT_HTTPHEADER => array(
        'REQUEST-ID: '.$tuuid,
        'TIMESTAMP: '.$timestamp,
        'Authorization: Bearer '.$sess_token,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
      curl_close($curl);
     $res = json_decode($response);
     //print_r($response);exit;
    if(isset($res->error)){
    //die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
    $data1['msg1'] = $res->error->message;
    $this->session->set_flashdata($data1);
    redirect("admin/abhavalidation/abhaRegisterWithAdhar");
    }elseif(!empty($res->enrolProfile)){
      if(isset($res->enrolProfile->abhaNumber)){
      $ava_no = str_replace("-", "", $res->enrolProfile->abhaNumber);
     }elseif(isset($res->enrolProfile->enrolmentNumber)) {
      $ava_no = str_replace("-", "", $res->enrolProfile->enrolmentNumber);
     }

     $data['firstName'] = $firstName; 
     $data['lastName'] = $lastName;
     $data['dob'] = $dob;
     $data['gender'] = $gender;
     //$data['photo'] = $res->ABHAProfile->photo;
     $data['avha_address'] = $res->enrolProfile->phrAddress[0];
     $data['avha_no'] = $ava_no;
     $data['districtCode'] = $res->enrolProfile->districtCode;
     $data['stateCode'] = $res->enrolProfile->stateCode;
     $data['response'] = $response;
     $data['mobile'] = $res->enrolProfile->mobile;
     $this->avha_create->abhainfodlresponsedlSave($data);


    $data['patient_name'] = $firstName.''.''.$lastName;
    $data['mobileno'] = $res->enrolProfile->mobile;
    //$data['address'] = $res->ABHAProfile->address;
    $this->avha_create->avadataSaveOpd($data);

     
     $data1['msg'] = $res->message;
    $this->session->set_flashdata($data1);
    redirect("admin/abhavalidation/abhaRegisterWithAdhar");
     //die(json_encode(array("status"=>"1","message"=>$res->message))); 
    }else{
    $data1['msg1'] = 'Ops something wrong !!';
    $this->session->set_flashdata($data1);
    redirect("admin/abhavalidation/abhaRegisterWithAdhar");
    //die(json_encode(array("status"=>"0","message"=>"Please send otp again !!")));  
     }
     }
  }
}


public function searchava(){
     if ($this->input->server('REQUEST_METHOD') === 'POST') {
       $avatype = $this->input->post('avatype');
       $ava = $this->input->post('ava');
       $userdata = $this->avha_create->getabhaUserdata($ava);
       if(!is_null($userdata)){
      $this->session->set_flashdata('abha_userdata', $userdata);
      redirect('admin/abdm/hipInitiateLinking');
      }else{
        $data1['msg1'] = 'No data found !!';
       $this->session->set_flashdata($data1);  
      }
  }
}


public function linktokengen(){
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
  $datetime = new DateTime('now', new DateTimeZone('UTC'));
  $timestamp = $datetime->format('Y-m-d\TH:i:s.') . sprintf('%03d', $datetime->format('v')) . 'Z';
  $uuid = bin2hex(random_bytes(16));
  $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
  
  $sess_token = $this->genrateSession();

  $avha_address = $this->input->post('avha_address');
  $avha_no = $this->input->post('avha_no');
  $fname = $this->input->post('fname');
  $lname = $this->input->post('lname');
  $dob = $this->input->post('dob');
  $gender = $this->input->post('gender');
  $name = $fname.''.''.$lname;
 
  $parts = explode('-', $dob);
  $mdob = $parts[2];
  $avha_no = str_replace("-", "", $avha_no);

  $data['avano'] = $this->input->post('avha_no');
  $data['avha_ads'] = $this->input->post('avha_address');
  $data['date'] = date('Y-m-d');

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dev.abdm.gov.in/api/hiecm/v3/token/generate-token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "abhaNumber": "'. $avha_no .'",
      "abhaAddress": "'. $avha_address .'",
      "name": "'. $name .'",
      "gender": "'. $gender .'",
      "yearOfBirth": "'. $mdob .'"
  }',
    CURLOPT_HTTPHEADER => array(
      'REQUEST-ID:'.$tuuid,
      'TIMESTAMP:'.$timestamp,
      'X-HIP-ID: IN0910032862',
      'X-CM-ID: sbx',
      'Authorization: Bearer '.$sess_token,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  //echo $response;exit;
  $res = json_decode($response);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  if($httpCode == '202'){
  $this->avha_create->linktokenUpdate($data);
  die(json_encode(array("status"=>"1","message"=>'Link token has been generated successfully.Valid for 6 months.'))); 
  }elseif(isset($res->error)){
   die(json_encode(array("status"=>"0","message"=>$res->error->message))); 
  }else{
   die(json_encode(array("status"=>"0","message"=>'Ops something wrong !!'))); 
  }

  }
}

























private function abha_base_image_string_convert($filePath){
//$imagePath = 'path/to/your/image.png'; 
$imageData = file_get_contents($filePath);
if ($imageData === false) {
    echo "Failed to read the image file!";
    exit;
}
$base64Image = base64_encode($imageData);
return $base64Image;

}


private function abha_base_image_string_convert_back($file1){
  $imagePath1 = $file1;
  //print_r($image);exit;
//$imagePath = 'path/to/your/image.png'; 
$imageData1 = file_get_contents($imagePath1);
if ($imageData1 === false) {
    echo "Failed to read the image file!";
    exit;
}
$base64Image_back = base64_encode($imageData1);
return $base64Image_back;
}





private function genrateSession(){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://dev.abdm.gov.in/gateway/v0.5/sessions',
  //CURLOPT_URL => 'https://dev.abdm.gov.in/api/hiecm/gateway/v3/sessions',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "clientId": "SBXID_008162",
    "clientSecret": "94a46d01-6e0a-4402-925f-40415f0ea4dc",
    "grantType": "client_credentials"
}
',
  CURLOPT_HTTPHEADER => array(
    'accept: application/json',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$sdata = json_decode($response);

//print_r($response);exit;
 return $sdata->accessToken; 

}


private function rsaEncription($val){
  $public_key ='-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAstWB95C5pHLXiYW59qyO
4Xb+59KYVm9Hywbo77qETZVAyc6VIsxU+UWhd/k/YtjZibCznB+HaXWX9TVTFs9N
wgv7LRGq5uLczpZQDrU7dnGkl/urRA8p0Jv/f8T0MZdFWQgks91uFffeBmJOb58u
68ZRxSYGMPe4hb9XXKDVsgoSJaRNYviH7RgAI2QhTCwLEiMqIaUX3p1SAc178ZlN
8qHXSSGXvhDR1GKM+y2DIyJqlzfik7lD14mDY/I4lcbftib8cv7llkybtjX1Aayf
Zp4XpmIXKWv8nRM488/jOAF81Bi13paKgpjQUUuwq9tb5Qd/DChytYgBTBTJFe7i
rDFCmTIcqPr8+IMB7tXA3YXPp3z605Z6cGoYxezUm2Nz2o6oUmarDUntDhq/PnkN
ergmSeSvS8gD9DHBuJkJWZweG3xOPXiKQAUBr92mdFhJGm6fitO5jsBxgpmulxpG
0oKDy9lAOLWSqK92JMcbMNHn4wRikdI9HSiXrrI7fLhJYTbyU3I4v5ESdEsayHXu
iwO/1C8y56egzKSw44GAtEpbAkTNEEfK5H5R0QnVBIXOvfeF4tzGvmkfOO6nNXU3
o/WAdOyV3xSQ9dqLY5MEL4sJCGY1iJBIAQ452s8v0ynJG5Yq+8hNhsCVnklCzAls
IzQpnSVDUVEzv17grVAw078CAwEAAQ==
-----END PUBLIC KEY-----';

// The plaintext message to encrypt
$data = $val;

    // Load the public key
  $pubkey = openssl_pkey_get_public($public_key);

 /* if (!$pubkey) {
      die('Invalid public key');
  }
*/
    // Encrypt the data using the public key
    $encrypted_data = '';
    if (!openssl_public_encrypt($data, $encrypted_data, $pubkey, OPENSSL_PKCS1_OAEP_PADDING)) {
        die('Encryption failed');
    }

 return base64_encode($encrypted_data);

}

   

}

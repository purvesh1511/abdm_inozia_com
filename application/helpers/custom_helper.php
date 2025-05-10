<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function isJSON($string)
{
    return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function findPrefixType($prefixes, $search_prefix)
{
    foreach ($prefixes as $prefix_key => $prefix_value) {
        if ($prefix_value->prefix == $search_prefix) {
            return $prefix_value->type;
        }
    }
    return false;
}

function splitPrefixID($search)
{
    $search_prefix = preg_replace('/[^0-9]/', '', $search);

    return $search_prefix;
}

function splitPrefixType($search)
{
    $search_prefix = preg_replace('/[^a-zA-Z]/', '', $search);

    return $search_prefix;
}

function chkDuplicate($arr)
{
    $dups = array();
    foreach (array_count_values($arr) as $val => $c) {
        if ($c > 1) {
            $dups[] = $val;
        }
    }

    return $dups;
}

function has_duplicate_array($array)
{
    return count($array) !== count(array_unique($array));
}

function amountFormat($amount)
{
    return number_format((float) $amount, 2, '.', '');
}

function uniqueFileName()
{
    return time() . uniqid(rand());
}

function composePatientName($patient_name, $patient_id)
{
    $name = "";
    if ($patient_name != "") {
        $name = ($patient_id != "") ? $patient_name . " (" . $patient_id . ")" : $patient_name;
    }

    return $name;
}

function composeStaffName($staff)
{
    $name = "";
    if (!empty($staff)) {
        $name = ($staff->surname == "") ? $staff->name : $staff->name . " " . $staff->surname;
    }

    return $name;
}

function composeStaffNameByString($staff_name, $staff_surname, $staff_employeid)
{
    $name = "";
    if ($staff_name != "") {
        $name = ($staff_surname == "") ? $staff_name . " (" . $staff_employeid . ")" : $staff_name . " " . $staff_surname . " (" . $staff_employeid . ")";
    }

    return $name;
}

function calculatePercent($amount, $percent)
{
    $ci = &get_instance();
    $ci->load->helper('custom');
    $percent_amt = 0;
    if ($amount != "") {
        $percent_amt = ($amount * $percent) / 100;
        $percent_amt = amountFormat($percent_amt);
    }
    return $percent_amt;
}

function chat_couter()
{
    $ci = &get_instance();
    return $ci->chatuser_model->getChatUnreadCount();
}

function cal_percentage($first_amount, $secound_amount)
{
    if ($secound_amount > 0) {
        $count1 = $first_amount / $secound_amount;
        $count2 = $count1 * 100;
        $count  = number_format($count2, 2);
    } else {
        $count = 0;
    }

    return $count;
}

function searchForKeyData($id, $array, $find_key)
{
    foreach ($array as $key => $val) {

        if ($val[$find_key] == $id) {
            return $key;
        }
    }
    return null;
}

function rand_color()
{
    $array = array(
        '#267278',
        '#50aed3',
        '#e46031',
        '#65228d',
        '#48b24f',
        '#e4B031',
        '#cad93f',
        '#d21f75',
        '#3b3989',
        '#58595b',
    );
    return $array;
}

function sortInnerData($a, $b)
{
    return $a['total_counts'] < $b['total_counts']?1:-1;
}


function img_time(){
   return "?".time();
}

function random_string($len = 5){
  $string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, $len);
  return $string;
}

if (!function_exists('custom_url')) {

    function custom_url() {

        $CI = &get_instance();
        $session_data=$CI->session->userdata('admin');
        return $session_data['base_url'];
      
    }
}

if (!function_exists('dir_path')) {

    function dir_path() {

        $CI = &get_instance();
        $session_data=$CI->session->userdata('admin');
        return $session_data['folder_path'];
      
    }
}

if (!function_exists('IsNullOrEmptyString')) {

function IsNullOrEmptyString($str){
    return ($str === null || trim($str) === '');
}
}

if (!function_exists('check_report_level_exceed')) {

    function check_report_level_exceed($old_reference_range,$range_from,$range_to,$patient_range) {
        
    if($patient_range == ""){
        return false;
    }
    if(IsNullOrEmptyString($range_from)){
    
        $range=explode('-',$old_reference_range);
        $range_from=trim($range[0]);
        $range_to=trim($range[1]);
    }

    $range_to= IsNullOrEmptyString($range_to) ? $range_from : $range_to;

    if ($range_from <= $patient_range && $range_to >= $patient_range) {
      return false;
    }
      return true;
      
    }
}




//**************** ABHA M1 Helpers Starts *****************//

function generateRequestId() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}


function callAbhaAPI($method, $url, $headers, $data = false)
{
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	switch($method)
	{
	    case "POST":
	        $payload=json_encode($data);
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);	        
	    break;
	    
	    case "PATCH":
	        $payload=json_encode($data);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);	
	    break;
	}
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
	curl_close($ch); 
	$returnData=array('response_code' => $httpcode,'response_body' => $body);
	return $returnData;
}


function generateNewAccessToken()
{
    $url="https://dev.abdm.gov.in/api/hiecm/gateway/v3/sessions";
        
    $data=array("clientId" => "SBXID_008162","clientSecret" => "94a46d01-6e0a-4402-925f-40415f0ea4dc","grantType" => "client_credentials");
        
    $random_request_id=generateRequestId();
    $XCMID=ABHA_XCMID;
       
    $timestamp = time();  // Unix timestamp (seconds)
    $microseconds = microtime(true) - $timestamp;
    $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
    $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
    $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
    $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","X-CM-ID:$XCMID");
	$response=callAbhaAPI('POST',$url,$headerSet,$data);
	
	$response_code=$response['response_code'];
    $response_body=$response['response_body'];
    $data = json_decode($response_body, true);
    $accessToken=$data['accessToken'];
    return $accessToken;
}


function getAccessToken()
{
    /*$ci = &get_instance();
    if($ci->session->userdata('accessToken')=='')
    {
        $accessToken=generateNewAccessToken();
		$ci->session->set_userdata('accessToken',$accessToken);
    }
    else
    {
        $accessToken=$ci->session->userdata('accessToken');
    }*/
    $accessToken=generateNewAccessToken();
    return $accessToken;
}

function getRsaPublicKey()
{
    $ci = &get_instance();
    $accessToken=$ci->session->userdata('accessToken');
            
    $random_request_id=generateRequestId();
            
    $cDateTime=date('Y-m-d H:i:s');
        
    //$url="https://healthidsbx.abdm.gov.in/api/v1/auth/cert";
    $url=ABHA_BASE_URL."/v3/profile/public/certificate";
        
    $random_request_id=generateRequestId();
               
    //date_default_timezone_set('Asia/Kolkata');
	$timestamp = time();  // Unix timestamp (seconds)
    $microseconds = microtime(true) - $timestamp;
    $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
    $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
    $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds).'Z';
    
    $accessToken=getAccessToken();
            
    $headerSet=array("Content-Type:application/json","REQUEST-ID:$random_request_id","TIMESTAMP:$timestamp","Authorization:Bearer $accessToken");
    
    $response=callAbhaAPI('GET',$url,$headerSet);

    $response_code=$response['response_code'];
    $response_body=$response['response_body'];
    $data = json_decode($response_body, true);
    $rsaPublicKey=$data['publicKey'];
    
    return $rsaPublicKey;
}

function getRsaEncryptedOutput($textToEnc)
{
    $url="https://www.devglan.com/online-tools/rsa-encrypt";
    $publicKey=getRsaPublicKey();

    $data=array("cipherType" => "RSA/ECB/OAEPWithSHA-1AndMGF1Padding","keyType" => "publicKeyForEncryption","publicKey" => $publicKey,"textToEncrypt" => $textToEnc);

    $headerSet=array("Content-Type:application/json");
    $response=callAbhaAPI('POST',$url,$headerSet,$data);
    
    $response_code=$response['response_code'];
    $response_body=$response['response_body'];
    
    $data = json_decode($response_body, true);
    return $data['encryptedOutput'];
}

//*************** ABHA M1 Helpers Ends ******************//
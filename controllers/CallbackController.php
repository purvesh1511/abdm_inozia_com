<?php

class CallbackController extends CI_Controller
{

    public function __construct($key = "")
    {
        parent::__construct();
        $this->load->model('callback_avdm');
    }



  public function generate_link_token(){
     if ($this->input->server('REQUEST_METHOD') === 'POST') {
   //echo 'Success';   
  $data = file_get_contents('php://input');
  $res = json_decode($data);
  if(isset($res->linkToken)){
    //$res = json_decode($data);
    $rdata['ava_address'] = $res->abhaAddress;
    $rdata['link_token'] = $res->linkToken;
    $rdata['date'] = date('Y-m-d');
    $rdata['type'] = "link-token";
    $rdata['response'] = $data;
   $this->callback_avdm->saveLinktoken($rdata);
   }
  echo 'Success';
 }

}


public function webhook_on_carecontext(){
   if ($this->input->server('REQUEST_METHOD') === 'POST') {
  $data = file_get_contents('php://input');
  $res = json_decode($data);
  if(!empty($res->abhaAddress)){
    $rdata['requestId'] = $res->response->requestId;
    $rdata['ava_address'] = $res->abhaAddress;
    $rdata['date'] = date('Y-m-d');
    $rdata['type'] = "link-care-context";
    $rdata['response'] = $data;
   $this->callback_avdm->savecontextsingleData($rdata);

   }else{
  $rdata['response'] = $data;
   $this->callback_avdm->savecontextsingleData($rdata);
 }
 echo 'Success';
}
}


public function  hiu_on_consent_notify(){
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
  $data = file_get_contents('php://input');
  if(!empty($data)){
    $rdata['response'] = $data;
   $this->callback_avdm->saveconsentnotifyData($rdata);

   }
  echo 'Success';
 }

}

public function links_context_on_notify(){
    if($this->input->server('REQUEST_METHOD') === 'POST') {
  $data = file_get_contents('php://input');
  if(!empty($data)){
    $rdata['response'] = $data;
   $this->callback_avdm->saveonNotifycarecontext($rdata);
   }
  echo 'Success';
 }
}



































}
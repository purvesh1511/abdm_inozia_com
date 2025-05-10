<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Callback_avdm extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

    }


   public function saveLinktoken($data) {
        $this->db->insert('call_back_response', $data);
        return $this->db->insert_id(); 
    }
  public function savecontextsingleData($data) {
        $this->db->insert('call_back_response', $data);
        return $this->db->insert_id(); 
    }

 public function saveconsentnotifyData($data) {
        $this->db->insert('call_back_response', $data);
        return $this->db->insert_id(); 
    }
 
public function saveonNotifycarecontext($data){
     $this->db->insert('call_back_response', $data);
        return $this->db->insert_id(); 
}








}
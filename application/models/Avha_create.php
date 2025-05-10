<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Avha_create extends MY_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  protected $table = 'avha_data';
  protected $allowedFields = ['date', 'adhar_no', 'avha_no', 'avha_address'];

 public function saveadharData($data) {
        $this->db->insert('avha_data', $data);
        return $this->db->insert_id(); 
   }

public function avadataSaveOpd($data) {
        $this->db->insert('patients', $data);
        return $this->db->insert_id(); 
   }

public function customavaSavedb($data) {
      $this->db->insert('custom_ava', $data);
      return $this->db->insert_id(); 
 }

public function getabhaTxnallData() {
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
}

public function getabhaTxnId($adhar_no) {
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('adhar_no',$adhar_no);
   $qresult = $this->db->get();
   $result = $qresult->row();
   return $result;
}

public function abhamobVebtxnSave($data) {
  $this->db->set('txnId',$data['txnId']);
  $this->db->order_by('id','desc');
  $this->db->where('adhar_no',$data['adhar_no']);
  $this->db->update('avha_data');
}


public function getabhaTxnIddriving($mobile){
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('adhar_no',$mobile);
   $qresult = $this->db->get();
   $result = $qresult->row();
   return $result;
}


 public function abhainfoSave($data){
  $this->db->set('txnId',$data['txnId']);
  $this->db->set('firstName',$data['firstName']);
  $this->db->set('lastName',$data['lastName']);
  $this->db->set('dob',$data['dob']);
  $this->db->set('gender',$data['gender']);
  $this->db->set('photo',$data['photo']);
  $this->db->set('avha_address',$data['avha_address']);
  $this->db->set('avha_no',$data['avha_no']);
  $this->db->set('districtCode',$data['districtCode']);
  $this->db->set('stateCode',$data['stateCode']);
  $this->db->set('response',$data['response']);
  $this->db->where('sId',$data['sId']);
  $this->db->update('avha_data');
  }


  public function abhainfodlresponseSave($data){
  $this->db->set('response',$data['response']);
  $this->db->order_by('id','desc');
  //$this->db->where('adhar_no',$data['mobile']);
  $this->db->update('avha_data');
  }


  public function abhainfodlresponsedlSave($data){
    $this->db->set('firstName',$data['firstName']);
    $this->db->set('lastName',$data['lastName']);
    $this->db->set('dob',$data['dob']);
    $this->db->set('gender',$data['gender']);
    $this->db->set('avha_address',$data['avha_address']);
    $this->db->set('avha_no',$data['avha_no']);
    $this->db->set('districtCode',$data['districtCode']);
    $this->db->set('stateCode',$data['stateCode']);
    $this->db->set('response',$data['response']);
    $this->db->order_by('id','desc');
    $this->db->where('adhar_no',$data['mobile']);
    $this->db->update('avha_data');
  }





 public function abhacardfolderSave($data){
  $this->db->set('image_path',$data['image_path']);
   $this->db->order_by('id','desc');
  $this->db->where('avha_address',$data['avha_address']);
  $this->db->update('avha_data');

 }

 public function getUsers($limit, $start, $search, $orderColumn, $orderDir) {
       /* $query = $this->db->table($this->table)
            ->select('date, adhar_no, avha_no, avha_address');

        if (!empty($search)) {
            $query->groupStart()
                ->like('adhar_no', $search)
                ->orLike('avha_no', $search)
                ->orLike('avha_address', $search)
                ->groupEnd();
        }
       
        $query->orderBy($orderColumn, $orderDir);
        return $query->limit($limit, $start)->get()->getResult();*/
        $this->db->select('*');
       $this->db->from('avha_data');
       $this->db->order_by('id','desc');
       $qresult = $this->db->get();
       $result = $qresult->result();
       return $result;
    }

    // Count total records after filtering
    public function countFiltered($search) {
        $query = $this->db->table($this->table);

        if (!empty($search)) {
            $query->groupStart()
                ->like('adhar_no', $search)
                ->orLike('avha_no', $search)
                ->orLike('avha_address', $search)
                ->groupEnd();
        }

        return $query->countAllResults();
    }

    // Count all users (before filtering)
    public function countAllUsers() {
        return $this->countAll();
    }


  public function getAlldata() {
        $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('type','adhar');
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
    }


public function getdrivingAlldata() {
        $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('type','driving');
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
    }


public function getabhatokenwithadds($avadds){
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('avha_address',$avadds);
   $qresult = $this->db->get();
   $result = $qresult->row();
   return $result;
}

public function saveatxnFormobileup($data){
  $this->db->set('txnId',$data['txnId']);
  $this->db->where('avha_address',$data['avha_address']);
  $this->db->update('avha_data');
}


public function checkadhar($adhar_no){
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('adhar_no',$adhar_no);
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
}


public function abhatxnSave($data){
  $this->db->set('txnId',$data['txnId']);
   $this->db->set('date',$data['date']);
   $this->db->order_by('id','desc');
  $this->db->where('adhar_no',$data['adhar_no']);
  $this->db->update('avha_data');
}


public function getabhaTxnIdmobUpdate($avha_address){
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('avha_address',$avha_address);
   $qresult = $this->db->get();
   $result = $qresult->row();
   return $result;
}



public function getAllbridgedata(){
    $this->db->select('*');
   $this->db->from('bridge_service');
   $this->db->order_by('id','desc');
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
 }


public function bridgeRegter($data) {
        $this->db->insert('bridge_service', $data);
        return $this->db->insert_id(); 
   }


public function checkhiptokenrepeate($data){
   $this->db->select('*');
   $this->db->from('hip_link_token');
   $this->db->order_by('id','desc');
   $this->db->where('ava_no',$data['ava_no']);
   $this->db->where('fac_id',$data['fac_id']);
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
}


public function hiplinktokensave($data) {
        $this->db->insert('hip_link_token', $data);
        return $this->db->insert_id(); 
   }

/*public function hiplinktokensaveupdate($data){
  $this->db->set('txnId',$data['txnId']);
  $this->db->set('date',$data['date']);
  $this->db->order_by('id','desc');
  $this->db->where('adhar_no',$data['adhar_no']);
  $this->db->update('avha_data');
}*/

public function checkdlmobiledata($mobile){
   $this->db->select('*');
   $this->db->from('avha_data');
   $this->db->order_by('id','desc');
   $this->db->where('adhar_no',$mobile);
   $qresult = $this->db->get();
   $result = $qresult->result();
   return $result;
}

public function updatedharData($data){
  $this->db->set('txnId',$data['txnId']);
  $this->db->set('date',$data['date']);
  $this->db->order_by('id','desc');
  $this->db->where('adhar_no',$data['adhar_no']);
  $this->db->update('avha_data');
}


public function getabhaUserdata($ava){
  $this->db->select('*');
  $this->db->from('avha_data');
  $this->db->where('avha_no', $ava);
  $this->db->or_where('avha_address', $ava);
  $this->db->order_by('id', 'desc');
  $query = $this->db->get();
  return $query->row();
}

public function linktokenUpdate($data){
    $this->db->set('link_token_status', 1);
    $this->db->set('link_date', $data['date']);
    $this->db->group_start(); 
    $this->db->where('avha_no', $data['avano']);
    $this->db->or_where('avha_address', $data['avha_ads']);
    $this->db->group_end(); 
    $this->db->order_by('id', 'desc');
    $this->db->update('avha_data');

}


public function linkTokenget($ava_adds){
   $this->db->select('*');
   $this->db->from('call_back_response');
   $this->db->order_by('id','desc');
   $this->db->where('ava_address',$ava_adds);
   $qresult = $this->db->get();
   $result = $qresult->row();
   return $result;
}

public function linkcarecontextstatusUpdate($ava_adds){
  $this->db->set('link_care_context_status',1);
  $this->db->order_by('id','desc');
  $this->db->where('avha_address',$ava_adds);
  $this->db->update('avha_data');
}














 

}
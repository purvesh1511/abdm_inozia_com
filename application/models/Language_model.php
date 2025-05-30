<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Language_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('languages');
        $this->db->order_by('created_at', 'desc');
        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    public function get($id = null)
    {
        $this->db->select()->from('languages');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('language asc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function set_userlang($id, $data)
    {        
        $this->db->where('id', $id);
        $this->db->update('staff', $data);       
        return $record_id;        
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('languages');
        $message = DELETE_RECORD_CONSTANT . " On Languages id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $record_id;
        }
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('languages', $data);
            $message = UPDATE_RECORD_CONSTANT . " On Languages id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
        } else {
            $this->db->insert('languages', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On Languages id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
        }
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $record_id;
        }
    }

    public function valid_check_exists($str)
    {
        $language = $this->input->post('language');
        $id       = $this->input->post('id');
        if (!isset($id) && $id == "") {
            $id = 0;
        }
        if ($this->check_data_exists($language, $id)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return false;
        } else {
            return true;
        }
    }

    public function check_data_exists($name, $id)
    {
        $this->db->where('language', $name);
        $this->db->where('id !=', $id);
        $query = $this->db->get('languages');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getEnable_languages()
    {
        $languages_id = $this->db->select('languages')->from('sch_settings')->get()->row_array();
        $query        = $this->db->select()->from('languages')->where_in('id', json_decode($languages_id['languages']))->get()->result_array();
        return $query;
    }

    public function set_patientlang($id, $data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->update('patients', $data);        
        $message = UPDATE_RECORD_CONSTANT . " On Patients id " . $id;
        $action = "Update";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $record_id;
        }
            
    }
}

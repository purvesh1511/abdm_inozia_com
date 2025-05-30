<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Biometric extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('json_output');
        $this->load->model('setting_model');      
        $this->load->model('staff_model');
    }

    public function index()
    {
        $method = $this->input->server('REQUEST_METHOD');
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $attendence_param = file_get_contents('php://input');
            $params           = json_decode(file_get_contents('php://input'), true);
            $settings         = $this->setting_model->getHospitalDetail();

            if ($settings->biometric) {
                $total_devices = array_map('trim', explode(",", $settings->biometric_device));
                if (!empty($params)) {
                    if ($params['serial_number']) {
                        if (in_array($params['serial_number'], $total_devices)) {
                            $record_data = $this->staff_model->getStaffId($params['user_id']);
 
                            if ($record_data) {
                                
                                       $insert_record = array(
                                        'date'                  => date('Y-m-d', strtotime($params['t'])),
                                        'staff_id'               => $record_data['id'],
                                        'staff_attendance_type_id'    => 1,
                                        'biometric_attendence'  => 1,
                                        'remark'                => '',
                                        'created_at'            => $params['t'],
                                        'biometric_device_data' => $attendence_param,
                                    );
                                    $insert_result = $this->staffattendancemodel->onlineattendence($insert_record);

                                

                                if ($insert_result) {
                                    json_output(200, array('status' => 200, 'message' => 'Attendance submitted'));
                                } else {
                                    json_output(200, array('status' => 200, 'message' => 'Attendance already submitted'));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Handles attendance logging and SMS notification triggers
class Attendance extends CI_Controller
{
    public string $user_id;
    public string $time_interval;
    public string $date;
    public string $time;
    public array $user_information;
    public string $sms_type;
    public string $attendance_id;
    public string $timeIntervalMessage;

    public function __construct()
    {
        // Initialize date, time, and interval settings for attendance validation
        parent::__construct();
        $this->load->model('Attendance_model', 'attendance');
        $this->date = date('Y-m-d');
        $this->time = date('H:i');
        $this->time_interval = $GLOBALS['TIME_INTERVAL'];
        $this->timeIntervalMessage = "LOGIN or LOGOUT interval must be " . $GLOBALS['TIME_INTERVAL'] . " minutes";
    }

    public function index()
    {
        if($this->session->userdata('access') != 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Attendance';
        $data['url'] = 'attendance';

        // Get current attendance records
        $data['attendance_records'] = $this->attendance->get();

        $this->load->view('admin-header', $data);
        $this->load->view('attendance/index');
        $this->load->view('admin-footer');
        $this->load->view('attendance/js-script');

    }

    // Main RFID tap handler for gate (auto login/logout detection)
    public function create()
    {
        $rfid = $this->input->post('rfidno');

        // Check if RFID exists in the system
        if($this->attendance->rfid_exist($rfid) == false) {
            redirect('gate', 'refresh');
        }

        $this->user_information = $this->attendance->rfid_exist($rfid);

        // Get the user information
        $this->user_id = $this->user_information['id'];

        // Check if the user has entry or logs for current date
        $attendance_exist = $this->attendance->attendance_exist();

        if($attendance_exist === false) {
            $login = $this->attendance->save_login();
            if($login) {
                $this->sms_type = 1; //  Set SMS type to IN.
                $this->attendance_id = $login;
                // Add sms notification queue after attendance is recorded.
                $this->attendance->save_sms_notification($this->sms_type);
            }

        } else {
            if($attendance_exist['type'] == '2') {
                $this->sms_type = 1; //  Set SMS type to IN.
                $this->attendance_id = $attendance_exist['id'];
                $logout_time = $attendance_exist['logout'];

                // Prevent  multiple login/logout within the restricted time interval
                if($this->time_interval($this->time, $logout_time) === true) {
                    $login = $this->attendance->save_login();
                    if($login) {
                        $this->attendance_id = $login;
                        $this->attendance->save_sms_notification($this->sms_type);
                    }

                }
            } else {
                $this->sms_type = 2; // Set SMS type to OUT.
                $login_time = $attendance_exist['login'];
                $this->attendance_id = $attendance_exist['id'];
                if($this->time_interval($this->time, $login_time) === true) {
                    $this->attendance->save_logout();
                    $this->attendance->save_sms_notification($this->sms_type);
                }
            }
        }

        // Save attendance logs if not already added
        if(!$this->attendance->current_log_check()) {
            $this->attendance->save_logs();
        }
        redirect('gate', 'refresh');
    }


    // RFID tap handler for entrance
    public function entrance()
    {
        $rfid = $this->input->post('rfidno');

        if($this->attendance->rfid_exist($rfid) == false) {
            redirect('entrance', 'refresh');
        }

        $this->user_information = $this->attendance->rfid_exist($rfid);

        $this->user_id = $this->user_information['id'];

        $attendance_exist = $this->attendance->attendance_exist();
        $this->sms_type = 1;

        if($attendance_exist === false) {
            $login = $this->attendance->save_login();

            if($login) {
                $this->attendance_id = $login;
                $this->attendance->save_sms_notification($this->sms_type);
            }

        } else {
            if($attendance_exist['type'] == '2') {
                $this->attendance_id = $attendance_exist['id'];
                $logout_time = $attendance_exist['logout'];
                if($this->time_interval($this->time, $logout_time) === true) {
                    $login = $this->attendance->save_login();
                    if($login) {
                        $this->attendance_id = $login;
                        $this->attendance->save_sms_notification($this->sms_type);
                    }
                } else {
                    $this->session->set_flashdata('timeInterval', $this->timeIntervalMessage);
                }
            } else {

                $login_time = $attendance_exist['login'];

                $this->attendance_id = $attendance_exist['id'];

                if($this->time_interval($this->time, $login_time) === true) {
                    $login = $this->attendance->save_login();
                    if($login) {
                        $this->attendance_id = $login;
                        $this->attendance->save_sms_notification($this->sms_type);
                    }
                } else {
                    $this->session->set_flashdata('timeInterval', $this->timeIntervalMessage);
                }
            }
        }

        if(!$this->attendance->current_log_check()) {
            $this->attendance->save_logs($this->sms_type);
        }
        redirect('entrance', 'refresh');
    }


    // RFID tap handler for entrance
    public function exit()
    {
        $rfid = $this->input->post('rfidno');

        if($this->attendance->rfid_exist($rfid) == false) {
            redirect('exit', 'refresh');
        }

        $this->user_information = $this->attendance->rfid_exist($rfid);

        $this->user_id = $this->user_information['id'];

        $attendance_exist = $this->attendance->attendance_exist();

        $this->sms_type = 2;

        if($attendance_exist === false) {
            $logout = $this->attendance->save_logout_exit();

            if($logout) {
                $this->attendance_id = $logout;
                $this->attendance->save_sms_notification($this->sms_type);
            }

        } else {
            if($attendance_exist['type'] == '2') {
                $this->attendance_id = $attendance_exist['id'];
                $logout_time = $attendance_exist['logout'];
                if($this->time_interval($this->time, $logout_time) === true) {
                    $logout = $this->attendance->save_logout_exit();
                    if($logout) {
                        
                        $this->attendance_id = $logout;
                        $this->attendance->save_sms_notification($this->sms_type);
                    }
                } else {
                    $this->session->set_flashdata('timeInterval', $this->timeIntervalMessage);
                }
            } else {
                $login_time = $attendance_exist['login'];
                $this->attendance_id = $attendance_exist['id'];

                if($this->time_interval($this->time, $login_time) === true) {
                    $this->attendance->save_logout();
                    $this->attendance->save_sms_notification($this->sms_type);
                } else {
                    $this->session->set_flashdata('timeInterval', $this->timeIntervalMessage);
                }
            }
        }

        if(!$this->attendance->current_log_check()) {
            $this->attendance->save_logs($this->sms_type);
        }
        redirect('exit', 'refresh');
    }

    // Check if the required time interval has passed between scans
    public function time_interval($current_time, $recorded_time)
    {
        $current_time_convert = strtotime($current_time);
        $recorded_time_convert = strtotime($recorded_time);
        $interval = ($current_time_convert - $recorded_time_convert) / 60;

        if($interval > $this->time_interval) {
            return true;
        } else {
            return false;
        }
    }
}

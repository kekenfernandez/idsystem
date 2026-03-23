<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cron_model', 'cron');
        $this->load->model('Attendance_model', 'attendance');
        $this->load->model('Sms_model', 'sms');
    }

    public function execute()
    {
        $this->cron->delete_logs();
        $this->cron->delete_sms();
        die();
    }

    public function daily_report()
    {
        $date = date('Y-m-d');
        $filename = 'Report_' . $date .'.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/force-download; ");
        // get data
        $data = $this->cron->get_daily_attendance();

        // file creation
        $file = fopen('php://output', 'w');

        $header = array("Name", "Grade", "Section", "Login", "Logout", "Role" ,"Date");
        fputcsv($file, $header);
        foreach ($data as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function sms_alert() {
        
        $data = array(
            'login' => $this->attendance->count_login(),
            'logout' => $this->attendance->count_logout(),
            'sent' => $this->sms->count(1),
            'sending' => $this->sms->count(0)
        );
        
        $this->cron->create_sms($data);
        die();
    }
}
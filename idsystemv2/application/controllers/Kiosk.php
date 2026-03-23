<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kiosk extends CI_Controller
{
    public string $date;

    public function __construct()
    {
        parent::__construct();
        $this->date = date('Y-m-d');
        $this->load->model('Logs_model', 'logs');
    }

    public function index()
    {
        $this->load->view('kiosk/index');
    }

    // Auto login or logout
    // For single kiosk
    public function gate()
    {
        $data['page_title'] = 'MULTI-GATE';

        $recents = $this->logs->recent();
        $current = array_shift($recents);

        $data['recents'] = $recents;
        $data['current'] = $current;

        if($data['current'] == null) {
            $data['current'] = array(
                'full_name' => '-----',
                'login' => '-----',
                'logout' => '-----',
                'date' => '-----',
                'image' => '------'
            );
        }

        $this->load->view('kiosk/main', $data);
    }

    // For Entrance only kiosks
    public function entrance()
    {
        $data['page_title'] = 'ENTRANCE';

        $recents = $this->logs->get_recent_entrance();
        $current = array_shift($recents);

        $data['recents'] = $this->logs->get_login();
        $data['current'] = $current;

        if($data['current'] == null) {
            $data['current'] = array(
                'full_name' => '-----',
                'login' => '-----',
                'logout' => '-----',
                'date' => '-----',
                'image' => '------'
            );
        }
        $this->load->view('kiosk/entrance', $data);
    }

    // For Exit only kioks
    public function exit()
    {
        $data['page_title'] = 'EXIT';

        $recents = $this->logs->get_recent_exit();
        $current = array_shift($recents);

        $data['recents'] = $this->logs->get_logout();
        $data['current'] = $current;

        if($data['current'] == null) {
            $data['current'] = array(
                'full_name' => '-----',
                'login' => '-----',
                'logout' => '-----',
                'date' => '-----',
                'image' => '------'
            );
        }
        $this->load->view('kiosk/exit', $data);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_ctrl extends CI_Controller {

	public function index()
	{
		$this->load->view('login_view');
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}

	public function account_setting()
	{
		$this->load->view('account_setting_view');
	}
}

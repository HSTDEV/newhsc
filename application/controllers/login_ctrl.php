<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_ctrl extends CI_Controller {

	public function index()
	{
		$this->load->view('login_view');
	}

	public function verify_login()
	{
		$this->load->view('dashboard');
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Se_ctrl extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('se_model');
		//$this->load->model('dvr2_model');
		$this->load->helper('url');
		// $this->load->library('form_validation');
		// $this->load->library('session');
	}

	public function getRunningSVSql()
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getRunningSVSql();
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function insertTypeSE()
	{
		$runningno = $this->se_model->getRunningSVSql();
		$prefix = $runningno[0]['prefix_runnum'];

		$data = json_decode(file_get_contents('php://input'), TRUE);
		$datasuccess[] = $this->se_model->insertDataTypeSE($data,$prefix);
		
		if($datasuccess[0]['status'])
		{
			$response = $datasuccess[0]['data'];
			$this->output
			        ->set_status_header(200)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		else
		{
			$response = 'not insert DB';
			$this->output
			        ->set_status_header(400)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		//print_r($datasuccess);
	}

	public function insertTypeCP()
	{
		$data = json_decode(file_get_contents('php://input'), TRUE);
		$datasuccess[] = $this->se_model->insertDataTypeCP($data);
		
		if($datasuccess[0]['status'])
		{
			$response = $datasuccess[0]['data'];
			$this->output
			        ->set_status_header(200)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		else
		{
			$response = 'not insert DB';
			$this->output
			        ->set_status_header(400)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		//print_r($datasuccess);
	}

	public function insertTypeFAQ()
	{
		$data = json_decode(file_get_contents('php://input'), TRUE);
		$datasuccess[] = $this->se_model->insertDataTypeFAQ($data);
		
		if($datasuccess[0]['status'])
		{
			$response = $datasuccess[0]['data'];
			$this->output
			        ->set_status_header(200)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		else
		{
			$response = 'not insert DB';
			$this->output
			        ->set_status_header(400)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		//print_r($datasuccess);
	}

	public function getTblCustomer()
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		// header("Access-Control-Allow-Origin: *");
		// header("content-type:text/javascript;charset=utf-8");
		// header("Content-Type: application/json; charset=utf-8", true, 200);
		// $data = $this->se_model->getTblCustomer(urldecode($txtSearch),urldecode($txtType));
		// echo (json_encode(array("success" => true,"data"=>$data)));

		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);

		$data = json_decode(file_get_contents('php://input'), TRUE);

        
		$datasuccess = $this->se_model->getTblCustomer($data);
		
		if($datasuccess)
		{
			$response = $datasuccess;
			$this->output
			        ->set_status_header(200)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}
		else
		{
			$response = 'not query DB';
			$this->output
			        ->set_status_header(400)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
		}

	}

	public function getDrpdwnItemgroup()
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnItemgroup();

		if($data)
		{
		   //$data[] = array('zipcode'=> '');
		}
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnSubitemgroup($itemgrp_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnSubitemgroup($itemgrp_code);

		if(!$data)
		{
		   //$data[] = array('zipcode'=> '');
		}
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnItem($subitemgrp_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnItem($subitemgrp_code);

		if(!$data)
		{
		   //$data[] = array('zipcode'=> '');
		}
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnZone($province_code = null)
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnZone($province_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnProvince($zone_code = null)
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnProvince($zone_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnAmphur($province_code = null)
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnAmphur($province_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnDistrict($amphur_code = null)
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnDistrict($amphur_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnZipcode($district_code = null)
	{
		//echo $txtSearch;
		//echo iconv("windows-874", "utf-8", $txtSearch );
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnZipcode($district_code);

		if(!$data)
		{
		   $data[] = array('zipcode'=> '');
		}
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnSVC($province_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnSVC($province_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnSVCReturn($item_code = null,$serialno = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnSVCReturn($item_code,$serialno);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnFAQType()
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnFAQType();
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getDrpdwnFAQ($faqtype_id = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getDrpdwnFAQ($faqtype_id);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getChkSymtomItemgroup($itemgrp_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getChkSymtomItemgroup($itemgrp_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getChkSymtomSubitemgroup($subitemgrp_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getChkSymtomSubitemgroup($subitemgrp_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getChkSymtomItem($item_code = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getChkSymtomItem($item_code);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getChkWarrantyHistory($item = null,$serialno = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getChkWarrantyHistory($item,$serialno);
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getChkWarrantyTbl($item = null,$serialno = null,$itemgroup = null)
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getChkWarrantyTbl($item,$serialno,$itemgroup);
		if($data)
		{
			echo (json_encode(array("success" => true,"data"=>$data)));
		}
		else
		{ 
			echo (json_encode(array("success" => false,"data"=>$data))); 
		}
	}

	public function getTblServicetrans()
	{
		header("Access-Control-Allow-Origin: *");
		header("content-type:text/javascript;charset=utf-8");
		header("Content-Type: application/json; charset=utf-8", true, 200);
		$data = $this->se_model->getTblServicetrans();
		echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function se_call()
	{
		$this->load->view('ServiceEnquiry/se_call_view');
	}

	public function se_call_manage()
	{
		$this->load->view('ServiceEnquiry/se_call_manage_viewX');
		//$this->load->view('ServiceEnquiry/');
	}

	public function se_history_view()
	{
		//$this->load->view('ServiceEnquiry/se_call_manage_view');
		$this->load->view('ServiceEnquiry/se_history_view');
	}

	public function se_history_job_view()
	{
		//$this->load->view('ServiceEnquiry/se_call_manage_view');
		$this->load->view('ServiceEnquiry/se_history_job_view');
	}

	public function se_call_old()
	{
		$this->load->view('ServiceEnquiry/se_call_view_old15022017');
	}

}

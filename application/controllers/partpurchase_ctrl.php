<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partpurchase_ctrl extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('partpurchase_model');
					
	}

// -------------------- ========== View ========== --------------------
	public function po_sv()
	{
			$this->load->view('PartPurchases/po_sv_view');
	}

	public function po_sv_manage()
	{
			$this->load->view('PartPurchases/po_sv_manage_view');
	}

    public function po_sv_manage_list($ponum = null)
	{
		    $data['po_num'] = $ponum;
			$this->load->view('PartPurchases/po_sv_manage_list_view',$data);
	}

    // HST ------>>>>>
	public function po_hst_manage($ponum = null)
	{
		   
			$this->load->view('PartPurchases/po_hst_manage_view');
	}

	public function po_hst_manage_list($ponum = null)
	{
		    $data['po_num'] = $ponum;
			$this->load->view('PartPurchases/po_hst_manage_list_view',$data);
	}

	public function po_hst_inv_manage()
	{
		    
			$this->load->view('PartPurchases/po_hst_inv_manage_view');
	}

	public function po_hst_tst_manage()
	{
			$this->load->view('PartPurchases/po_hst_tst_manage_view');
	}

    public function po_hst_inv_manage_list($ponum = null)
	{
			$data['po_num'] = $ponum;
			$this->load->view('PartPurchases/po_hst_inv_manage_list_view',$data);
	}
// -------------------- ========== End View ========== --------------------



// -------------------- ========== SVCENTER  ========== --------------------

    public function getImageModelSV($model = NULL){
        //Show Image from folder server
    	$Imodel = explode(" ", $model);
	    $model  = @$Imodel[0]; 

	    $files = glob("../newhsc/images/img_model/$model/*.{jpg,gif,png,jpeg}", GLOB_BRACE);

	
        for ($i=0; $i<count($files); $i++)
        {
          $img = $files[$i];
          if($img != ''){

         		$images[$i]['url'] = "http://150.95.24.212/".str_replace("../","",$img);
         		$images[$i]['thumbUrl'] = "http://150.95.24.212/".str_replace("../","",$img);
    	 		$images[$i]['caption'] = $model;

          }

        }



			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			echo (json_encode(array("success" => true,"data"=>$images)));
        

	}
    //========== get =============
    public function getListManagePurchaseSV(){

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getListManagePurchaseSV();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}
    public function getHdrListPurchaseSV($po_num = null){

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getHdrListPurchaseSV($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getLnListPurchaseSV($po_num = null){

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getLnListPurchaseSV($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}
    //========== end get =========

    //========== insert =============
    public function addPurchaseSV(){


	  $data = json_decode(file_get_contents('php://input'), TRUE);
	  $running = $this->partpurchase_model->getRunningSql('partorder_hdr','purchase');

	  $prefix = $running[0]['prefix_runnum'];
        
		$datasuccess[] = $this->partpurchase_model->addPurchaseSV($data,$prefix);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = 'not insert DB';

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($prefix , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}
	}

    //----------------================ Update ================------------------------
    public function updateStatusPurchaseSV(){

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	
		$datasuccess[] = $this->partpurchase_model->updateStatusPurchaseSV($data);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}

    }


    public function updateQtyLineOrderSV(){

	  	$data = json_decode(file_get_contents('php://input'), TRUE);
   
		$datasuccess[] = $this->partpurchase_model->updateQtyLineOrderSV($data);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}

    }

    public function updateQtyCancelOrderSV()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->partpurchase_model->updateQtyCancelOrderSV($data);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }





	//----------------================ Update ================------------------------
	
	
	//----------------================ delete ================------------------------
    public function deleteOrderLineSV()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->partpurchase_model->deleteOrderLineSV($data);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }
	//----------------================ delete ================------------------------


  

// -------------------- ========== SVCENTER END ========== --------------------


	

// ----------------- ==================== Data Backend HST ==================== ---------------
	public function getListManagePurchaseHST(){

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getListManagePurchaseHST();
			echo (json_encode(array("success" => true,"data"=>$data)));

	}
	public function getHdrListPurchaseHST($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getHdrListPurchaseHST($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));

	}

	public function getLnListPurchaseHST($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getLnListPurchaseHST($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

    public function getPolistHST($order = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getPolistHST($order);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getPoLnlistHST($po = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->partpurchase_model->getPoLnlistHST($po);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}



	//insert
	public function addPoHST(){

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	  $running = $this->partpurchase_model->getRunningSql('po_hdr','purchase');

	  $prefix = $running[0]['prefix_runnum'];
        
		$datasuccess[] = $this->partpurchase_model->addPoHST($data,$prefix);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = 'not insert DB';

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($prefix , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}
	}


	public function updateQtyCancelOrderHST()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
        
		$datasuccess[] = $this->partpurchase_model->updateQtyCancelOrderHST($data);
		if($datasuccess[0]['status']){
				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;
		}else{

				$response = $datasuccess[0]['data'];

				$this->output
				        ->set_status_header(400)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }

//----------------- ==================== Data Backend HST ==================== ----------------


}// End Class

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part_ctrl extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('part_model');
					
	}

// -------------------- ========== View ========== --------------------
	public function po_sv()
	{
			$this->load->view('PartPurchase/po_sv_view');
	}

	public function po_sv_manage()
	{
			$this->load->view('PartPurchase/po_sv_manage_view');
	}

    public function po_sv_manage_list($ponum = null)
	{
		    $data['po_num'] = $ponum;
			$this->load->view('PartPurchase/po_sv_manage_list_view',$data);
	}

    // HST ------>>>>>
	public function po_hst_manage($ponum = null)
	{
		   
			$this->load->view('PartPurchase/po_hst_manage_view');
	}

	public function po_hst_manage_list($ponum = null)
	{
		    $data['po_num'] = $ponum;
			$this->load->view('PartPurchase/po_hst_manage_list_view',$data);
	}

	public function po_hst_inv_manage()
	{
		    
			$this->load->view('PartPurchase/po_hst_inv_manage_view');
	}

	public function po_hst_tst_manage()
	{
			$this->load->view('PartPurchase/po_hst_tst_manage_view');
	}

    public function po_hst_inv_manage_list($ponum = null)
	{
			$data['po_num'] = $ponum;
			$this->load->view('PartPurchase/po_hst_inv_manage_list_view',$data);
	}


	

	public function po_test()
	{
		    
			$this->load->view('PartPurchase/po_test');
	}





// -------------------- ========== View ========== --------------------


// ----------------- ==================== Data Backend SV ==================== ---------------

    public function getImageModelSV($model = NULL){

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

	public function getHdrLastUpdateSV()
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getHdrLastUpdateSV();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getHdrListPurchaseSV($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getHdrListPurchaseSV($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

		public function getLnListPurchaseSV($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getLnListPurchaseSV($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


	public function getListManagePurchaseSV()
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getListManagePurchaseSV();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


	public function addPurchaseSV()
	{


	  $data = json_decode(file_get_contents('php://input'), TRUE);
	  $running = $this->part_model->getRunningSql('partorder','purchase');

	  $prefix = $running[0]['prefix_runnum'];
        
		$datasuccess[] = $this->part_model->addPurchaseSV($data,$prefix);
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
	
    public function updateStatusPurchaseSV()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateStatusPurchaseSV($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }


    public function updateQtyLineOrderSV()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateQtyLineOrderSV($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }

    public function updateQtyCancelOrderSV()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateQtyCancelOrderSV($data);
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
	

	 
        
		$datasuccess[] = $this->part_model->deleteOrderLineSV($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }
	//----------------================ delete ================------------------------




//// ----------------- ==================== Data Backend SV ==================== ---------------
//**********************************************************************************************



// ----------------- ==================== Data Backend HST ==================== ---------------
	public function getHdrListPurchaseHST($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getHdrListPurchaseHST($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function getLnListPurchaseHST($po_num = null)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getLnListPurchaseHST($po_num);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


	public function getListManagePurchaseHST()
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getListManagePurchaseHST();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


    //Update
	public function updateStatusPurchaseHST()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateStatusPurchaseHST($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }


    public function updateQtyCancelOrderHST()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateQtyCancelOrderHST($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }

    // Confrim Reject From Cancel SV
    public function updateQtySVCancelOrderHST()
    {

	  $data = json_decode(file_get_contents('php://input'), TRUE);
	

	 
        
		$datasuccess[] = $this->part_model->updateQtySVCancelOrderHST($data);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}


    }
    //+++++++ Invoice ++++++
    public function getListManagePurchaseInvoiceHST()
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getListManagePurchaseInvoiceHST();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

	public function prcInvoiceAxHST()
  	{



	    $data = json_decode(file_get_contents('php://input'), TRUE);
	    $running = $this->part_model->getRunningSql('partorderinvoice','Transaction');
	    $prefix = $running[0]['prefix_runnum'];

		$datasuccess[] = $this->part_model->prcInvoiceAxHST($data,$prefix);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}
  		

	}

	public function getInvoiceList($ponum = NULL)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getInvoiceList($ponum);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}

    public function getInvoiceListDetail($inv = NULL)
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getInvoiceListDetail($inv);
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


// Transport ==========
    public function getListManageTstHST()
	{

			header("Access-Control-Allow-Origin: *");
			header("content-type:text/javascript;charset=utf-8");
			header("Content-Type: application/json; charset=utf-8", true, 200);
			$data = $this->part_model->getListManageTstHST();
			echo (json_encode(array("success" => true,"data"=>$data)));
	}


	public function prcTSTAxHST()
	{

	    $data = json_decode(file_get_contents('php://input'), TRUE);
	    $running = $this->part_model->getRunningSql('transport','Transaction');
	    $prefix = $running[0]['prefix_runnum'];

		$datasuccess[] = $this->part_model->prcTSTAxHST($data,$prefix);
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
				        ->set_output(json_encode($response , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
				exit;

		}
  		
	}



	


	
    
//----------------- ==================== Data Backend HST ==================== ----------------


}// End Class

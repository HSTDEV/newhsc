<?php
class part_model extends CI_Model {

        public $title;
        public $content;
        public $date;
        //public $Puser;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();

                //$this->load->database();
               // $ci =& get_instance();
                //$this->db = $ci->load->database('default', TRUE);
                $this->db = $this->load->database('default', TRUE);

                //$Puser = 'admin';
             
        }




//========================================--------  SV --------========================================
        function getListManagePurchaseSV()
        {
           
              //where session SVC
              
                  $this->db->trans_start();
                  $this->db->query("SET @row_number = 0;");
                  $data = $this->db->query("select 
                        (@row_number:=@row_number + 1) AS num
                        ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                        ,p.*
                        ,ifnull((select flag from partorderline ln where ln.partorder_code = p.partorder_code and ln.flag = 1 limit 1 ),0)as partorderline_flag
                         FROM partorder p;");
                  $this->db->trans_complete();
  
              // $sql = "SELECT * 
              //        ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
              //         FROM partorder p";
              // $query = $this->db->query($sql);
              return $data->result_array();
        }

        function getHdrLastUpdateSV()
        {
           
              //where session SVC
              
  
              $sql = "select 
                      updated_date
                      FROM partorder p order by updated_date desc limit 1 ";
              $query = $this->db->query($sql);
              
              return $query->result_array();
        }

        // =================== magage list view ===================
        
        function getHdrListPurchaseSV($po_num = NULL)
        {

              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th

                      FROM partorder p where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }


        function getLnListPurchaseSV($po_num = NULL)
        {

              $sql = "select * from partorderline where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }
        // =================== magage list view ===================







        public function addPurchaseSV($inputdata = NULL,$prefix = NULL)
        {

            $this->load->helper('url');

           // echo "prefix :".$prefix;

            $partorder_code = $prefix;

            $i = 1;
            $query_line = false;

            $total_amt = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                    $data_line = array(
                        'partorder_code'              => $partorder_code,
                        'partorder_ln'                => $i,
                        'partorderline_type'          => 'CR',
                        'item_code'                   => @$data['model'],
                        'partmaster_code'             => @$data['partno'],
                        'partmaster_code_desc'        => @$data['partename'],
                        'partorderline_order_qty'     => @$data['partqty'],
                        'partorderline_amt'           => @$data['partprice'],
                        'partorderline_total_amt'     => @$data['partTotal'],
                        'partorderline_order_blance_qty' => @$data['partqty'],
                        'created_by'                  => 'admin'
                        
                        );
                    $query_line = $this->db->insert('partorderline',$data_line);
                    //echo $this->db->last_query();
                    $total_amt += @$data['partTotal'];
                    $i++;

                }
            }
                 
            $data_header = array(
                    'partorder_code'          => $partorder_code,
                    'partorder_type'          => 'CR',
                    'servicecenter_code'      => 'SC0001',
                    'item_code'               => '',
                    'partorder_total_amt'     => $total_amt,
                    'created_by'              => 'admin'
                    );

            $query_header = $this->db->insert('partorder',$data_header);
            //echo $this->db->last_query();
            
           if($query_header){
              return (array("status" => true,"data"=>'')); 
           }
           else{
              return (array("status" => false,"data"=>'')); 
           }
        }


        public function getRunningPO(){

                try {


                   // $this->db->reconnect();
                    $sql = "CALL getRunningPrefix (?,?)";
                    $a_result = $this->db->query( $sql, array('first'=>'partorder','last'=>'purchase') ); // $data included 3 param and binding & query to db
                    $result   = $a_result->result_array();

                    $this->db->_error_message();
                  //  $this->db->close();


                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return $result;

            

            //  $a_procedure = "CALL getRunningPrefix (?,?)";
            //  @$a_result = @$this->db->query( $a_procedure, array('first'=>'partorder','last'=>'purchase') );

            // return @$a_result->result();
        }


        public function getRunningSql($tbl = NULL,$type = NULL){



            
            $iTblname = $tbl;
            $iTbltype = $type;

            
           $sql1 =  $this->db->query("select pf.prefix_runnum from `prefix` AS pf where pf.prefix_ref_tbl = '$iTblname' and pf.prefix_ref_tbl_type ='$iTbltype' and pf.prefix_year =YEAR(NOW()) and pf.prefix_month =DATE_FORMAT(NOW(),'%m')  and pf.prefix_runnum like CONCAT((select df.prefix_desc_use from `prefix` as df  where df.prefix_ref_tbl = '$iTblname' and df.prefix_ref_tbl_type ='$iTbltype' limit 1),'%')");
           $query1 = $sql1->result_array();

            if (is_array($query1)){
            $sql2 =  $this->db->query("update prefix as f set f.prefix_runnum = 
                                (SELECT         
                                        (CONCAT(
                                                 f.prefix_desc_use
                                                 ,DATE_FORMAT(NOW(),'%y')
                                                 ,DATE_FORMAT(NOW(),'%m')
                                                ,'-'
                                                ,(CASE WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 2
                                                       THEN CONCAT('0000',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 3
                                                       THEN CONCAT('000',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 4
                                                       THEN CONCAT('00',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 5
                                                       THEN CONCAT('0',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                         ELSE CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1 END)            
                                                )) as result
                                )
                                where f.`prefix_ref_tbl` = '$iTblname' and f.prefix_ref_tbl_type = '$iTbltype';");
            //$query2 = $sql2->result_array();


            }else{

                            $sql3 =  $this->db->query("update prefix as f set f.prefix_year = DATE_FORMAT(NOW(),'%Y')
                                                    ,f.prefix_month = DATE_FORMAT(NOW(),'%m') 
                                                    ,f.prefix_runnum = CONCAT(f.prefix_desc_use,DATE_FORMAT(NOW(),'%y'),DATE_FORMAT(NOW(),'%m'),'-00000')
                                where f.`prefix_ref_tbl` = '$iTblname' and f.prefix_ref_tbl_type = '$iTbltype';");
           // $query3 = $sql3->result_array();

                        $sql4 =  $this->db->query("update prefix as f set f.prefix_runnum = 
                                (SELECT         
                                        (CONCAT(
                                                 f.prefix_desc_use
                                                 ,DATE_FORMAT(NOW(),'%y')
                                                 ,DATE_FORMAT(NOW(),'%m')
                                                ,'-'
                                                ,(CASE WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 2
                                                       THEN CONCAT('0000',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 3
                                                       THEN CONCAT('000',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 4
                                                       THEN CONCAT('00',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                       WHEN LENGTH(CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)< 5
                                                       THEN CONCAT('0',CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1)
                                                         ELSE CAST(SUBSTRING(f.prefix_runnum,LENGTH(f.prefix_runnum)-4,LENGTH(f.prefix_runnum))AS UNSIGNED INTEGER)+1 END)            
                                                )) as result
                                )
                                where f.`prefix_ref_tbl` = '$iTblname' and f.prefix_ref_tbl_type = '$iTbltype';");
           // $query4 = $sql4->result_array();



            }
            
            $data = $this->db->query("select prefix_runnum from prefix 
                                      where prefix_ref_tbl = '$iTblname' and prefix_ref_tbl_type = '$iTbltype';");

            return $data->result_array();


        }



        public function updateStatusPurchaseSV($inputdata = NULL){

             $po_num = @$inputdata['po_num'];
             $type   = @$inputdata['type'];
             $sql    = '';

               if($type == 'confirmSV'){

                  $sql = "update partorder set partorder_type = 'CF-SV' where partorder_code = '$po_num'";

               }else if($type == 'rejectSV'){

                  $sql = "update partorder set partorder_type = 'RE-SV' where partorder_code = '$po_num'";
               }
             


            
             
              $query = $this->db->query($sql);
              //echo $this->db->last_query();
              //return $query->result_array();

           if($query){
              return (array("status" => true,"data"=>'OK')); 
           }
           else{
              return (array("status" => false,"data"=>'not OK')); 
           }

        }



        public function updateQtyLineOrderSV($inputdata = NULL){

             $id    = @$inputdata['id'];
             $qty   = @$inputdata['qty'];
             $sql   = '';

              //line
              $sql = "update partorderline set partorderline_order_qty = $qty
              ,partorderline_order_blance_qty = $qty
              ,partorderline_total_amt = partorderline_amt * $qty 
              where partorderline_id = $id ";
              $query = $this->db->query($sql);
              //header
              $sql_sum = "update partorder set partorder_total_amt = 
                          IFNULL((select sum(partorderline_total_amt) from partorderline  where 
                          partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )),0)
                          where partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )";
              $query_sum = $this->db->query($sql_sum);


           if($query){



              return (array("status" => true,"data"=>'OK')); 
           }
           else{
              return (array("status" => false,"data"=>'not OK')); 
           }

      }



      public function deleteOrderLineSV($inputdata = NULL){

             $id    = @$inputdata['id'];
             $po    = @$inputdata['po'];
  
              $sql   = '';

              
              $sql = "delete from partorderline where partorderline_id = $id ";
              $query = $this->db->query($sql);

              $sql_sum = "update partorder set partorder_total_amt = 
                          IFNULL((select sum(partorderline_total_amt) from partorderline  where 
                          partorder_code = '$po'),0)
                          where partorder_code = '$po' ";
              $query_sum = $this->db->query($sql_sum);

              $query_row = $this->db->query("select * from partorderline where partorder_code = '$po'");
              $num = 0;
              $num = $query_row->num_rows();

              if($num < 1){

                 $this->db->query("update partorder set partorder_type = 'RE-SV' where partorder_code = '$po'");
              }


           if($query){
              return (array("status" => true,"data"=>'OK')); 
           }
           else{
              return (array("status" => false,"data"=>'not OK')); 
           }

      }




      public function updateQtyCancelOrderSV($inputdata = NULL){

          
           $total_amt = 0; $id = ''; $qty = 0; $flag = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                      $id = @$data['partorderline_id'];
                      $qty = @$data['partorderline_order_cancelSV_qty'];
                      $flag = @$data['status'];

                      if($flag > 0){

                        $query = $this->db->query("update partorderline set partorderline_order_cancelSV_qty = $qty
                                                          where partorderline_id = $id;");

                                   $this->db->query("update partorderline set flag = 1
                                                          where partorderline_id = $id and partorderline_order_cancelSV_qty > 0;");

                                   $this->db->query("update partorderline set flag = 0
                                                          where partorderline_id = $id and partorderline_order_cancelSV_qty = 0;");

                        }
                                                         
  
              

               }
            }

       
                 

           if($query){

              return (array("status" => true,"data"=>'OK')); 

           }
           else{

              return (array("status" => false,"data"=>'not OK')); 
           }

      }



//========================================--------  SV --------========================================


//========================================--------  HST --------========================================

        function getListManagePurchaseHST()
        {
           
              //where session SVC
  
              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                      ,(select servicecenter_name_th from servicecenter s where s.servicecenter_code = p.servicecenter_code limit 1 ) as servicecenter_name_th
                      ,ifnull((select flag from partorderline ln where ln.partorder_code = p.partorder_code and ln.flag = 1 limit 1 ),0)as partorderline_flag
                      FROM partorder p where partorder_type not in ('CR','RE-SV')";
              $query = $this->db->query($sql);
              return $query->result_array();
        }



        // =================== magage list view ===================
        
        function getHdrListPurchaseHST($po_num = NULL)
        {

              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                      ,(select servicecenter_name_th from servicecenter s where s.servicecenter_code = p.servicecenter_code limit 1 ) as servicecenter_name_th
                      FROM partorder p where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }


        function getLnListPurchaseHST($po_num = NULL)
        {

              $sql = "select * 
                     ,0 as partorderline_order_qty_temp from partorderline where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }


        public function updateStatusPurchaseHST($inputdata = NULL){

             $po_num = @$inputdata['po_num'];
             $type   = @$inputdata['type'];
             $sql    = '';

               if($type == 'confirmHST'){

                  $sql = "update partorder set partorder_type = 'AC' where partorder_code = '$po_num'";

               }else if($type == 'rejectHST'){

                  $sql = "update partorder set partorder_type = 'RE-HST' where partorder_code = '$po_num'";
               }
             


            
             
              $query = $this->db->query($sql);
              //echo $this->db->last_query();
              //return $query->result_array();

           if($query){
              return (array("status" => true,"data"=>'OK')); 
           }
           else{
              return (array("status" => false,"data"=>'not OK')); 
           }

      }

      public function updateQtyCancelOrderHST($inputdata = NULL){

          
           $total_amt = 0; $id = ''; $qty = 0; $flag = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                      $id = @$data['partorderline_id'];
                      $qty = @$data['partorderline_order_cancel_qty'];
                      $flag = @$data['status'];

                      if($flag > 0){

                        $query = $this->db->query("update partorderline set partorderline_order_cancel_qty = $qty
                                                         ,partorderline_order_blance_qty = (partorderline_order_qty - partorderline_order_ship_qty -  $qty)
                                                         ,partorderline_total_amt  = (partorderline_order_qty  - $qty) * partorderline_amt
                                                         where partorderline_id = $id;");

                                $this->db->query("update partorder set partorder_total_amt = 
                                  IFNULL((select sum(partorderline_total_amt) from partorderline  where 
                                   partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )),0)
                                   where partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )");

                        }
                                                         
  
              

               }
            }

       
                 

           if($query){

              return (array("status" => true,"data"=>'OK')); 

           }
           else{

              return (array("status" => false,"data"=>'not OK')); 
           }

      }


            // Confrim Reject From Cancel SV
      public function updateQtySVCancelOrderHST($inputdata = NULL){

          
           $total_amt = 0; $id = ''; $qty = 0; $flag = 0;
             $id    = @$inputdata['id'];
             $type    = @$inputdata['type'];



                      if($type == 'rejectHST'){
                        // update qty for cancel
                      
                        $query = $this->db->query("update partorderline 
                                                   set partorderline_order_cancelSV_qty = 0
                                                   where partorderline_id = $id;");

                                    
                        //update flag    
                                   $this->db->query("update partorderline set flag = 0
                                                          where partorderline_id = $id;");

                        }
                        else{
                            //update qty blance
                            $query = $this->db->query("update partorderline 
                               set partorderline_order_cancel_qty = partorderline_order_cancel_qty + partorderline_order_cancelSV_qty
                               where partorderline_id = $id;");

                            $this->db->query("update partorderline 
                               set partorderline_order_blance_qty = partorderline_order_qty - (partorderline_order_cancel_qty + partorderline_order_ship_qty)
                               where partorderline_id = $id;");

                            //clear qty sv cancel
                            $this->db->query("update partorderline 
                                                   set partorderline_order_cancelSV_qty = 0
                                                   where partorderline_id = $id;");



                            //update total amt line
                                    $this->db->query("update partorderline 
                                       set partorderline_total_amt = (partorderline_order_qty - partorderline_order_cancel_qty) * partorderline_amt
                                       where partorderline_id = $id;");
                            //update total amt header
                                    $this->db->query("update partorder set partorder_total_amt = 
                                              IFNULL((select sum(partorderline_total_amt) from partorderline  where 
                                              partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )),0)
                                              where partorder_code = (select partorder_code from partorderline where partorderline_id = $id limit 1 )");

                                   
                             // update flag         
                                   $this->db->query("update partorderline set flag = 0
                                                          where partorderline_id = $id;");
                        }
                                                         
  
              

            //    }
             // }

       
                 

           if($query){

              return (array("status" => true,"data"=>'OK')); 

           }
           else{

              return (array("status" => false,"data"=>'not OK')); 
           }

      }

  //+++++++ Invoice ++++++
  public function getListManagePurchaseInvoiceHST()
  {
          $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                      ,(select servicecenter_name_th from servicecenter s where s.servicecenter_code = p.servicecenter_code limit 1 ) as servicecenter_name_th
                      ,ifnull((select flag from partorderline ln where ln.partorder_code = p.partorder_code and ln.flag = 1 limit 1 ),0)as partorderline_flag
                      FROM partorder p where partorder_type in ('AC')";
              $query = $this->db->query($sql);
              return $query->result_array();
  }
  

  public function prcInvoiceAxHST($inputdata,$prefix)
  {
          
            $running     = $prefix;
            $invoice_num = @$inputdata['invoice'];
            $i = 1;
            $add_inv = false;


            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){
 
                    $qty  = 0 ;
                    $qty  = @$data['partorderline_order_qty_temp'];
                    $id   = @$data['partorderline_id'];

                  if($qty > 0){

                    $data_line = array(
                        'partorderinvoice_code'        => $running,
                        'partorderline_id'             => @$data['partorderline_id'],
                        'partmaster_code'              => @$data['partmaster_code'],
                        'partorder_code'              => @$data['partorder_code'],
                        'partorderinvoice_ship_qty'    => $qty,
                        'partorderinvoice_invoice_num' => $invoice_num,
                        'created_by'                   => 'admin'
                        
                        );
                    $add_inv = $this->db->insert('partorderinvoice',$data_line);
                    
                    //Update Shipment
                    $this->db->query("update partorderline 
                                      set partorderline_order_ship_qty = partorderline_order_ship_qty + $qty
                                      where partorderline_id = $id;");
                    //Update Blance
                    $this->db->query("update partorderline 
                               set partorderline_order_blance_qty = partorderline_order_qty - (partorderline_order_cancel_qty + partorderline_order_ship_qty)
                               where partorderline_id = $id;");

                    // Log PO  && Trans

                    }
                    


                }
            }
                 

            //echo $this->db->last_query();
            
           if($add_inv){
              return (array("status" => true,"data"=>'OK')); 
           }
           else{
              return (array("status" => false,"data"=>'NOT OK')); 
           }
  }

  public function getInvoiceList($ponum)
  {
          $sql = "select  partorderinvoice_code
                         ,partorderinvoice_invoice_num
                         ,created_by
                         ,transport_code
                         ,DATE_FORMAT(created_date,'%Y-%m-%d') as created_date
              from partorderinvoice 
              where partorder_code = '$ponum'
              group by 
              partorderinvoice_code,transport_code,partorderinvoice_invoice_num";
              $query = $this->db->query($sql);
              return $query->result_array();
  }

  public function getInvoiceListDetail($inv_num)
  {
          $sql = "select  *
                  from partorderinvoice 
                  where partorderinvoice_code = '$inv_num'";
          $query = $this->db->query($sql);
          return $query->result_array();
  }


//-----> TST

  public function getListManageTstHST()
  {
          $sql = "select  partorderinvoice_code
                         ,partorderinvoice_invoice_num
                         ,created_by
                         ,transport_code
                         ,partorder_code
                         ,DATE_FORMAT(created_date,'%Y-%m-%d') as created_date
              from partorderinvoice 
              group by 
              partorderinvoice_code,transport_code,partorderinvoice_invoice_num";
          $query = $this->db->query($sql);
          return $query->result_array();
  }

  public function prcTSTAxHST($inputdata,$prefix){

         $invoice_num  = @$inputdata['invoice'];
         $type         = @$inputdata['type'];
         $track        = @$inputdata['track'];
         $running      = @$prefix;

         $add_inv = false;


          
              if($invoice_num){
                $data_line = array(
                        'transport_code'                   => $running,
                        'partorder_inv_num'                => $invoice_num,
                        'transport_type_code'              => $type,
                        'transport_track_code'             => $track,
                        'created_by'                   => 'admin'
                        );
               
              $add_inv = $this->db->insert('transport',$data_line);

               $this->db->query("update partorderinvoice 
                               set transport_code = '$running'
                               where partorderinvoice_invoice_num = '$invoice_num';");

              }
                        
                  
            



            if($add_inv){
              return (array("status" => true,"data"=>'OK')); 
            }
            else{
              return (array("status" => false,"data"=>'NOT OK')); 
            }
  

  }

  

//========================================--------  HST --------========================================

} //End Class

?>

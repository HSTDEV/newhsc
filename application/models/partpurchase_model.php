<?php
class partpurchase_model extends CI_Model {

    
        public $puser;
        public $pservicecode;
      

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->db = $this->load->database('default', TRUE);

                $this->puser = 'admin'; //sess
                $this->pservicecode = 'SVC0001';
             
        }

// ===========================     SVCENTER     ==========================================


        // ====== get =============
        function getListManagePurchaseSV(){
           
                  $this->db->trans_start();
                  $this->db->query("SET @row_number = 0;");
                  $data = $this->db->query("select 
                        (@row_number:=@row_number + 1) AS num
                        ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                        ,p.*
                        ,ifnull((select flag from partorderline ln where ln.partorder_code = p.partorder_code and ln.flag = 1 limit 1 ),0) as partorderline_flag
                         FROM partorder_hdr p
                         where p.servicecenter_code = '$this->pservicecode' order by p.partorder_date desc;");
                  $this->db->trans_complete();
                  return $data->result_array();

        }

        function getHdrLastUpdateSV(){
              $sql = "select 
                      updated_date
                      FROM partorder_hdr p order by updated_date desc limit 1 ";
              $query = $this->db->query($sql);
              
              return $query->result_array();
        }

        function getHdrListPurchaseSV($po_num = NULL){

              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th

                      FROM partorder_hdr p where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }

        function getLnListPurchaseSV($po_num = NULL){

              $sql = "select * from partorder_line where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }
        
        // ====== end get =========
        
        // ====== insert ======
        function addPurchaseSV($inputdata = NULL,$prefix = NULL){

            $this->load->helper('url');


            $running_code = $prefix;

            $i = 1;
            $query_line = false;
            $total_amt = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                    $data_line = array(
                        'partorder_code'              => $running_code,
                        'partorder_ln'                => $i,
                        'partmaster_code'             => @$data['partno'],
                        'item_code'                   => @$data['model'],
                        'partmaster_code_desc'        => @$data['partename'],
                        'partorderline_order_qty'     => @$data['partqty'],
                        'partorderline_backorder_qty' => @$data['partqty'],
                        'partorderline_amt'           => @$data['partprice'],
                        'partorderline_total_amt'     => @$data['partTotal'],
                        'partorderline_order_blance_qty' => @$data['partqty'],
                        'created_by'                  => $this->puser
                        
                        );
                    $query_line = $this->db->insert('partorder_line',$data_line);
                    //echo $this->db->last_query();
                    $total_amt += @$data['partTotal'];
                    $i++;

                }
            }
                 
            $data_header = array(
                    'partorder_code'          => $running_code,
                    'partorder_type'          => 'CR',
                    'servicecenter_code'      => $this->pservicecode,
                    'partorder_total_amt'     => $total_amt,
                    'created_by'              => $this->puser
                    );

            $query_header = $this->db->insert('partorder_hdr',$data_header);
            
           if($query_header){
              return (array("status" => true,"data"=>'')); 
           }
           else{
              return (array("status" => false,"data"=>'')); 
           }
        }
        // ====== end ======
        
        // ======= update ====
        function updateQtyLineOrderSV($inputdata = NULL){

             $id       = @$inputdata['id'];
             $qty      = @$inputdata['qty'];
             $sql      = '';
             $Cnumrow  = 0;


             $sql_check   = "select * from partorder_hdr 
                            where  partorder_code = (select partorder_code from partorder_line where partorderline_id = $id limit 1 ) and partorder_type = 'CR'";
             $query_check = $this->db->query($sql_check);
             $Cnumrow     = $query_check->num_rows();
             if ($Cnumrow !== 0){
                //line
                $sql = "update partorder_line set partorderline_order_qty = $qty
                ,partorderline_order_blance_qty = $qty
                ,partorderline_total_amt = partorderline_amt * $qty 
                where partorderline_id = $id ";
                $query = $this->db->query($sql);
                //header
                $sql_sum = "update partorder_hdr set partorder_total_amt = 
                            IFNULL((select sum(partorderline_total_amt) from partorder_line  where 
                            partorder_code = (select partorder_code from partorder_line where partorderline_id = $id limit 1 )),0)
                            where partorder_code = (select partorder_code from partorder_line where partorderline_id = $id limit 1 )";
                $query_sum = $this->db->query($sql_sum);

               if($query){
                  return (array("status" => true,"data"=>'OK')); 
               }
               else{
                  return (array("status" => false,"data"=>'not OK')); 
               }
             }else{
                  return (array("status" => false,"data"=>'CR'));
             }

      }

      function updateStatusPurchaseSV($inputdata = NULL){

             $po_num = @$inputdata['po_num'];
             $type   = @$inputdata['type'];
             $sql    = '';


             $Cnumrow  = 0;
             $sql_check   = "select * from partorder_hdr 
                            where  partorder_code = '$po_num' and partorder_type = 'CR'";
             $query_check = $this->db->query($sql_check);
             $Cnumrow     = $query_check->num_rows();
             if ($Cnumrow !== 0){

               if($type == 'confirmSV'){

                  $sql = "update partorder_hdr set partorder_type = 'CF-SV' where partorder_code = '$po_num'";

               }else if($type == 'rejectSV'){

                  $sql = "update partorder_hdr set partorder_type = 'RE-SV' where partorder_code = '$po_num'";
               }
               
               $query = $this->db->query($sql);

               if($query){
                  return (array("status" => true,"data"=>'OK')); 
               }
               else{
                  return (array("status" => false,"data"=>'not OK')); 
               }

              }else{
                  return (array("status" => false,"data"=>'CR'));
              }

        }
      // ======= update ====
      // ======= delete ====
      function deleteOrderLineSV($inputdata = NULL){

              $id    = @$inputdata['id'];
              $po    = @$inputdata['po'];
  
              $sql   = '';
              $Cnumrow = 0;

              $sql_check   = "select * from partorder_hdr 
                            where  partorder_code = (select partorder_code from partorder_line where partorderline_id = $id limit 1 ) and partorder_type = 'CR'";
              $query_check = $this->db->query($sql_check);
              $Cnumrow     = $query_check->num_rows();
          if ($Cnumrow !== 0){

              $sql = "delete from partorder_line where partorderline_id = $id ";
              $query = $this->db->query($sql);

              $sql_sum = "update partorder_hdr set partorder_total_amt = 
                          IFNULL((select sum(partorderline_total_amt) from partorder_line  where 
                          partorder_code = '$po'),0)
                          where partorder_code = '$po' ";
              $query_sum = $this->db->query($sql_sum);

              $query_row = $this->db->query("select * from partorder_line where partorder_code = '$po'");
              $num = 0;
              $num = $query_row->num_rows();

              if($num < 1){

                 $this->db->query("update partorder_hdr set partorder_type = 'RE-SV' where partorder_code = '$po'");
              }

              if($query){
                return (array("status" => true,"data"=>'OK')); 
              }
              else{
                return (array("status" => false,"data"=>'not OK')); 
              }
          }else{

               return (array("status" => false,"data"=>'CR')); 
          }

      }
      // ======= delete ====
      




// ===========================     SVCENTER     ==========================================






//========================================--------  HST --------========================================

        function getListManagePurchaseHST(){
           
              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                      ,(select servicecenter_name_th from servicecenter s where s.servicecenter_code = p.servicecenter_code limit 1 ) as servicecenter_name_th
                      ,ifnull((select flag from partorderline ln where ln.partorder_code = p.partorder_code and ln.flag = 1 limit 1 ),0)as partorderline_flag
                      FROM partorder_hdr p where partorder_type not in ('CR','RE-SV')";
              $query = $this->db->query($sql);
              return $query->result_array();
        }



        // =================== magage list view ===================
        
        
        function getHdrListPurchaseHST($po_num = NULL){

              $sql = "SELECT * 
                      ,(select description_th from userdefindfield u where u.TypeValue = 'partorder' and u.Value = p.partorder_type limit 1 ) as partorder_type_desc_th
                      ,(select servicecenter_name_th from servicecenter s where s.servicecenter_code = p.servicecenter_code limit 1 ) as servicecenter_name_th
                      FROM partorder_hdr p where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }


        function getLnListPurchaseHST($po_num = NULL){

              $sql = "select *  
                      ,partorderline_backorder_qty as openpo
                      ,0 as backorder
                      ,partorderline_backorder_qty as Tempbackorder
                      from partorder_line where partorder_code = '$po_num'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }

        function getPolistHST($order = NULL){

              $sql = "select *  from po_hdr where partorder_code = '$order'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }

        function getPoLnlistHST($po = NULL){

              $sql = "select *  from po_line where po_code = '$po'";
              $query = $this->db->query($sql);
              return $query->result_array();

        }

        // ====== insert ======
        function addPoHST($inputdata = NULL,$prefix = NULL){

            $this->load->helper('url');


            $running_code = $prefix;

            $i = 1;
            $query_line = false;
            $total_amt = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                    if(@$data['openpo'] > 0){

                        $data_line = array(
                            'po_code'                        => $running_code,
                            'poline_ln'                      => $i,
                            'poline_type'                    => 'CR',
                            'item_code'                      => @$data['item_code'],
                            'partorderline_id'               => @$data['partorderline_id'],
                            'partmaster_code'                => @$data['partmaster_code'],
                            'partmaster_code_desc'           => @$data['partmaster_code_desc'],
                            'poline_order_qty'               => @$data['openpo'],
                            'poline_amt'                     => @$data['partorderline_amt'],
                            'poline_total_amt'               => @$data['partorderline_amt'] * @$data['openpo'],
                            'poline_order_blance_qty'        => @$data['openpo'],
                            'created_by'                     => $this->puser     
                            );
                        $query_line = $this->db->insert('po_line',$data_line);
                  
                    }

                    $sql = "update partorder_line set partorderline_backorder_qty = ".@$data['backorder']."
                            where partorderline_id = ".@$data['partorderline_id'];
                    $query = $this->db->query($sql);
    
                    $total_amt += (@$data['partorderline_amt'] * @$data['openpo']);
                    $i++;

                }

                $data_header = array(
                    'po_code'              => $running_code,
                    'po_type_gen'          => @$inputdata['type'],
                    'po_type'              => 'CR',
                    'partorder_code'       => @$inputdata['partorder_code'],
                    'servicecenter_code'   => @$inputdata['servicecenter_code'],
                    'po_total_amt'         => $total_amt,
                    'created_by'           => $this->puser
                    );

                $query_header = $this->db->insert('po_hdr',$data_header);

                //update status partorder
                $sql_hdr = "update partorder_hdr set partorder_type = 'AC'
                            where partorder_code = '".@$inputdata['partorder_code']."' ";
                $query_hdr = $this->db->query($sql_hdr);
            }
                 
  
           if($query_line){
              return (array("status" => true,"data"=>'')); 
           }
           else{
              return (array("status" => false,"data"=>'')); 
           }

        }

        function updateQtyCancelOrderHST($inputdata = NULL){

           $id   = ''; 
           $qty  = 0; 
           $flag = 0;
           $query = false;
           $checkbackorder = 0;

           $tblOrder = $this->getLnListPurchaseHST(@$inputdata['partorder']);

            if (is_array(@$inputdata['data']))
            {
              foreach(@$inputdata['data'] as $data ){ 

                 foreach ($tblOrder as $order) {
                      if ($order['partmaster_code'] == $data['partmaster_code']){
                          if($order['partorderline_backorder_qty'] !== $data['partorderline_backorder_qty']){
                               $checkbackorder = 1;
                               break;
                          }
                          
                      }
                     // $checkbackorder = 1;
                 }
              }

               // $flag = @$data['status'];
               //   $qty  = @$data['partorderline_order_cancel_qty'];
               //   $id   = @$data['partorderline_id'];

                 //           if($flag > 0){
                 //    $sql = "update partorder_line set partorderline_order_cancel_qty = '$qty'
                 //            where partorderline_id = '$id'";
                 //    $query = $this->db->query($sql);

                 // }
            }

            if($query){
                return (array("status" => true,"data"=>'OK')); 
            }
            else{
                return (array("status" => false,"data"=>$checkbackorder)); 
            }

        }
        // ====== end ======


/*

        function updateStatusPurchaseHST($inputdata = NULL){

             $po_num = @$inputdata['po_num'];
             $type   = @$inputdata['type'];
             $sql    = '';

               if($type == 'confirmHST'){

                  $sql = "update partorder set partorder_type = 'AC' where partorder_code = '$po_num'";

               }else if($type == 'rejectHST'){

                  $sql = "update partorder set partorder_type = 'RE-HST' where partorder_code = '$po_num'";
               }
             
              $query = $this->db->query($sql);
  
              if($query){
                  return (array("status" => true,"data"=>'OK')); 
              }
              else{
                  return (array("status" => false,"data"=>'not OK')); 
              }

        }

        function updateQtyCancelOrderHST($inputdata = NULL){

          
           $total_amt = 0; $id = ''; $qty = 0; $flag = 0;

            if (is_array(@$inputdata['data']))
            {
                foreach (@$inputdata['data'] as $data ){

                      $id = @$data['partorderline_id'];
                      $qty = @$data['partorderline_order_cancel_qty'];
                      $flag =   $flag = @$data['status'];;

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
        function updateQtySVCancelOrderHST($inputdata = NULL){

          
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
        */


//========================================--------  HST --------========================================

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


        // function checkbackorder(){

        //     $data = $this->db->query("select 
        //             partorder_code,partmaster_code
        //             ,partorderline_backorder_qty
        //             ,(partorderline_order_qty
        //             -partorderline_order_cancel_qty
        //             -IFNULL((select sum(po_line.poline_order_qty)
        //             from po_hdr
        //             left outer join po_line on po_hdr.po_code = po_line.po_code
        //             where po_hdr.partorder_code = orln.partorder_code and po_line.partmaster_code = orln.partmaster_code),0)
        //             -IFNULL((select sum(po_line.poline_order_cancel_qty)
        //             from po_hdr
        //             left outer join po_line on po_hdr.po_code = po_line.po_code
        //             where po_hdr.partorder_code = orln.partorder_code and po_line.partmaster_code = orln.partmaster_code),0)) as backorder
        //             from partorder_line orln
        //             where orln.partorder_code = 'OR1705-00015'");
        //    if (is_array($data)){
        //         foreach($data as $data ){ 
        //            if $data['backorder']

        //         }
        //    }
        //    else{
        //      return 0;
        //    }
        // }




} //End Class

?>

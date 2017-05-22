<?php
class se_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public $puser;
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();

                //$this->load->database();
                $this->db = $this->load->database('default', TRUE);
                // $this->db2 = $this->load->database('dbAX', TRUE);
                $this->load->library('session');

                $this->puser = 'SURACHET';
        }

        public function insertDataTypeSE($inputdata,$prefix)
        {
            $this->load->helper('url');
            $servicetranscode = $prefix;
            $dateWarranty = '';
            $dateCust = '';

            if(@$inputdata['warranty_end_date'] <> '')
            {
               $newDate =  @$inputdata['warranty_end_date'];
               $dateArray = explode('/',$newDate);
               $dateWarranty = $dateArray[2]."-". $dateArray[1]."-".$dateArray[0];
            }
            if(@$inputdata['is_custdate'] <> '')
            {
               $isDate =  @$inputdata['is_custdate'];
               $dateArray2 = explode('/',$isDate);
               $dateCust = $dateArray2[2]."-". $dateArray2[1]."-".$dateArray2[0];
            }

            //-------------------------------- Insert Service Trans
            $data = array(
                    'servicetrans_code'             => $servicetranscode,
                    'servicetrans_type'             => @$inputdata['servicetrans_type'],
                    'servicecenter_code'            => @$inputdata['servicecenter_code'],
                    'warranty_code'                 => @$inputdata['warranty_code'],
                    'warranty_end_date'             => $dateWarranty,
                    'inwarranty'                    => @$inputdata['inwarranty'],
                    'is_custdate'                   => $dateCust,
                    'is_dealer_name'                => @$inputdata['is_dealer_name'],
                    'servicetrans_con_name'         => @$inputdata['servicetrans_con_name'],
                    'servicetrans_con_tel'          => @$inputdata['servicetrans_con_tel'],
                    'customer_id'                   => @$inputdata['customer_id'],
                    'province_code'                 => @$inputdata['province_code'],
                    'jobAx_num'                     => @$inputdata['jobAx_num'],
                    'job_type_code'                 => @$inputdata['job_type_code'],
                    'enquiry_code'                  => @$inputdata['enquiry_code'],
                    'item_code'                     => @$inputdata['item_code'],
                    'servicetrans_serial'           => @$inputdata['servicetrans_serial'],
                    'servicetrans_confirm_date'     => @$inputdata['servicetrans_confirm_date'],
                    'servicetrans_confirm_by'       => @$inputdata['servicetrans_confirm_by'],
                    'servicetrans_description'      => @$inputdata['servicetrans_description'],
                    'servicetrans_comment'          => @$inputdata['servicetrans_comment'],
                    'servicetrans_member_type'     => @$inputdata['servicetrans_member_type'],
                    'servicetrans_status'           => @$inputdata['servicetrans_status'],
                    'status'                        => @$inputdata['status'],
                    'flag'                          => @$inputdata['flag'],
                    'created_by'                    => $this->puser,
                    'updated_by'                    => $this->puser,      
                    'remark'                        => @$inputdata['remark']
                    );
            $query = $this->db->insert('servicetrans',$data);
            //-------------------------------- End Insert Service Trans
            //-------------------------------- Insert Service Repair
            $dataRepair = array(
                    'servicerepair_code'                                   => $servicetranscode,
                    'servicerepair_symtom_itemgrp'                  => @$inputdata['servicerepair_symtom_itemgrp'],
                    'servicerepair_symtom_subitemgrp'            => @$inputdata['servicerepair_symtom_subitemgrp'],
                    'servicerepair_symtom_item'                     => @$inputdata['servicerepair_symtom_item'],
                    'created_by'                                            => $this->puser,
                    'updated_by'                                        => $this->puser       
                    );
            $queryRepair = $this->db->insert('servicerepair',$dataRepair);


            //-------------------------------- End Insert Service Repair
            //-------------------------------- Insert or Update Customers
            $dataCustomes = array(
                    'customer_code'             => 'P8999',
                    'customer_name'             => @$inputdata['customer_name'],
                    'customer_tel1'             => @$inputdata['customer_tel1'],
                    'customer_tel2'             => @$inputdata['customer_tel2'],
                    'customer_addr'             => @$inputdata['customer_addr'],
                    'district_code'             => @$inputdata['district_code'],
                    'amphur_code'               => @$inputdata['amphur_code'],
                    'zipcode_code'              => @$inputdata['zipcode_code'],
                    'province_code'             => @$inputdata['province_code'],
                    'customer_status'           => 'A',
                    'created_by'                => $this->puser,  
                    'updated_by'                => $this->puser  
                    );

            $dataCustomes2 = array(
                    'customer_tel1'             => @$inputdata['customer_tel1'],
                    'customer_tel2'             => @$inputdata['customer_tel2'],
                    'customer_addr'             => @$inputdata['customer_addr'],
                    'district_code'             => @$inputdata['district_code'],
                    'amphur_code'               => @$inputdata['amphur_code'],
                    'zipcode_code'              => @$inputdata['zipcode_code'],
                    'province_code'             => @$inputdata['province_code'],
                    'updated_by'                => $this->puser    
                    );
           //-------------------------------- End Insert or Update Customers

            if($query && $queryRepair)
            {
                if($inputdata['customer_id'] == 0)
                {
                    //Insert Customer
                    $this->db->insert('customer',$dataCustomes);
                }
                else
                {
                    //Update Customer
                    $this->db->set($dataCustomes2);
                    $this->db->where('customer_id', $inputdata['customer_id']);
                    $this->db->update('customer');
                }
                return (array("status" => true,"data"=>$data)); 
            }
            else
            {
                return (array("status" => false,"data"=>$data)); 
            }
        }

        public function insertDataTypeCP($inputdata)
        {
            $this->load->helper('url');

            //-------------------------------- Insert Service Trans
            $data = array(
                    'servicetrans_code'                 => @$inputdata['servicetrans_code'],
                    'servicetrans_type'                 => @$inputdata['servicetrans_type'],
                    'servicetrans_con_name'         => @$inputdata['servicetrans_con_name'],
                    'servicetrans_con_tel'             => @$inputdata['servicetrans_con_tel'],
                    'servicetrans_member_type'    => @$inputdata['servicetrans_member_type'],
                    'status'                                => @$inputdata['status'],
                    'servicetrans_status'               => @$inputdata['servicetrans_status'],
                    'created_by'                        => $this->puser,
                    'updated_by'                        => $this->puser
                    );
            $query = $this->db->insert('servicetrans',$data);
            //-------------------------------- End Insert Service Trans

            if($query)
            {
                return (array("status" => true,"data"=>$data)); 
            }
            else
            {
                return (array("status" => false,"data"=>$data)); 
            }
        }

        public function insertDataTypeFAQ($inputdata)
        {
            $this->load->helper('url');

            //-------------------------------- Insert Service Trans
            $data = array(
                    'servicetrans_type'                 => @$inputdata['servicetrans_type'],
                    'faqtype_id'                          => @$inputdata['faqtype_id'],
                    'faq_id'                                => @$inputdata['faq_id'],
                    'servicetrans_member_type'    => @$inputdata['servicetrans_member_type'],
                    'status'                                => @$inputdata['status'],
                    'servicetrans_status'               => @$inputdata['servicetrans_status'],
                    'created_by'                        => $this->puser,
                    'updated_by'                        => $this->puser
                    );
            $query = $this->db->insert('servicetrans',$data);
            //-------------------------------- End Insert Service Trans

            if($query)
            {
                return (array("status" => true,"data"=>$data)); 
            }
            else
            {
                return (array("status" => false,"data"=>$data)); 
            }
        }

        function getTblCustomer($inputdata = null)
        {

            $txtType = @$inputdata['custType'];
            $txtSearch = @$inputdata['custTxt'];

            //$sql = "SELECT * FROM CUSTOMER WHERE customer_name Like '%mr%' LIMIT 50";
            if($txtType == 'custName'){
                $sql = "SELECT 
                customer_id,
                customer_code,
                customertype_code,
                customer_name,
                customer_surname,
                customer_tel1,
                customer_tel2
                customer_email,
                customer_addr,
                district_code,
                amphur_code,
                zipcode_code,
                IFNULL(province_code,'') AS province_code,
                country_code,
                customer_status,
                status,              
                flag,
                created_date,
                created_by,
                updated_date,
                updated_by,
                remark
                FROM CUSTOMER WHERE customer_name Like '%$txtSearch%' LIMIT 50";
            }else{
                $sql = "SELECT * FROM CUSTOMER WHERE customer_tel1 Like '%$txtSearch%' or customer_tel2 Like '%$txtSearch%'  LIMIT 50";
            }

              $query = $this->db->query($sql);
              //return $query->result_array();

            if($query){
              return (array("status" => true,"data"=>$query->result_array())); 
           }
           else{
              return (array("status" => false,"data"=>$data)); 
           }
        }

        function getDrpdwnItemgroup()
        {
            $sql = "SELECT * FROM itemgroup WHERE itemgrp_status = 'A'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnSubitemgroup($itemgrp_code = null)
        {
            $sql = "SELECT * FROM subitemgroup WHERE itemgrp_code ='$itemgrp_code' AND subitemgrp_status = 'A'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnItem($subitemgrp_code = null)
        {
            $sql = "SELECT * FROM item WHERE subitemgrp_code ='$subitemgrp_code' AND item_status = 'A' GROUP BY item_alt_name";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnZone($province_code)
        {
            if($province_code)
            {
                $sql = "SELECT * FROM p_zone WHERE zone_code = (SELECT zone_code FROM p_province WHERE province_code = '$province_code')";
            }
            else
            {
                $sql = "SELECT * FROM p_zone";
            }
                $query = $this->db->query($sql);
                return $query->result_array();
        }

        function getDrpdwnProvince($zone_code = null)
        {
            if($zone_code)
            {
                $sql = "SELECT * FROM p_province WHERE zone_code ='$zone_code' ORDER BY province_name";
            }
            else
            {
                $sql = "SELECT * FROM p_province ORDER BY province_name";
            }
            
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnAmphur($province_code = NULL)
        {
            if($province_code)
            {
                $sql = "SELECT * FROM p_amphur WHERE province_code ='$province_code'";
            }
            else
            {
                $sql = "SELECT * FROM p_amphur";
            }
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnDistrict($amphur_code = NULL)
        {
            if($amphur_code)
            {
                $sql = "SELECT * FROM p_district WHERE amphur_code ='$amphur_code'";
            }
            else
            {
                $sql = "SELECT district_code,district_name FROM p_district";
            }
            
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnZipcode($district_code = NULL)
        {
            $sql = "SELECT zipcode_code FROM p_zipcode WHERE district_code ='$district_code'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnSVC($province_code = NULL)
        {
            $sql = "SELECT * FROM servicecenter WHERE province_code ='$province_code'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnSVCReturn($item_code = null,$serialno = null)
        {
            $sql = "SELECT DISTINCT sv.servicecenter_code, sv.servicecenter_name_th FROM servicetrans s, servicecenter sv WHERE s.servicecenter_code = sv.servicecenter_code AND s.item_code = '$item_code' AND s.servicetrans_serial = '$serialno' ORDER BY s.created_date ASC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnFAQType()
        {
            $sql = "SELECT faqtype_id,faqtype_name FROM faqtype WHERE status = 'A'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getDrpdwnFAQ($faqtype_id)
        {
            $sql = "SELECT faq.faqtype_id,faq.faq_id,faq.faq_name FROM faq, faqtype WHERE faq.faqtype_id = faqtype.faqtype_id AND faq.status = 'A' AND faq.faqtype_id = '$faqtype_id'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getChkSymtomItemgroup($itemgrp_code = NULL)
        {
            $sql = "SELECT * FROM symptom_itemgroup WHERE itemgrp_code ='$itemgrp_code'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getChkSymtomSubitemgroup($subitemgrp_code = NULL)
        {
            $sql = "SELECT * FROM symptom_subitemgroup WHERE subitemgrp_code ='$subitemgrp_code'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getChkSymtomItem($item_code = NULL)
        {
            $sql = "SELECT * FROM symptom_item WHERE item_code = SUBSTRING_INDEX('$item_code',' ', 1)";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getChkWarrantyHistory($item = null,$serialno = null)
        {
            $sql = "SELECT warranty_code,DATE_FORMAT(is_custdate,'%d/%m/%Y') AS is_custdate,
                    DATE_FORMAT(warranty_end_date,'%d/%m/%Y') AS warranty_end_date,
                    DATE_FORMAT(NOW(),'%d/%m/%Y') AS TODAY,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'IN' ELSE 'OUT' END) AS WARRANTYRESULT,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'ในประกัน' ELSE 'นอกประกัน' END) AS WARRANTYDESC,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'success' ELSE 'danger' END) AS WARRANTYCOLOR,
                    item_code,
                    'ประวัติการแจ้งซ่อม' as bysystem,
                    servicetrans_serial,
                    is_dealer_name,
                    servicetrans_code,
                    servicetrans_status FROM servicetrans WHERE item_code = '$item' AND servicetrans_serial = '$serialno' LIMIT 1";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getChkWarrantyTbl($item = null,$serialno = null,$itemgroup = null)
        {
            $sql = "SELECT '' AS is_custdate,warranty_code,
                    DATE_FORMAT(warranty_end_date,'%d/%m/%Y') AS warranty_end_date,
                    DATE_FORMAT(NOW(),'%d/%m/%Y') AS TODAY,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'IN' ELSE 'OUT' END) AS WARRANTYRESULT,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'ในประกัน' ELSE 'นอกประกัน' END) AS WARRANTYDESC,
                    (CASE WHEN DATE_FORMAT(NOW(),'%Y%m%d') <= DATE_FORMAT(warranty_end_date,'%Y%m%d') 
                        THEN 'success' ELSE 'danger' END) AS WARRANTYCOLOR,
                    item_code,
                    'บัตรรับประกัน' as bysystem,
                    warranty_serial as servicetrans_serial,
                    '' AS is_dealer_name FROM warranty_$itemgroup WHERE item_code Like '$item%' AND warranty_serial = '$serialno' LIMIT 1";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function getTblServicetrans()
        {
            $sql = "SELECT s.servicetrans_code, DATE_FORMAT(s.servicetrans_date,'%d/%m/%Y') AS servicetrans_date, s.item_code, s.servicetrans_serial, sv.servicecenter_name_th, s.servicetrans_status
                    FROM servicetrans s, servicecenter sv
                    WHERE s.servicecenter_code = sv.servicecenter_code AND s.servicetrans_type = 'SE' AND s.servicetrans_status = 'WAIT ACCEPT' AND s.status = 'A'";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        //-----------------------------
         public function getRunningSVSql()
         {
            $iTblname = 'servicetrans';
            $iTbltype = 'servicetrans';

            
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

        //----------------------------
}

?>

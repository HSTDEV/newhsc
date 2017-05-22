<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HSC | Hitachi Service Center</title>

    <!-- Bootstrap -->
    <link href="<?=base_url();?>assets/theme/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url();?>assets/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url();?>assets/theme/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url();?>assets/theme/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=base_url();?>assets/theme/build/css/custom.min.css" rel="stylesheet">

    <!-- wesome-bootstrap-checkbox -->
    <link href="<?=base_url();?>assets/css/awesome-bootstrap-checkbox/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/awesome-bootstrap-checkbox/build.css" rel="stylesheet">
  </head>

  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-h-square fa-spin fa-lg"></i> <span>HSC</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?=base_url();?>assets/img/avatar.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Surachet Lertmongkolroj</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="height:90%;">
              <div class="menu_section">
                 <h3>Administrator</h3> <!-- Member Group -->
                <ul class="nav side-menu">
                  <li><a href="<?=site_url();?>/main_ctrl/dashboard"><i class="fa fa-home" style="color:#1ABB9C"></i> หน้าแรก</a></li>
                  <li><a><i class="fa fa-phone-square" style="color:#1ABB9C"></i> รายการแจ้งซ่อม (HST) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=site_url();?>/se_ctrl/se_call">รับเรื่องแจ้งซ่อม</a></li>
                      <li><a href="<?=site_url();?>/se_ctrl/se_call_manage">จัดการรายการแจ้งซ่อม</a></li>
                      <li><a href="<?=site_url();?>/se_ctrl/se_call_old"  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รับเรื่องแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*งานที่แจ้งจากฝ่าย Sale </a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*งานที่คืนจากศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยืนยันปิด Job</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสินค้าซ่อมออกจากห้องช่าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการยืนยันจัดส่งสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยืนยันรายการวางบิลซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์รายการวางบิล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการยกเลิกบิล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*สถานะการซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็คงานศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็คงานที่ส่งไปศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*งานที่ไม่พบข้อมูลในฐานข้อมูล ในประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*งานที่ไม่พบข้อมูลในฐานข้อมูล นอกประกัน</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-phone-square" style="color:#1ABB9C"></i> รายการแจ้งซ่อม (SV) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=site_url();?>/se_ctrl/">รับเรื่องแจ้งซ่อม</a></li>
                      <li><a href="<?=site_url();?>/se_ctrl/">จัดการรายการแจ้งซ่อม</a></li>
                      <li><a href="<?=site_url();?>/se_ctrl/">งานซ่อมที่ส่งมาจาก Hitachi</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รับเรื่องแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*งานซ่อมที่ส่งมาจากHST</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*จัดเก็บรายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยืนยันปิดJob</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยืนยันรายการวางบิล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์ใบสรุปรายการวางบิล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็คสถานะการวางบิล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*สถานะการซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยกเลิกการซ่อม</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-phone-square" style="color:#1ABB9C"></i> รายการแจ้งซ่อม (Technician) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รับเรื่องแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*จัดเก็บรายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสินค้าซ่อมออกจากห้องช่าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูล</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยกเลิกการซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ข้อมูลเทคนิค</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cubes" style="color:#1ABB9C"></i> รายการสั่งซื้ออะไหล่ (HST) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="<?=site_url();?>/Part_ctrl/po_hst_manage">*รายการสั่งซื้ออะไหล่</a></li>
                      <li><a href="<?=site_url();?>/Part_ctrl/po_hst_inv_manage">*จ่ายอะไหล่</a></li>
                      <li><a href="<?=site_url();?>/Part_ctrl/po_hst_tst_manage">*บันทึกข้อมูลการขนส่ง</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">รายการเคลมอะไหล่</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">รายการจองอะไหล่คงค้าง</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">รายการคืนอะไหล่</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">บันทึกข้อมูลการขนส่ง</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">พิมพ์ใบรับฝากรวม</a></li>
                      <li><a style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">ค้นหาข้อมูลอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ซื้ออะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็ครายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสั่งซื้ออะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการยืนยันการสั่งซื้อ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการเคลมอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการยืนยันเคลมอะไหล่</a></li>
                     
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*บันทึกข้อมูลวันที่ประมาณการจัดส่ง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูลในหมวดสั่งซื้ออะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายงานคงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการรับคืนอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายงานการจัดส่งสินค้าออกจากโกดัง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Reprint ใบรับฝากไปรษณีย์</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยกเลิกรายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Adjust Stock</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Check Part Different From AX and Web Service</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Partmaster</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลการขนส่ง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูล Invoice</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cubes" style="color:#1ABB9C"></i> รายการสั่งซื้ออะไหล่ (SV) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=site_url();?>/Part_ctrl/po_sv">*ซื้ออะไหล่</a></li>
                      <li><a href="<?=site_url();?>/Part_ctrl/po_sv_manage">*รายการสั่งซื้ออะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เคลมอะไหล่พิเศษ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสั่งซื้ออะไหล่คงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการจองอะไหล่คงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการคืนอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขรายการคืนอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ในประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*นอกประกัน</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cubes" style="color:#1ABB9C"></i> รายการสั่งซื้ออะไหล่ (Technician) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็ครายการอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*จัดการรูป Exploded Views และ Part อะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เบิกอะไหล่นอกประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เคลมอะไหล่ในประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เคลมอะไหล่พิเศษ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสั่งซื้ออะไหล่คงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการจองอะไหล่คงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการเคลมอะไหล่คงค้าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการคืนอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Reprint รายการคืนอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูลอะไหล่</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-exchange" style="color:#1ABB9C"></i> Cargo Return (HST) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการคัดสินค้าคืน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รับสินค้าเข้าโกดัง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เจ้าหน้าที่ตรวจสอบสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลสินค้าคืน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการสินค้าที่ไม่ตรงกับต้นฉบับ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการออก Special Request</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รอออก CR กับ Job</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการ Assign ช่าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เบิกอะไหล่ในประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ตีสภาพ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการ ตี Grade สินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Complete Job</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการ Confirm Grade สินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการแก้ไข Grade สินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการโอนสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูลสินค้าคืน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลให้ Sales Admin </a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Reprint ใบรับฝากและตรวจสภาพสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ยกเลิกข้อมูลสินค้าคืน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Returned Invoice Request Report</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Returned Cargo Checklist Report</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-exchange" style="color:#1ABB9C"></i> Cargo Return (SV) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการคัดสินค้าคืน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ค้นหาข้อมูลสินค้าคืน</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-exchange" style="color:#1ABB9C"></i> Cargo Return Dealer <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการอนุมัติส่วนลด</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*บันทึกรายการส่วนลด</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการ Approved</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายการรอ Deaaler ยืนยัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์ใบ Approved</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*บันทึกเลขที่ CN</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Summary Report of CR products</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลสินค้าคืน</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file" style="color:#1ABB9C"></i> Report (HST) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Efficiency Report</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายงานการแจ้งซ่อม (Repair Data Record)</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Report Bill ASC</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เช็คงานศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*สรุปรายจ่ายเงินชดเชยค่าซ่อมสินค้าในประกันสำหรับศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*REPORT OF WARRANTEE PRODUCT REPAIRING SERVICE CENTER</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*REPORT CALLCENTER</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ASC QUEUE ARRARGMENT REPORT</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file" style="color:#1ABB9C"></i> Report (SV) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Reprintใบขอเบิกเงินช่วยเหลือค่าบริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Reprintใบแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์ใบขอเบิกเงินช่วยเหลือค่าบริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์ใบขอชดเชยอะไหล่</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*พิมพ์ใบแจ้งซ่อม</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ข้อมูลเทคนิค</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file" style="color:#1ABB9C"></i> Report (Technician) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รายงานการแจ้งซ่อม (Repair Data Record)</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-list-alt" style="color:#1ABB9C"></i> บัตรรับประกัน (Warranty Data Enquiry) <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*จัดเก็บข้อมูลบัตรประกัน</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*จัดเก็บข้อมูลบัตรประกัน(Period)</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ข้อมูลบัตรประกัน Online</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลบัตรรับประกัน(Period)</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แก้ไขข้อมูลบัตรรับประกัน</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-gears" style="color:#1ABB9C"></i> Back Office <span class="fa fa-chevron-down" style="color:#1ABB9C"></span></a>
                    <ul class="nav child_menu">
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ผู้ใช้งานระบบ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*แจ้งเตือนต่อสัญญาศูนย์บริการ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*เกี่ยวกับช่าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ประเภทช่าง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*อัตราค่าช่วยเหลือ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ประเภทสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*อาการเสีย</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*อาการเสียเฉพาะ</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ประเภท JOB</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ประเภทการจัดส่ง</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*สถานะลูกค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*Manage Dealer</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*รุ่นสินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*อุปกรณ์ สินค้า</a></li>
                      <li><a  style="color:#FFEB3B" href="<?=site_url();?>/se_ctrl/">*ประเภทการรับเรื่อง</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu --><!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small"> -->
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a> -->
            <!-- </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url();?>assets/img/avatar.jpg" alt="">Surachet
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?=site_url();?>/main_ctrl/account_setting"> Account Setting</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

<?php $this->load->view('layout/header.php')?>
<style type="text/css">
    form.tab-form-demo .tab-pane {
      margin: 20px 20px;
    }
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(<?=base_url();?>assets/img/Preloader_21.gif) center no-repeat #fff;
    }
</style>

<!-- page content -->
<div class="se-pre-con"></div>
<div ng-app="AppJS" ng-controller="StepCtrl as $ctrl" class="right_col" role="main">
<div class="">
<div class="page-title">

</div>
 <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>รับเรื่องแจ้งซ่อม</h2>
          <div class="clearfix">
          
          </div>
        </div>
        <div class="x_content">
          <uib-progressbar class="progress-striped" value="progress" type="info"><b>{{progress}}%</b></uib-progressbar>
          <!-- ==================================== Button ===================================== -->
          
          <div>
            <div class="row" align="center" ng-show="!seType"></br>
              <!-- <pre>{{seType || 'null'}}</pre> -->
              <div class="btn-group">
                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'1'" ng-click="progress = 20">แจ้งซ่อม</label>
                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'2'" ng-click="progress = 33">ติดตามงานซ่อม</label>
                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'3'" ng-click="progress = 100">ร้องเรียน</label>
                  <label class="btn btn-warning" ng-model="seType" uib-btn-radio="'4'" ng-click="progress = 100">สอบถามข้อมูลทั่วไป</label>
              </div><hr/>
            </div>
          <!-- =============================================================================== -->
          <!-- ==================================== SE ====================================== -->
          <!-- <form name="SEFORM"> -->
            <div ng-show="seType == '1'">
              <div align="right">
                <!-- Step 1 -->
                <a href="<?=site_url();?>/se_ctrl/se_call" class="btn btn-default">กลับไปเมนูรับเรื่องแจ้งซ่อม</a>
                <button type="button" class="btn btn-primary" ng-click="SEactive = 1;progress = 40" ng-show="tblCustomer.length > 0 && SEactive == 0">Next</button>
                
                <!-- Step 2 -->
                <button type="button" class="btn btn-default" ng-click="SEactive = 0;progress = 20" ng-show="SEactive == 1">Back</button>
                <button type="button" class="btn btn-primary" ng-click="SEactive = 2;progress = 60" ng-show="SEactive == 1" ng-disabled="object.txtName.length==0 || object.txtTel1.length==0 || object.txtAddress.length==0 || object.txtZipcode.length==0 || object.txtConName.length==0 || object.txtConTel.length==0 || provinceCustObj.selected == '' || amphurCustObj.selected == '' || districtCustObj.selected == ''">Next</button>
                
                <!-- Step 3 -->
                <button type="button" class="btn btn-default" ng-click="SEactive = 1;progress = 40" ng-show="SEactive == 2">Back</button>
                <button type="button" class="btn btn-primary" ng-click="SEactive = 3;progress = 80" ng-show="SEactive == 2" ng-disabled="stp3nextDisabled">Next</button>
                
                <!-- Step 4 -->
                <button type="button" class="btn btn-default" ng-click="SEactive = 2;progress = 60" ng-show="SEactive == 3">Back</button>
                <button type="button" class="btn btn-primary" ng-click="SEactive = 4;progress = 100" ng-show="SEactive == 3" ng-disabled="stp4nextDisabled">Next</button>
                
                <!-- Step 5 -->
                <button type="button" class="btn btn-default" ng-click="SEactive = 3;progress = 80" ng-show="SEactive == 4">Back</button>
                <button type="button" class="btn btn-success" ng-click="insertTypeSE()" ng-show="SEactive == 4">OK</button>
              </div>

              <uib-tabset active="SEactive" justified="true" type="tabs">
                <uib-tab index="0" heading="Step 1 : ค้นหาประวัติลูกค้า" disable="true">
                  <h2><center>Step 1 : ค้นหาประวัติลูกค้า</center></h2>
                  <div style="margin-bottom:20%">
                      
                      <div style="height: 400px;">
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <input class="form-control col-md-7 col-xs-12" type="text" name="txtCustSearch" ng-model="txtCustSearch">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" align="center">
                              <div class="btn-group" ng-show="txtCustSearch.length > 0"><br />
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearch,searchCheck);clearSelectedCustomer()" ng-model="searchCheck" uib-btn-radio="'custName'">ค้นหาจากชื่อลูกค้า</label>
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearch,searchCheck);clearSelectedCustomer()" ng-model="searchCheck" uib-btn-radio="'custTel'">ค้นหาจากเบอร์โทรลูกค้า</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="table-responsive col-md-1"></div>
                            <div class="table-responsive col-md-10" align="center"><br />
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch.length == 0">กรุณากรอกคำค้นหา</h2>
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch.length > 0">ไม่พบข้อมูล</h2>
                                <table ng-show="tblCustomer.length > 0" style="color:#000000" width="100%">
                                  <tr>
                                    <td>
                                       <div style="height:400px; overflow:auto;">
                                         <table class="table table-striped jambo_table">
                                         <thead>
                                            <tr>
                                              <th width="10%" style="text-align:center;">เลือก</th>
                                              <th width="25%" style="text-align:center;">ชื่อลูกค้า</th>
                                              <th width="20%" style="text-align:center;">เบอร์โทรศัพท์</th>
                                              <th width="45%" style="text-align:center;">ที่อยู่</th>
                                            </tr>
                                          </thead>
                                         <tbody>
                                            <tr ng-repeat="data in tblCustomer">
                                              <td style="text-align:center;">
                                                <div class="radio radio-primary" style="margin-top: 0px;margin-bottom: 0px;">
                                                  <input type="radio" ng-model="ChkCustomers" name="custCheck" value="{{ data.customer_id }}" 
                                                  ng-click="setSelectedCustomer(
                                                  data.customer_id,
                                                  data.customer_name,
                                                  data.customer_tel1,
                                                  data.customer_tel2,
                                                  data.customer_addr,
                                                  data.province_code,
                                                  data.district_code,
                                                  data.amphur_code,
                                                  data.zipcode_code)">
                                                  <label></label>
                                                </div>
                                              </td>
                                              <td>
                                                  {{data.customer_name}}
                                                  <div style="color:red;" ng-if="data.customer_status === 'B'">(Blacklist)</div>
                                              </td>
                                              <td>{{data.customer_tel1}}</td>
                                              <td>{{data.customer_addr}}</td>
                                            </tr>
                                          </tbody>
                                        </table> 
                                       </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                          </div>
                        </div>
                  </div>
                </uib-tab>
                <uib-tab index="1" heading="Step 2 : รายละเอียดลูกค้า" disable="true">
                  <h2><center>Step 2 : รายละเอียดลูกค้า</center></h2>
                  <div style="margin-bottom:20%">
                    <div style="height: 400px;">
                      <div class="row">
                        <div class="table-responsive col-md-12" align="center"></br>
                            <table style="width:100%;" border="0">
                                <tr style="height: 50px;">
                                  <td class="col-md-1"></td>
                                  <td class="col-md-2" align="right"><label for="">ชื่อลูกค้า :</label></td>
                                  <td colspan="2" class="col-md-3">
                                    <input class="form-control" type="text" name="txtName" ng-model="object.txtName" ng-disabled="txtActive" required>
                                  </td>
                                  <td class="col-md-1"></td>
                                </tr>
                                <tr style="height: 50px;">
                                  <td class="col-md-1"></td>
                                  <td class="col-md-2" align="right"><label for="">เบอร์โทร :</label></td>
                                  <td class="col-md-3">
                                    <input class="form-control" type="text" name="txtTel1" ng-model="object.txtTel1" required>
                                  </td>
                                  <td class="col-md-2" align="right"><label for="">เบอร์โทร (สำรอง) :</label></td>
                                  <td class="col-md-3">
                                    <input class="form-control" type="text" ng-model="object.txtTel2">
                                  </td>
                                  <td class="col-md-1"></td>
                                </tr>
                                <tr style="height: 50px;">
                                  <td class="col-md-1"></td>
                                  <td class="col-md-2" align="right"><label for="">ที่อยู่ :</label></td>
                                  <td colspan="3" class="col-md-3">
                                    <input class="form-control" type="text" name="txtAddress" ng-model="object.txtAddress" required>
                                  </td>
                                  <td class="col-md-3"></td>
                                  <td class="col-md-1"></td>
                                </tr>
                                <tr style="height: 50px;">
                                  <td class="col-md-1"></td>
                                  <td class="col-md-2" align="right"><label for="">จังหวัด :</label></td>
                                  <td class="col-md-3">
                                      <select class="form-control" ng-change="do_province(provinceCustObj.selected)" ng-model="provinceCustObj.selected" ng-options="provinceCust.province_code as provinceCust.province_name for provinceCust in drpdwnProvince">
                                        <option value="">- เลือก จังหวัด -</option>
                                      </select>
                                  </td>
                                  <td class="col-md-2" align="right"><label for="">อำเภอ :</label></td>
                                  <td class="col-md-3">
                                    <select class="form-control" ng-change="do_amphur(amphurCustObj.selected)" ng-model="amphurCustObj.selected" ng-options="amphurCust.amphur_code as amphurCust.amphur_name for amphurCust in drpdwnAmphur">
                                        <option value="">- เลือก อำเภอ -</option>
                                    </select>
                                  </td>
                                  <td class="col-md-1"></td>
                                </tr>
                                <tr style="height: 50px;">
                                  <td class="col-md-1"></td>
                                  <td class="col-md-2" align="right"><label for="">ตำบล :</label></td>
                                  <td class="col-md-3">
                                    <select class="form-control" ng-change="do_district(districtCustObj.selected)" ng-model="districtCustObj.selected" ng-options="districtCust.district_code as districtCust.district_name for districtCust in drpdwnDistrict">
                                        <option value="">- เลือก ตำบล -</option>
                                     </select>
                                  </td>
                                  <td class="col-md-2" align="right"><label for="">รหัสไปรษณีย์ :</label></td>
                                  <td class="col-md-3">
                                    <input class="form-control" type="text" name="txtZipcode" ng-model="object.txtZipcode" required>
                                  </td>
                                  <td class="col-md-1"></td>
                                </tr>
                                <tr style="height: 50px;">
                                <td class="col-md-1"></td>
                                <td class="col-md-2" align="right"><label for="">ชื่อผู้ติดต่อ :</label></td>
                                <td class="col-md-3">
                                  <input class="form-control" type="text" name="txtConName" ng-model="object.txtConName" required>
                                </td>
                                <td class="col-md-2" align="right"><label for="">เบอร์โทร (ผู้ติดต่อ) :</label></td>
                                <td class="col-md-3">
                                  <input class="form-control" type="text" name="txtConTel" ng-model="object.txtConTel" required>
                                </td>
                                <td class="col-md-1"></td>
                              </tr>
                            </table>
                            
                        </div>
                      </div>
                    </div>  
                  </div>
                </uib-tab>
                <uib-tab index="2" heading="Step 3 : รายละเอียดสินค้า" disable="true">
                  <h2><center>Step 3 : รายละเอียดสินค้า</center></h2>
                  <div style="margin-bottom:20%">
                    <div class="row">
                       <div class="table-responsive col-md-12" align="center">
                          </br>
                          <table style="width:100%;" border="0">
                             <tr style="height: 50px;">
                                <td class="col-md-2"></td>
                                <td class="col-md-3">
                                  <select class="form-control" ng-model="itemgroup" ng-change="do_itemgroup(itemgroup.itemgrp_code)"  ng-init="itemgroup=drpdwnItemgroup[0]" ng-options="data as data.itemgrp_desc_th for data in drpdwnItemgroup">
                                     <option value="">- เลือก กลุ่มสินค้า -</option>
                                  </select>
                                </td>
                                <td class="col-md-3">
                                   <select class="form-control" ng-model="subitemgroup" ng-change="do_subitemgroup(subitemgroup.subitemgrp_code)" ng-init="subitemgroup=drpdwnSubitemgroup[0]" ng-options="data as data.subitemgrp_desc for data in drpdwnSubitemgroup">
                                     <option value="">- เลือก ประเภทสินค้า -</option>
                                  </select>
                                </td>
                                <td class="col-md-2">
                                   <select class="form-control" ng-model="item" ng-change="do_item(item.item_alt_name)" ng-init="item=drpdwnItem[0]" ng-options="data as data.item_alt_name for data in drpdwnItem" required>
                                     <option value="">- เลือก รุ่นสินค้า -</option>
                                  </select>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 50px;">
                                <td class="col-md-2"></td>
                                <td class="col-md-3" align="right">หมายเลขเครื่อง</td>
                                <td class="col-md-3">
                                   <input class="form-control" type="text" ng-model="serialno">
                                </td>
                                <td class="col-md-2">
                                   <button type="button" class="btn btn-primary" ng-show="serialno.length > 0 && item.item_code.length > 0" ng-model="chkWarranty" ng-click="getChkWanranty(serialno,itemgroup.itemgrp_code,subitemgroup.subitemgrp_code,item.item_alt_name)">ตรวจสอบประกัน</button> 
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr ng-show="WarrantyData.length > 0" ng-repeat="WarData in WarrantyData">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <table style="color:#000000;" class="table table-striped jambo_table">
                                      <thead>
                                         <tr align="center">
                                            <td colspan="6">
                                               <div>รายละเอียดบัตรรับประกัน</div>
                                            </td>
                                         </tr>
                                      </thead>
                                      <tbody>
                                         <tr>
                                            <td colspan="2">{{itemgroup.itemgrp_desc_th}} รุ่น : {{item.item_alt_name}}</td>
                                            <td colspan="2">Serial : {{WarData.servicetrans_serial}}</td>
                                            <td colspan="2">สถานะ : <span class="label label-{{WarData.WARRANTYCOLOR}}">{{WarData.WARRANTYDESC}}</span></td>
                                         </tr>
                                         <tr>
                                            <td colspan="2">วันที่ซื้อ : {{WarData.is_custdate}}</td>
                                            <td colspan="4">สถานที่ซื้อ : {{WarData.is_dealer_name}}</td>
                                         </tr>
                                         <tr>
                                            <td colspan="2">วันหมดอายุประกัน : {{WarData.warranty_end_date}}</td>
                                            <td colspan="4">ตรวจสอบประกันจาก : {{WarData.bysystem}}</td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                             <tr style="height: 40px;" ng-show="ChkSymtomItemgroup.length > 0 && WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">อาการเสียทั่วไปของ {{itemgroup.itemgrp_desc_th}}</label> <br/>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr>
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                   <div class="rows" ng-show="ChkSymtomItemgroup.length > 0 && WarrantyData.length > 0">
                                   <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItemgroup">
                                           <td>
                                              <div class="checkbox checkbox-primary" ng-show="$index%3==0">
                                                  <input class="styled" type="checkbox" ng-value="data.symitemgrp_code" ng-checked="exists(data.symitemgrp_code,data.symitemgrp_desc_th, selectedID,selectedName)" ng-click="toggle(data.symitemgrp_code,data.symitemgrp_desc_th,selectedID,selectedName)">
                                                  <label>{{data.symitemgrp_desc_th}}</label>
                                              </div>
                                            </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItemgroup">
                                           <td>
                                              <div class="checkbox checkbox-primary" ng-show="$index%3==1">
                                                <input type="checkbox" ng-value="data.symitemgrp_code" ng-checked="exists(data.symitemgrp_code,data.symitemgrp_desc_th,selectedID,selectedName)" ng-click="toggle(data.symitemgrp_code,data.symitemgrp_desc_th,selectedID,selectedName)"> 
                                                <label>{{data.symitemgrp_desc_th}}</label>
                                              </div>
                                            </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItemgroup">
                                           <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==2">
                                                <input type="checkbox" ng-value="data.symitemgrp_code" ng-checked="exists(data.symitemgrp_code,data.symitemgrp_desc_th,selectedID,selectedName)" ng-click="toggle(data.symitemgrp_code,data.symitemgrp_desc_th,selectedID,selectedName)"> 
                                                <label>{{data.symitemgrp_desc_th}}</label>
                                            </td>
                                        </tr>
                                     </table>
                                     </div>
                                   </div>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 30px;" ng-show="ChkSymtomSubitemgroup.length > 0 && WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">อาการเสียทั่วไปของ {{subitemgroup.subitemgrp_desc}}</label><br/>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr>
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                   <div class="rows" ng-show="ChkSymtomSubitemgroup.length > 0 && WarrantyData.length > 0">
                                   <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomSubitemgroup">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==0">
                                                <input type="checkbox" ng-value="data.symsubitemgrp_code" ng-checked="exists(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)" ng-click="toggle(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)"> 
                                                <label>{{data.symsubitemgrp_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomSubitemgroup">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==1">
                                                <input type="checkbox" ng-value="data.symsubitemgrp_code" ng-checked="exists(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)" ng-click="toggle(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)"> 
                                                <label>{{data.symsubitemgrp_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomSubitemgroup">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==2">
                                                <input type="checkbox" ng-value="data.symsubitemgrp_code" ng-checked="exists(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)" ng-click="toggle(data.symsubitemgrp_code,data.symsubitemgrp_desc_th, selectedID2,selectedName2)">  
                                                <label>{{data.symsubitemgrp_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                    </div>
                                   </div>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 30px;" ng-show="ChkSymtomItem.length > 0 && WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">อาการเสียเฉพาะรุ่น {{item.item_code}}</label><br/>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr>
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                  <div class="rows" ng-show="ChkSymtomItem.length > 0 && WarrantyData.length > 0">
                                   <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItem">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==0">
                                                <input type="checkbox" ng-value="data.symitem_code" ng-checked="exists(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)" ng-click="toggle(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)"> 
                                                <label>{{data.symitem_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItem">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==1">
                                                <input type="checkbox" ng-value="data.symitem_code" ng-checked="exists(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)" ng-click="toggle(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)"> 
                                                <label>{{data.symitem_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                     </div>
                                     <div class="col-md-4">
                                     <table style="width:100%;" border="0">
                                        <tr valign="top" ng-repeat="data in ChkSymtomItem">
                                          <td>
                                            <div class="checkbox checkbox-primary" ng-show="$index%3==2">
                                                <input type="checkbox" ng-value="data.symitem_code" ng-checked="exists(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)" ng-click="toggle(data.symitem_code,data.symitem_desc_th,selectedID3,selectedName3)">  
                                                <label>{{data.symitem_desc_th}}</label>
                                            </div>
                                          </td>
                                        </tr>
                                     </table>
                                    </div>
                                   </div>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 30px;" ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">กลุ่มอาการเสียอื่นๆ</label>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                   <input class="form-control" type="text" name="SymptomETC" ng-model="object.SymptomETC">
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 30px;" ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">ของที่นำมาด้วย</label>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                   <input class="form-control" type="text" name="withGoods" ng-model="object.withGoods">
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height: 30px;" ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center" style="height:50px;">
                                   <label for="">หมายเหตุ</label>
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr ng-show="WarrantyData.length > 0">
                                <td class="col-md-2"></td>
                                <td colspan="3" align="center">
                                   <input class="form-control" type="text" name="remark" ng-model="object.remark">
                                </td>
                                <td class="col-md-2"></td>
                             </tr>
                             <tr style="height:20px;"></tr>
                          </table>
                       </div>
                    </div>
                  </div>
                </uib-tab>
                <uib-tab index="3" heading="Step 4 : เลือกศูนย์บริการ" disable="true">
                  <h2><center>Step 4 : เลือกศูนย์บริการ</center></h2>
                  <div style="margin-bottom:20%">
                    <div style="height: 400px;">
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <label for="">Comment :</label>
                          <textarea ng-model="object.txtComment" id="" class="form-control" name="" rows="5"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <label for="">ศูนย์บริการ :</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                          <select class="form-control" ng-model="zone" ng-init="zone=drpdwnZone[0]" ng-change="do_zoneSV(zone.zone_code)"  
                              ng-options="data as data.zone_name for data in drpdwnZone track by data.zone_name">
                               <option value="">- เลือก ภาค -</option>
                          </select>
                        </div>
                      </div>
                      <div class="row"> 
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                          <select class="form-control" ng-change="do_provinceSV(provinceSV)"
                              ng-options="provinceSV.province_code as provinceSV.province_name for provinceSV in drpdwnProvinceSV" ng-model="provinceSV"">
                               <option value="">- เลือก จังหวัด -</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">   
                         <select class="form-control" ng-model="servicecenter" ng-init="servicecenter=drpdwnSVC[0]" 
                            ng-options="data as data.servicecenter_name_th for data in drpdwnSVC track by data.servicecenter_name_th" ng-change="do_service(servicecenter.servicecenter_code)" >
                             <option value="">- เลือก ศูนย์บริการ -</option>
                        </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <input type="checkbox" ng-model="disdropdown" ng-click="getDrpdwnSVCReturn(item.item_alt_name,serialno)" /><label for="">&nbsp;งาน Return จาก :</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                          <select class="form-control" ng-disabled="!disdropdown" ng-model="servicecenterReturn" ng-init="servicecenter=drpdwnSVCReturn[0]" 
                            ng-options="data as data.servicecenter_name_th for data in drpdwnSVCReturn track by data.servicecenter_name_th">
                             <option value="">- เลือก ศูนย์บริการ -</option>
                        </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </uib-tab>
                <uib-tab index="4" heading="Step 5 : ยืนยันงานแจ้งซ่อม" disable="true">
                  <h2><center>Step 5 : ยืนยันงานแจ้งซ่อม</center></h2>
                  <div style="margin-bottom:20%">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6" style="font-size: 16px;">
                        <table class="table" align="left">
                          <tr>
                            <td width="40%">ชื่อลูกค้า : </td>
                            <td width="60%">{{object.txtName}} </td>
                          </tr>
                          <tr>
                            <td>เบอร์โทรศัพท์ : </td>
                            <td>{{object.txtTel1}}      {{object.txtTel2}}</td>
                          </tr>
                          <tr>
                            <td>ที่อยู่ : </td>
                            <td>{{object.txtAddress}}</td>
                          </tr>
                          <tr>
                            <td>ชื่อผู้ติดต่อ : </td>
                            <td>{{object.txtConName}}</td>
                          </tr>
                          <tr>
                            <td>เบอร์โทรศัพท์ผู้ติดต่อ : </td>
                            <td>{{object.txtConTel}}</td>
                          </tr>
                          <tr>
                            <td>สินค้า</td>
                            <td>{{item.item_alt_name}}   <br/> [ {{itemgroup.itemgrp_desc_th}} ]  [ {{subitemgroup.subitemgrp_desc}} ]</td>
                          </tr>
                          <tr>
                            <td>สถานะการรับประกัน : </td>
                            <td><span class="label label-{{WarrantyData[0].WARRANTYCOLOR}}">{{WarrantyData[0].WARRANTYDESC}}</span></td>
                          </tr>
                          <tr>
                            <td>อาการเสีย</td>
                            <td>
                                  <p ng-repeat="symAll in selectedName">{{symAll}}</p> 
                                  <p ng-repeat="symAll2 in selectedName2">{{symAll2}}</p>
                                  <p ng-repeat="symAll3 in selectedName3">{{symAll3}}</p>  
                                  <p>{{object.SymptomETC}}</p>
                            </td>
                          </tr>
                          <tr>
                            <td>ส่งงานให้ศูนย์บริการ : </td>
                            <td>{{servicecenter.servicecenter_name_th}}</td>
                          </tr>
                          <tr>
                            <td>งาน Return จาก : </td>
                            <td>{{servicecenterReturn.servicecenter_name_th}}</td>
                          </tr>
                          <tr>
                            <td>Comment</td>
                            <td>{{object.txtComment}}</td>
                          </tr>
                          <tr>
                            <td>ของที่นำมาด้วย</td>
                            <td>{{object.withGoods}}</td>
                          </tr>
                          <tr>
                            <td>หมายเหตุ</td>
                            <td>{{object.remark}}</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </uib-tab>
              </uib-tabset>
            </div>
            <!-- </form> -->
            <!-- ================================ FL ===================================== -->
            <div ng-show="seType == '2'">
              <div align="right">
                <!-- Step 1 -->
                <a href="<?=site_url();?>/se_ctrl/se_call" class="btn btn-default">กลับไปเมนูรับเรื่องแจ้งซ่อม</a>
                <button type="button" class="btn btn-primary" ng-click="FLactive = 1;progress = 66" ng-show="tblCustomer.length > 0 && FLactive == 0">Next</button>
                
                <!-- Step 2 -->
                <button type="button" class="btn btn-default" ng-click="FLactive = 0;progress = 33" ng-show="FLactive == 1">Back</button>
                <button type="button" class="btn btn-primary" ng-click="FLactive = 2;progress = 99" ng-show="FLactive == 1" ng-disabled="object.txtName.length==0 || object.txtTel1.length==0 || object.txtAddress.length==0 || object.txtZipcode.length==0 || object.txtConName.length==0 || object.txtConTel.length==0 || provinceCustObj.selected == '' || amphurCustObj.selected == '' || districtCustObj.selected == ''">Next</button>
                
                <!-- Step 3 -->
                <button type="button" class="btn btn-default" ng-click="FLactive = 1;progress = 66" ng-show="FLactive == 2">Back</button>
                <button type="button" class="btn btn-primary" ng-click="FLactive = 3" ng-show="FLactive == 2" ng-disabled="">Next</button>
              </div>

              <!-- <uib-tabset active="FLactive" justified="true" type="tabs">
                <uib-tab index="0" heading="Step 1 : ค้นหาประวัติลูกค้า" disable="true">
                  <h2><center>Step 1 : ค้นหาประวัติลูกค้า</center></h2>
                  <div style="margin-bottom:20%">
                      <div style="height: 400px;">
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <input class="form-control col-md-7 col-xs-12" type="text" name="txtCustSearchFL" ng-model="txtCustSearchFL">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" align="center">
                              <div class="btn-group" ng-show="txtCustSearchFL.length > 0"><br />
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearchFL,searchCheck);clearSelectedCustomer()" ng-model="searchCheck" uib-btn-radio="'custName'">ค้นหาจากชื่อลูกค้า</label>
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearchFL,searchCheck);clearSelectedCustomer()" ng-model="searchCheck" uib-btn-radio="'custTel'">ค้นหาจากเบอร์โทรลูกค้า</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="table-responsive col-md-1"></div>
                            <div class="table-responsive col-md-10" align="center"><br />
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch.length == 0">กรุณากรอกคำค้นหา</h2>
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch.length > 0">ไม่พบข้อมูล</h2>
                                <table ng-show="tblCustomer.length > 0" style="color:#000000" width="100%">
                                  <tr>
                                    <td>
                                       <div style="height:400px; overflow:auto;">
                                         <table class="table table-striped jambo_table">
                                         <thead>
                                            <tr>
                                              <th width="10%" style="text-align:center;">เลือก</th>
                                              <th width="25%" style="text-align:center;">ชื่อลูกค้า</th>
                                              <th width="20%" style="text-align:center;">เบอร์โทรศัพท์</th>
                                              <th width="45%" style="text-align:center;">ที่อยู่</th>
                                            </tr>
                                          </thead>
                                         <tbody>
                                            <tr ng-repeat="data in tblCustomer">
                                              <td style="text-align:center;">
                                                <div class="radio radio-primary" style="margin-top: 0px;margin-bottom: 0px;">
                                                  <input type="radio" ng-model="ChkCustomers" name="custCheck" value="{{ data.customer_id }}" 
                                                  ng-click="setSelectedCustomer(
                                                  data.customer_id,
                                                  data.customer_name,
                                                  data.customer_tel1,
                                                  data.customer_tel2,
                                                  data.customer_addr,
                                                  data.province_code,
                                                  data.district_code,
                                                  data.amphur_code,
                                                  data.zipcode_code)">
                                                  <label></label>
                                                </div>
                                              </td>
                                              <td>
                                                  {{data.customer_name}}
                                                  <div style="color:red;" ng-if="data.customer_status === 'B'">(Blacklist)</div>
                                              </td>
                                              <td>{{data.customer_tel1}}</td>
                                              <td>{{data.customer_addr}}</td>
                                            </tr>
                                          </tbody>
                                        </table> 
                                       </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                          </div>
                        </div>
                  </div>
                </uib-tab>
                <uib-tab index="1" heading="Step 2 : " disable="true">
                  <h2><center>Step 2 : ค้นหาประวัติลูกค้า</center></h2>
                  <div style="margin-bottom:20%">
                    
                  </div>
                </uib-tab>
                <uib-tab index="2" heading="Step 3 : " disable="true">
                  <h2><center>Step 3 : ค้นหาประวัติลูกค้า</center></h2>
                  <div style="margin-bottom:20%">
                    
                  </div>
                </uib-tab> -->

                <uib-tabset active="CPactive" justified="true" type="tabs">
                  <h2><center>ค้นหาข้อมูล</center></h2>
                  <div style="margin-bottom:20%">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6" style="font-size: 16px;">
                        
                      </div>
                    </div>
                  </div>
                </uib-tab>

            </div>
          </div>
          <!-- ================================================================================  -->
          <!-- ================================ CP ===================================== -->
            <div ng-show="seType == '3'">
              <div align="right">
                <a href="<?=site_url();?>/se_ctrl/se_call" class="btn btn-default">กลับไปเมนูรับเรื่องแจ้งซ่อม</a>
                <button type="button" class="btn btn-success" ng-disabled="object.txtCPName.length==0 || object.txtCPTel.length==0 || object.txtCPComment.length==0 || object.txtCPSVNo.length==0" ng-click="insertTypeCP()">บันทึกข้อมูล</button>
              </div>
              <uib-tabset active="CPactive" justified="true" type="tabs">
                  <h2><center>ข้อมูลการร้องเรียน</center></h2>
                  <div style="margin-bottom:20%">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6" style="font-size: 16px;">
                        <table class="table" align="left">
                          <tr>
                            <td style="vertical-align: middle;" width="40%">ชื่อผู้ร้องเรียน : </td>
                            <td width="60%"><input class="form-control" type="text" name="txtCPName" ng-model="object.txtCPName" required></td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;">เบอร์โทรศัพท์ : </td>
                            <td><input class="form-control" type="text" name="txtCPTel" ng-model="object.txtCPTel" required></td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;">งานซ่อมที่ต้องการร้องเรียน : </td>
                            <td><input class="form-control" type="text" name="txtCPSVNo" ng-model="object.txtCPSVNo" required></td>
                          </tr>
                          <tr>
                            <td>ข้อมูลการร้องเรียน : </td>
                            <td><textarea ng-model="object.txtCPComment" class="form-control" name="" rows="5"></textarea></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </uib-tab>
            </div>
          </div>
          <!-- ================================================================================  -->
          <!-- ================================ FAQ ===================================== -->
            <div ng-show="seType == '4'">
              <div align="right">
                <a href="<?=site_url();?>/se_ctrl/se_call" class="btn btn-default">กลับไปเมนูรับเรื่องแจ้งซ่อม</a>
                <button type="button" class="btn btn-success" ng-disabled="object.txtFAQComment.length==0 || faqDisabled" ng-click="insertTypeFAQ()">บันทึกข้อมูล</button>
              </div>
              <uib-tabset active="FAQactive" justified="true" type="tabs">
                  <h2><center>สอบถามข้อมูลทั่วไป</center></h2>
                  <div style="margin-bottom:20%">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6" style="font-size: 16px;">
                        <table class="table" align="left">
                          <tr>
                            <td style="vertical-align: middle;" class="col-md-3">คำถามเกี่ยวกับ : </td>
                            <td style="vertical-align: middle;" class="col-md-9">
                                <select class="form-control" ng-change="do_faqtype(faqtype)" ng-model="faqtype"
                                    ng-options="faqtype.faqtype_id as faqtype.faqtype_name for faqtype in drpdwnFAQType">
                                     <option value="">- เลือก -</option>
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;">คำถาม : </td>
                            <td style="vertical-align: middle;">
                                <select class="form-control" ng-change="do_faq(faq)" ng-model="faq"
                                    ng-options="faq.faq_id as faq.faq_name for faq in drpdwnFAQ">
                                     <option value="">- เลือก -</option>
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>คำตอบ : </td>
                            <td>
                              <textarea  ng-model="object.txtFAQComment" class="form-control" name="" rows="5"></textarea>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </uib-tab>
            </div>
          </div>
          <!-- ================================================================================  -->

        <!-- Modal Check Transaction -->
        <div class="modal-demo">
          <script type="text/ng-template" id="myModalDuplicate.html">
              <div class="modal-header">
                  <h3 class="modal-title" id="modal-title">รับเรื่องแจ้งซ่อม</h3>
              </div>
              <div class="modal-body" id="modal-body" align="center">
                  <img src="<?=base_url();?>assets/img/webui/question-orange.png" style="width:100px;height:100px;"><br/>
                  <h3>สินค้าดังกล่าวมีการแจ้งซ่อมแล้ว</h3><br/>  
                  <h3>เลขที่แจ้งซ่อมของคุณ คือ {{servicetrans_Data}}</h3><br/>
                  (กดปุ่ม OK เพื่อไปหน้าติดตามงานแจ้งซ่อม)
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" ng-click="cancel()">OK</button>
              </div>
          </script>
        </div>
        <!-- Modal Check Transaction -->

        <!-- Modal Insert -->
        <div class="modal-demo">
        <script type="text/ng-template" id="myModalContent.html">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title">รับเรื่องแจ้งซ่อม</h3>
            </div>
            <div class="modal-body" id="modal-body" align="center">
                <img src="<?=base_url();?>assets/img/webui/happy-green.png" style="width:100px;height:100px;">
                <h3>บันทึกข้อมูลเรียบร้อยแล้ว</h3>  
                <h3>เลขที่แจ้งซ่อมของคุณ คือ : {{$ctrl.items}}</h3>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="$ctrl.cancel()">OK</button>
            </div>
        </script>
        </div>
      <!-- Modal Insert -->

        </div> <!-- x_content -->
      </div> <!-- x_panel -->
    </div> <!-- col-md-12 col-sm-12 col-xs-12 -->
  </div> <!-- row -->
</div>  <!-- "" -->
</div> <!-- role="main" -->

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script>

  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");;});

  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap']);
  //app = angular.module('ui.bootstrap.demo').controller('DatepickerPopupDemoCtrl', function ($scope,$http,$uibModal, $log, $document) {
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document', function ($scope,$http,$uibModal, $log, $document)
  {
      $scope.tabs = [
        { title:'progress Title 1', content:'progress content 1' },
        { title:'progress Title 2', content:'progress content 2', disabled: true }
      ];

      $scope.model = {
        name: 'Tabs'
      };
      $scope.progress = 0;
      $scope.tblCustomer = '';
      $scope.itemgroup = "";
      $scope.subitemgroup = "";
      $scope.item = "";
      $scope.txtCustSearch = "";
      $scope.ChkCustomers = "";
      $scope.stp4nextDisabled = true; // Next Button in Step 4 Disable
      $scope.stp3nextDisabled = true; // Next Button in Step 3 Disable
      $scope.object = {};
      $scope.disdropdown = 0;
      $scope.object.txtCPName = "";  //set defualt
      $scope.object.txtCPTel = "";  //set defualt
      $scope.object.txtCPComment = "";  //set defualt
      $scope.object.txtCPSVNo = "";  //set defualt
      $scope.object.txtFAQComment = "";  //set defualt
      $scope.faqDisabled = true; // Submit Button Disabled 
      // =================================================================
      $scope.searchCustomer = function(custTxt,custType) 
      {
          //alert(custTxt + " " +custType);
          $scope.getDrpdwnProvince(); // LOAD DROPDOWN
          $scope.getDrpdwnAmphur();
          $scope.getDrpdwnDistrict();

          $scope.tblCustomer = '';

          var request = $http({
              method: "post",
              url: "http://150.95.24.212/newhsc/index.php/se_ctrl/getTblCustomer",
              data: {
                  custTxt: custTxt,
                  custType:custType
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {
              //$scope.tblCustomer = [{customer_name : "เพิ่มข้อมูลลูกค้าใหม่"}];
              //$scope.tblCustomer.push(response.data.data);
              
              $scope.tblCustomer = response.data.data;
              $scope.tblCustomer.splice(0, 0, {customer_name : "เพิ่มข้อมูลลูกค้าใหม่" , customer_id : "0"});
              $scope.ChkCustomers = "0";  // set defualt 
              $scope.txtActive = false; //disable textbox
              $scope.cID = 0; // Set Customers ID 
              $scope.object.txtConName = "";  //set defualt
              $scope.object.txtConTel = ""; //set defualt
              
              //console.log($scope.ChkCustomers);
              //console.log($scope.tblCustomer);
              //$scope.tblCustomer = response.data.data;  
          },function(response) {
              console.log("tbl Custeomers Error");
          });
      }
      

      $scope.getChkWanranty = function(serialno,itemgroup,subitemgroup,item) 
      {
          //alert("itemgroup : "+itemgroup + "|| subitemgroup : "+subitemgroup + "|| item : "+ item + "|| serial : "+ serialno);
          $scope.stp3nextDisabled = false; // Next Button in Step 4 Enable
          $scope.ChkSymtomItemgroup = '';
          $scope.ChkSymtomsubitemgroup = '';
          $scope.ChkSymtomItem = '';
          $scope.WarrantyData = '';
          $scope.WarrantyDataIS = '';
          $scope.SymtomItemgroupArr = '';

          //-- Check Warranty
            //---- Check History
            $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkWarrantyHistory/"+item+"/"+serialno,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
              .then(function(responseHistory) 
              {
                 if(responseHistory.data.data.length < 1) // No History
                 { 
                    //---- Check HIS
                      $http.get("http://www.hst-is.com/index.php/hsc/getChkWarrantyHis/"+item+"/"+serialno,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
                      .then(function(responseHIS) 
                      {
                        if(responseHIS.data.data.length < 1) // No HIS
                        {   
                            //---- Check Warranty Table
                            $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkWarrantyTbl/"+item+"/"+serialno+"/"+itemgroup,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
                              .then(function(responseWarrantyTbl) 
                              {
                                //alert(" item :"+item + " itemgroup :"+itemgroup + " serial :"+serialno);
                                if(responseWarrantyTbl.data.data.length < 1) // No Warranty Table
                                {
                                    $scope.WarrantyData = [{"warranty_code": "",
                                                          "is_custdate": "",
                                                          "warranty_end_date": "",
                                                          "TODAY": "",
                                                          "WARRANTYRESULT": "OUT",
                                                          "WARRANTYDESC": "นอกประกัน",
                                                          "WARRANTYCOLOR": "danger",
                                                          "item_code": item,
                                                          "bysystem": "ไม่พบข้อมูลในระบบ",
                                                          "servicetrans_serial": serialno,
                                                          "is_dealer_name": ""}];
                                }
                                else
                                { 
                                  //use data from Warranty Table
                                  $scope.WarrantyData = responseWarrantyTbl.data.data;
                                }
                               }, function(responseWarrantyTbl) {
                                    console.log('Not found warranty table in this itemgroup');

                                    $scope.WarrantyData = [{"warranty_code": "",
                                                          "is_custdate": "",
                                                          "warranty_end_date": "",
                                                          "TODAY": "",
                                                          "WARRANTYRESULT": "OUT",
                                                          "WARRANTYDESC": "นอกประกัน",
                                                          "WARRANTYCOLOR": "danger",
                                                          "item_code": item,
                                                          "bysystem": "ไม่พบข้อมูลในระบบ",
                                                          "servicetrans_serial": serialno,
                                                          "is_dealer_name": ""}];
                              }
                            );
                        }
                        else
                        { 
                          //use data from HIS
                            
                            //$scope.WarrantyData = responseHIS.data.data;
                            //console.log(responseHIS.data.data);
                            if(responseHIS.data.data[0].WARRANTYRESULT == 'IN')
                            {
                                //console.log(responseHIS.data.data[0].WARRANTYRESULT);
                                $scope.WarrantyData = responseHIS.data.data;
                            }
                            else
                            {
                                //---- Check Warranty Table (When HIS is OUT)
                                $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkWarrantyTbl/"+item+"/"+serialno+"/"+itemgroup,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
                                  .then(function(responseWarrantyTbl) 
                                  {
                                    if(responseWarrantyTbl.data.data.length < 1) // No Data in Warranty Table
                                    {
                                        $scope.WarrantyData = [{"warranty_code": "",
                                                          "is_custdate": "",
                                                          "warranty_end_date": "",
                                                          "TODAY": "",
                                                          "WARRANTYRESULT": "OUT",
                                                          "WARRANTYDESC": "นอกประกัน",
                                                          "WARRANTYCOLOR": "danger",
                                                          "item_code": item,
                                                          "bysystem": "ไม่พบข้อมูลในระบบ",
                                                          "servicetrans_serial": serialno,
                                                          "is_dealer_name": ""}];
                                    }
                                    else
                                    { 
                                      //use data from Warranty Table
                                      $scope.WarrantyData = responseWarrantyTbl.data.data;
                                    }
                                   }, function(responseWarrantyTbl) {
                                        console.log('ChkWarrantyTbl Error3');
                                  }
                                );
                                //console.log('OUT OF WARRANTY BY HIS');
                            }
                        }
                       }, function(responseHIS) {
                            console.log('ChkWarrantyHIS Error');

                            //---- Check Warranty Table (When HIS not Responding)
                            $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkWarrantyTbl/"+item+"/"+serialno+"/"+itemgroup,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
                              .then(function(responseWarrantyTbl) 
                              {
                                //alert(" item :"+item + " itemgroup :"+itemgroup + " serial :"+serialno);
                                if(responseWarrantyTbl.data.data.length < 1) // No Warranty Table
                                {
                                    $scope.WarrantyData = [{"warranty_code": "",
                                                          "is_custdate": "",
                                                          "warranty_end_date": "",
                                                          "TODAY": "",
                                                          "WARRANTYRESULT": "OUT",
                                                          "WARRANTYDESC": "นอกประกัน",
                                                          "WARRANTYCOLOR": "danger",
                                                          "item_code": item,
                                                          "bysystem": "ไม่พบข้อมูลในระบบ",
                                                          "servicetrans_serial": serialno,
                                                          "is_dealer_name": ""}];
                                }
                                else
                                { 
                                  //use data from Warranty Table
                                  $scope.WarrantyData = responseWarrantyTbl.data.data;
                                }
                               }, function(responseWarrantyTbl) {
                                    console.log('ChkWarrantyTbl Error2');
                              }
                            );
                      }
                    );
                 }
                 else
                 { 
                    //console.log(responseHistory.data.data[0].servicetrans_status);
                    if(responseHistory.data.data[0].servicetrans_status == 'COMPLETE')
                    {
                        //use data from history 
                        $scope.WarrantyData = responseHistory.data.data;
                        console.log("Use Data from History");
                    }
                    else
                    {
                        // SHOW MODAL AND REDIRECT
                        $scope.openModalDupliacte(responseHistory.data.data[0].servicetrans_code);
                        console.log("Duplicate");

                    }
                 }
              }, function(responseHistory) {
                   console.log('ChkWarrantyHistory Error');
              }
            );

          //-- End Check Wanranty

          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkSymtomItemgroup/"+itemgroup,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
            .then(function(response) {
               $scope.ChkSymtomItemgroup = response.data.data;
            }, function(response) {
                 console.log('ChkSymtomItemgroup Error');
            }
          );

          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkSymtomSubitemgroup/"+subitemgroup,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
            .then(function(response) {
               $scope.ChkSymtomSubitemgroup = response.data.data;
            }, function(response) {
                 console.log('ChkSymtomSubitemgroup Error');
            }
          );

          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getChkSymtomItem/"+item,{headers:{ 'Content-Type': 'application/x-www-form-urlencoded' }})
            .then(function(response) {
               $scope.ChkSymtomItem = response.data.data;
            }, function(response) {
                 console.log('ChkSymtomItem Error');
            }
          );

          $scope.selectedID = [];
          $scope.selectedName = [];
          $scope.selectedID2 = [];
          $scope.selectedName2 = [];
          $scope.selectedID3 = [];
          $scope.selectedName3 = [];
      }

      //------------- Checkbox Symptom Selected ----------------------------
      // 
      $scope.selectedID = [];                 //----Itemgroup Symtom ID
      $scope.selectedName = [];            //----Itemgroup Symtom Name
      $scope.selectedID2 = [];               //----Subitemgroup Symtom ID
      $scope.selectedName2 = [];           //----Subitemgroup Symtom Name
      $scope.selectedID3 = [];                //----Item Symtom ID
      $scope.selectedName3 = [];            //----Item Symtom Name

      $scope.toggle = function (symid,symname, listid,listname) 
      {
          var idx = listid.indexOf(symid);
          var idz = listname.indexOf(symname);

          if (idx > -1 && idz > -1) 
          {
              listid.splice(idx, 1);
              listname.splice(idz, 1);
          }
          else 
          {
              listid.push(symid);
              listname.push(symname);
          }

          // console.log('selectedID : '+ $scope.selectedID + ' | selectedName : ' + $scope.selectedName);
          // console.log('selectedID2 : '+ $scope.selectedID2 + ' | selectedName2 : ' + $scope.selectedName2);
          // console.log('selectedID3: '+ $scope.selectedID3 + ' |selectedName3 : ' + $scope.selectedName3);
      };
      
      $scope.exists = function (symid, list) 
      {
          return list.indexOf(symid) > -1;
      };
      
      //------------- End Checkbox Symptom Selected ----------------------------

      //--------- Dropdown List Item
       
      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnItemgroup/")
      .then(function(response) 
        {
           $scope.drpdwnItemgroup = response.data.data;
        },function(response) {
             console.log('drpdwnItemgroup Error');
      });

      $scope.do_itemgroup = function(itemgrp_code)
      {
        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnSubitemgroup/"+itemgrp_code)
        .then(function(response) 
          {
             $scope.drpdwnSubitemgroup = response.data.data;
          },function(response) {
               console.log('drpdwnSubitemgroup Error');
        });
        $scope.itemgrp_code = itemgrp_code;
      }

      $scope.do_subitemgroup = function(subitemgrp_code)
      {
        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnItem/"+subitemgrp_code)
        .then(function(response) 
          {
             $scope.drpdwnItem = response.data.data;
          },function(response) {
               console.log('drpdwnItem Error');
        });
        $scope.subitemgrp_code = subitemgrp_code;
      }

      $scope.do_item = function(item_alt_name)
      {
          $scope.item_code = item_alt_name;
      }
      //--------- End Dropdown Item

      //--------- Dropdown List Zone , Province , Amphur , District
      $scope.getDrpdwnZone = function()
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnZone/")
          .then(function(response) 
            {
               $scope.drpdwnZone = response.data.data;
            },function(response) {
                 console.log('drpdwnZone Error');
          });
      }

      $scope.getDrpdwnProvince = function()
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnProvince/")
          .then(function(response) 
            {
               $scope.drpdwnProvince = response.data.data;
               $scope.drpdwnProvinceSV = response.data.data;
            },function(response) {
                 console.log('drpdwnProvince Error');
          });
      }

      $scope.getDrpdwnAmphur = function()
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnAmphur/")
          .then(function(response) 
            {
               $scope.drpdwnAmphur = response.data.data;
            },function(response) {
                 console.log('drpdwnAmphur Error');
          });
      }

      $scope.getDrpdwnDistrict = function()
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnDistrict/")
          .then(function(response) 
            {
               $scope.drpdwnDistrict = response.data.data;

            },function(response) {
                console.log('drpdwnDistrict Error');
          });
      }

      $scope.getDrpdwnSVC = function(province_code)
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnSVC/"+province_code)
          .then(function(response) 
            {
               $scope.drpdwnSVC = response.data.data;
            },function(response) {
                 console.log('drpdwnSVC Error');
          });
      }
      
      $scope.getDrpdwnSVCReturn = function(item_code,serialno)
      {
        //console.log(item_code + " " + serialno);
        if($scope.disdropdown== 0)
        {
            $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnSVCReturn/"+item_code+"/"+serialno)
            .then(function(response) 
              {
                 $scope.drpdwnSVCReturn = response.data.data;
                 $scope.disdropdown++;
              },function(response) {
                   console.log('drpdwnSVCReturn Error');
            });
        }
        else
        {
            $scope.drpdwnSVCReturn = "";
            $scope.disdropdown++;
        }
      }

      $scope.do_zoneSV = function(zone_code)
      {
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnProvince/"+zone_code)
            .then(function(response) 
            {
               $scope.drpdwnProvinceSV = response.data.data;
            },function(response) {
                 console.log('drpdwnProvinceSV Error');
          });
      }

      $scope.do_provinceSV = function(province_code)
      {
          $scope.getDrpdwnSVC(province_code);
          $scope.stp4nextDisabled = true; // Next Button in Step 4 Disable
      }

      $scope.do_province = function(province_code)
      {          
          //$scope.drpdwnZone = "";
          $scope.object.txtZipcode = "";

          $scope.getDrpdwnZone();

          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnAmphur/"+province_code)
          .then(function(response) 
            {
               $scope.drpdwnAmphur = response.data.data;
            },function(response) {
                 console.log('drpdwnAmphur Error');
          });

           $scope.province_code = province_code;

           //CHANGE drpdwnProvinceSV 
           $scope.provinceSV = province_code;
           $scope.getDrpdwnSVC(province_code);
      }

      $scope.do_amphur = function(amphur_code)
      {
        $scope.object.txtZipcode = "";
        $scope.amphur_code = amphur_code;
        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnDistrict/"+amphur_code)
        .then(function(response) 
          {
             $scope.drpdwnDistrict = response.data.data;

          },function(response) {
              console.log('drpdwnDistrict Error');
        });
        //$scope.drpdwnProvince = '';
      }

      $scope.do_district = function(district_code)
      {
        $scope.district_code = district_code;
        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnZipcode/"+district_code)
        .then(function(response) 
          {
              $scope.object.txtZipcode = response.data.data[0]['zipcode_code'];
          },function(response) {
              console.log('txtZipcode Error');
        });
        //$scope.drpdwnProvince = '';
      }

      $scope.do_service = function(servicecenter_code)
      {
          if(servicecenter_code)
          {
              $scope.stp4nextDisabled = false; // Next Button in Step 4 Enable
          }
          else
          {
              $scope.stp4nextDisabled = true; // Next Button in Step 4 Disable
          }
          $scope.service_code = servicecenter_code;
      }
      //--------- End Dropdown List Zone , Province , Amphur , District
      //--------- Dropdown FAQ
      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnFAQType/")
          .then(function(response) 
            {
                $scope.drpdwnFAQType = response.data.data;
            },function(response) {
                console.log('drpdwnFAQType Error');
      });

      $scope.do_faqtype = function(faqtype_id)
      {
          $scope.faqDisabled = true;
          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnFAQ/"+faqtype_id)
          .then(function(response) 
            {
                $scope.drpdwnFAQ = response.data.data;
            },function(response) {
                console.log('drpdwnFAQ Error');
          });
      }
      $scope.do_faq = function(faq_id)
      {
        if(faq_id)
        {
            $scope.faqDisabled = false;
        }
        else
        {
            $scope.faqDisabled = true;
        }
      }
      //---------- END Dropdown FAQ

      $scope.provinceCustObj = [];
      $scope.amphurCustObj = [];
      $scope.districtCustObj = [];

      $scope.setSelectedCustomer = function(cID,cName,cTel1,cTel2,cAddr,cProv,cTumbon,cAumpor,cZipcode)
      {  
          $scope.getDrpdwnProvince(); // LOAD DROPDOWN
          $scope.getDrpdwnAmphur();
          $scope.getDrpdwnDistrict();
          $scope.getDrpdwnZone();
          $scope.getDrpdwnSVC(cProv);

          //console.log('Province Code = ' + cProv);
          $scope.object.txtConName = "";
          $scope.object.txtConTel = "";

         if(!cZipcode){ $scope.object.txtZipcode = ""; } // if zipcode = null
         // Set Value to Step 2
         $scope.cID = cID;
         if(cID > 0)
         {
              $scope.object.txtName = cName;
              $scope.object.txtTel1 = cTel1;
              $scope.object.txtTel2 = cTel2;
              $scope.object.txtAddress = cAddr;
              $scope.object.txtZipcode = cZipcode;
              $scope.txtActive = true; //enable textbox

              $scope.provinceCustObj.selected = cProv;
              $scope.amphurCustObj.selected = cAumpor;
              $scope.districtCustObj.selected = cTumbon;
              $scope.provinceSV = cProv;
         }
         else
         {
              $scope.object.txtName = "";
              $scope.object.txtTel1 = "";
              $scope.object.txtTel2 = "";
              $scope.object.txtAddress = "";
              $scope.object.txtZipcode = "";
              $scope.txtActive = false; //disable textbox

              $scope.provinceCustObj.selected = "";
              $scope.amphurCustObj.selected = "";
              $scope.districtCustObj.selected = "";
              $scope.provinceSV = "";
         }
         
      }

      $scope.clearSelectedCustomer = function()
      { 
          $scope.object.txtName = "";
          $scope.object.txtTel1 = "";
          $scope.object.txtTel2 = "";
          $scope.object.txtAddress = "";
          $scope.object.txtZipcode = "";
          $scope.txtActive = false; //disable textbox
          
          $scope.provinceCustObj.selected = "";
          $scope.amphurCustObj.selected = "";
          $scope.districtCustObj.selected = "";
      }

      // model 
      var $ctrl = this;
      $ctrl.items = '';

      $scope.insertTypeSE = function () //Send Data to Database
      {
            //console.log('selectedID : '+ $scope.selectedID + ' | selectedName : ' + $scope.selectedName);
            // console.log('selectedID2 : '+ $scope.selectedID2 + ' | selectedName2 : ' + $scope.selectedName2);
            // console.log('selectedID3: '+ $scope.selectedID3 + ' |selectedName3 : ' + $scope.selectedName3);

            //console.log($scope.service_code);
            // console.log($scope.WarrantyData[0].warranty_code);
            //console.log($scope.WarrantyData[0].is_custdate);
            //console.log($scope.WarrantyData[0].warranty_end_date);
            // console.log($scope.WarrantyData[0].TODAY);
            // console.log($scope.WarrantyData[0].WARRANTYRESULT);
            // console.log($scope.WarrantyData[0].WARRANTYDESC);
            // console.log($scope.WarrantyData[0].WARRANTYCOLOR);
            // console.log($scope.WarrantyData[0].item_code);
            // console.log($scope.WarrantyData[0].bysystem);
            // console.log($scope.WarrantyData[0].servicetrans_serial);
            // console.log($scope.WarrantyData[0].is_dealer_name);

            // angular.forEach($scope.selectedID, function(value, key)
            // {
            //     $scope.SymtomItemgroupArr += value + ","; 
            //     console.log($scope.SymtomItemgroupArr);
            // });

            
            var request = $http({
            method: "post",
            url: "http://150.95.24.212/newhsc/index.php/se_ctrl/insertTypeSE",
            data: {
                    servicetrans_type: "SE",
                    servicecenter_code: $scope.service_code,
                    warranty_code: $scope.WarrantyData[0].warranty_code,
                    warranty_end_date: $scope.WarrantyData[0].warranty_end_date,
                    inwarranty: $scope.WarrantyData[0].WARRANTYRESULT,
                    is_custdate: $scope.WarrantyData[0].is_custdate,
                    is_dealer_name: $scope.WarrantyData[0].is_dealer_name,
                    servicetrans_con_name: $scope.object.txtConName,
                    servicetrans_con_tel: $scope.object.txtConTel,
                    customer_id: $scope.cID,
                    province_code: $scope.province_code,
                    jobAx_num: "",
                    job_type_code: "",
                    enquiry_code: "",
                    item_code: $scope.WarrantyData[0].item_code,
                    servicetrans_serial: $scope.WarrantyData[0].servicetrans_serial,
                    servicetrans_confrim_date: "",
                    servicetrans_confrim_by: "",
                    servicetrans_description: "",
                    servicetrans_comment: $scope.object.txtComment,
                    servicetrans_member_type: "Callcenter",                                         // Repace with type of Username
                    servicetrans_status: "WAIT ACCEPT",
                    status: "A",
                    flag: "",
                    remark: $scope.object.remark,
                    // data customer
                    customer_name: $scope.object.txtName,
                    customer_tel1: $scope.object.txtTel1,
                    customer_tel2: $scope.object.txtTel2,
                    customer_addr: $scope.object.txtAddress,
                    district_code: $scope.district_code,
                    amphur_code: $scope.amphur_code,
                    zipcode_code: $scope.object.txtZipcode,
                    province_code: $scope.province_code,

                    // // ServiceRepair
                    servicerepair_symtom_itemgrp: $scope.selectedID.toString(),         
                    servicerepair_symtom_subitemgrp: $scope.selectedID2.toString(),
                    servicerepair_symtom_item: $scope.selectedID3.toString()

              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {
               //console.log(response.data);
                $ctrl.open('md',undefined,response.data.servicetrans_code);
                $ctrl.items = response.data.servicetrans_code;
               //alert("Add Success:"+ response.data.servicetrans_code);
               console.log(response.data.servicetrans_code);
          },function(response) {
              console.log(response);
              //console.log(response);
          });
      }

      $scope.insertTypeCP = function () //Send Data to Database
      {
           
            var request = $http({
            method: "post",
            url: "http://150.95.24.212/newhsc/index.php/se_ctrl/insertTypeCP",
            data: {
                    servicetrans_code: $scope.object.txtCPSVNo,
                    servicetrans_type: "CP",
                    servicetrans_con_name: $scope.object.txtCPName,
                    servicetrans_con_tel: $scope.object.txtCPTel,
                    servicetrans_comment: $scope.object.txtCPComment,
                    servicetrans_member_type: "Callcenter",    
                    servicetrans_status: "",                                   
                    status: "A",
                    flag: ""
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {
               //console.log(response.data);
                //$ctrl.open('md',undefined,response.data.servicetrans_code);
                //$ctrl.items = response.data.servicetrans_code;
               console.log(response.data.servicetrans_code);
          },function(response) {
              console.log(response);
              //console.log(response);
          });
      }

      $scope.insertTypeFAQ = function () //Send Data to Database
      {
           
            var request = $http({
            method: "post",
            url: "http://150.95.24.212/newhsc/index.php/se_ctrl/insertTypeFAQ",
            data: {
                    servicetrans_type: "FAQ",
                    faqtype_id : $scope.faqtype,
                    faq_id : $scope.faq,
                    servicetrans_comment: $scope.object.txtFAQComment,
                    servicetrans_member_type: "Callcenter",    
                    servicetrans_status: "",                                   
                    status: "A",
                    flag: ""
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {
               //console.log(response.data);
                //$ctrl.open('md',undefined,response.data.servicetrans_code);
                //$ctrl.items = response.data.servicetrans_code;
               console.log(response.data.servicetrans_code);
          },function(response) {
              console.log(response);
              //console.log(response);
          });
      }

  $ctrl.animationsEnabled = true;

  $ctrl.open = function (size, parentSelector, sitem) 
  {  
      var parentElem = parentSelector ? 
      angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;

      $ctrl.items = sitem;

      var modalInstance = $uibModal.open({
        animation: $ctrl.animationsEnabled,
        ariaLabelledBy: 'modal-title',
        ariaDescribedBy: 'modal-body',
        templateUrl: 'myModalContent.html',
        controller: 'ModalInstanceCtrl',
        controllerAs: '$ctrl',
        size: size,
        appendTo: parentElem,
        resolve: {
          items: function () {
            return $ctrl.items;
          }
        }
      });

    modalInstance.result.then(function (selectedItem) {
      $ctrl.selected = selectedItem;


    }, function () {
        //$log.info('Modal dismissed at: ' + new Date());
        //window.location.href = "http://150.95.24.212/newhsc/index.php/se_ctrl/se_call"; // Redirect After Insert
    });
  };


  $scope.openModalDupliacte = function (data) 
  {
      var modalInstance = $uibModal.open({
      animation: true,
      ariaLabelledBy: 'modal-title',
      ariaDescribedBy: 'modal-body',
      templateUrl: 'myModalDuplicate.html',
      controller: 'myModalDuplicateCtrl',
      // controllerAs: '$ctrl',
      size: 'md',
      resolve: {
        items: function () {
          return data;
        }
      }
    });

   //OK Modal
    modalInstance.result.then(function () 
    {
      //Codeing
    }, function () {
      //$log.info('Modal dismissed at: ' + new Date());
      //window.location.href = "http://150.95.24.212/newhsc/index.php/se_ctrl/se_call"; // Redirect
    });
  };




       // =================================================================
  }]);

//popup duplicate
angular.module('AppJS').controller('myModalDuplicateCtrl', function ($scope,$uibModalInstance, items) {
 
  $scope.servicetrans_Data = items;

  $scope.WarrantyData = items;
  // $ctrl.selected = {
  //   item: $ctrl.items[0]
  // };
  $scope.ok = function () {
    $uibModalInstance.close();
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});


// POPUP
angular.module('AppJS').controller('ModalInstanceCtrl', function ($uibModalInstance, items) {
  var $ctrl = this;
  $ctrl.items = items;
  // $ctrl.selected = {
  //   item: $ctrl.items[0]
  // };
  $ctrl.ok = function () {
    $uibModalInstance.close($ctrl.selected.item);
  };

  $ctrl.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});

// Please note that the close and dismiss bindings are from $uibModalInstance.

angular.module('AppJS').component('modalComponent', {
  templateUrl: 'myModalContent.html',
  bindings: {
    resolve: '<',
    close: '&',
    dismiss: '&'
  },
  controller: function () {
    var $ctrl = this;

    $ctrl.$onInit = function () {
      $ctrl.items = $ctrl.resolve.items;
      // $ctrl.selected = {
      //   item: $ctrl.items[0]
      // };
    };
    // $ctrl.ok = function () {
    //   $ctrl.close({$value: $ctrl.selected.item});
    // };
    $ctrl.cancel = function () {
      $ctrl.dismiss({$value: 'cancel'});
    };
  }
});   

</script>

<!-- /page content -->
<?php $this->load->view('layout/footer.php')?>

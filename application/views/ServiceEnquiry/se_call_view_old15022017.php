<?php $this->load->view('layout/header.php')?>
<link href="<?=base_url();?>assets/css/serviceenquiry.css" rel="stylesheet">

<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url(http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_21.gif) center no-repeat #fff;
}
</style>
<!-- page content -->
<div class="se-pre-con"></div>
        <div ng-app="AppJS"  class="right_col" role="main">
          <div class="">
            <div class="page-title">

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height: 100%;">
                  <div class="x_title" style="height: 30px;">
                    <h2>รับเรื่องแจ้งซ่อม </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="height: 100%;">
                    <section ng-controller="StepCtrl">

                      <steps on-finish="finished()">
                        <step class="step1" name="first"><!--Step 1-->
                          <div style="height: 400px;">
                              <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="16" aria-valuenow="16" style="width: 16%;"></div>
                              </div>
                            <h2 align="center">Step 1 : เลือกประเภทงาน</h2>
                            <div class="row col-md-4"></div>
                            <div class="row" align="center"></br>
                              <!-- <pre>{{seType || 'null'}}</pre> -->
                              <div class="btn-group">
                                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'1'">แจ้งซ่อม</label>
                                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'2'">ติดตามงานซ่อม</label>
                                  <label class="btn btn-primary" ng-model="seType" uib-btn-radio="'3'">ร้องเรียน</label>
                                  <label class="btn btn-warning" ng-model="seType" uib-btn-radio="'4'">สอบถามข้อมูลทั่วไป</label>
                              </div>
                            </div>
                            <!-- Show Form 'ร้องเรียน' when choose '3' -->
                            <div ng-show="seType == '3'">
                              <div class="row"><br /><br />

                                <h2 align="center">งานร้องเรียน</h2><br />
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                  <label>ชื่อผู้ร้องเรียน :</label>
                                  <input type="text" />
                                  <label>นามสกุล :</label>
                                  <input type="text" />
                                </div>
                              </div><br />
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                  <label>เบอร์โทรศัพท์ :</label>
                                  <input type="text" />
                                </div>
                              </div><br />
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                  <label>งานซ่อมที่ต้องการร้องเรียน :</label>
                                  <input type="text" />
                                </div>
                              </div><br />
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                  <label>ข้อมูลการร้องเรียน :</label>
                                  <textarea required="required" class="form-control" name="message" rows="3"></textarea><br />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6" align="right">
                                  <button type="submit" class="btn btn-primary">บันทึกการร้องเรียน</button>
                                </div>
                              </div>
                            </div>
                              <!-- End Show Form when choose '3' -->
                              <!-- Show Form 'สอบถามข้อมูลทั่วไป' when choose '4' -->
                            <div ng-show="seType == '4'">
                                <div class="row"><br /><br />
                                  <h2 align="center">สอบถามข้อมูลทั่วไป</h2><br />
                                  <div class="col-md-3"></div>
                                  <div class="col-md-8">
                                    <label>ชื่อผู้สอบถาม :</label>
                                    <input type="text" />
                                    <label>นามสกุล :</label>
                                    <input type="text" />
                                  </div>
                                </div><br />
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                    <label>เบอร์โทรศัพท์ :</label>
                                    <input type="text" />
                                  </div>
                                </div><br />
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                    <select class="form-control">
                                      <option value="0">เลือกคำถาม</option>
                                      <option value="">ติดตามงานภายใน</option>
                                      <option value="">ปรึกษาช่าง</option>
                                      <option value="">แนะนำบริการ ติชม</option>
                                    </select>
                                  </div>
                                </div><br />
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                    <label>ข้อมูลการสอบถาม :</label>
                                    <textarea required="required" class="form-control" name="message" rows="3"></textarea><br />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6" align="right">
                                    <button type="submit" class="btn btn-primary">บันทึกการสอบถาม</button>
                                  </div>
                                </div>
                              </div>
                                <!-- End Show Form when choose '4' -->
                            </div>

                        <!-- Show Div when choose RadioButton -->
                        <div class="row" align="right">
                          <!-- Go to แจ้งซ่อม -->
                          {{seType}}
                          <input type="button" ng-show="seType == '1'" ng-click="gogo('second')" class="btn btn-primary" value="ถัดไป">
                          <!-- Go to ติดตามงานซ่อม -->
                          <button ng-show="seType == '2'" ng-click="gogo('secondB')" class="btn btn-primary">ถัดไปB</button>
                          <!-- Go to ร้องเรียน -->
                          <div ng-show="seType == '3'">
                            <!-- <button type="submit" class="btn btn-primary">บันทึกการร้องเรียน</button> -->
                          </div>
                          <!-- Go to สอบถาม -->
                          <div ng-show="seType == '4'">
                            <!-- <button type="submit" class="btn btn-primary">บันทึกการสอบถาม</button> -->
                          </div>
                        </div>
                        <!-- End Show Div when choose RadioButton -->
                        </step>
                        <step class="step2" name="second"><!--Step 2-->
                          <div style="height: 400px;">
                            <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="32" aria-valuenow="32" style="width: 32%;"></div>
                                  </div>
                          <h2 align="center">Step 2 : ค้นหาประวัติลูกค้า {{seType}}</h2>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <input class="form-control col-md-7 col-xs-12" type="text" value="" name="" ng-model="txtCustSearch">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" align="center">
                              <div class="btn-group"><br />
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearch,searchCheck)" ng-model="searchCheck" uib-btn-radio="'custName'">ค้นหาจากชื่อลูกค้า</label>
                                  <label class="btn btn-primary" ng-click="searchCustomer(txtCustSearch,searchCheck)" ng-model="searchCheck" uib-btn-radio="'custTel'">ค้นหาจากเบอร์โทรลูกค้า</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="table-responsive col-md-1"></div>
                            <div class="table-responsive col-md-10" align="center"><br />
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch == ''">กรุณากรอกคำค้นหา</h2>
                              <h2 ng-show="tblCustomer.length == 0 && txtCustSearch != ''">ไม่พบข้อมูล</h2>
                                <table ng-show="tblCustomer.length > 0" style="color:#000000" width="100%">
                                  <tr>
                                    <td>
                                       <table class="table table-striped jambo_table">
                                          <thead align="center">
                                            <tr>
                                              <th width="10%">เลือก</th>
                                              <th width="40%">ชื่อลูกค้า</th>
                                              <th width="30%">เบอร์โทรศัพท์</th>
                                              <th width="20%">รายละเอียด</th>
                                            </tr>
                                          </thead>
                                       </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                       <div style="height:150px; overflow:auto;">
                                         <table class="table table-striped jambo_table">
                                         <tbody>
                                            <tr>
                                              <th scope="row" align="center"><input type="radio" name="custCheck"></th>
                                              <td colspan="4">เพิ่มข้อมูลลูกค้าใหม่</td>
                                            </tr>
                                            <tr ng-repeat="data in tblCustomer | filter:txtCustSearch">
                                              <td width="10%" scope="row">
                                                <input type="radio" name="custCheck" value="{{ data.customer_id }}" 
                                                ng-click="setClickedRow(
                                                data.customer_name,
                                                data.customer_tel1,
                                                data.customer_tel2,
                                                data.customer_addr,
                                                data.customer_tumbon,
                                                data.customer_aumpor,
                                                data.customer_province,
                                                data.customer_zipcode)">
                                              </td>
                                              <td width="40%">{{data.customer_name}}</td>
                                              <td width="30%">{{data.customer_tel1}}</td>
                                              <td width="20%"><a href="#" target="_blank">รายละเอียด</a></td>
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
                          <div class="row" align="right">
                            <button type="button" class="btn btn-primary" ng-click="gogo('first')">ก่อนหน้า</button>
                            <button type="button" class="btn btn-primary" ng-click="gogo('third')">ถัดไป</button>
                          </div>
                        </step>
                        <step class="step2B" name="secondB"><!--Step 2B-->
                          <div style="height: 400px;">
                            <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="32" aria-valuenow="32" style="width: 32%;"></div>
                                  </div>
                          <h2 align="center">Step 2B : ค้นหาประวัติลูกค้า</h2>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <input id="" class="form-control col-md-7 col-xs-12" type="text" name="" value="(สุรเชษฐ์,0909814111,9999999999)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12" align="center">
                              <div class="row" align="center"></br>
                                <!-- <pre>{{seType || 'null'}}</pre> -->
                                <div class="btn-group">
                                    <label class="btn btn-primary" ng-model="TwoBsearchBy" uib-btn-radio="'1'">ค้นหาจากชื่อลูกค้า</label>
                                    <label class="btn btn-primary" ng-model="TwoBsearchBy" uib-btn-radio="'2'">ค้นหาจากเบอร์โทรลูกค้า</label>
                                    <label class="btn btn-primary" ng-model="TwoBsearchBy" uib-btn-radio="'3'">ค้นหาจากหมายเลขเครื่อง</label>
                                    <label class="btn btn-primary" ng-model="TwoBsearchBy" uib-btn-radio="'4'">ค้นหาจากหมายเลขงานซ่อม (SV)</label>
                                </div>
                              </div>
                            </div>
                          </div><br />
                          <div class="row">
                            <div class="table-responsive col-md-1"></div>
                            <div class="table-responsive col-md-10">
                                <!-- Show When Search By Name -->
                              <div ng-show="TwoBsearchBy == '1'">
                                <table style="color:#000000" class="table table-striped jambo_table">
                                  <thead>
                                    <tr>
                                      <th>เลือก</th>
                                      <th class="span1">ชื่อลูกค้า</th>
                                      <th>นามสกุล</th>
                                      <th>เบอร์โทรศัพท์</th>
                                      <th>รายละเอียด</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                      <td>สุรเชษฐ์</td>
                                      <td>เลิศมงคลโรจน์</td>
                                      <td>0873515508</td>
                                      <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                    </tr>
                                    <tr>
                                      <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                      <td>สุรเชษฐ์</td>
                                      <td>เลิศมงคลโรจน์</td>
                                      <td>0873515508</td>
                                      <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                                <!-- Show When Search By Tel -->
                                <div ng-show="TwoBsearchBy == '2'">
                                <table style="color:#000000" class="table table-striped jambo_table">
                                  <thead>
                                    <tr>
                                      <th>เลือก</th>
                                      <th class="span1">ชื่อลูกค้า</th>
                                      <th>นามสกุล</th>
                                      <th>เบอร์โทรศัพท์</th>
                                      <th>รายละเอียด</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                      <td>Surachet</td>
                                      <td>Lertmongkolroj</td>
                                      <td>0909814111</td>
                                      <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                                <!-- Show When Search By Serial -->
                                <div ng-show="TwoBsearchBy == '3'">
                                <table style="color:#000000" class="table table-striped jambo_table">
                                  <thead>
                                    <tr>
                                      <th>เลือก</th>
                                      <th class="span1">รุ่นสินค้า</th>
                                      <th class="span1">กลุ่มสินค้า</th>
                                      <th>หมายเลขเครื่อง</th>
                                      <th>รายละเอียด</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                      <td>RH200PA</td>
                                      <td>ตู้เย็น</td>
                                      <td>RF9999999999</td>
                                      <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                    </tr>
                                    <tr>
                                      <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                      <td>SF150XWV</td>
                                      <td>เครื่องซักผ้า</td>
                                      <td>WM9999999999</td>
                                      <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                              <!-- Show When Search By SV -->
                              <div ng-show="TwoBsearchBy == '4'">
                              <table style="color:#000000" class="table table-striped jambo_table">
                                <thead>
                                  <tr>
                                    <th>เลือก</th>
                                    <th>หมายเลขงานแจ้งซ่อม</th>
                                    <th class="span1">รุ่นสินค้า</th>
                                    <th class="span1">กลุ่มสินค้า</th>
                                    <th>หมายเลขเครื่อง</th>
                                    <th>รายละเอียด</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row"><input type="radio" class="flat" name="chkSearchHistory"></th>
                                    <td>SV1701/0001</td>
                                    <td>RH200PA</td>
                                    <td>ตู้เย็น</td>
                                    <td>RF9999999999</td>
                                    <td><a href="<?=site_url();?>/se_ctrl/se_history_view" target="_blank">รายละเอียด</a></td>
                                  </tr>
                                </tbody>
                              </table>
                              </div>
                        </div>
                      </div>
                    </div>
                        </step>        <!-- end Step 2B-->
                        <step class="step3" name="third"><!--Step 3-->
                          <div style="height: 400px;">
                            <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="48" aria-valuenow="48" style="width: 48%;"></div>
                            </div>
                          <h2 align="center">Step 3 : รายละเอียดลูกค้า</h2>
                          <div class="row">
                            <div class="table-responsive col-md-12" align="center"></br>
                                <table style="width:100%;" border="0">
                                    <tr style="height: 50px;">
                                      <td class="col-md-1"></td>
                                      <td class="col-md-2" align="right"><label for="">ชื่อลูกค้า :</label></td>
                                      <td colspan="2" class="col-md-3">
                                        <input id="txtName" class="form-control" type="text" ng-model="txtName">
                                      </td>
                                      <td class="col-md-1"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                      <td class="col-md-1"></td>
                                      <td class="col-md-2" align="right"><label for="">เบอร์โทร :</label></td>
                                      <td class="col-md-3">
                                        <input id="txtTel1" class="form-control" type="text" ng-model="txtTel1">
                                      </td>
                                      <td class="col-md-2" align="right"><label for="">เบอร์โทร (สำรอง) :</label></td>
                                      <td class="col-md-3">
                                        <input id="txtTel2" class="form-control" type="text" ng-model="txtTel2">
                                      </td>
                                      <td class="col-md-1"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                      <td class="col-md-1"></td>
                                      <td class="col-md-2" align="right"><label for="">ที่อยู่ :</label></td>
                                      <td colspan="3" class="col-md-3">
                                        <input id="txtAddress" class="form-control" type="text" ng-model="txtAddress">
                                      </td>
                                      <td class="col-md-3"></td>
                                      <td class="col-md-1"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                      <td class="col-md-1"></td>
                                      <td class="col-md-2" align="right"><label for="">จังหวัด :</label></td>
                                      <td class="col-md-3">
                                         <select class="form-control"  ng-change="do_province(province.province_id)" ng-model="province.province_id" ng-options="data.province_id as data.province_name for data in drpdwnProvince" >
                                            <option value="">- Select Province -</option>
                                         </select>
                                      </td>
                                      <td class="col-md-2" align="right"><label for="">อำเภอ :</label></td>
                                      <td class="col-md-3">
                                        <select class="form-control" ng-change="do_amphur(amphur.amphur_id)" ng-model="amphur.amphur_id" ng-options="data.amphur_id as data.amphur_name for data in drpdwnAmphur" >
                                            <option value="">- Select Amphur -</option>
                                         </select>
                                      </td>
                                      <td class="col-md-1"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                      <td class="col-md-1"></td>
                                      <td class="col-md-2" align="right"><label for="">ตำบล :</label></td>
                                      <td class="col-md-3">
                                        <select class="form-control" ng-change="do_district(district.district_id)" ng-model="district.district_id" ng-options="data.district_id as data.district_name for data in drpdwnDistrict" >
                                            <option value="">- Select District -</option>
                                         </select>
                                      </td>
                                      <td class="col-md-2" align="right"><label for="">รหัสไปรษณีย์ :</label></td>
                                      <td class="col-md-3">
                                        <input id="txtZipcode" class="form-control" type="text" ng-model="txtZipcode">
                                      </td>
                                      <td class="col-md-1"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                    <td class="col-md-1"></td>
                                    <td class="col-md-2" align="right"><label for="">ชื่อผู้ติดต่อ :</label></td>
                                    <td class="col-md-3">
                                      <input id="txtConName" class="form-control" type="text" ng-model="txtConName">
                                    </td>
                                    <td class="col-md-2" align="right"><label for="">เบอร์โทร (ผู้ติดต่อ) :</label></td>
                                    <td class="col-md-3">
                                      <input id="txtConTel" class="form-control" type="text" ng-model="txtConTel">
                                    </td>
                                    <td class="col-md-1"></td>
                                  </tr>
                                </table>
                            </div>
                          </div>
                        </div>
                        <div class="row" align="right">
                          <button type="button" class="btn btn-primary" ng-click="gogo('second')">ก่อนหน้า</button>
                          <button type="button" class="btn btn-primary" ng-click="gogo('fourth')">ถัดไป</button>
                        </div>
                        </step>
                        <step class="step4" name="fourth"><!--Step 4-->
                          <div style="height: 400px;">
                            <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="64" aria-valuenow="64" style="width: 64%;"></div>
                                  </div>
                          <h2 align="center">Step 4 : รายละเอียดสินค้า</h2>
                          <div class="row">
                            <div class="table-responsive col-md-12" align="center"></br>
                                <table style="width:100%;" border="0">
                                    <tr style="height: 50px;">
                                      <td class="col-md-2"></td>
                                      <td class="col-md-3">
                                        <select class="form-control" ng-model="itemgroup.itemgrp_code" ng-options="data.itemgrp_code as data.itemgrp_desc_th for data in drpdwnItemgroup" >
                                            <option value="">เลือกสินค้า</option>
                                         </select>
                                      </td>
                                      <td class="col-md-3">
                                        <select class="form-control">
                                          <option value="0">เลือกประเภท</option>
                                          <option value="1 DOOR">1 DOOR</option>
                                        </select>
                                      </td>
                                      <td class="col-md-2">
                                        <select class="form-control">
                                          <option value="0">เลือกรุ่น</option>
                                          <option value="RH200PA">RH200PA</option>
                                        </select>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 50px;">
                                      <td class="col-md-2"></td>
                                      <td class="col-md-3" align="right">หมายเลขเครื่อง</td>
                                      <td class="col-md-3">
                                        <input id="" class="form-control" type="text" name="">
                                      </td>
                                      <td class="col-md-2">
                                        <label class="btn btn-primary" ng-model="chkWarranty" uib-btn-checkbox>ตรวจสอบประกัน</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                      <table style="color:#000000;" class="table table-striped jambo_table">
                                          <thead>
                                            <tr align="center">
                                               <td colspan="8">
                                                  <div>รายละเอียดบัตรรับประกัน</div>
                                               </td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                               <td>หมายเลขบัตรรับประกัน :</td>
                                               <td>WARRANTY10000</td>
                                               <td>Serial :</td>
                                               <td>RF9999999999</td>
                                               <td>สถานะ :</td>
                                               <td><span class="label label-success">ในประกัน</span></td>
                                            </tr>
                                            <tr>
                                               <td>วันหมดอายุประกัน :</td>
                                               <td>12-2017</td>
                                               <td>สถานที่ซื้อ</td>
                                               <td colspan="3">ฮิตาชิเซลส์ (ประเทศไทย)</td>
                                            </tr>
                                            <tr>
                                               <td>วันที่ซื้อ :</td>
                                               <td>01-10-2017</td>
                                               <td>ตรวจสอบประกันโดย</td>
                                               <td colspan="3"><span class="label label-info">by HIS</span></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr style="height: 40px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">กลุ่มอาการเสียทั่วไป</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                      <table style="width:100%;" border="0">
                                        <tr valign="top">
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ไม่เย็น</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; คอมเพรสเซอร์เสียงดัง</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ช่องด้านบนเย็นช่องด้านล่างไม่เย็น</td>
                                        </tr>
                                        <tr valign="top">
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ มีกลิ่นเหม็น</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ เย็นมากเกินไป</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymGeneral[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; มีน้ำไหลออกจากด้านหน้าเครื่อง</td>
                                        </tr>
                                      </table>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 30px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">กลุ่มอาการเสียอื่นๆ นอกจากอาการเสียข้างต้น</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                      <table style="width:100%;" border="0">
                                        <tr valign="top">
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ มีกลิ่นเหม็นไหม้</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ขนาดก้อนน้ำแข็งผิดปกติ</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; เปิดปิดประตูมีเสียงดัง</td>
                                        </tr>
                                        <tr valign="top">
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ ตู้เย็นกินไฟมาก</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ Smart drink น้ำไหลตลอด</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymMain[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ขอบยางประตูขาด</td>
                                        </tr>
                                      </table>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 30px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">กลุ่มอาการเสียเฉพาะ</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                      <table style="width:100%;" border="0">
                                        <tr valign="top">
                                          <td style="width:33%;"><input type="checkbox" name="chkSymSpecify[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ตู้ ไม่ละลายน้ำแข็ง</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymSpecify[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ไม่เย็น พัดลมใน ช่องแช่แข็งติดน้ำแข็ง</td>
                                          <td style="width:33%;"><input type="checkbox" name="chkSymSpecify[]" id="" value="" data-parsley-mincheck="2" required class="flat" />&nbsp; ถาดรองน้ำทิ้งเสียงดัง</td>
                                        </tr>
                                      </table>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 30px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">กลุ่มอาการเสียอื่นๆ</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                        <input id="" class="form-control" type="text" name="">
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 30px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">ของที่นำมาด้วย</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                        <input id="" class="form-control" type="text" name="">
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr style="height: 30px;" ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center" style="height:50px;">
                                        <label for="">หมายเหตุ</label>
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr>
                                    <tr ng-show="chkWarranty">
                                      <td class="col-md-2"></td>
                                      <td colspan="3" align="center">
                                        <input id="" class="form-control" type="text" name="">
                                      </td>
                                      <td class="col-md-2"></td>
                                    </tr><tr style="height:20px;"></tr>
                                </table>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" align="center">
                              <div>

                              </div>
                            </div>
                          </div>
                          </div>
                          <div class="row" align="right">
                            <button type="button" class="btn btn-primary" ng-click="gogo('third')">ก่อนหน้า</button>
                            <button type="button" class="btn btn-primary" ng-click="gogo('fifth')">ถัดไป</button>
                          </div>
                        </step>
                        <step class="step5" name="fifth"> <!--Step 5 -->
                          <div style="height: 400px;">
                            <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="80" aria-valuenow="80" style="width: 80%;"></div>
                                  </div>
                          <h2 align="center">Step 5 : เลือกศูนย์บริการ</h2>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <label for="">Comment :</label>
                              <textarea id="" class="form-control" name="" rows="5"></textarea>
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
                              <select class="form-control" ng-change="do_zone(zone.zone_id)" ng-model="zone.zone_id" ng-options="data.zone_id as data.zone_name for data in drpdwnZone" >
                                <option value="">- Select Zone -</option>
                              </select>

                              <!-- STRAT TEST  -->
 <select ng-model="selectedZone" ng-init="selectedZone=drpdwnZone[0]" 
    ng-options="zone as zone.zone_name for zone in drpdwnZone track by zone.zone_name" 
    ng-change="do_zone2(selectedZone)">
</select>



  <!-- END TEST  -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="height:50px;">
                              <select class="form-control" ng-model="province.province_id" ng-options="data.province_id as data.province_name for data in drpdwnProvinceSV" >
                                <option value="">- Select Province -</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="height:50px;">
                              <select class="form-control" ng-model="servicecenter.servicecenter_code" ng-options="data.servicecenter_code as data.servicecenter_name_th for data in drpdwnSVC" >
                                <option value="">- Select Service Center -</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <input type="checkbox" ng-model="disdropdown" name="" id="" value="" class="" /><label for="">&nbsp;งาน Return จาก :</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="height:50px;">
                              <select class="form-control" ng-disabled="!disdropdown">
                                <option value="">เลือกศูนย์บริการ</option>
                                <option value="">ฮิตาชิเซลล์ (ประเทศไทย)</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row" align="right">
                          <button type="button" class="btn btn-primary" ng-click="gogo('fourth')">ก่อนหน้า</button>
                          <button type="button" class="btn btn-primary" ng-click="gogo('sixth')">ถัดไป</button>
                        </div>
                        </step>
                      </steps>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /page content -->
        <script src="<?=base_url();?>assets/js/angular.js"></script>
        <script src="<?=base_url();?>assets/js/angular-animate.js"></script>
        <script src="<?=base_url();?>assets/js/angular-steps.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
        <script src="<?=base_url();?>assets/js/ui-bootstrap-tpls-2.4.0.js"></script>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.18/angular.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.18/angular-animate.js"></script>
        <script src="https://rawgit.com/omichelsen/angular-steps/master/dist/angular-steps.js"></script> -->
        <script>
        //alert("OK");

        $(window).load(function() {
          // Animate loader off screen
          $(".se-pre-con").fadeOut("slow");;
        });


        var AppJS = angular.module('AppJS', ['ngAnimate', 'angular-steps','ui.bootstrap']);

        AppJS.controller('StepCtrl', ['$scope','$http', 'StepsService', function ($scope, $http, StepsService)
        {
                      $scope.tblCustomer = '';
                      $scope.txtZipcode = "";

                      $scope.gogo = function (to)
                      {
                          StepsService.steps().goTo(to);
                          // $scope.txtConName = to;

                          $scope.EsetTxtValue(); // Call function Set Value
                      };

                      $scope.finished = function ()
                      {
                          alert('Finish!');
                      };
                      $scope.searchCustomer = function(custTxt,custType) {
                          //alert(custTxt + " " +custType);
                          $scope.tblCustomer = '';
                          $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getTblCustomer/"+custTxt+"/"+custType)
                          .success(function (response) {$scope.tblCustomer = response.data;});
                      }
                      
                      //--------- Dropdown List Item
                      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnItemgroup/")
                      .success(function (response) {$scope.drpdwnItemgroup = response.data;});

                      $scope.do_itemgroup = function(itemgroup_id){
                        
                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnSubitemgroup/"+itemgroup_id)
                        .success(function (response) {$scope.drpdwnSubitemgroup = response.data;});
                      }
                      //--------- End Dropdown Item

                      //--------- Dropdown List Zone , Province , Amphur , District
                      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnZone/")
                      .success(function (response) {$scope.drpdwnZone = response.data;});

                      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnProvince/")
                      .success(function (response) {$scope.drpdwnProvince = response.data;});

                      $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnSVC/")
                      .success(function (response) {$scope.drpdwnSVC = response.data;});

                      $scope.do_zone = function(zone_id){
                       
                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnProvince/"+zone_id)
                        .success(function (response) {$scope.drpdwnProvinceSV = response.data;});

                       // $scope.svccode = zone_name;
                      }

                      $scope.do_zone2 = function(Obzone){
                       
                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnProvince/"+Obzone.zone_id)
                        .success(function (response) {$scope.drpdwnProvinceSV = response.data;});

                         $scope.svccode = Obzone.zone_name;
                      }

                      $scope.do_province = function(province_id){
                        
                        $scope.drpdwnDistrict = "";
                        $scope.txtZipcode = "";

                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnAmphur/"+province_id)
                        .success(function (response) {$scope.drpdwnAmphur = response.data;});
                        //$scope.drpdwnProvince = '';
                      }

                      $scope.do_amphur = function(amphur_id){

                        $scope.txtZipcode = "";
                        
                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnDistrict/"+amphur_id)
                        .success(function (response) {$scope.drpdwnDistrict = response.data;});
                        //$scope.drpdwnProvince = '';
                      }

                      $scope.do_district = function(district_id){
                        
                        $http.get("http://150.95.24.212/newhsc/index.php/se_ctrl/getDrpdwnZipcode/"+district_id)
                        .success(function (response) {$scope.txtZipcode = response.data[0].zipcode;});
                        //$scope.drpdwnProvince = '';
                      }
                      //--------- End Dropdown List Zone , Province , Amphur , District
                      
                      $scope.setClickedRow = function(cName,cTel1,cTel2,cAddr,cTumbon,cAumpor,cProvince,cZipcode){  //function that sets the value of selectedRow to current index
                         //alert("ok "+ cName);
                         
                         // Set Value to Textbox (Step 3)
                         $scope.txtName = cName;
                         $scope.txtTel1 = cTel1;
                         $scope.txtTel2 = cTel2;
                         $scope.txtAddress = cAddr;
                         //$scope.txtTB = cTumbon;
                         //$scope.txtAP = cAumpor;
                         //$scope.txtProv = cProvince;
                         //$scope.person.levels = $scope.drpdwnProvince.province_id[0].value;
                         $scope.province.province_id = $scope.drpdwnProvince.province_id[0].value;
                         $scope.txtZipcode = cZipcode;
                        // $scope.selectedRow = index;
                      }

        //--------------------------------------------------------------------------
                      
                      $scope.EsetTxtValue = function () // Set Value in Last Step
                      {
                          //alert(document.getElementById('txtConName').value);
                          $scope.txtName = document.getElementById('txtName').value;
                          $scope.txtTel1 = document.getElementById('txtTel1').value;
                          $scope.txtTel2 = document.getElementById('txtTel2').value;
                          $scope.txtAddress = document.getElementById('txtAddress').value;
                          $scope.txtZipcode = document.getElementById('txtZipcode').value;

                          $scope.txtConName = document.getElementById('txtConName').value;
                          $scope.txtConTel = document.getElementById('txtConTel').value;
                          //$scope.txtConTel = document.getElementById('txtConTel').value;
                      };
                      
                      $scope.inserttrans = function (seTypeValue,txtName,txtTel1,txtTel2,txtAddress,txtTB,txtAP,txtProv,txtZipcode,txtConName,txtConTel) {
                          alert(" seType :"+ seTypeValue + 
                                " txtName : "+ txtName +
                                " txtConName : "+ txtConName +
                          "");
                          
                          var request = $http({
                              method: "post",
                              url: "http://150.95.24.212/newhsc/index.php/se_ctrl/addServiceTrans",
                              data: {
                                      servicetrans_type: seTypeValue,
                                      servicecenter_code: "",
                                      warranty_code: "",
                                      warranty_end_date: "",
                                      inwarranty: "",
                                      is_custdate: "",
                                      is_dealer_name: "",
                                      servicetrans_con_name: txtConName,
                                      servicetrans_con_surname: txtConName,
                                      servicetrans_con_tel: txtConTel,
                                      customer_id: txtName,
                                      servicetrans_buy_date: "",
                                      servicetrans_buy_state: "",
                                      province_code: txtProv,
                                      country_code: "",
                                      jobAx_num: "",
                                      job_type_code: "",
                                      enquiry_code: "",
                                      item_id: "",
                                      servicetrans_serial: "",
                                      servicetrans_confrim_date: "",
                                      servicetrans_confrim_by: "",
                                      servicetrans_description: "",
                                      servicetrans_comment: "",
                                      servicetrans_status: "",
                                      status: "",
                                      flag: "",
                                      created_by: "",
                                      updated_date: "",
                                      updated_by: "",
                                      remark: ""
                              },
                              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                          });
                          request.success(function (data) {
                              $scope.message = "Console : "+data;
                          });
                      }
          }]);
</script>

<?php $this->load->view('layout/footer.php')?>

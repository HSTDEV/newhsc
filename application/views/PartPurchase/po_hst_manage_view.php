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
      background: url(http://150.95.24.212/newhsc/assets/img/Preloader_21.gif) center no-repeat #fff;
    }
</style>




<!-- page content -->
<div class="se-pre-con"></div>
<!-- Loading..... -->
<div class="right_col" role="main" ng-app="AppJS" >


  <div class="clearfix"></div>

   

        <!-- ####################===  Top ===######################### -->        
        
          <!-- ####################===  End Top ===######################### --> 

<!-- ####################===  Order list ===######################### -->
<div class="row" ng-controller="StepCtrl" ng-init="doShowData();">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">
<!--     <div class="x_title">
    <h1><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่&nbsp;&nbsp;&nbsp;</h1>

      <input type="text" class="form-control" placeholder="Search" ng-model="order_search" style="width:300px">
      
  
    <div class="clearfix"></div>
    </div> -->

    <div class="row x_title">
                  <div class="col-md-6">
                   <h2><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่ HST&nbsp;&nbsp;&nbsp;</h1>
                  </div>
                  <div class="col-md-6" align="right">
                  
<!-- <h1><a href="<?php //site_url();?>/Part_ctrl/po_sv"><i class="glyphicon glyphicon-backward"></i>&nbsp;กลับไป</a></h1> -->

<!-- <button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-backward" aria-hidden="true"></span> กลับไป
</button> -->
  
                  </div>
                </div>


    <div class="x_content">
<!--         <div class="row">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4 m-b-xs">
            
        </div>
        <div class="col-sm-3">
         <label>เรียงลำดับ :
            <select class="form-control">
              <option value="partorder_date">วันที่สั่งซื้อ</option>
              <option value="partorder_code">เลขที่ใบสั่งซื้อ</option>
              <option value="created_by">ชื่อผู้สั่งซื้อ</option>
            </select>   
             </label>                                
        </div> -->
       
    </div>

                            <div class="form-group" align="right">
    <div class="input-group">
      <div class="input-group-addon" style="width:20%">ค้นหาข้อมูล</div>
      <input type="text" ng-model="search"class="form-control" id="exampleInputAmount">
    </div>
  </div>
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>เลขที่ใบสั่งซื้อ</th>
              <th>ศูนย์บริการ</th>
              <th>วันที่สั่งซื้อ</th>
              <th>สถานะ</th>
              <th>ราคารวม</th>
              <th>ชื่อผู็สั่งซื้อ</th>
              <th>รายละเอียด</th>
              <th>#</th>
            </tr>
        </thead>
        <tbody ng-show="tblPartOrder.length > 0">
            <tr ng-repeat="data in tblPartOrder | orderBy:'-partorder_date' | filter:search">
              <td>{{$index +1}}</td>
              <td>{{data.partorder_code}} <span class="label label-warning" ng-show="data.partorderline_flag != '0'">ขอแก้ไขจำนวน</span></td>
              <td>{{data.servicecenter_name_th}}</td>
              <td>{{data.partorder_date}}</td>
              <td align="center">{{data.partorder_type_desc_th}}
              <img ng-show="data.partorder_type == 'CF-SV'" src="<?=base_url();?>/assets/img/icons/24/clock.png"></img>  
              <img ng-show="data.partorder_type == 'RE-HST' || data.partorder_type == 'RE-HST' " src="<?=base_url();?>/assets/img/icons/24/sign-error.png"></img>
              <img ng-show="data.partorder_type == 'CF-HST'" src="<?=base_url();?>/assets/img/icons/24/sign-check.png"></img>
              </td>
              <td align="right">{{data.partorder_total_amt | number}}</td>
              <td align="center">{{data.created_by}}</td>
              <td align="center"><button type="button" class="btn btn-primary btn-sm" ng-click="doShowList(data.partorder_code);"><i class="fa fa-search"></i></button></td>
              <td align="center"><button type="button" class="btn btn-warning btn-sm" ng-confirm-click="ยืนยันการสั่งซื้ออะไหล่ {{data.partorder_code}} ?" confirmed-click="confirmOrderHST(data.partorder_code)" ng-show="data.partorder_type == 'CF-SV'">ยืนยัน</button>
              <button type="button" class="btn btn-danger btn-sm" ng-confirm-click="ยกเลิกการสั่งซื้ออะไหล่ {{data.partorder_code}} ?" confirmed-click="rejectOrderHST(data.partorder_code)" ng-show="data.partorder_type == 'CF-SV'">ยกเลิก</button></td>
            </tr>
        </tbody>
        </table> 

    </div>
    </div>
    </div>
</div>



<!-- ####################===  End Order list ===######################### -->

<!-- ####################===  End Part list ===######################### -->



    
    </div>
  </div>
</div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>


<script>

var site = '<?=site_url();?>';
  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");});


  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap']);
  //app = angular.module('ui.bootstrap.demo').controller('DatepickerPopupDemoCtrl', function ($scope,$http,$uibModal, $log, $document) {
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document','$timeout', function ($scope,$http,$uibModal, $log, $document,$timeout)
  {

    $scope.doShowData = function(){

        $http.get(site+"/part_ctrl/getListManagePurchaseHST")
        .then(function(response) 
          {
             $scope.tblPartOrder = response.data.data;
               //console.log(response.data.data);http://150.95.24.212/newhsc/index.php/part_ctrl/getListManagePurchase
          },function(response) {
               console.log('tblPartOrder Error');
        });

          $timeout(function(){
            $scope.doShowData();
          },5000);

    }

    $scope.doShowList = function(po){

      window.location.href = site+"/Part_ctrl/po_hst_manage_list/"+po;

    }

    $scope.confirmOrderHST = function(po){

        //alert("confirm :"+po);
          var request = $http({
              method: "post",
              url: site+"/part_ctrl/updateStatusPurchaseHST",
              data: {
                      po_num : po,
                      type   : 'confirmHST'
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {

           //success
           $scope.doShowData();
 
          },function(response) {
              console.log(response);
              //console.log(response);
          });
    }

    $scope.rejectOrderHST = function(po){

        //alert("reject :"+po);
          var request = $http({
              method: "post",
              url: site+"/part_ctrl/updateStatusPurchaseHST",
              data: {
                      po_num : po,
                      type   : 'rejectHST'
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {

              //success
               $scope.doShowData();
 
          },function(response) {
              console.log(response);
              //console.log(response);
          });
    }




       // =================================================================
  }]);

AppJS.directive('ngConfirmClick', [
    function(){
        return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click',function (event) {
                    if ( window.confirm(msg) ) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
}])

</script>


  



<!-- /page content -->
<?php $this->load->view('layout/footer.php')?>

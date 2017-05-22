<?php $this->load->view('layout/header.php')?>

<style>

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
<div class="right_col" role="main" ng-app="AppJS">


  <div class="clearfix"></div>

   

        <!-- ####################===  Top ===######################### -->        
        
          <!-- ####################===  End Top ===######################### --> 

<!-- ####################===  Order list ===######################### -->
<div class="row" ng-controller="MainCtrl as $ctrl" ng-init="getDataHdr(); getDataLn(); getPolist();">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">
      <div class="row x_title">
        <h2><a href="<?=site_url();?>/partpurchase_ctrl/po_hst_manage"><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่ &nbsp;&nbsp;&nbsp;</a>: <?=$po_num;?></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a href="<?=site_url();?>/partpurchase_ctrl/po_hst_manage"><i class="glyphicon glyphicon-backward"></i>&nbsp;กลับไป
            </a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

      <!-- ****************** Order Header ****************** -->
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>เลขที่ใบสั่งซื้อ</th>
              <th>วันที่สั่งซื้อ</th>
              <th>ศูนย์บริการ</th>
              <th>สถานะ</th>
              <th>ราคารวม</th>
              <th>ชื่อผู้สั่งซื้อ</th>
            </tr>
        </thead>
        <tbody ng-show="tblPartOrder.length > 0">
            <tr ng-repeat="data in tblPartOrder">
              <td>{{data.partorder_code}}</td>
              <td>{{data.partorder_date}}</td>
              <td>{{data.servicecenter_name_th}}</td>
              <td align="center">{{data.partorder_type_desc_th}}</td>
              <td align="right">{{data.partorder_total_amt | number}}</td>
              <td align="center">{{data.created_by}}</td>
            </tr>
        </tbody>
        </table> 
        <!-- ****************** End Order Header ****************** -->

        <!-- ****************** Button ****************** -->
        <div class="row">
        <div class="col-sm-6 m-b-xs">
        </div>
        <div class="col-sm-6" align="right">
          <button type="button" class="btn btn-warning" ng-click="">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;ดูประวัติ
          </button> 
           <button type="button" class="btn btn-success" ng-click="openModelEditOrder()"  ng-disabled="EnableEdit" ng-show="tblLnPartOrder.length > 0 && (tblPartOrder[0].partorder_type == 'CF-HST' || tblPartOrder[0].partorder_type == 'AC')">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>&nbsp;แก้ไขรายการ
          </button>  
          <button type="button" class="btn btn-primary" ng-click="openModelgenPO()"  ng-disabled="EnableEdit" ng-show="tblLnPartOrder.length > 0 && (tblPartOrder[0].partorder_type == 'CF-HST' || tblPartOrder[0].partorder_type == 'AC')">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ></span>&nbsp;สร้าง PO
          </button>                                   
        </div>
        </div>
        <!-- ****************** End Buuton ****************** -->
        
        <table class="table table-bordered jambo_table" ng-show="tblLnPartOrder.length > 0">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <th>ชื่ออะไหล่</th>
               <th>ราคาต่อหน่วย</th>
              <th>จำนวน</th>
              <th>Back Order</th>
              <th>ส่ง</th>
              <th>ยกเลิกจากศูนย์</th>
              <th>ยกเลิก HST</th>
              <th>ค้างส่ง</th>            
              <th>ราคารวม</th>
              <th>#</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="data in tblLnPartOrder">
              <td>{{$index +1}}</td>
              <td>{{data.item_code}}</td>
              <td>{{data.partmaster_code}}</td>
              <td>{{data.partmaster_code_desc}}</td>
              <td align="right">{{data.partorderline_amt | number}}</td>
              <td align="center">{{data.partorderline_order_qty | number}}</td>
              <td align="center">{{data.partorderline_backorder_qty | number}}</td>
              <td align="center">{{data.partorderline_order_ship_qty | number}}</td>
              <td align="center">{{data.partorderline_order_cancelSV_qty | number}}&nbsp;<span class="label label-warning" ng-show="data.flag != '0'">รอการอนุมัติ</span></td>
              <td align="center">{{data.partorderline_order_cancel_qty | number}}</td>
              <td align="center">{{data.partorderline_order_blance_qty | number}}</td>
              
              <td align="right">{{data.partorderline_total_amt | number}}</td>
              <td align="center">
              <button type="button" class="btn btn-warning btn-sm" ng-confirm-click="ยืนยันการยกเลิก {{data.partmaster_code}} ?" confirmed-click="confirmOrderCancelHST(data.partorderline_id)" ng-show="data.flag == '1'">ยืนยัน</button>
              <button type="button" class="btn btn-danger btn-sm" ng-confirm-click="ยกเลิก {{data.partmaster_code}} ?" confirmed-click="rejectOrderCancelHST(data.partorderline_id)" ng-show="data.flag == '1'">ยกเลิก</button>
              </td>
            </tr>
        </tbody>
        </table> 

  
        
    </div>
    </div>
    </div>
   <!-- **************************  Purchase Order ******************************** -->
    <div class="col-md-12 col-xs-12">
        <div class="x_panel" style="height:100%;">
          <div class="row x_title">
     
             <h2><i class="fa fa-credit-card"></i>&nbsp;Purchase Order</h2>
             <ul class="nav navbar-right panel_toolbox">
                <li></li>                 
              </ul>
                  <div class="clearfix"></div>
              </div>

        <div class="x_content">
        
            <table class="table table-bordered jambo_table">
            <thead align="center">
                <tr>
                  <th>เลขที่ PO</th>
                  <th>วันที่</th>
                  <th>เลชที่ Invoice</th>
                  <th>เลชที่ใบขนส่ง</th>
                  <th>ชื่อผู้ทำรายการ</th>
                  <th>#</th>
                </tr>
            </thead>
            <tbody ng-show="tblPOlist.length > 0">
                <tr ng-repeat="data in tblPOlist">
                  <td>{{data.po_code}}</td>
                  <td>{{data.po_date}}</td>
                  <td>{{data.invoice_ax_num}}</td>
                  <td>{{data.transport_code}}</td>
                  <td align="center">{{data.created_by}}</td>
                  <td align="center">
                   <button type="button" class="btn btn-primary btn-sm" ng-click="openModelShowPO(data);"><i class="fa fa-search"></i></button>
                  </td>
                </tr>
            </tbody>
            </table>    
        </div>
        </div>
    </div>
    <!-- **************************  End Purchase Order ******************************** -->
</div>



<!-- ####################===  End Order list ===######################### -->

<!-- ####################===  End Part list ===######################### -->

  <!-- Start Template  Order-->
    <div class="modal-demo">
      <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header" ng-init="doShowOrderLn()">
            <h3 class="modal-title" id="modal-title">แก้ไขรายการใบสั่งซื้อเลขที่ :&nbsp;{{tblPartOrderTemp[0].partorder_code}}</h3>
        </div>
        <div class="modal-body" id="modal-body">
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <!-- <th>ชื่ออะไหล่</th> -->
              <th>จำนวน</th>
              <th>Back Order</th>

              <th>ส่ง</th>
              <th>ยกเลิกจากศูนย์</th>
              <th>ยกเลิก</th>
              <th>ค้างส่ง</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="item in tblPartOrderTemp">
              <td>{{item.item_code}}</td>
              <td>{{item.partmaster_code}}</td>
              <!-- <td>{{item.partmaster_code_desc}}</td> -->
              <td align="center">{{item.partorderline_order_qty | number}}</td>
              <td align="center">{{item.partorderline_backorder_qty | number}}</td>
              <td align="center">{{item.partorderline_order_ship_qty | number}}</td>
              <td align="center">{{item.partorderline_order_cancelSV_qty | number}}</td>
              <td align="center">
                    <button type="button" class="btn-xs btn-danger" ng-click="decCancelOrderList(item)">
                      <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    </button>
                     &nbsp;{{item.partorderline_order_cancel_qty | number}}&nbsp;
                    <button type="button" class="btn-xs btn-success" ng-click="inCancelOrderList(item)">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
              </td>
              <td align="center">{{item.partorderline_order_blance_qty | number}}</td>            
            </tr>
        </tbody>
        </table> 
        </div>
         <!-- {{$ctrl.items | json}} -->
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="doUpdate()">ตกลง</button>
            <button class="btn btn-danger" type="button" ng-click="cancel()">ยกเลิก</button>
        </div>
      </script>
    </div>
  <!-- End Template -->




  <!-- Start Template PO-->
    <div class="modal-demo">
      <script type="text/ng-template" id="listPO.html">
        <div class="modal-header" ng-init="doShowPoLn();">
            <h3 class="modal-title" id="modal-title">Purchase Order :&nbsp;{{tblPolistLnTemp[0].po_code}}</h3>
        </div>
        <div class="modal-body" id="modal-body">
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <th>จำนวน</th>
              <th>ยกเลิก</th>
              <th>ค้างส่ง</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="item in tblPolistLnTemp">
              <td>{{item.item_code}}</td>
              <td>{{item.partmaster_code}}</td>
              <td align="center">{{item.poline_order_qty | number}}</td>
              <td align="center">
                     &nbsp;{{item.poline_order_cancel_qty | number}}&nbsp;        
              </td>
              <td align="center">{{item.poline_order_blance_qty | number}}</td>            
            </tr>
        </tbody>
        </table> 
        </div>
         <!-- {{$ctrl.items | json}} -->
        <div class="modal-footer">
            <!-- <button class="btn btn-primary" type="button" ng-click="doUpdatePoLnList()">ตกลง</button> -->
            <button class="btn btn-danger" type="button" ng-click="cancel()">ปิด</button>
        </div>
      </script>
    </div>
  <!-- End Template PO-->


  <!-- Start Template Gen PO Query -->
  <div class="modal-demo">
      <script type="text/ng-template" id="poContent.html">
      <div class="modal-header">
        <div class="row">
          <div class="col-sm-6 m-b-xs">
          <h3 class="modal-title" id="modal-title">เลขที่ใบสั่งซื้อ : {{tblPoHdrTemp[0].partorder_code}}</h3>
          </div>
          <div class="col-sm-6" align="right">
          </div>
        </div>
      </div>
      <div class="modal-body" id="modal-body" ng-init="getHdrPo(); getLnPo();">
          <table class="table table-bordered jambo_table">
          <thead align="center">
              <tr>
                <th>รหัสศูนย์บริการ</th>
                <th>ศูนย์บริการ</th>
                <th>วันที่สั่งซื้อ</th>
                <th>ชื่อผู้สั่งซื้อ</th>
              </tr>
          </thead>
          <tbody ng-show="tblPoHdrTemp.length > 0">
              <tr ng-repeat="data in tblPoHdrTemp">
                <td>{{data.servicecenter_code}}</td>
                <td>{{data.servicecenter_name_th}}</td>
                <td align="center">{{data.partorder_date}}</td>
                <td align="center">{{data.created_by}}</td>
              </tr>
          </tbody>
          </table> 
          <table class="table table-bordered jambo_table" ng-show="tblPoLnTemp.length > 0">
              <thead align="center">
                  <tr>
                    <th>ลำดับ</th>
                    <th>อะไหล่</th>
                    <th>ชื่ออะไหล่</th>
                    <th>จำนวน</th>
                    <th>ค้าง</th>
                  </tr>
              </thead>
              <tbody>
                  <tr ng-repeat="data in tblPoLnTemp">
                    <td>{{$index +1}}</td>
                    <td>{{data.partmaster_code}}</td>
                    <td>{{data.partmaster_code_desc}}</td>
                    <td align="center">              
                    <button type="button" class="btn-xs btn-success" ng-click="decrementList(data)"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                    &nbsp;{{data.openpo | number}}&nbsp;
                    <button type="button" class="btn-xs btn-danger" ng-click="incrementList(data)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                    </td>
                    <td>
                       {{data.backorder | number}}
                    </td>
                  </tr>
            
              </tbody>
          </table> 
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary" type="button" ng-click="addPoHST()">ตกลง</button>
          <button class="btn btn-danger" type="button" ng-click="cancel()">ยกเลิก</button>
      </div>
      </script>
  </div>
  <!-- End Template Gen PO  Query -->


    
    </div>
  </div>
</div>
</div>

</body>

</html>




<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>


<script>

   var site = '<?=site_url();?>';
   var order = '<?=$po_num;?>';
  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");});


  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap']);
  //app = angular.module('ui.bootstrap.demo').controller('DatepickerPopupDemoCtrl', function ($scope,$http,$uibModal, $log, $document) {
  AppJS.controller('MainCtrl', ['$scope','$http','$uibModal', '$log', '$document','$uibModal','$timeout', function ($scope,$http,$uibModal, $log, $document, $uibModal, $timeout)
  {

    // Show Order
    $scope.getDataHdr = function(){

      $http.get(site+"/partpurchase_ctrl/getHdrListPurchaseHST/"+order)
      .then(function(response) 
        {
           $scope.tblPartOrder = response.data.data;
        },function(response) {
             console.log('tblPartOrder Error');
      });

      $timeout(function(){
        $scope.getDataHdr();
        $scope.getDataLn();
        $scope.getPolist();
      },5000);
    }

    $scope.getDataLn = function(){
        $http.get(site+"/partpurchase_ctrl/getLnListPurchaseHST/"+order)
        .then(function(response) 
          {
            
          $scope.tblLnPartOrder = response.data.data;
           // ----- Check SV Cencel ------
           $scope.EnableEdit = false; 
            $scope.tblLnPartOrder.forEach(function(data){
               if(data.flag > 0 ){
                   return $scope.EnableEdit = true; 
               }
            });
           // -----      End        ------
          },function(response) {
               console.log('tblPartOrder Error');
        });
    }

    $scope.tblLnPartOrder = {};
    // ------------ Show PO -*-*--*--*--*-*--
    $scope.getPolist = function(){

        $http.get(site+"/partpurchase_ctrl/getPolistHST/"+order)
        .then(function(response) 
          {
            
            $scope.tblPOlist = response.data.data;

          },function(response) {
               console.log('tblPOlist Error');
        });
    }

    //Confrim Reject Cancel Order ----------
    $scope.confirmOrderCancelHST = function(data){

        var request = $http({
        method: "post",
        url: site+"/partpurchase_ctrl/updateQtySVCancelOrderHST",
        data: {
                id : data,
                type   : 'confirmHST'
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.then(function (response) {

         //success
         $scope.getDataLn();
         $scope.getDataHdr();

        },function(response) {
            console.log(response);
            //console.log(response);
        });
    }

    $scope.rejectOrderCancelHST = function(data){

        var request = $http({
        method: "post",
        url: site+"/part_ctrl/updateQtySVCancelOrderHST",
        data: {
                id : data,
                type   : 'rejectHST'
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.then(function (response) {

         //success
         $scope.getDataLn();
         $scope.getDataHdr();

        },function(response) {
            console.log(response);
            //console.log(response);
        });
    }

    $scope.animationsEnabled = true;  //SET ANIMATION
    $scope.openModelEditOrder = function () {

      var modalInstance = $uibModal.open({
        animation: $scope.animationsEnabled,
        templateUrl: 'myModalContent.html',
        controller: 'ModalInstanceCtrl',
        size: 'lg',
        resolve: {
          items: function () {
            return $scope.tblLnPartOrder;
          }
        }
      });
      modalInstance.result.then(function () {
            $scope.getDataHdr();
            $scope.getDataLn();
            $scope.getPolist();
      }, function () {
            $scope.getDataHdr();
            $scope.getDataLn();
            $scope.getPolist();
        $log.info('Modal dismissed at: ' + new Date());
      });
    };

    // list PO --**-*-*---*-**---*-*-*-*
    $scope.openModelShowPO = function(po){

      var modalInstance = $uibModal.open({
      animation: $scope.animationsEnabled,
      templateUrl: 'listPO.html',
      controller: 'PoCtrl',
      size: 'lg',
      resolve: {
        items: function () {
          return po;
        }
      }
      });

      modalInstance.result.then(function () {
            $scope.getDataHdr();
            $scope.getDataLn();
            $scope.getPolist();
      }, function () {
            $scope.getDataHdr();
            $scope.getDataLn();
            $scope.getPolist();
        $log.info('Modal dismissed at: ' + new Date());
      });
    };


    //------Gen PO ***-------*
    $scope.openModelgenPO = function () {

      var modalInstance = $uibModal.open({
        animation: $scope.animationsEnabled,
        templateUrl: 'poContent.html',
        controller: 'poCtrlGen',
        size: 'lg',
        resolve: {
          items: function () {
            return order;
          }
        }
      });
      modalInstance.result.then(function () {
          $scope.getDataHdr();
          $scope.getDataLn();
          $scope.getPolist();
      }, function () {
          $scope.getDataHdr();
          $scope.getDataLn();
          $scope.getPolist();
      });
    };

  

// =================================================================
  }]);

// Part Order  ---**-**--**--*-
angular.module('AppJS').controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items, $http) {

  //$scope.tblPartOrderTemp = items;

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.doShowOrderLn = function () {

        $http.get(site+"/partpurchase_ctrl/getLnListPurchaseHST/"+order)
        .then(function(response) 
          {
            
            $scope.tblPartOrderTemp = response.data.data;

          },function(response) {
            console.log('tblPartOrderTemp Error');
        });
  }

  $scope.doUpdate = function () {
    
    var chkBackorderEdit = 0 ;
  
    //check change value
    $scope.tblPartOrderTemp.forEach(function(data){
      if(parseInt(data.Tempbackorder) !== parseInt(data.partorderline_backorder_qty)){
           chkBackorderEdit = 1;
           data.status = 1;
      }
    });

    if (chkBackorderEdit > 0){

        var request = $http({
        method: "post",
        url: site+"/partpurchase_ctrl/updateQtyCancelOrderHST",
        data: {
                partorder:order,
                data : $scope.tblPartOrderTemp
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.then(function (response) {
         console.log(response);
          //$uibModalInstance.close();

        },function(response) {
            console.log(response);
            console.log($scope.tblPartOrderTemp);
        });

    }else{

        $uibModalInstance.close();
    }



    
  };

  $scope.inCancelOrderList = function(part){

     var cancel      = 0;
     var blance      = 0;
     var backorder   = 0;

      cancel    =  part.partorderline_order_cancel_qty;
      backorder =  part.partorderline_backorder_qty;
      backorder--;
      cancel++;
      blance   =  (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+cancel));

    if((blance >= 0) && (cancel >=0) && (backorder >= 0)){
            
            part.partorderline_backorder_qty--;
            part.partorderline_order_cancel_qty++;
            part.partorderline_order_blance_qty = (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+parseInt(part.partorderline_order_cancel_qty)));
    }

  }

  $scope.decCancelOrderList = function(part){

     var cancel   = 0;
     var blance   = 0;
     var backorder   = 0;

      cancel    =  part.partorderline_order_cancel_qty;
      backorder =  part.partorderline_backorder_qty;
      backorder++;
      cancel--;
      blance   =  (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+cancel));

    if((blance >= 0) && (cancel >=0) && (backorder >= 0)){
      
            part.partorderline_backorder_qty++;
            part.partorderline_order_cancel_qty--;
            part.partorderline_order_blance_qty = (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+parseInt(part.partorderline_order_cancel_qty)));

    }

  }
}); 


// PO Ctrl  ========---===-=-=-=-=-=-=-=-==-=-=
angular.module('AppJS').controller('PoCtrl', function ($scope, $uibModalInstance, items, $http) {

  $scope.po_hdr = items;

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.doShowPoLn = function () {

    $http.get(site+"/partpurchase_ctrl/getPoLnlistHST/"+$scope.po_hdr.po_code)
    .then(function(response) 
      {
        
        $scope.tblPolistLnTemp = response.data.data;

      },function(response) {
           console.log('tblPolistLnTemp Error');
    });

    
  };
}); 

// PO Ctrl Gen  ========---===-=-=-=-=-=-=-=-==-=-=
angular.module('AppJS').controller('poCtrlGen', function ($scope, $uibModalInstance, items, $http) {

  $scope.po = items;

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.getHdrPo = function (){

    $http.get(site+"/partpurchase_ctrl/getHdrListPurchaseHST/"+$scope.po)
    .then(function(response) 
    {
         $scope.tblPoHdrTemp = response.data.data;
    },function(response) {
         console.log('getHdrPo');
    });  
  };

  $scope.getLnPo = function () {
    $http.get(site+"/partpurchase_ctrl/getLnListPurchaseHST/"+$scope.po)
    .then(function(response) 
    {
         $scope.tblPoLnTemp = response.data.data;
    },function(response) {
         console.log('getLnPo');
    }); 
  };

  $scope.addPoHST = function () {

    var chkOpenpo = 0 ;

    $scope.tblPoLnTemp.forEach(function(data){
      if(data.openpo > 0){
           chkOpenpo = 1;
      }
    });

    if(chkOpenpo !== 0){

      var request = $http({
      method: "post",
      url: site+"/partpurchase_ctrl/addPoHST",
      data: {
              data: $scope.tblPoLnTemp,
              partorder_code: $scope.tblPoHdrTemp[0].partorder_code,
              servicecenter_code: $scope.tblPoHdrTemp[0].servicecenter_code,
              type:'BACKORDER'
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
      request.then(function (response) {

        $uibModalInstance.close();

      },function(response) {
          console.log(response);
          console.log($scope.tblPartOrderTemp);
      });

    }else{

      $uibModalInstance.close();

    }


    
  };
  $scope.incrementList = function(part){

      var qty   = 0;
      var backorder   = 0;

      qty =  part.openpo;

      backorder  =  parseInt(part.backorder);
      backorder--;
      if(backorder >= 0){
  
            part.openpo++;
            part.backorder--;
            part.status = 1;
      }

  }
  $scope.decrementList = function(part){

      var qty   = 0;
      var backorder   = 0;

      qty =  part.openpo;
      qty--;
      backorder  =  parseInt(part.backorder);

      if(qty >=0){
  
            part.openpo--;
            part.backorder++;
            part.status = 1;
      }
    
  }
}); 




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

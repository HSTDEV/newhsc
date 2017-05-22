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
<div class="row" ng-controller="MainCtrl as $ctrl" ng-init="getDataHdr(); getDataLn();">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">
      <div class="row x_title">
 
           <h2><a href="<?=site_url();?>/Part_ctrl/po_hst_manage"><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่ HST&nbsp;&nbsp;&nbsp;</a>: <?=$po_num;?></h2>
   
     
     
          
     
   <ul class="nav navbar-right panel_toolbox">
                      <li><a href="<?=site_url();?>/Part_ctrl/po_hst_manage"><i class="glyphicon glyphicon-backward"></i>&nbsp;กลับไป</a></li>
                      
                    </ul>
        <div class="clearfix"></div>
    </div>



    <div class="x_content">
    
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
        <div class="row">
        <div class="col-sm-6 m-b-xs">
        </div>
        <div class="col-sm-6" align="right">
          <button type="button" class="btn btn-warning" ng-click="">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;ดูประวัติ
          </button> 
           <button type="button" class="btn btn-success" ng-click="EditOrder()"  ng-disabled="EnableEdit" ng-show="tblLnPartOrder.length > 0 && (tblPartOrder[0].partorder_type == 'CF-HST' || tblPartOrder[0].partorder_type == 'AC')">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>&nbsp;แก้ไขรายการ
          </button>                                 
        </div>
        </div>

        <!-- Read Only -->
        <table class="table table-bordered jambo_table" ng-show="tblLnPartOrder.length > 0 && (tblPartOrder[0].partorder_type == 'RE-HST' || tblPartOrder[0].partorder_type == 'CF-SV' || tblPartOrder[0].partorder_type == 'CP')">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <th>ชื่ออะไหล่</th>
              <th>จำนวน</th>
              <th>ราคา</th>
              <th>รวม</th>
              <th>#</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="data in tblLnPartOrder">
              <td>{{$index +1}}</td>
              <td>{{data.item_code}}</td>
              <td>{{data.partmaster_code}}</td>
              <td>{{data.partmaster_code_desc}}</td>
              <td align="center">{{data.partorderline_order_qty | number}}</td>
              <td align="right">{{data.partorderline_amt | number}}</td>
              <td align="right">{{data.partorderline_total_amt | number}}</td>
              <td align="center"></td>
            </tr>
            <tr>
              <td colspan="8" align="right"><h3>ยอดรวม : {{getTotaltblPartMaster() | number}} บาท</h3></td>  
            </tr>
        </tbody>
        </table> 
        <!-- Confrimed -->
        <table class="table table-bordered jambo_table" ng-show="tblLnPartOrder.length > 0 && (tblPartOrder[0].partorder_type == 'CF-HST' || tblPartOrder[0].partorder_type == 'AC')">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <th>ชื่ออะไหล่</th>
               <th>ราคาต่อหน่วย</th>
              <th>จำนวน</th>
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
            <tr>
              <td colspan="12" align="right"><h3>ยอดรวม : {{getTotaltblPartMaster() | number}} บาท</h3></td>  
            </tr>
        </tbody>
        </table> 

        <!-- {{ EnableEdit | json}} -->
        
    </div>
    </div>
    </div>
</div>



<!-- ####################===  End Order list ===######################### -->

<!-- ####################===  End Part list ===######################### -->
    <!-- Start Template -->
    <div class="modal-demo">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">แก้ไขรายการ</h3>
        </div>
        <div class="modal-body" id="modal-body">
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <!-- <th>ชื่ออะไหล่</th> -->
              <th>จำนวน</th>
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
              <td align="center">{{item.partorderline_order_ship_qty | number}}</td>
              <td align="center">{{item.partorderline_order_cancelSV_qty | number}}</td>
              <td align="center">
                    <button type="button" class="btn-xs btn-danger" ng-click="decrementList(item)">
                      <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    </button>
                     &nbsp;{{item.partorderline_order_cancel_qty | number}}&nbsp;
                    <button type="button" class="btn-xs btn-success" ng-click="incrementList(item)">
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
  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");});


  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap']);
  //app = angular.module('ui.bootstrap.demo').controller('DatepickerPopupDemoCtrl', function ($scope,$http,$uibModal, $log, $document) {
  AppJS.controller('MainCtrl', ['$scope','$http','$uibModal', '$log', '$document','$uibModal','$timeout', function ($scope,$http,$uibModal, $log, $document, $uibModal, $timeout)
  {



      $scope.limitOrder = 5;
          


      $scope.getDataHdr = function(){

              $http.get(site+"/part_ctrl/getHdrListPurchaseHST/<?=$po_num;?>")
      .then(function(response) 
        {
           $scope.tblPartOrder = response.data.data;
             //console.log(response.data.data);
        },function(response) {
             console.log('tblPartOrder Error');
      });

          $timeout(function(){
            $scope.getDataHdr();
            $scope.getDataLn();
            //$scope.tblPartOrderTemp();
          },5000);

      }

      $scope.getDataLn = function(){
          $http.get(site+"/part_ctrl/getLnListPurchaseHST/<?=$po_num;?>")
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

      $scope.getTotaltblPartMaster = function(){

          var total = 0;
          for(var i = 0; i < $scope.tblLnPartOrder.length; i++){
              var price = $scope.tblLnPartOrder[i];
              total = total + (price.partorderline_total_amt*1);
          }
          return total;

      }


      //Confrim Reject Cancel Order ----------
      
      $scope.confirmOrderCancelHST = function(data){

          var request = $http({
          method: "post",
          url: site+"/part_ctrl/updateQtySVCancelOrderHST",
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







      // model 
      var $ctrl = this;
      $ctrl.items = '';

      $scope.EditOrder = function(data){

        $scope.open('lg');

      }


    $scope.animationsEnabled = true;  //SET ANIMATION
    $scope.open = function (size) {

    var modalInstance = $uibModal.open({
      animation: $scope.animationsEnabled,
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          return $scope.tblLnPartOrder;
        }
      }
    });

    modalInstance.result.then(function () {
      //alert("OK");
      $scope.getDataHdr();
      $scope.getDataLn();
    }, function () {
      $scope.getDataHdr();
      $scope.getDataLn();
      $log.info('Modal dismissed at: ' + new Date());
    });
  };

       // =================================================================
  }]);

// POPUP

angular.module('AppJS').controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items, $http) {

  $scope.tblPartOrderTemp = items;

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.doUpdate = function () {

      var request = $http({
      method: "post",
      url: site+"/part_ctrl/updateQtyCancelOrderHST",
      data: {
              data: $scope.tblPartOrderTemp
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
      request.then(function (response) {

        $uibModalInstance.close();

      },function(response) {
          console.log(response);
          console.log($scope.tblPartOrderTemp);
      });
    
  };

  $scope.incrementList = function(part){
     var cancel   = 0;
     var blance   = 0;

      cancel   =  part.partorderline_order_cancel_qty;
      cancel++;
      blance   =  (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+cancel));

    if((blance >= 0) && (cancel >=0)){
  
            part.partorderline_order_cancel_qty++;
            part.partorderline_order_blance_qty = (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+parseInt(part.partorderline_order_cancel_qty)));
            part.status = 1;
    }

  }

  $scope.decrementList = function(part){


     var cancel   = 0;
     var blance   = 0;

      cancel   =  part.partorderline_order_cancel_qty;
      cancel--;
      blance   =  (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+cancel));

    if((blance >= 0) && (cancel >=0)){
  
            part.partorderline_order_cancel_qty--;
            part.partorderline_order_blance_qty = (parseInt(part.partorderline_order_qty)-(parseInt(part.partorderline_order_ship_qty)+parseInt(part.partorderline_order_cancel_qty)));
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

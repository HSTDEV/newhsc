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
                  


                  </div>
                </div>


    <div class="x_content">

        <div class="ibox-content m-b-sm border-bottom">
          <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="product_name">ค้นหาข้อมูล</label>
                        <input type="text" ng-model="search" value="" placeholder="Search" class="form-control">
                  </div>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                          <option value="1" selected="">All</option>
                          <option value="0">Disabled</option>
                      </select>
                  </div>
              </div>
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
              <td align="center"><button type="button" class="btn btn-warning btn-sm" ng-click="openModelgenPO(data.partorder_code)" ng-show="data.partorder_type == 'CF-SV'">ยืนยัน</button>
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
    <button class="btn btn-danger" type="button" ng-click="cancel()">ปิด</button>
</div>
</script>
</div>
  <!-- End Template Gen PO  Query -->



    
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
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document','$timeout', function ($scope,$http,$uibModal, $log, $document,$timeout)
  {

    $scope.doShowData = function(){

        $http.get(site+"/partpurchase_ctrl/getListManagePurchaseHST")
        .then(function(response) 
        {
             $scope.tblPartOrder = response.data.data;
        },function(response) {
             console.log('tblPartOrder Error');
        });

          // $timeout(function(){
          //   $scope.doShowData();
          // },5000);

    }

    $scope.doShowList = function(po){

      window.location.href = site+"/partpurchase_ctrl/po_hst_manage_list/"+po;

    }

    $scope.confirmOrderHST = function(po){
          $scope.openModelgenPO();
    }

    $scope.rejectOrderHST = function(po){

          var request = $http({
              method: "post",
              url: site+"/partpurchase_ctrl/updateStatusPurchaseHST",
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

    $scope.animationsEnabled = true;  //SET ANIMATION
    $scope.openModelgenPO = function (po) {
    var modalInstance = $uibModal.open({
      animation: $scope.animationsEnabled,
      templateUrl: 'poContent.html',
      controller: 'poCtrl',
      size: 'lg',
      resolve: {
        items: function () {
          return po;
        }
      }
    });
    modalInstance.result.then(function () {
      $scope.doShowData();
    }, function () {
      $scope.doShowData();
    });
    };

    

  }]);

// POPUP *****************************************
angular.module('AppJS').controller('poCtrl', function ($scope, $uibModalInstance, items, $http) {

  $scope.po = items;

  // $scope.ok = function () {
  //   $uibModalInstance.close($scope.selected.item);
  // };
  // $scope.cancel = function () {
  //   $uibModalInstance.dismiss('cancel');
  // };

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
              type:'INVOICE'
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
angular.module('AppJS').controller('InvoiceContentCtrl', function ($scope, $uibModalInstance, items, $http) {
  
  $scope.tblInvoiceTemp = items;
  $scope.EditInvoice = false;
  $scope.ok = function () {
    $uibModalInstance.close();
  };
  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
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

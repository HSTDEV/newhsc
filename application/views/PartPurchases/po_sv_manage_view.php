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
<div class="right_col" role="main" ng-app="AppJS" >


  <div class="clearfix"></div>

   

        <!-- ####################===  Top ===######################### -->        
        
        <!-- ####################===  End Top ===######################### --> 

<!-- ####################===  Order list ===######################### -->
<div class="row" ng-controller="StepCtrl" ng-init="doShowData();">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">

     <div class="row x_title">

           <h2><a href="<?=site_url();?>/partpurchase_ctrl/po_sv"><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่ Service Center&nbsp;&nbsp;&nbsp;</a></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a href="<?=site_url();?>/partpurchase_ctrl/po_sv"><i class="glyphicon glyphicon-backward"></i>&nbsp;กลับไป</a></li>
          </ul>
    <div class="clearfix"></div>
    </div>


    <div class="x_content">
      <div class="row">
        <div class="col-sm-9"><h3><span class="label label-warning">รอการยืนยันจากศูนย์บริการ {{numStatusCR}} รายการ</span><img src="<?=base_url();?>/assets/img/facebook.gif" style="width:32px;height:32px"> </h3>
         </div>
        <div class="col-sm-3"></div>
       
      </div>

<div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="product_name">ค้นหาข้อมูล</label>
                              <input type="text" ng-model="search" value="" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                       <!--  <div class="form-group">
                            <label class="control-label" for="price">Price</label>
                            <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
                        </div> -->
                    </div>
                    <div class="col-sm-2">
                     <!--    <div class="form-group">
                            <label class="control-label" for="quantity">Quantity</label>
                            <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity" class="form-control">
                        </div> -->
                    </div>
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
        <table ng-table="NgtblPartOrder" class="table table-bordered jambo_table">
    
            <tr ng-repeat="data in $data | filter:search">
              <td data-title="'ลำดับ'" ">{{data.num}}</td> 

              <td data-title="'เลขที่ใบสั่งซื้อ'" sortable="'partorder_code'">{{data.partorder_code}} <span class="label label-warning" ng-show="data.partorderline_flag != '0'">ขอแก้ไขจำนวน</span></td>
              <td data-title="'วันที่สั่งซื้อ'" sortable="'partorder_date'">{{data.partorder_date}}</td>
              <td data-title="'สถานะ'" align="center" sortable="'partorder_type_desc_th'">{{data.partorder_type_desc_th}}&nbsp;
              <img ng-show="data.partorder_type == 'CR'" src="<?=base_url();?>/assets/img/icons/24/clock.png"></img>
              
              <img ng-show="data.partorder_type == 'RE-SV' || data.partorder_type == 'RE-HST' " src="<?=base_url();?>/assets/img/icons/24/sign-error.png"></img>
              <img ng-show="data.partorder_type == 'CF-SV'" src="<?=base_url();?>/assets/img/icons/24/sign-check.png"></img>
              </td>
              <td data-title="'ราคารวม'" align="right" sortable="'partorder_total_amt'">{{data.partorder_total_amt | number}}</td>
              <td data-title="'ชื่อผู้สั่งซื้อ'" align="center" sortable="'created_by'">{{data.created_by}}</td>
              <td data-title="'รายละเอียด'" align="center">
              <button type="button" class="btn btn-primary btn-sm" ng-click="doShowList(data.partorder_code);" ng-show="data.partorder_type != 'CR'"><i class="fa fa-search"></i></button>
              <button type="button" class="btn btn-success btn-sm" ng-click="doShowList(data.partorder_code);" ng-show="data.partorder_type == 'CR'"><i class="fa fa-pencil"></i></button>
              </td>
              <td data-title="'#'" align="center"><button type="button" class="btn btn-warning btn-sm" ng-confirm-click="ยืนยันการสั่งซื้ออะไหล่ {{data.partorder_code}} ?" confirmed-click="confirmOrderSV(data.partorder_code)" ng-show="data.partorder_type == 'CR'">ยืนยัน</button>
              <button type="button" class="btn btn-danger btn-sm" ng-confirm-click="ยกเลิกการสั่งซื้ออะไหล่ {{data.partorder_code}} ?" confirmed-click="rejectOrderSV(data.partorder_code)" ng-show="data.partorder_type == 'CR'">ยกเลิก</button></td>
            </tr>
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

<!-- ngtable -->
<link rel="stylesheet"; href="https://unpkg.com/ng-table@2.0.2/bundles/ng-table.min.css">
<script src="https://unpkg.com/ng-table@2.0.2/bundles/ng-table.min.js"></script>


<script>

var site = '<?=site_url();?>';
  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");});


  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap','ngTable']);
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document' ,'$timeout','NgTableParams', function ($scope,$http,$uibModal, $log, $document, $timeout, NgTableParams)
  {

    $scope.numStatusCR = 0;

            var data = [{}];
    $scope.tableParams = new NgTableParams({}, { dataset: data});

    $scope.doShowData = function(){
        // loading
      
        $http.get(site+"/partpurchase_ctrl/getListManagePurchaseSV")
        .then(function(response) 
          {
             /// close loaf
             $scope.tblPartOrder = response.data.data;
             $scope.NgtblPartOrder = new NgTableParams({  
                sorting: {partorder_date: 'desc'}
             }, { dataset: response.data.data});

             if($scope.tblPartOrder.length > 0 ){
                  $scope.numStatusCR = 0;
                  $scope.tblPartOrder.forEach(function(data){

                        if(data.partorder_type == 'CR'){
                             $scope.numStatusCR++;
                        }


                  });

             }

          },function(response) {
               console.log('tblPartOrder Error');
        });

          // $timeout(function(){
          //   $scope.doShowData();
          // },5000);

    }

    $scope.doShowList = function(po){

      window.location.href = site+"/partpurchase_ctrl/po_sv_manage_list/"+po;

    }

    $scope.confirmOrderSV = function(po){

          var request = $http({
              method: "post",
              url: site+"/partpurchase_ctrl/updateStatusPurchaseSV",
              data: {
                      po_num : po,
                      type   : 'confirmSV'
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {

           //success
           $scope.doShowData();
 
          },function(response) {
              console.log(response);
              if(response.data == 'CR'){
                   alert("Error Status has change!");
                   window.location.href = site+"/partpurchase_ctrl/po_sv_manage/"+po;
              }
          });
    }

    $scope.rejectOrderSV = function(po){

        //alert("reject :"+po);
          var request = $http({
              method: "post",
              url: site+"/partpurchase_ctrl/updateStatusPurchaseSV",
              data: {
                      po_num : po,
                      type   : 'rejectSV'
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {

              //success
               $scope.doShowData();
 
          },function(response) {
              console.log(response);
              if(response.data == 'CR'){
                   alert("Error Status has change!");
                   window.location.href = site+"/partpurchase_ctrl/po_sv_manage/"+po;
              }
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

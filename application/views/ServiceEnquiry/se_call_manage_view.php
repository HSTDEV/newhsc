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

<!-- ####################===  list ===######################### -->
    <div class="row" ng-controller="StepCtrl" ng-init="doShowData();">
      <div class="col-md-12 col-xs-12">
        <div class="x_panel" style="height:100%;">
         <div class="row x_title">
               <h2><a href="<?=site_url();?>/se_ctrl/se_call_manage">จัดการรายการแจ้งซ่อม HST&nbsp;&nbsp;&nbsp;</a></h2>
              <ul class="nav navbar-right panel_toolbox">
                <!-- <li><a href="<?=site_url();?>/Part_ctrl/po_sv"><i class="glyphicon glyphicon-backward"></i>&nbsp;กลับไป</a></li> -->
              </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
            <!-- <div class="col-sm-9"><h3><span class="label label-warning">รอการยืนยันจากศูนย์บริการ {{numStatusCR}} รายการ</span><img src="<?=base_url();?>/assets/img/facebook.gif" style="width:32px;height:32px"> </h3>
             </div> -->
            <div class="col-sm-3"></div>
           
        </div><br>
            <table ng-table="NgtblServiceTrans" class="table table-bordered jambo_table">
              <tr ng-repeat="data in $data | orderBy:'-servicetrans_code'">
                <td align="center" width="5%" data-title="'ลำดับ'">{{$index +1}}</td>
                <td align="center" width="13%" data-title="'เลขที่แจ้งซ่อม'" sortable="'servicetrans_code'">{{data.servicetrans_code}}</td>
                <td align="center" width="12%" data-title="'วันที่แจ้งซ่อม'" sortable="'servicetrans_date'">{{data.servicetrans_date}}</td>
                <td width="20%" data-title="'ศูนย์บริการ'" sortable="'servicecenter_name_th'">{{data.servicecenter_name_th}}</td>
                <td align="center" width="10%" data-title="'รุ่นสินค้า'">{{data.item_code}}</td>
                <td align="center" width="14%" data-title="'หมายเลขเครื่อง'">{{data.servicetrans_serial}}</td>
                <td align="center" width="10%" data-title="'สถานะ'" sortable="'servicetrans_status'">{{data.servicetrans_status}}</td>
                <td align="center" width="9%" data-title="'รายละเอียด'">
                  <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                </td>
              </tr>
            </table> 
        </div>
        </div>
        </div>
    </div>   
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
  //app = angular.module('ui.bootstrap.demo').controller('DatepickerPopupDemoCtrl', function ($scope,$http,$uibModal, $log, $document) {
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document' ,'$timeout','NgTableParams', function ($scope,$http,$uibModal, $log, $document, $timeout, NgTableParams)
  {

    $scope.numStatusCR = 0;

    //var self = this;
        var data = [{name: "Moroni50", age: 50}
                ,{name: "Moroni49", age: 49}
                ,{name: "Moroni48", age: 48}
                ,{name: "Moroni47", age: 47}
                ,{name: "Moroni46", age: 46}
                ,{name: "Moroni45", age: 45}
                ,{name: "Moroni44", age: 44}
                ,{name: "Moroni43", age: 43}
                ,{name: "Moroni42", age: 42}
                ,{name: "Moroni41", age: 41}
                ,{name: "Moroni40", age: 40}
                ,{name: "Moroni39", age: 39}
               ];
    $scope.tableParams = new NgTableParams({}, { dataset: data});

    $scope.doShowData = function(){

      
        $http.get(site+"/se_ctrl/getTblServicetrans")
        .then(function(response) 
          {
             //$scope.tblPartOrder = response.data.data;
             $scope.NgtblServiceTrans = new NgTableParams({}, { dataset: response.data.data});

             // if($scope.tblPartOrder.length > 0 ){
             //      $scope.numStatusCR = 0;
             //      $scope.tblPartOrder.forEach(function(data){

             //            if(data.partorder_type == 'CR'){
             //                 $scope.numStatusCR++;
             //            }


             //      });

             // }

          },function(response) {
               console.log('TblServicetrans Error');
        });

          // $timeout(function(){
          //   $scope.doShowData();
          // },5000);

    }

    // $scope.doShowList = function(po){

    //   window.location.href = site+"/Part_ctrl/po_sv_manage_list/"+po;

    // }

    // $scope.confirmOrderSV = function(po){

    //     //alert("confirm :"+po);
    //       var request = $http({
    //           method: "post",
    //           url: site+"/part_ctrl/updateStatusPurchaseSV",
    //           data: {
    //                   po_num : po,
    //                   type   : 'confirmSV'
    //           },
    //           headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    //       });
    //       request.then(function (response) {

    //        //success
    //        $scope.doShowData();
 
    //       },function(response) {
    //           console.log(response);
    //           //console.log(response);
    //       });
    // }

    // $scope.rejectOrderSV = function(po){

    //     //alert("reject :"+po);
    //       var request = $http({
    //           method: "post",
    //           url: site+"/part_ctrl/updateStatusPurchaseSV",
    //           data: {
    //                   po_num : po,
    //                   type   : 'rejectSV'
    //           },
    //           headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    //       });
    //       request.then(function (response) {

    //           //success
    //            $scope.doShowData();
 
    //       },function(response) {
    //           console.log(response);
    //           //console.log(response);
    //       });
    // }

       // =================================================================
  }]);

// AppJS.directive('ngConfirmClick', [
//     function(){
//         return {
//             link: function (scope, element, attr) {
//                 var msg = attr.ngConfirmClick || "Are you sure?";
//                 var clickAction = attr.confirmedClick;
//                 element.bind('click',function (event) {
//                     if ( window.confirm(msg) ) {
//                         scope.$eval(clickAction)
//                     }
//                 });
//             }
//         };
// }])

</script>
<!-- /page content -->
<?php $this->load->view('layout/footer.php')?>

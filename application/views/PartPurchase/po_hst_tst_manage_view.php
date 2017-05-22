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
<style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
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

        <h2><i class="fa fa-car"></i>&nbsp;บันทึกการขนส่ง&nbsp;&nbsp;&nbsp;</h2>
   
    <div class="clearfix"></div>
    </div>


    <div class="x_content">
        <div class="row">
        <div class="col-sm-9">   
        <button type="button" class="btn btn-primary" ng-click="openTST()">
                 <span class="glyphicon glyphicon-send" aria-hidden="true" ></span>&nbsp;ส่งของ
        </button> 
        </div>
        <div class="col-sm-3"></div>
       
    </div>
<div class="form-group" align="right">
    <div class="input-group">
      <div class="input-group-addon" style="width:20%">ค้นหาข้อมูล</div>
      <input type="text" ng-model="search" class="form-control" id="exampleInputAmount">
    </div>
  </div>

        <table ng-table="NgtblTST" class="table table-bordered jambo_table">
    

          <tr ng-repeat="data in $data | filter:search">
              <td data-title="'ลำดับ'" sortable="'num'">{{$index +1}}</td>
              <td data-title="'เลขที่ invoice'" sortable="'partorderinvoice_code'">
                {{data.partorderinvoice_code}}
              </td>
              <td data-title="'เลขที่ invoice AX'" sortable="'partorderinvoice_invoice_num'">
                {{data.partorderinvoice_invoice_num}}
              </td>
              <td data-title="'เลขที่ใบสั่งซื้อ'" sortable="'partorder_code'">
                {{data.partorder_code}}
              </td>
              <td data-title="'เลขที่ส่งของ'" sortable="'transport_code'">
                {{data.transport_code}}
              </td>
              <td data-title="'วันที่ออก Invoice'" sortable="'created_date'">
                {{data.created_date}}
              </td>

              <td data-title="'ผู้ออก Invoice'" sortable="'created_by'">
                {{data.created_by}}
              </td>
              <td data-title="'#'" align="center">
                 <button type="button" class="btn btn-primary" ng-click="openModelGetInvoice(data.partorderinvoice_code)">
                 <span class="glyphicon glyphicon-send" aria-hidden="true" ></span>&nbsp;ส่งของ
                 </button> 
              </td>

              
          </tr>
        </table> 




    </div>
    </div>
    </div>
</div>



<!-- ####################===  End Order list ===######################### -->
<!-- Start Template TST Invoice Query -->
<div class="modal-demo">
<script type="text/ng-template" id="InvoiceContent.html">
<div class="modal-header">
          <div class="row">
        <div class="col-sm-6 m-b-xs">
        <h3 class="modal-title" id="modal-title">ใบกำกับภาษี : {{tblInvoiceTemp[0].partorderinvoice_invoice_num}}</h3>
        </div>
        <div class="col-sm-6" align="right">
                                
        </div>
        </div>
</div>
<div class="modal-body" id="modal-body">
<form name="myForm">

<table style="width:100%;" border="0">
  <tbody>
      <tr style="height: 50px;">
          <td class="col-md-1"></td>
            <td class="col-md-2" align="right"><label>เลขที่ Invoice Ax :</label></td>
            <td colspan="2" class="col-md-3">
              <p>{{tblInvoiceTemp[0].partorderinvoice_invoice_num}}</p>
            </td>
            <td class="col-md-1"></td>
      </tr>
      <tr style="height: 50px;">
            <td class="col-md-1"></td>
            <td class="col-md-2" align="right"><label>เลขที่ Invoice :</label></td>
            <td class="col-md-3">
              {{tblInvoiceTemp[0].partorderinvoice_code}}
            </td>
            <td class="col-md-2" align="right"><label>เลขที่ใบสั่งซื้อ :</label></td>
            <td class="col-md-3">
              {{tblInvoiceTemp[0].partorder_code}}
            </td>
            <td class="col-md-1"></td>
      </tr>
      <tr style="height: 50px;">
            <td class="col-md-1"></td>
            <td class="col-md-2" align="right"><label>วันที่ออกเอกสาร :</label></td>
            <td class="col-md-3">
             {{tblInvoiceTemp[0].created_date}}
            </td>
            <td class="col-md-2" align="right"><label>ผู้ออกเอกสาร :</label></td>
            <td class="col-md-3">
             {{tblInvoiceTemp[0].created_by}}
            </td>
            <td class="col-md-1"></td>
      </tr>
                              
 </tbody>
</table>
  
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>อะไหล่</th>
              <th>จำนวนที่ส่ง</th>

            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="item in tblInvoiceTemp">
              <td>{{$index +1}}</td>
              <td>{{item.partmaster_code}}</td>
              <td align="center">{{item.partorderinvoice_ship_qty | number}}</td>
            </tr>
        </tbody>
        </table> 

<table style="width:100%;" border="0">
  <tbody>
      <tr style="height: 50px;">
         
          <td class="col-md-2" align="right"><label>การจัดส่ง **</label></td>
          <td class="col-md-2" >
            <input type="text" class="form-control" style="width:150px" ng-model="tst.Type" name="tstType" class="form-control" required>
          </td>
          <td class="col-md-2" align="right"><label>Track **</label></td>
          <td class="col-md-2" >
          <input type="text" class="form-control" style="width:150px" ng-model="tst.track" name="track" class="form-control" required>
          </td>
          <td class="col-md-2" ></td>
           
          
           
      </tr>
      <tr style="height: 50px;">
            
          <td class="col-md-2" align="right"><label>วันที่จัดส่ง **</label></td>
          <td class="col-md-2" >
                     <div class="input-group">
          <input type="text" class="form-control" uib-datepicker-popup="{{format}}" name="dt" ng-model="dt" is-open="popupDate.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" />
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="openDate()"><i class="glyphicon glyphicon-calendar"></i></button>
          </span>
        </div>
          </td>
          <td class="col-md-2" align="right"></td>
          <td class="col-md-2" ></td>
          <td class="col-md-2" ></td>
          
      </tr>
                              
 </tbody>
</table>

        </form>
        </div> <!-- End Model Body  -->
         <!-- {{$ctrl.items | json}} -->
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="doTst()" ng-disabled="myForm.tstType.$invalid || myForm.track.$invalid || myForm.dt.$invalid">ตกลง</button>
            <button class="btn btn-danger" type="button" ng-click="cancel()">ปิด</button>
        </div>


</script>
</div>
  <!-- End Template TST Invoice Query -->


  <!-- Start Template TST  Query -->
<div class="modal-demo">
<script type="text/ng-template" id="TSTTemplate.html">
<div class="modal-header">
        <h3 class="modal-title" id="modal-title">ทำรายการส่งของ</h3>
</div>
<div class="modal-body" id="modal-body">
       <div class="row">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">เลือกศูนย์บริการ</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option>Choose option</option>
                            <option>Option one</option>
                            <option>Option two</option>
                            <option>Option three</option>
                            <option>Option four</option>
                          </select>
                        </div>
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess3" placeholder="Last Name">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess5" placeholder="Phone">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Default Input">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Disabled Input </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Read-Only Input</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary">Cancel</button>
               <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
                </div>

               
              
</div> <!-- End Model Body  -->
         
<div class="modal-footer">
    <button class="btn btn-primary" type="button" ng-click="" ng-disabled="">ตกลง</button>
    <button class="btn btn-danger" type="button" ng-click="">ปิด</button>
</div>


</script>
</div>
  <!-- End Template TST Query -->



    
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



    $scope.doShowData = function(){

      
        $http.get(site+"/part_ctrl/getListManageTstHST")
        .then(function(response) 
          {
             // $scope.tblPartOrder = response.data.data;
             $scope.NgtblTST = new NgTableParams({}, { dataset: response.data.data});

             // if($scope.tblPartOrder.length > 0 ){
             //      $scope.numStatusCR = 0;
             //      $scope.tblPartOrder.forEach(function(data){

             //            if(data.partorder_type == 'CR'){
             //                 $scope.numStatusCR++;
             //            }


             //      });

             // }

          },function(response) {
               console.log('tblPartOrder Error');
        });

          // $timeout(function(){
          //   $scope.doShowData();
          // },5000);

    }



        $scope.openModelGetInvoice = function (item) {

    // $scope.getInvoiceListDetail(item);

          $http.get(site+"/part_ctrl/getInvoiceListDetail/"+item)
          .then(function(response) 
            {
              
              $scope.tblInvoiceDetail = response.data.data;

              var modalInstance = $uibModal.open({
              animation: $scope.animationsEnabled,
              templateUrl: 'InvoiceContent.html',
              controller: 'InvoiceContentCtrl',
              size: 'lg',
              resolve: {
                items: function () {

                  return $scope.tblInvoiceDetail;
                }
              }
              });

              modalInstance.result.then(function () {
                //alert("OK");
                
                $scope.doShowData();
                // $scope.getDataLn();
                // $scope.getDataInvoice();
              }, function () {
                $scope.doShowData();
                // $scope.getDataLn();
                // $scope.getDataInvoice();
                $log.info('Modal dismissed at: ' + new Date());
              });

            },function(response) {
                 console.log('tblInvoiceDetail Error');
          });


  };


  $scope.openTST = function(){

        var modalInstance = $uibModal.open({
        animation: $scope.animationsEnabled,
        templateUrl: 'TSTTemplate.html',
        controller: 'TSTCtrl',
        size: 'lg',
        resolve: {
          items: function () {

            return $scope.tblInvoiceDetail;
          }
        }
        });

        modalInstance.result.then(function () {
      
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

  }


    





       // =================================================================
  }]);


  //popup
  angular.module('AppJS').controller('InvoiceContentCtrl', function ($scope, $uibModalInstance, items, $http,$filter) {

  $scope.tblInvoiceTemp = items;
  $scope.EditInvoice = false;

  $scope.ok = function () {
    $uibModalInstance.close();
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.doTst = function () {


      var dateTst = $filter('date')($scope.dt, "yyyy-MM-dd");
         // console.log($scope.tblInvoiceTemp[0].partorderinvoice_invoice_num);
         // console.log($scope.tst.Type);
         // console.log($scope.tst.track);
         // console.log(dateTst);
         // console.log(site+"/part_ctrl/prcTSTAxHST");


      var request = $http({
      method: "post",
      url: site+"/part_ctrl/prcTSTAxHST",
      data: {
              invoice : $scope.tblInvoiceTemp[0].partorderinvoice_invoice_num
              ,type   : $scope.tst.Type
              ,track  : $scope.tst.track
              ,date   : dateTst
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
      request.then(function (response) {
      
        $uibModalInstance.close();

      },function(response) {
          console.log(response);
      });



  };

// Date
  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();


  $scope.inlineOptions = {
    customClass: getDayClass,
    minDate: new Date(),
    showWeeks: true
  };

  $scope.dateOptions = {
    // dateDisabled: disabled,
    formatYear: 'yyyy',
    maxDate: new Date(2030, 5, 22),
    // minDate: new Date(),
    startingDay: 1
  };

  // Disable weekend selection
  // function disabled(data) {
  //   var date = data.date,
  //     mode = data.mode;
  //   return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
  // }


 


  $scope.openDate = function() {
    $scope.popupDate.opened = true;
  };

  $scope.setDate = function(year, month, day) {
    $scope.dt = new Date(year, month, day);
  };

  $scope.formats = ['dd-MMMM-yyyy', 'dd-MM-yyyy', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[1];
  $scope.altInputFormats = ['M!/d!/yyyy'];



  $scope.popupDate = {
    opened: false
  };

  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 1);
  $scope.events = [
    {
      date: tomorrow,
      status: 'full'
    },
    {
      date: afterTomorrow,
      status: 'partially'
    }
  ];

  function getDayClass(data) {
    var date = data.date,
      mode = data.mode;
    if (mode === 'day') {
      var dayToCheck = new Date(date).setHours(0,0,0,0);

      for (var i = 0; i < $scope.events.length; i++) {
        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  } 
//
 

}); 


//popup
angular.module('AppJS').controller('TSTCtrl', function ($scope, $uibModalInstance, items, $http,$filter) {


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

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

<link rel="stylesheet" href="https://compact.github.io/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.min.css?v0.10.0">

<!-- page content -->
<div class="se-pre-con"></div>


  



<!-- page content -->
<div class="se-pre-con"></div>
<!-- Loading..... -->
<div class="right_col" role="main" ng-app="AppJS">


  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h1><i class="fa fa-gear"></i>&nbsp;ซื้ออะไหล่</h1>
         
          <div class="clearfix"></div>
        </div>


        <div class="row" ng-controller="StepCtrl">   

        <!-- ####################===  Top ===######################### -->        
          <div class="row" style="display: flex;flex-flow: row wrap;">
            <div class="col-md-4 col-xs-12">
                <div class="x_panel" style="height:100%;">
                  <div class="x_title">
                    <h2><i class="fa fa-search"></i>&nbsp;ค้นหาสินค้า</h2>
                  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
                  <!-- Start Content *************************************-->
                      <div class="radio radio-primary" style="margin-top: 0px;margin-bottom: 0px;">
                        <input type="radio" ng-model="flagSearch" name="custCheck" value="1">
                        <label>ค้นหาจากสินค้า</label>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                                  <select class="form-control" ng-model="itemgroup" ng-change="do_itemgroup(itemgroup.itemgrp_code)"  ng-init="itemgroup=drpdwnItemgroup[0]" ng-options="data as data.itemgrp_desc_th for data in drpdwnItemgroup">
                                     <option value="">- เลือก กลุ่มสินค้า -</option>
                                  </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                                  <select class="form-control" ng-model="subitemgroup" ng-change="do_subitemgroup(subitemgroup.subitemgrp_code)" ng-init="subitemgroup=drpdwnSubitemgroup[0]" ng-options="data as data.subitemgrp_desc for data in drpdwnSubitemgroup">
                                     <option value="">- เลือก ประเภทสินค้า -</option>
                                  </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                                  <select class="form-control" ng-model="item" ng-change="do_item(item.item_code)" ng-init="item=drpdwnItem[0]" ng-options="data as data.item_code for data in drpdwnItem">
                                     <option value="">- เลือก รุ่นสินค้า -</option>
                                  </select>
                        </div>
                      </div>
                      <div class="radio radio-primary" style="margin-top: 0px;margin-bottom: 0px;">
                        <input type="radio" ng-model="flagSearch" name="custCheck" value="2">
                        <label>ค้นหาจากอะไหล่</label>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                            <input type="text" class="form-control" placeholder="อะไหล่" ng-model="partdesc">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" style="height:50px;">
                          <button type="button" class="btn btn-primary" ng-click="doSearch()" style="width:150px;">ค้นหา</button>
                        </div>
                      </div>

                  <!-- End Content  **************************** -->
                  </div>
                </div>
            </div>
            <!-- Picture ********************************** -->
            <div class="col-md-8 col-xs-12">
                <div class="x_panel" style="height:100%;">
                    <div class="x_title">
                    <h2><i class="fa fa-picture-o"></i>&nbsp;รูปภาพคู่มือ</h2>
                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content" ng-show="ImageModel.length >0">
                      <div class="lightBoxGallery" align="center">
                      <div ng-repeat="image in ImageModel" style="margin:5px">
                        <a ng-click="openLightboxModal($index)">
                            <img ng-src="{{image.thumbUrl}}" class="img-thumbnail" width="150px" height="150px">
                        </a>
                      </div>
                             
                      </div>
                    </div>

                </div>
            </div>
            <!-- Picture End********************************** -->
          </div>
          <!-- ####################===  End Top ===######################### --> 
<br>
<!-- ####################===  Order list ===######################### -->
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">
    <div class="x_title">
    <h2><i class="fa fa-credit-card"></i>&nbsp;รายการสั่งซื้ออะไหล่&nbsp;&nbsp;&nbsp;</h2>
  
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table class="table table-bordered jambo_table">
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
        <tbody ng-show="tblPartOrder.length > 0">
            <tr ng-repeat="data in tblPartOrder">
              <td>{{$index +1}}</td>
              <td>{{data.model}}</td>
              <td>{{data.partno}}</td>
              <td>{{data.partename}}</td>
              <td align="center">
                  <button type="button" class="btn-xs btn-danger" ng-click="decrementList(data)">
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                  </button>
                    &nbsp;{{data.partqty}}&nbsp;
                  <button type="button" class="btn-xs btn-success" ng-click="incrementList(data)">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </button>
              </td>
              <td align="right">{{data.partprice | number}}</td>
              <td align="right">{{data.partTotal | number}}</td>
              <td align="center">
                <button type="button" class="btn btn-danger" ng-click="deleteOrder($index)">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete
                </button>
              </td>
            </tr>
            <tr>
              <td colspan="8" align="right"><h3>ยอดรวม : {{getTotaltblPartMaster() | number}} บาท</h3></td>  
            </tr>
            <tr>
              <td colspan="8" align="right">    
              <button type="button" class="btn btn-primary" style="width:150px;"  ng-confirm-click="ยืนยันการสั่งซื้ออะไหล่ ?" confirmed-click="doSubmitOrder()">ตกลง</button>
              </td>  
            </tr>
        </tbody>
        </table> 
        
    </div>
    </div>
    </div>


</div>



<!-- ####################===  End Order list ===######################### -->
<br>
<!-- ####################===  Part list ===######################### -->
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="height:100%;">
    <div class="x_title">
    <h2><i class="fa fa-gear"></i>&nbsp;รายการอะไหล่</h2>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <div class="row">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4 m-b-xs">
            
        </div>
        <div class="col-sm-3">
           <input type="text" placeholder="ค้นหาอะไหล่" ng-model="part_search.num" class="input-sm form-control">                                  
        </div>
    </div>
                            <br>
        <table class="table table-bordered jambo_table">
        <thead align="center">
            <tr>
              <th>ลำดับ</th>
              <th>สินค้า</th>
              <th>อะไหล่</th>
              <th>ชื่ออะไหล่</th>
              <th>ปี</th>
              <th>ราคา</th>
              <th>สถานะ</th>
              <th>#</th>
            </tr>
        </thead>
        <tbody>
        <!-- limitOrderPO = 0 not show this data -->
            <tr ng-repeat="data in tblPartMaster | filter:part_search" ng-show="tblPartMaster.length > 0">
              <td>{{data.num}}</td>
              <td>{{data.model}}</td>
              <td>{{data.partno}}</td>
              <td>{{data.partename}}</td>
              <td>{{data.year}}</td>
              <td align="right">{{data.partprice | number}}</td>
              <td align="center">{{data.checkOnhand}}</td>
              <td align="center"><button type="button" class="btn btn-primary" ng-click="doPurchase(data)">ซื้อ</button></td>
            </tr>
        </tbody>
        </table> 
      

        </div>
      </div>
    </div>
</div>


</div>
<!-- ####################===  End Part list ===######################### -->



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
<script src="https://compact.github.io/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.min.js?v0.12.0"></script>


<script>

var site = '<?=site_url();?>';

  // Animate loader off screen
  $(window).load(function() {$(".se-pre-con").fadeOut("slow");});


  var AppJS = angular.module('AppJS', ['ngAnimate','ngSanitize','ui.bootstrap','bootstrapLightbox']);
  AppJS.controller('StepCtrl', ['$scope','$http','$uibModal', '$log', '$document','Lightbox', function ($scope,$http,$uibModal, $log, $document,Lightbox)
  {
     
      $scope.tblPartOrder = [];
      $scope.ImageModel = {};
      $scope.flagSearch = "1";

      $scope.images = [];

      $scope.openLightboxModal = function (index) {
          Lightbox.openModal($scope.ImageModel, index);
      };

      $scope.getTotaltblPartMaster = function(){

          var total = 0;
          for(var i = 0; i < $scope.tblPartOrder.length; i++){
              var price = $scope.tblPartOrder[i];
              total = total + (price.partTotal*1);
          }
          return total;

      }

     $scope.doSubmitOrder = function(){
          var request = $http({
              method: "post",
              url: site+"/partpurchase_ctrl/addPurchaseSV",
              data: {
                      data: $scope.tblPartOrder
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          });
          request.then(function (response) {

            window.location.href = site+"/partpurchase_ctrl/po_sv_manage";
 
          },function(response) {
              console.log(response);
          });

      }




//-======================== doSearch  ========================

$scope.doSearch = function(){

      //---------- get data  -----------------    
      $http.get("http://www.hitachiservice.in.th/svcenter/index.php/hsc/getPartMaster/"+$scope.item_code)
      .then(function(response) 
        {
           $scope.tblPartMaster = response.data.data;
          
           $scope.tblPartMaster.forEach(function(data){
                 data.num = parseInt(data.num);
                 //select from db hsc 0 คือไม่ใช้ สั่ง
                 data.checkOnhand = "มี"; 
                 data.limitOrderPO = "5"; 

                 if(data.num > 5){
                    data.checkOnhand = "ไม่มี"; 
                    data.limitOrderPO = "10"; 
                 }

    
           });

          //  angular.forEach($scope.tblPartMaster, function(value, key) {
          //    if(value['limitOrderPO'] === "0"){

          //      $scope.tblPartMaster.splice(key, 1);
          //    }
          // });
        },function(response) {
             console.log('tblPartMaster Error');
             console.log(response);
      });

      $http.get(site+"/partpurchase_ctrl/getImageModelSV/"+$scope.item_code)
      .then(function(response) 
        {
           $scope.ImageModel = response.data.data;
        },function(response) {
             console.log('ImageModel Error');
      });

     

    
      //---------- end  get data  ----------------- 


}


$scope.deleteOrder = function ( idx ) {

    $scope.tblPartOrder.splice(idx, 1);

};



//-======================== End doSearch  ====================


$scope.removeUser = function() {
    alert("OK");
}


      //---------- do Click -----------------         
      $scope.doPurchase = function(data) 
      {
          var temp = data.partno;
          var Bcheck = true;
          angular.forEach($scope.tblPartOrder, function(value, key) {
             if(value['partno'] === temp){

              Bcheck = false;
                 console.log("partno :"+value['partno']+" Rpartno :");
             }
          });

          //data.model,data.partno,data.partename,data.partprice,1

              if(Bcheck){

                $scope.tblPartOrder.push({    model: data.model
                                        , partno: data.partno
                                        , partename: data.partename
                                        , partprice: data.partprice
                                        , partqty  : 1
                                        , partTotal  : data.partprice
                                        , limitOrderPO : data.limitOrderPO
                                    }); 
              }else{
                alert("สั่งอะไหล่ซ้ำ");
              }

                
      }
      //---------- End Click ----------------
      

      $scope.incrementList = function(part){
        var qty = 0;
        qty =  part.partqty;
        qty++;
        if(qty <= part.limitOrderPO){

            part.partqty++;
            part.partTotal = part.partqty * part.partprice;

        }else{
          alert('สั่งได้ไม่เกิน '+part.limitOrderPO);
        }
       
 
     

      }

      $scope.decrementList = function(part){
   
        if (part.partqty > 1){
           part.partqty--;
           part.partTotal = part.partqty * part.partprice;
        }
        

      }


      //--------- Dropdown List Item
       
      $http.get(site+"/se_ctrl/getDrpdwnItemgroup/")
      .then(function(response) 
        {
           $scope.drpdwnItemgroup = response.data.data;
        },function(response) {
             console.log('drpdwnItemgroup Error');
      });

      $scope.do_itemgroup = function(itemgrp_code)
      {
        $http.get(site+"/se_ctrl/getDrpdwnSubitemgroup/"+itemgrp_code)
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
        $http.get(site+"/se_ctrl/getDrpdwnItem/"+subitemgrp_code)
        .then(function(response) 
          {
             $scope.drpdwnItem = response.data.data;
          },function(response) {
               console.log('drpdwnItem Error');
        });
        $scope.subitemgrp_code = subitemgrp_code;
      }

      $scope.do_item = function(item_code)
      {
          $scope.item_code = item_code;
          $scope.ImageModel = {};
          $scope.tblPartMaster = [];
      }
      //--------- End Dropdown Item
    

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

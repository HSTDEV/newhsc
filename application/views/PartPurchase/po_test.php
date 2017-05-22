<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/ng-table/bundles/ng-table.min.css">



<div ng-app="myApp">
  <div ng-controller="demoController as demo">
    <h2 class="page-header">Loading data - managed array</h2>
    <div class="bs-callout bs-callout-info">
      <h4>Overview</h4>
      <p>When you have the <em>entire</em> dataset available in-memory you can hand this to <code>NgTableParams</code> to manage the filtering, sorting and paging of that array</p>
    </div>
    <table ng-table="demo.tableParams" class="table table-condensed table-bordered table-striped">
      <tr ng-repeat="row in $data">
        <td data-title="'Name'" filter="{name: 'text'}" sortable="'name'">{{row.name}}</td>
        <td data-title="'Age'" filter="{age: 'number'}" sortable="'age'">{{row.age}}</td>
        <td data-title="'Money'" filter="{money: 'number'}" sortable="'money'">{{row.money}}</td>
      </tr>
    </table>
  </div>
</div>



<script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.2/angular.min.js"></script>
<script src="https://unpkg.com/ng-table/bundles/ng-table.min.js"></script>


<script>



  // var app = angular.module("myApp", ["ngTable", "ngTableDemos"]);

  // app.controller("demoController", demoController);
  // demoController.$inject = ["NgTableParams", "ngTableSimpleList"];

  // function demoController(NgTableParams, simpleList) {
  //   var self = this;
  //   self.tableParams = new NgTableParams({}, {
  //     dataset: simpleList
  //   });
  // }


  // });


  var app = angular.module('myApp', ["ngTable"]);
  app.controller('demoController', ["NgTableParams", function (NgTableParams)
  {


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
    var self = this;
    self.tableParams = new NgTableParams({}, {
      dataset: data
    });


       // =================================================================
  }]);

</script>

@extends('layout.company.masterpage')
@section('title', 'Return Items')
@section('masterpage')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.js"></script>
<script src="https://www.cssscript.com/demo/toast-alert-allert/allert.js"></script>
<link rel="stylesheet" href="https://www.cssscript.com/demo/toast-alert-allert/allert.css">
<style>
    .outputLists {
        padding: 6px;
        display: block;
        cursor: pointer;
        outline: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .outoutList {
        display: block;
        z-index: 99;
        width: 100%;
        position: relative;
        top: 0px;
        margin: -1px 0 0;
        border: 1px solid #eee;
        border-top: 0;
        padding: 0;
        background: #eee;
        -webkit-border-radius: 0 0 5px 5px;
    }
    .outputLists.focus {
        color: white;
        background: #428bca;
    }
    .modal-lg {
        max-width: 52% !important;
    }
    [ng\:cloak], [ng-cloak], [data-ng-cloak] {
        /*display: none !important;*/
        visibility: hidden
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9" ng-app="myApp" ng-controller="personCtrl" ng-init="onInit()">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Return Item</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Return Item</a>
                    </div>
                </div>
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="new-customer-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-md-10">
                                                 <label for="">Invoice ID</label> 
                                                <input type="text" id="invoiceNo" value="{{$record->sales_no}}" readonly>
                                                 <label for="">Customer Name</label>
                                                <input type="text" value="{{$record->cus_name}}" readonly>
                                                <label for="">Customer Mobile</label>
                                                <input type="text" value="{{$record->cus_mobile}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for=""></label>

                                            </div>
                                            <div class="col-md-4">
                                                <form action="{{route('sl-invoice')}}" method="post" class="mb-3"> @csrf
                                                    <input type="hidden" name="invoice_id" value="{{$record->sales_no}}">
                                                    <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button">
                                                        <i class="fa fa-file"></i> Invoice</button>
                                                </form>
                                                <label for="">Date</label>
                                                <input type="text" value="{{$record->date}}" readonly>
                                                 <label for="">Saled By</label>
                                                <input type="text" value="{{$record->seller}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="invoice_id" ng-model="finalStudents.invoice_id" ng-value="{{$invoice_id}}">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <th align="center">Item Information</th><th align="center">Rate</th>
                                    <th align="center">Quantity</th><th align="center">Total</th>
                                    <th align="center">Action</th>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="student in Students">
                                        <td>
                                            <input type="text" class="form-control" ng-change="complete(student)" ng-model="student.search"
                                                   ng-keydown="handleKeyDown($event, student)"/>

                                            <ul class="outoutList" tabindex="0" ng-show="student.isShow" ng-keydown="handleKeyDown($event, student)">
                                                <li class="outputLists" ng-repeat="search in filterData" data-item="true" data-index="0"
                                                    ng-click="fillTextBox(search,student)" ng-class="{'focus': focusedIndex == $index}"
                                                    ng-mouseover="$parent.focusedIndex = $index" ng-cloak>
                                                    @{{search}}
                                                </li>
                                            </ul>
                                        </td>
                                        <td><input type="text" class="form-control" ng-model="student.sale_rate" readonly></td>
                                        <td><input type="text" class="form-control quantity" ng-model="student.new_qty" ng-keyup="total(student)"></td>
                                        <td><input type="text" class="form-control" ng-model="student.total" readonly></td>
                                        <td><input type="button" class="btn btn-danger btn-sm" value="Delete" ng-click="deleteRow(student)"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="align-middle">
                                            <button class="sales-button align-middle new-sales-font-size"
                                                    ng-click="addNewRow()">Add Item</button>
                                        </td>
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="col-md-4">
                                            <small>Grand Total</small>
                                            <input type="text" class="form-control" value="{{$record->grand_total}}" readonly>
                                                </div>
                                            <div class="col-md-4">
                                                <small>Paid</small>
                                                <input type="text" class="form-control" value="{{$record->paid}}" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <small>Due</small>
                                                <input type="text" class="form-control" value="{{$record->remaining}}" readonly>
                                            </div>
                                            </div>
                                        </td>
                                        <td align="center" class="align-middle new-sales-table">
                                            <small>Total Returned Amount</small>
                                            <input type="text" name="grand_total" ng-model="grand_total"  class="form-control" readonly>
                                        </td>
                                        <td align="center" class="align-middle">
                                            <button type="button"  id="clicks" name="clicks" class="sales-button align-middle red-button green-button new-sales-font-size mb-2"
                                                    data-toggle="modal" data-target="#alert">Submit
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br /><br /><br /><br /><br /><br />
        </div>
    </div>
    <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-minus margin-right-css"></i>Return Confirmation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if($ads1->status == 'on')
                    <div class="col-md-12" id="Ads">
                        {!! html_entity_decode($ads1->code)!!}
                    </div>
                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                    @endif
                    <div class="product-add-form">
                        <h6> Are you sure you want to return item? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" ng-click="saveStudents()" class="btn btn-success" data-dismiss="modal">Return</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--printed section-->
    @include('custom_plugin.invoice_print')
</div>
<script type="text/javascript">
    var myModule = angular.module('myApp',[]);
    myModule.controller('personCtrl', function($scope, $http) {
        $scope.Students = []; $scope.Students1 = [];
        $scope.finalStudents = { "invoice_id":$('#invoiceNo').val(), "Data":[] };
        $scope.showInfo = false; $scope.focusedIndex = 0; $scope.generateRow = 0;

        $scope.onInit = function(){
            console.log($scope.finalStudents.invoice_id);
            $http.get("returnData/"+$scope.finalStudents.invoice_id)
                .then(function(response) {
                    var temporary = jQuery.parseJSON(JSON.stringify(response.data));
                    $scope.Try = temporary.products;  $scope.suggestions = temporary.customer;
                });
            $scope.addNewRow();
        };

        $scope.addNewRow = function() {
            var tempSearch = ""; var newObject = null;
                newObject = {row: $scope.generateRow++, new_qty: 1, sale_rate:0};
            $scope.Students.push(newObject);
            if($scope.grand_total === undefined) $scope.grand_total = 0;
            $scope.total(newObject);
            Object.keys($scope.Students).forEach(function(key) {
                if($scope.Students[key].row === newObject.row) { $scope.fillTextBox(tempSearch, newObject); } });
        };
        $scope.deleteRow = function(obj) {
            for(j=0; j < $scope.Students.length; j++) {
                if($scope.Students[j].row === obj.row) $scope.Students.splice(j,1);
            }

            for(j=0; j < $scope.Students1.length; j++) {
                if($scope.Students1[j].search === obj.search) $scope.Students1.splice(j,1);
            }
            $scope.grandTotal();
        };
        $scope.complete = function(obj){
            var temp = []; var ProductSearchSubString = obj.search.toLowerCase().substring(0,obj.search.length);
            angular.forEach($scope.Try, function(sugg){
                    var ProductSubString = sugg.item.toLowerCase().substring(0,obj.search.length);
                    if(ProductSubString === ProductSearchSubString) {
                    temp.push(sugg.item+'('+sugg.batch_number+')');
                    for(i=0; i < $scope.Students.length; i++) {
                        if($scope.Students[i].row === obj.row && (obj.search === "" || obj.search === null || obj.search === undefined ))
                            $scope.Students[i].isShow = false;
                        else if($scope.Students[i].row === obj.row && (obj.search !== "" && obj.search !== null && obj.search !== undefined ))
                            $scope.Students[i].isShow = true;
                    }
                }
                if(obj.search.toLowerCase() === null || obj.search.toLowerCase() === "" || obj.search.toLowerCase() === undefined)
                {
                    for(mmm1 = 0; mmm1<$scope.Students1.length; mmm1++) {
                        if($scope.Students1[mmm1].row === obj.row )
                        {
                            $scope.Students1[mmm1].sale_rate = 0; $scope.Students1[mmm1].new_qty = 1; $scope.total(obj);
                        }
                    }
                }
            });
            $scope.filterData = temp; $scope.focusedIndex = 0;
        };
        $scope.fillTextBox = function(str,obj){
            obj.search = str;
            for( k=0; k < $scope.Try.length; k++) {
                var tempString = str; var res = tempString.split("("); var res1 = res[1].split(")");
                if($scope.Try[k].item === res[0] && $scope.Try[k].batch_number === res1[0])
                {
                    obj.item = $scope.Try[k].item; obj.id = $scope.Try[k].id; obj.item_id = $scope.Try[k].item_id;
                    obj.sale_rate = $scope.Try[k].sale_rate; obj.qty = $scope.Try[k].qty; obj.search = str;
                }
            }
            for(p=0; p < $scope.Students.length; p++) {
                if($scope.Students[p].row === obj.row) $scope.Students[p].isShow = false;
            }
            var flag = false;
            for(p11=0; p11 < $scope.Students1.length; p11++) {
                if($scope.Students1[p11].row === obj.row) {
                    $scope.Students1[p11].isShow = false; flag = true;
                }
            }
            if(!flag)
                $scope.Students1.push(obj);
                $scope.total(obj);
        };
        $scope.saveStudents = function() {
            if($scope.Students.length === 0 || $scope.Students.length == undefined){
                allert('No product was added !', { icon: "fa fa-times", type: "danger", 'duration': '1000'}); return;
            }
            for( n=0; n < $scope.Students.length; n++) {
                delete $scope.Students[n].isShow; delete $scope.Students[n].row;
                delete $scope.Students[n].search; delete $scope.Students[n].$$hashKey;
                $scope.finalStudents.Data.push($scope.Students[n]);
            }
            var header =  {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
            $scope.finalStudents.grand_total = $scope.grand_total;
            $http.post('return_add', JSON.stringify($scope.finalStudents), header).then(function (response) {
                allert('Item Returned Successfully', { icon: "fa fa-check", type: "info", 'duration': '3000', });
                location.reload();
            }, function (response) {

            });
            $scope.Students = []; $scope.Students1 = [];
        };
        $scope.check = function(){
            document.getElementById('name').innerHTML = $scope.finalStudents.cus_name;
            document.getElementById('mobile').innerHTML = $scope.finalStudents.cus_mobile;
            document.getElementById('total_discount').innerHTML = $scope.total_discount;
            document.getElementById('service').innerHTML = $scope.finalStudents.service;
            document.getElementById('vat').innerHTML = $scope.finalStudents.vat;
            document.getElementById('grand_total').innerHTML = $scope.grand_total;
            document.getElementById('due').innerHTML = $scope.due; document.getElementById('paid').innerHTML = $scope.paid;

            for( q=0; q < $scope.finalStudents.Data.length; q++) {
                console.log($scope.finalStudents.Data);
                document.getElementsByClassName('item_data')[q].innerHTML = $scope.finalStudents.Data[q]['product_name'];
                document.getElementsByClassName('cat_data')[q].innerHTML = $scope.finalStudents.Data[q]['product_category'];
                document.getElementsByClassName('rate_data')[q].innerHTML = $scope.finalStudents.Data[q]['selling_rate'];
                document.getElementsByClassName('qty_data')[q].innerHTML = $scope.finalStudents.Data[q]['new_qty'];
                document.getElementsByClassName('total_data')[q].innerHTML = $scope.finalStudents.Data[q]['total'];
                document.getElementsByClassName('sl')[q].innerHTML = q+1;
            }
            document.getElementById('row_length').innerHTML = $scope.finalStudents.Data.length;
        }

        $scope.total = function(obj){
           difference =  parseFloat(obj.qty) - parseFloat(obj.new_qty);
            if(difference < 0){ var m = 'Insufficient Quantity'; }
            else { var m = parseFloat(obj.sale_rate) * parseFloat(obj.new_qty); }
            obj.total = m; $scope.grandTotal();
        };

        $scope.grandTotal = function(){
            var temporary = 0;
            for(mmm = 0; mmm<$scope.Students1.length; mmm++) {
                temporary = temporary + $scope.Students1[mmm].total;
            }
            if(temporary === 0 || temporary < 0){ $('#clicks').attr('disabled', 'disabled'); }
            else if(isNaN(temporary)) { $('#clicks').attr('disabled', 'disabled'); }
            else{ $('#clicks').attr('disabled', false); $scope.grand_total = temporary; }
        };
        $scope.handleKeyDown = function($event,obj) {
            var keyCode = $event.keyCode;
            if (keyCode === 40) { $event.preventDefault();
                if ($scope.focusedIndex !== $scope.filterData.length - 1) { $scope.focusedIndex++; }
            }
            else if (keyCode === 38) { $event.preventDefault();
                if ($scope.focusedIndex !== 0) { $scope.focusedIndex--; }
            }
            else if (keyCode === 13 && $scope.focusedIndex >= 0) {
                $event.preventDefault(); $scope.fillTextBox($scope.filterData[$scope.focusedIndex], obj);
            }
        };
    });
</script>
@include('custom_plugin.js_files')
<style>
    @media print {  .example-print { overflow: hidden; }  }
</style>
<script>
    function printForm(divName) {
        var printContents = document.getElementById(divName).innerHTML; var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents; window.print(); document.body.innerHTML = originalContents;
    }
</script>
@endsection

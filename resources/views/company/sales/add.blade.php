@extends('layout.company.masterpage')
@section('title', 'New Sales')
@section('masterpage')
@if(in_array('sales', explode(",", Session::get('loggedUser')['role']  )))
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.js"></script>
<script src="https://www.cssscript.com/demo/toast-alert-allert/allert.js"></script>
<link rel="stylesheet" href="https://www.cssscript.com/demo/toast-alert-allert/allert.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
        visibility: hidden
    }
</style>


<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9" ng-app="myApp" ng-controller="personCtrl" ng-init="onInit()">
    <div class="row dashboard-right-content star-stuff-content-right">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>New Sales</h2><a href="#">Dashboard</a><a href="#">New Sales</a>
                    </div>
                </div>
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg star-stuff-table-bg">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="new-customer-area">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <!--
                                            <div class="col-md-4">
                                                <label class="jupiter-test" for="">Customer Name</label>
                                                <div ng-show="showInfo" ng-cloak>
                                                    <label for="">Mobile</label><label for="">Email</label><label for="">Address</label>
                                                </div>
                                                <label for="">Date </label>
                                            </div>
                                            -->
                                            
                                            <div class="col-md-8 star-stuff-col-md">
                                                  <label class="jupiter-test" for="">Customer Name</label>
                                                <input type="text" ng-change="complete1(finalStudents.cus_name)" ng-model="finalStudents.cus_name" placeholder="select name"
                                                       ng-keydown="handleKeyDown1($event)"/>

                                                <ul class="outoutList" tabindex="0" ng-show="isShow1" ng-keydown="handleKeyDown1($event)">
                                                    <li ng-repeat="item in filterData1" data-item="true" data-index="0" class="outputLists"
                                                        ng-click="fillTextBox1(item)" ng-class="{'focus': focusedIndex1 == $index}"
                                                        ng-mouseover="$parent.focusedIndex1 = $index" ng-cloak>
                                                        @{{item}}
                                                    </li>
                                                </ul>
                                                <div ng-show="showInfo" ng-cloak>
                                                     <label for="">Mobile</label>
                                                    <input type="text" name="cus_mobile" ng-model="finalStudents.cus_mobile" placeholder="Mobile">
                                                    <label for="">Email</label>
                                                    <input type="text" name="cus_email" ng-model="finalStudents.cus_email" placeholder="Email">
                                                    <label for="">Address</label>
                                                    <input type="text" name="cus_address" ng-model="finalStudents.cus_address" placeholder="Address">
                                                </div>
                                                <label for="">Date </label>
                                                <input type="text" name="date" value="{{$date}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 star-stuff-col-md">
                                        <button type="button" class="btn btn-success" ng-click="buttonClick()">New Customer</button>
                                        <button type="button" class="old-customer-button">Old Customer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 star-stuff-col-md">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered star-stuff-desktop-responsive-table">
                                    
                                    <thead>
                                    <th align="center">Item Information</th><th align="center">Category</th><th align="center">Batch No.</th>
                                    <th align="center">Available Qty</th><th align="center">Unit</th><th align="center">Rate</th>
                                    <th align="center">Quantity</th><th align="center">Discount</th><th align="center">Total</th>
                                    <th align="center">Action</th>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="student in Students">
                                        <td>
                                            <input type="text" ng-change="complete(student)" ng-model="student.search"
                                                   ng-keydown="handleKeyDown($event, student)"/>

                                            <ul class="outoutList" tabindex="0" ng-show="student.isShow" ng-keydown="handleKeyDown($event, student)">
                                                <li class="outputLists" ng-repeat="search in filterData" data-item="true" data-index="0"
                                                    ng-click="fillTextBox(search,student)" ng-class="{'focus': focusedIndex == $index}"
                                                    ng-mouseover="$parent.focusedIndex = $index" ng-cloak>
                                                    @{{search}}
                                                </li>
                                            </ul>
                                        </td>
                                        <td><input type="text" class="form-control" ng-model="student.product_category" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.batch" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.qty" readonly></td>
                                        <input type="hidden" class="form-control" ng-model="student.total_qty" readonly>
                                        <td><input type="text" class="form-control" ng-model="student.unit" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.selling_rate" readonly></td>
                                        <td><input type="text" id="data2" class="form-control" ng-model="student.new_qty" ng-keyup="total(student)"></td>
                                        <td><input type="text" class="form-control" placeholder="0.00" ng-model="student.discount" ng-change="total(student)"></td>
                                        <td><input type="text" class="form-control" ng-model="student.total" readonly></td>
                                        <td><input type="button" class="btn btn-danger btn-sm" value="Delete" ng-click="deleteRow(student)"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="align-middle">
                                            <button class="sales-button align-middle new-sales-font-size"
                                                    ng-click="addNewRow()">Add New Sales</button>
                                        </td>
                                        <td colspan="8" align="center" class="align-middle new-sales-table">
                                            <div class="new-sales-d-inline">
                                                <div>Total Discount</div>
                                                <input type="text" placeholder="0.00" name="total_discount" ng-model="total_discount"
                                                       class="form-control" ng-keyup="applyDiscount()">
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>{{$cms->vat_type}}</div>
                                                <input type="text" name="vat" ng-model="finalStudents.vat" class="form-control" readonly>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>{{$cms->service_type}}</div>
                                                <input type="text" name="service_charge" ng-model="finalStudents.service" class="form-control" readonly>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Grand Total</div>
                                                <input type="text" name="grand_total" ng-model="grand_total"  class="form-control" readonly>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Due Amount</div>
                                                <input type="text" name="remaining" placeholder="0.00" ng-model="due" class="form-control" readonly>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Paid Amount</div>
                                                <input type="text" name="paid" placeholder="0.00" ng-model="paid" ng-keyup="fillDueAmmount(paid)" class="form-control">
                                            </div>
                                        </td>
                                        <td align="center" class="align-middle">
                                            <button type="button"  id="clicks" class="sales-button align-middle red-button green-button new-sales-font-size mb-2"
                                                    data-toggle="modal" data-target="#alert">Submit
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                                
     <!-- START ==========================================  Mobile Responsive Table -> 575px width  START====================================================== START -->
     
     
            
                                     
                                <table class="table table-bordered star-stuff-mobile-responsive-table">
                                    
                                    <thead>
                                    <th align="center">Item Information</th>
                                    <!--
                                        <th align="center">Category</th>
                                        <th align="center">Batch No.</th>
                                        <th align="center">Available Qty</th>
                                        <th align="center">Unit</th>
                                        <th align="center">Rate</th>
                                    -->
                                    <th align="center">Quantity</th>
                                    <!--<th align="center">Discount</th>-->
                                    <th align="center">Total</th>
                                    <th align="center">Action</th>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="student in Students">
                                        <td>
                                            <input style="width: 100px;" type="text" ng-change="complete(student)" ng-model="student.search"
                                                   ng-keydown="handleKeyDown($event, student)"/> <div style="height:5px; width:100%;"></div>
                                            

                                            <ul class="outoutList" tabindex="0" ng-show="student.isShow" ng-keydown="handleKeyDown($event, student)">
                                                <li class="outputLists" ng-repeat="search in filterData" data-item="true" data-index="0"
                                                    ng-click="fillTextBox(search,student)" ng-class="{'focus': focusedIndex == $index}"
                                                    ng-mouseover="$parent.focusedIndex = $index" ng-cloak>
                                                    @{{search}}
                                                </li>
                                               
                                            </ul>
                                        </td>
                                        
                                    <!--    
                                        <td><input type="text" class="form-control" ng-model="student.product_category" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.batch" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.qty" readonly></td>
                                        <input type="hidden" class="form-control" ng-model="student.total_qty" readonly>
                                        <td><input type="text" class="form-control" ng-model="student.unit" readonly></td>
                                        <td><input type="text" class="form-control" ng-model="student.selling_rate" readonly></td>
                                    -->
                                        <td><input  type="text" id="data2" class="form-control star-td-width" ng-model="student.new_qty" ng-keyup="total(student)"></td>
                                        <!--<td><input type="text" class="form-control" placeholder="0.00" ng-model="student.discount" ng-change="total(student)"></td>-->
                                        <td><input type="text" class="form-control star-td-width" ng-model="student.total" readonly></td>
                                        <td>
                                            <input style="font-weight: bold;"  type="button" class="btn btn-danger btn-sm" value="&ndash;" ng-click="deleteRow(student)">
                                            
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="align-middle" >
                                            <button class="sales-button align-middle new-sales-font-size star-stuff-btn-table"
                                                    ng-click="addNewRow()">Add New Sales</button>
                                                    
                                            
                                        </td>
                                        <td colspan="8" align="center" class="align-middle new-sales-table">
                                            <div class="new-sales-d-inline">
                                                <div>Total Discount: 
                                                <input type="text" placeholder="0.00" name="total_discount" ng-model="total_discount"
                                                       class="form-control" ng-keyup="applyDiscount()"> </div>
                                            </div>
                                            <div class="new-sales-d-inline" style="">
                                                <div>{{$cms->vat_type}}: 
                                                <input type="text" name="vat" ng-model="finalStudents.vat" class="form-control" readonly></div>
                                            </div>
                                            <div class="new-sales-d-inline" style="">
                                                <div>{{$cms->service_type}}
                                                <input type="text" name="service_charge" ng-model="finalStudents.service" class="form-control" readonly></div>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Grand Total: 
                                                <input type="text" name="grand_total" ng-model="grand_total"  class="form-control" readonly></div>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Due Amount: 
                                                <input type="text" name="remaining" placeholder="0.00" ng-model="due" class="form-control" readonly></div>
                                            </div>
                                            <div class="new-sales-d-inline">
                                                <div>Paid Amount: 
                                                <input type="text" name="paid" placeholder="0.00" ng-model="paid" ng-keyup="fillDueAmmount(paid)" class="form-control"></div>
                                            </div>                                            <div class="new-sales-d-inline">
                                                <div>
                                                    <button type="button"  id="clicks" class="sales-button align-middle red-button green-button new-sales-font-size mb-2 star-stuff-submit-btn"
                                                    data-toggle="modal" data-target="#alert">Submit Now
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                
    
     
     <!-- END ==========================================  Mobile Responsive Table -> 575px width  END  ======================================================END -->
                               
        
                       
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br /><br /><br /><br /><br /><br />
        </div>
    </div>
    
    
    
    

   <!-- barcode part-->
    <div data-barcode-scanner="barcodeScanned"></div>

    <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  star-stuff-modal-dialogue-full-screen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-invoice margin-right-css"></i>Invoice Print & PDF </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="product-add-form">
                        @if($ads1->status == 'on')
                        <div class="col-md-12" id="Ads">
                            {!! html_entity_decode($ads1->code)!!}
                        </div>
                        <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div>Grand Total</div><input type="text" ng-model="grand_total"  class="form-control mb-2" readonly>
                        </div>
                        <div class="col-md-4">
                            <div>Due Amount</div><input type="text" ng-model="due"  class="form-control mb-2" readonly>
                        </div>
                        <div class="col-md-4">
                            <div>Paid Amount</div><input type="text" ng-model="paid"  class="form-control mb-2" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="SubmitInfo" ng-click="saveStudents(1)" class="btn btn-success mb-2" data-dismiss="modal">
                            <i class="fa fa-print"></i> Print & Submit</button> &nbsp;
                        <button type="submit" ng-click="saveStudents(0)" class="btn btn-success mb-2" data-dismiss="modal">
                            <i class="fa fa-clipboard-check"></i> Submit</button> &nbsp;
                        <button type="button" class="btn btn-danger mb-2" data-dismiss="modal" style="color: #fff;">Cancel</button>
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

        var date = new Date();
        $scope.FromDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();
        $scope.Students = []; $scope.Students1 = [];
        $scope.finalStudents = {
            "cus_name":"", "cus_mobile":"", "cus_email":"", "cus_address":"", "cus_date":$scope.FromDate,
            'due':'', 'paid':'','total_discount':'', "grand_total":0, "Data":[]
        };

        $scope.showInfo = false; $scope.focusedIndex = 0; $scope.generateRow = 0; $scope.ProductsLength= 0;
        $scope.onInit = function(){
            $http.get("getData")
                .then(function(response) {
                    var temporary = jQuery.parseJSON(JSON.stringify(response.data));
                    $scope.Try = temporary.products;
                    $scope.suggestions = temporary.customer;
                    $scope.finalStudents.vat = temporary.vat.vat_amount; $scope.finalStudents.service = temporary.vat.service_amount;
                    $scope.finalStudents.flag = temporary.vat.flag;
                    $scope.finalStudents.service_flag = temporary.vat.service_flag;
                    $scope.finalStudents.discount_flag = temporary.vat.discount_flag;
                });
            $scope.addNewRow();
        };

        $scope.addNewRow = function(_barcode) {
            var tempSearch = "";
            var discount1 = '';
            if($scope.total_discount > 0) discount1  = $scope.total_discount;
            ///Setting initial value zero in following fields
            if($scope.finalStudents.vat === undefined || $scope.finalStudents.vat === null || $scope.finalStudents.vat === "") $scope.finalStudents.vat = 0;
            if($scope.finalStudents.service === undefined || $scope.finalStudents.service === null || $scope.finalStudents.service === "") $scope.finalStudents.service = 0;
            if($scope.paid === undefined || $scope.paid === null || $scope.paid === "") $scope.paid = '';
            if($scope.due === undefined || $scope.due === null || $scope.due === "") $scope.due = '';
            if($scope.total_discount === undefined || $scope.total_discount === null || $scope.total_discount === "") $scope.total_discount = '';

            var newObject = null;
            if(_barcode !== null || _barcode !=="" || _barcode !== undefined)
            {
                angular.forEach($scope.Try, function(sugg){
                    // console.log(sugg + " " + _barcode);
                    if(sugg.barcode.toLowerCase().indexOf(_barcode) >= 0)
                    {
                        tempSearch =sugg.product_name+'('+sugg.batch+')';
                    }
                });
                newObject = {row: $scope.generateRow++, new_qty: 1, discount: discount1, selling_rate:0};
            }
            else
            {
                newObject = {row: $scope.generateRow++, new_qty: 1, discount: discount1, selling_rate:0};
            }

            $scope.Students.push(newObject);
            if($scope.grand_total === undefined) $scope.grand_total = 0;
            $scope.total(newObject);

            Object.keys($scope.Students).forEach(function(key) {
                if($scope.Students[key].row === newObject.row)
                {
                    $scope.fillTextBox(tempSearch, newObject);
                }
            });
            $scope.ProductsLength++;
        };


        $scope.deleteRow = function(obj) {
            for(j=0; j < $scope.Students.length; j++) {
                if($scope.Students[j].row === obj.row)
                    $scope.Students.splice(j,1);
            }

            // console.log("-------------");
            // console.log($scope.Students1);

            for(j=0; j < $scope.Students1.length; j++) {
                if($scope.Students1[j].search === obj.search)
                    $scope.Students1.splice(j,1);
            }
            $scope.grandTotal();
            $scope.fillDueAmmount(0);
            // console.log($scope.Students1);
            // console.log("-------------");
        };

        $scope.complete = function(obj){
            var temp = [];
            var ProductSearchSubString = obj.search.toLowerCase().substring(0,obj.search.length);
            angular.forEach($scope.Try, function(sugg){
                var ProductSubString = sugg.product_name.toLowerCase().substring(0,obj.search.length);
                if(ProductSubString === ProductSearchSubString)
                {
                    temp.push(sugg.product_name+'('+sugg.batch+')');
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
                            $scope.Students1[mmm1].selling_rate = 0;
                            $scope.Students1[mmm1].new_qty = 1;
                            $scope.Students1[mmm1].product_category = "";
                            $scope.Students1[mmm1].batch = "";
                            $scope.Students1[mmm1].qty = 1;
                            $scope.Students1[mmm1].unit = "";
                            $scope.total(obj);
                        }
                    }
                }
            });
            $scope.filterData = temp;
            $scope.focusedIndex = 0;
        };

        $scope.fillTextBox = function(str,obj){
            obj.search = str;

            for( k=0; k < $scope.Try.length; k++) {
                var tempString = str;
                var res = tempString.split("(");
                var res1 = res[1].split(")");
                if($scope.Try[k].product_name === res[0] && $scope.Try[k].batch === res1[0])
                {
                    obj.product_name = $scope.Try[k].product_name;
                    obj.id = $scope.Try[k].id;
                    obj.product_category = $scope.Try[k].product_category;
                    obj.batch = $scope.Try[k].batch;
                    obj.avqty = $scope.Try[k].avqty;
                    obj.unit = $scope.Try[k].unit;
                    obj.qty = $scope.Try[k].qty;
                    obj.total_qty = $scope.Try[k].total_qty;
                    obj.purchase_rate = $scope.Try[k].purchase_rate;
                    obj.selling_rate = $scope.Try[k].selling_rate;
                    obj.search = str;
                }
            }

            for(p=0; p < $scope.Students.length; p++) {
                if($scope.Students[p].row === obj.row)
                    $scope.Students[p].isShow = false;
            }

            var flag = false;
            for(p11=0; p11 < $scope.Students1.length; p11++) {
                if($scope.Students1[p11].row === obj.row)
                {
                    $scope.Students1[p11].isShow = false;
                    flag = true;
                }
            }
            if(!flag)
                $scope.Students1.push(obj);

            $scope.total(obj);
        };

        $scope.saveStudents = function(e) {

            if($scope.Students.length === 0 || $scope.Students.length == undefined){
                allert('No product was added !', { icon: "fa fa-times", type: "danger", 'duration': '1000'}); return;
            }

            for( n=0; n < $scope.Students.length; n++) {
                delete $scope.Students[n].isShow;
                delete $scope.Students[n].row;
                delete $scope.Students[n].search;
                delete $scope.Students[n].$$hashKey;

                $scope.finalStudents.Data.push($scope.Students[n]);
            }
            var header =  { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
            $scope.finalStudents.sub_total = $scope.sub_total;
            $scope.finalStudents.grand_total = $scope.grand_total;
            $scope.finalStudents.due = $scope.due;
            $scope.finalStudents.paid = $scope.paid;
            $scope.finalStudents.total_discount = $scope.total_discount;

            $http.post('add', JSON.stringify($scope.finalStudents), header).then(function (response) {

                if(e === 1) { $scope.check(); printForm('printableArea'); }
                allert('New Sales Added Successfully', {
                    icon: "fa fa-check", type: "info", 'duration': '3000',
                });
                location.reload();
            }, function (response) { });
            $scope.Students = []; $scope.Students1 = [];
        };

        $scope.check = function() {
            document.getElementById('name').innerHTML = $scope.finalStudents.cus_name;
            document.getElementById('mobile').innerHTML = $scope.finalStudents.cus_mobile;

            document.getElementById('total_discount').innerHTML = $scope.discountShow;
            document.getElementById('service').innerHTML = $scope.service_rate;
            document.getElementById('vat').innerHTML = $scope.vat_rate;
            document.getElementById('sub_total').innerHTML = $scope.sub_total;
            document.getElementById('grand').innerHTML = $scope.grand_total;
            document.getElementById('grand_total').innerHTML = $scope.grand_total;
            document.getElementById('due').innerHTML = $scope.due;
            document.getElementById('paid').innerHTML = $scope.paid;

            for( q=0; q < $scope.finalStudents.Data.length; q++) {
                document.getElementsByClassName('item_data')[q].innerHTML = $scope.finalStudents.Data[q]['product_name'];
                document.getElementsByClassName('cat_data')[q].innerHTML = $scope.finalStudents.Data[q]['product_category'];
                document.getElementsByClassName('rate_data')[q].innerHTML = $scope.finalStudents.Data[q]['selling_rate'];
                document.getElementsByClassName('qty_data')[q].innerHTML = $scope.finalStudents.Data[q]['new_qty'];
                document.getElementsByClassName('total_data')[q].innerHTML = $scope.finalStudents.Data[q]['total'];
                document.getElementsByClassName('disC')[q].innerHTML = $scope.finalStudents.Data[q]['disC'].toFixed(2);
            }
        };

        $scope.total = function(obj){
            var $divide = $scope.Students.length;
            difference =  parseFloat(obj.qty) - parseFloat(obj.new_qty);
            if(difference < 0){ var m = 'Insufficient'; obj.total = 'Insufficient'; $scope.total_checks = 0;}
            else if(obj.new_qty <= 0 || isNaN(obj.new_qty)) { $scope.total_checks = 0; }
            else {
                $scope.total_checks = 1; var m = parseFloat(obj.selling_rate) * parseFloat(obj.new_qty);

                if($scope.finalStudents.discount_flag === 0) {
                    obj.total = (m - (obj.discount/$divide).toFixed(2));
                    obj.disC = m - obj.total;  console.log(obj.disC); }
                else{ obj.total = m - ((m * obj.discount) / 100); obj.disC = (m * obj.discount) / 100; }
            }
            $scope.grandTotal();
            $scope.fillDueAmmount(0);
        };

        $scope.grandTotal = function(){
            var temporary = 0; var disTemp = 0; var saleTotals = 0;
            for(mmm = 0; mmm<$scope.Students1.length; mmm++) {
                temporary = temporary + $scope.Students1[mmm].total; disTemp = disTemp + $scope.Students1[mmm].disC;
                saleTotals = saleTotals + $scope.Students1[mmm].new_qty * $scope.Students1[mmm].selling_rate;
            }
            if(temporary === 0 || temporary < 0){ $scope.checks = 0; }
            else{
                $scope.checks = 1; $scope.sub_total = temporary.toFixed(2);$scope.discountShow = disTemp.toFixed(2);
                if($scope.finalStudents.flag === 0 && $scope.finalStudents.service_flag === 0){
                    $scope.grand_total = (temporary + parseFloat($scope.finalStudents.vat) + parseFloat($scope.finalStudents.service) ).toFixed(2);
                    $scope.vat_rate = $scope.finalStudents.vat; $scope.service_rate = $scope.finalStudents.service;
                }
                else if($scope.finalStudents.flag !== 0 && $scope.finalStudents.service_flag === 0){
                    $scope.grand_total = (temporary+ (saleTotals *(parseFloat($scope.finalStudents.vat)/100)) + parseFloat($scope.finalStudents.service) ).toFixed(2);
                    $scope.vat_rate = (saleTotals *(parseFloat($scope.finalStudents.vat)/100)).toFixed(2);
                    $scope.service_rate = $scope.finalStudents.service;
                }
                else if($scope.finalStudents.flag === 0 && $scope.finalStudents.service_flag !== 0){
                    $scope.grand_total = (temporary+ parseFloat($scope.finalStudents.vat) + (saleTotals *(parseFloat($scope.finalStudents.service)/100)) ).toFixed(2);
                    $scope.vat_rate = $scope.finalStudents.vat;
                    $scope.service_rate = (saleTotals *(parseFloat($scope.finalStudents.service)/100)).toFixed(2);
                }
                else{
                    $scope.grand_total = (temporary+ (saleTotals *(parseFloat($scope.finalStudents.vat)/100)) + (saleTotals *(parseFloat($scope.finalStudents.service)/100)) ).toFixed(2);
                    $scope.vat_rate = (saleTotals *(parseFloat($scope.finalStudents.vat)/100)).toFixed(2);
                    $scope.service_rate = (saleTotals *(parseFloat($scope.finalStudents.service)/100)).toFixed(2);
                }
            }
        };

        $scope.applyDiscount = function(){
            var $divide1 = $scope.Students.length;
            for(mk = 0; mk<$scope.Students.length; mk++) {
                $scope.Students[mk].discount = $scope.total_discount;
                $scope.total($scope.Students[mk]);
            }
            if($scope.finalStudents.discount_flag === 0) {
                for (ms = 0; ms < $scope.Students1.length; ms++) {
                    $scope.Students1[ms].discount = ($scope.total_discount / $divide1).toFixed(2);
                }
            }
            else {

                for (ms = 0; ms < $scope.Students1.length; ms++) {
                    $scope.Students1[ms].discount = $scope.total_discount;
                }
            }
        };

        $scope.fillDueAmmount = function (paid) {
            $scope.due =  ($scope.grand_total - paid).toFixed(2);
            if($scope.due < 0 || isNaN($scope.due) || isNaN(paid) ||  $scope.grand_total <= 0 || $scope.checks < 1 || $scope.total_checks < 1){
                $('#clicks').attr('disabled', 'disabled');}
            else{ $('#clicks').attr('disabled', false); }
        };

        $scope.handleKeyDown = function($event,obj) {
            var keyCode = $event.keyCode;
            if (keyCode === 40) {
                $event.preventDefault();
                if ($scope.focusedIndex !== $scope.filterData.length - 1) { $scope.focusedIndex++; }
            }
            else if (keyCode === 38) {
                // Up
                $event.preventDefault();
                if ($scope.focusedIndex !== 0) { $scope.focusedIndex--; }
            }
            else if (keyCode === 13 && $scope.focusedIndex >= 0) {
                // Enter
                $event.preventDefault();
                //$scope.selected($scope.list[$scope.focusedIndex].value);
                $scope.fillTextBox($scope.filterData[$scope.focusedIndex], obj);
                //$scope.item = $scope.list[$scope.focusedIndex].value;
            }
        };
        $scope.barcodeScanned = function(barcode) { $scope.addNewRow(barcode); };

        $scope.buttonClick = function () {  $scope.showInfo = !$scope.showInfo; };

        $scope.focusedIndex1 = 0;

        $scope.complete1 = function(obj){
            if(!$scope.showInfo) {
                var temp1 = []; var isShowFlag = true;
                var searchCustomerSubString = obj.toLowerCase().substring(0, obj.length);
                angular.forEach($scope.suggestions, function(sugg1){
                    var CustomerNameSubString = sugg1.name.toLowerCase().substring(0, obj.length);
                    if(CustomerNameSubString === searchCustomerSubString)
                    {
                        temp1.push(sugg1.name+"("+sugg1.mobile+")");
                    }
                    if(obj.toLowerCase() === null || obj.toLowerCase() === "" || obj.toLowerCase() === undefined)
                    {
                        $scope.finalStudents.cus_mobile = "";
                        $scope.finalStudents.cus_name = "";
                        $scope.finalStudents.cus_address = "";
                        $scope.finalStudents.cus_email = "";
                        $scope.finalStudents.id = "";
                        isShowFlag = false;
                    }
                });
                $scope.filterData1 = temp1; $scope.isShow1 = isShowFlag; $scope.focusedIndex1 = 0;
            }

        };

        $scope.fillTextBox1 = function(str){
            $scope.finalStudents.cus_name = str; $scope.showInfo = true;

            for( k12=0; k12 < $scope.suggestions.length; k12++) {
                var tempString = str; var res = tempString.split("("); var res1 = res[1].split(")");
                if($scope.suggestions[k12].name === res[0] && $scope.suggestions[k12].mobile === res1[0])
                {
                    $scope.finalStudents.cus_email = $scope.suggestions[k12].email;
                    $scope.finalStudents.cus_mobile = $scope.suggestions[k12].mobile;
                    $scope.finalStudents.cus_address = $scope.suggestions[k12].address;
                    $scope.finalStudents.cus_id = $scope.suggestions[k12].id;
                    $scope.finalStudents.cus_name = res[0];
                }
            }
            $scope.isShow1 = false;
        };
        $scope.handleKeyDown1 = function($event) {
            var keyCode1 = $event.keyCode;
            if (keyCode1 === 40) {
                $event.preventDefault();
                if ($scope.focusedIndex1 !== $scope.filterData1.length - 1) { $scope.focusedIndex1++; }
            }
            else if (keyCode1 === 38) {
                $event.preventDefault();
                if ($scope.focusedIndex1 !== 0) { $scope.focusedIndex1--; }
            }
            else if (keyCode1 === 13 && $scope.focusedIndex1 >= 0) { $event.preventDefault();
                $scope.fillTextBox1($scope.filterData1[$scope.focusedIndex1]);
            }
        };
    });

    myModule.directive('barcodeScanner', function() {
        return {
            restrict: 'A',
            scope: { callback: '=barcodeScanner', },
            link:    function postLink($scope, iElement, iAttrs){
                // Settings
                var zeroCode = 48; var nineCode = 57; var enterCode = 13; var minLength = 3; var delay = 300; // ms
                // Variables
                var pressed = false; var chars = []; var enterPressedLast = false;
                // Timing
                var startTime = undefined; var endTime = undefined;
                jQuery(document).keypress(function(e) {
                    if (chars.length === 0) { startTime = new Date().getTime(); }
                    else { endTime = new Date().getTime(); }
                    // Register characters and enter key
                    if (e.which >= zeroCode && e.which <= nineCode) { chars.push(String.fromCharCode(e.which)); }
                    enterPressedLast = (e.which === enterCode);
                    if (pressed == false) {
                        setTimeout(function(){
                            if (chars.length >= minLength && enterPressedLast) {
                                var barcode = chars.join('');
                                if (angular.isFunction($scope.callback)) { $scope.$apply(function() { $scope.callback(barcode); }); }
                            }
                            chars = []; pressed = false;
                        },delay);
                    } pressed = true;
                });
            }
        };
    });
</script>
@include('custom_plugin.js_files')
<style>
    @media print {  .example-print {  overflow: hidden; }  }
</style>
<script>
    function printForm(divName) {
        var printContents = document.getElementById(divName).innerHTML; var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents; window.print(); document.body.innerHTML = originalContents;
    }
</script>

@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

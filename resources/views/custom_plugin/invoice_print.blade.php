<div id="printableArea" style="display: none">
    <div class="row">
        <div class="col-md-9">
            <h1 style="font-size: 70px;"> INVOICE </h1>
        </div>
        <div class="col-md-3">
            <img src="{{asset('public/shop_logo/'.$invoice_info->logo)}}" height="140px;" width="140px;">
        </div>
    </div>
<!--    <div ng-model="number" ng-cloak>-->
<!--        <h1>@{{number}}</h1>-->
<!--    </div>-->
    <div class="row">
        <div class="col-md-6">
            <h5> INVOICE NUMBER  {{$invoice_id}}</h5>
            <h5> DATE OF ISSUE  {{$date}} </h5><br><br>
            <h5> BILLED TO </h5>
            <h5 id="name"></h5>
            <h5 id="mobile"></h5>
        </div>
        <div class="col-md-6" style="margin-top: 100px;">
            <h3>{{$mail->shopname}} </h3>
            <h5>{{$invoice_info->address}}</h5>
            <h5>{{$mail->mobile}}</h5>
            <h5>{{$mail->email}}</h5>
            <h5>{{$invoice_info->website}}</h5>
        </div>
    </div>
    <br><br>
    <table style="width:100%;">
        <tr style="border-bottom: 4px solid #000;">
            <th style="width:35%"><h5>ITEM</h5></th>
            <th style="width:15%"><h5>CATEGORY</h5></th>
            <th style="width:10%"><h5>UNIT COST</h5></th>
            <th style="width:10%"><h5>QUANTITY</h5></th>
            <th style="width:10%"><h5>DISCOUNT</h5></th>
            <th style="width:10%"><h5>AMOUNT</h5></th>
        </tr>

        <tr style="padding: 6px 1px;border-bottom: 2px solid #000;">
            <td><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="item_data"></h4><?php } ?></td>
            <td style=" padding: 6px 1px;"><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="cat_data"></h4><?php } ?></td>
            <td style=" padding: 6px 1px;"><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="rate_data"></h4><?php } ?></td>
            <td style=" padding: 6px 1px;"><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="qty_data"></h4><?php } ?></td>
            <td style=" padding: 6px 1px;"><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="disC"></h4><?php } ?></td>
            <td style=" padding: 6px 1px;"><?php for ($i = 0; $i < 150; $i++) { ?> <h4 class="total_data"></h4><?php } ?></td>
        </tr>
    </table>
    <br>
        <div class="row">
            <div class="col-md-3">
                <h5> INVOICE TOTAL </h5>
                <div class="row">
                    <div class="col-md-4"> <h1 style="color: #1a4993;">{{$invoice_info->currency}}</h1> </div>
                    <div class="col-md-3">  <h1 style="color: #1a4993;" id="grand"></h1> </div>
                </div>
            </div>
            <div class="col-md-9">
                <table style="width:100%;">
                    <tr>
                        <th style="width:30%"></th><th style="width:10%"></th>
                        <th style="width:15%"></th><th style="width:26%;"></th><th style="width:14%"></th>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>SUB TOTAL</h5></td>
                        <td><h5 id="sub_total"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>GRAND TOTAL</h5></td>
                        <td><h5 id="grand_total"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>TOTAL DISCOUNT</h5></td>
                        <td><h5 id="total_discount"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>TAX/VAT</h5></td>
                        <td><h5 id="vat"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>SERVICE CHARGE</h5></td>
                        <td><h5 id="service"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>PAID AMOUNT</h5></td>
                        <td><h5 id="paid"></h5></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><h5>DUE AMOUNT</h5></td>
                        <td><h5 id="due"></h5></td>
                    </tr>
                </table>
            </div>
        </div>
    <br><br><br><br>
    <h5> INVOICE CREATED BY: {{Session::get('loggedUser')['fname']}} {{Session::get('loggedUser')['lname']}}</h5>
    <h5>DATE: {{$date}}</h5><br>

<!--    <footer style="position: absolute;bottom: 0;text-align:right;width: 100%;height: 2.5rem;"><h5>Powered By sozashop.com </h5></footer>-->
</div>

@extends('layout.company.masterpage')
@section('title', 'Add Expense Invoice')
@section('masterpage')
@if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Expense Invoice</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Expense Invoice</a>
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
                    <form action="{{route('a-invoice-add')}}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="add-expense-area mt-3">
                                <div class="row">

                                    <div class="col-md-12">
                                        <label for="">Expense Type<i class="fas fa-star-of-life font-aw-color-red"></i></label> <br>
                                        <select name="expense_type" class="form-control mb-2" required>
                                            <option value="">Select Expense</option>
                                            @foreach($shows as $show)
                                            <option value="{{$show->type}}"> {{$show->type}}</option>
                                            @endforeach
                                        </select>
                                         <label for="">Date<i class="fas fa-star-of-life font-aw-color-red"></i></label><br>
                                        <input type="date" name="date" class="form-control" value="{{$date}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive mt-3">
                                <table class="table table-bordered table-striped table-hover product-page-table-font-size">
                                    <thead>
                                    <tr>
                                        <td>Item Information</td>
                                        <td>Rate</td>
                                        <td>Quantity</td>
                                        <td>Total</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="align-middle">
                                            <input type="text" name="item[]" placeholder="Item Name" class="form-control item">
                                        </td>
                                        <td class="align-middle">
                                            <input type="text" name="selling_rate[]" placeholder="0.00" class="form-control form-width selling_rate">
                                        </td>
                                        <td class="align-middle">
                                            <input type="text" name="qty[]" value="1" class="form-control form-width qty">
                                        </td>
                                        <td class="align-middle">
                                            <input type="text" name="total[]" placeholder="0.00" class="form-control form-width total" readonly>
                                        </td>
                                        <td class="align-middle" align="center">
                                            <a href="#" class="btn btn-danger btn-sm remove">Delete</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="align-middle" align="center">
                                            <button type="button" class="btn btn-success btn-sm addRow">Add New Item</button>
                                        </td>
                                        <td align="center">
                                            <label for="">Grand Total</label>
                                            <input type="text" name="grand_total" placeholder="0.00" class="form-control grand_total" readonly>
                                            <input type="hidden" name="grand" class="form-control grand">
                                        </td>
                                        <td align="center">
                                            <label for="">Paid Amount</label>
                                            <input type="text" name="paid" placeholder="0.00" class="form-control form-width paid">
                                        </td>
                                        <td align="center">
                                            <label for="">Remaining Amount</label>
                                            <input type="text" name="due" placeholder="0.00" class="form-control form-width due" readonly>
                                        </td>

                                        <td class="align-middle" align="center">
                                            <button type="submit" id="clicks" class="btn btn-success btn-sm">Submit</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('tbody').delegate('.selling_rate,.qty', 'keyup', function () {
        var tr = $(this).parent().parent();
        var selling_rate = tr.find('.selling_rate').val();
        var qty = tr.find('.qty').val();
        var total = (qty * selling_rate);
        if(total <= 0 || isNaN(total)){  $('#clicks').attr('disabled', 'disabled'); }
        else {
            $('#clicks').attr('disabled', false);
            tr.find('.total').val(total);
            total_count(0);
        }
    });
    $('.addRow').on('click', function () {
        addRow();
    });
    $('tfoot').delegate('.paid', 'keyup', function () {
        var tr = $(this).parent().parent();
        total_count(tr.find('.paid').val());
    });
    function total_count(value) {
        var amount = 0;
        var paid = value;
        var due;
        $('.total').each(function (i, e) {
            var total = $(this).val() - 0;
            amount += total;
        });
        if (amount <= 0) $('#clicks').attr('disabled', 'disabled');
        else{
            $('.grand_total').val(amount.formatMoney(2, ',', '.') + " /-");
            $('.grand').val(amount);
            due = amount - paid;
        }
        if(due < 0 || isNaN(due)){ $('.due').val('ERROR'); $('#clicks').attr('disabled', 'disabled'); }
        else { $('.due').val(due); $('#clicks').attr('disabled', false); }
    }
    Number.prototype.formatMoney = function (c, d, t, sym) {
        var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0,
            sym = sym == undefined ? "" : sym;
        /* <- add $/any sign here*/
        return sym + s + (j ? i.substr(0, j) + d : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + d) + (c ? t + Math.abs(n - i).toFixed(c).slice(2) : "");
    };
    function addRow() {
        var tr =
            '<tr>' +
            '<td><input type="text" name="item[]" class="form-control item"></td>' +
            '<td><input type="text" name="selling_rate[]" class="form-control selling_rate" placeholder="0.00"></td>' +
            '<td><input type="text" name="qty[]" value="1" class="form-control qty"></td>' +
            '<td><input type="text" name="total[]" class="form-control total"></td>' +
            '<td class="align-middle" align="center"><a href="#" class="btn btn-danger btn-sm remove">Delete</a></td>' +
            '</tr>';
        $('tbody').append(tr);
        $('.remove').on('click', function () {
            $(this).parent().parent().remove();
            total_count(0);
        });
        $('tbody').delegate('.selling_rate,.qty', 'keyup', function () {
            var tr = $(this).parent().parent();
            var selling_rate = tr.find('.selling_rate').val();
            var qty = tr.find('.qty').val();
            var total = (qty * selling_rate);

            if(total <= 0 || isNaN(total)){ $('#clicks').attr('disabled', 'disabled'); }
            else {
                $('#clicks').attr('disabled', false);
                tr.find('.total').val(total);
                total_count(0);
            }
        });
    }

    $('.remove').on('click', function () {
        var len = $('tbody tr').length;
            $(this).parent().parent().remove();
            total_count(0);
    });
</script>
@include('custom_plugin.js_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

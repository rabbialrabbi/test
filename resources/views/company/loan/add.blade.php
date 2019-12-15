@extends('layout.company.masterpage')
@section('title', 'Add Loan')
@section('masterpage')
@if(in_array('loan', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Loan</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Loan</a>
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
                            <h2>Add Loan</h2>
                            <small>use this form to add loan to database.</small>
                            <div class="add-expense-area mt-5">
                                <div class="row">

                                    <div class="col-md-8">
                                        <form action="{{route('loan-add')}}" method="post">
                                            @csrf
                                             <label for="">Loaner</label><br>
                                            <select name="loaner_id" class="mb-3 form-control" required>
                                                <option value="">Select</option>
                                                @foreach($loaners as $value)
                                                <option value="{{$value->id}}">{{$value->loaner}}</option>
                                                @endforeach
                                            </select>
                                             <label for="">Loan Type</label><br>
                                            <select name="type" class="mb-3 form-control" required>
                                                <option value="">Select Loan Type</option>
                                                <option value="taken">Taken</option>
                                                <option value="given">Given</option>
                                            </select>
                                             <label for="">Amount</label><br>
                                            <input type="text" name="num1" id="num1" class="form-control mb-3" placeholder="0.00" required>
                                            <label for="">Interest</label><br>
                                            <input type="text" name="num2" id="num2" class="form-control mb-3" placeholder="0.00 %" required>
                                             <label for="">Loan Contract Date</label><br>
                                            <input type="date" id="startDate" name="contract_start" class="form-control mb-3" required>
                                             <label for="">Loan Contract End Date</label><br>
                                            <input type="date" id="endDate" name="contract_end" class="form-control mb-3" required>
                                            <label for="">Total Paid Amount</label><br>
                                            <input type="text" name="sum" class="form-control mb-3" id="sum"
                                                   placeholder="0.00" readonly><br>
                                            <label for="">Detail</label><br>
                                            <textarea name="detail" cols="30" rows="5" class="form-control"></textarea>
                                            <input type="submit" class="btn btn-success mt-2" value="Submit">
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        @if($ads2->status == 'on')
                                        {!! html_entity_decode($ads2->code)!!}
                                        <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('custom_plugin.js_files')

<script>
    $(document).ready(function() {
        sum();
        $("#num1, #num2,#startDate,#endDate").bind("keydown keyup change", function() {
            sum();
        });
    });
    function sum() {
        var date1 = new Date($("#startDate").val());
        var date2 = new Date($("#endDate").val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        var num1 = document.getElementById('num1').value; //amount
        var num2 = document.getElementById('num2').value; //interest
        var result1 = parseInt(num1) + ((((parseInt(num1) * parseInt(num2)) /100)/365) * diffDays);
        var result = result1.toFixed(2);
        if (!isNaN(result)) {
            document.getElementById('sum').value = result;
        }
    }
</script>
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

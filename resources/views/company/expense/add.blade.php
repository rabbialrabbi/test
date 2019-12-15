@extends('layout.company.masterpage')
@section('title', 'Add Expense Type')
@section('masterpage')
@if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Expense</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Expense</a>
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
                            <h2>Add Expense Type</h2>
                            <small>use this form to add expense type to database.</small>
                            <div class="add-expense-area mt-5">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Expense Type</label>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{route('expense-add')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <input type="text" class="form-control mb-3" name="expense_type" placeholder="Expense Type" required>
                                        <input type="submit" class="btn btn-success" value="Add Expense Type">
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
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

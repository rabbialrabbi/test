@extends('layout.company.masterpage')
@section('title', 'Payment Information')
@section('masterpage')
@if(in_array('setting', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Payment Information</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Payment Information</a>
                    </div>
                </div>
                <div class="col-md-9">
                    @if($ads1->status == 'on')
                    {!! html_entity_decode($ads1->code)!!}
                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                    @endif
                </div>
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <br><br>
                            <form action="{{route('p_info_update')}}" method="post">
                                @csrf
                            <div class="row">
                                <div class="d-sm-none col-md-4 d-md-block d-lg-block d-none">
                                    <label for="">Discount Calculation Type</label><br><br>
                                    <label for="">Vat/Tax Type</label><br><br>
                                    <label for="">Vat/Tax Amount</label><br><br>
                                    <label for="">Service Charge Type</label><br><br>
                                    <label for="">Service Charge Amount</label><br><br>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$show->id}}">

                                    <select class="form-control mb-3" name="discount_flag">
                                        <option value=" " <?php if ($show->discount_flag !== 0) echo 'selected'; ?>>%</option>
                                        <option value="0" <?php if ($show->discount_flag === 0) echo 'selected'; ?>>Fixed</option>
                                    </select>

                                    <input type="text" class="form-control mb-3" name="vat_type" value="{{$show->vat_type}}" required>

                                    <div class="row ml-1">
                                        <input type="text" class="form-control col-md-2 mb-3" name="vat_charge" value="{{$show->vat_amount}}" required>
                                        <select class="form-control col-md-3 mb-2" name="flag">
                                            <option value=" " <?php if ($show->flag !== 0) echo 'selected'; ?> >%</option>
                                            <option value="0" <?php if ($show->flag === 0) echo 'selected'; ?> >Fixed</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control mb-3" name="service_type" value="{{$show->service_type}}" required>
                                    <div class="row ml-1">
                                        <input type="text" class="form-control col-md-2 mb-3" name="service_charge" value="{{$show->service_amount}}" required>
                                        <select class="form-control col-md-3 mb-5" name="service_flag">
                                            <option value=" " <?php if ($show->service_flag !== 0) echo 'selected'; ?> >%</option>
                                            <option value="0" <?php if ($show->service_flag === 0) echo 'selected'; ?> >Fixed</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Update Setting</button>
                                </div>
                            </div>
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
@include('custom_plugin.js_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

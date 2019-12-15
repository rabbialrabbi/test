@extends('layout.company.masterpage')
@section('title', 'Message History')
@section('masterpage')

<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Message History</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Message History</a>
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
                            <h2>Message List</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="align-middle" align="center">NO</th>
                                        <th class="align-middle" align="center">Message From</th>
                                        <th class="align-middle" align="center">Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shows as $key => $show)
                                    <tr>
                                        <td class="align-middle" align="center">{{$key+ 1}}</td>
                                        <td class="align-middle" align="center">Admin</td>
                                        <td class="align-middle" align="center">{{$show->msg}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
@endsection

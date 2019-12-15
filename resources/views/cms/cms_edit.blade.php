@extends('layout.cmsLayout')
@section('title', 'CMS edit')
@section('cms')
<div class="row dashboard-right-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="dashboard-page-title">
                    Content Management System
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="shop-page-content">
                    <div class="row new-sales-table-bg">
                        <div class="col-md-12">
                            <h4>Edit Information</h4>
                            <div class="product-form">
                                <div class="row">
                                    <div class="col-md-10">
                                        <br><br>
                                        <form action="{{route('cms-update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$edit->id}}">
                                            <input type="text" class="form-control mb-3" name="title" value="{{$edit->title}}" required>
                                            <textarea class="form-control mb-3" cols="6" rows="5" name="description" required>
                                                {{$edit->description}}
                                            </textarea>
                                            <br>
                                            <input type="file" class="form-control mb-3" name="image">
                                            <button type="submit" class="btn btn-success btn-sm" style="padding: 5px 10px; color: #fff;">Update</button>
                                            <br><br><br><br><br><br>
                                        </form>
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
<script type="text/javascript">
    CKEDITOR.replace( 'description');
</script>
@endsection

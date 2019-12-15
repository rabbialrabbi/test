@extends('layout.cmsLayout')
@section('title', 'CMS Panel')
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
                    <!--                                 shop page tab menu-->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">CMS Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Country & Currency</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="option-tab" data-toggle="tab" href="#option" role="tab" aria-controls="option" aria-selected="false">Industry Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="unit-tab" data-toggle="tab" href="#unit" role="tab" aria-controls="unit" aria-selected="false">Unit</a>
                        </li>
                    </ul>
                    <!--                                    shop page tab menu end-->
                    <div class="tab-content" id="myTabContent">
                        <!--                                     shop page first tab strat-->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <!--                                        table row start for first tab-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="shop-page-table-content table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Section</th>
                                                <th>Title</th>
                                                <th>Description</th>

                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($shows as $show)
                                            <tr>
                                                <td>{{$show->section}}</td>
                                                <td style="width: 300px;">{{$show->title}}</td>
                                                <td style="width: 600px;">{!! html_entity_decode($show->description)!!}</td>
                                                <td> <img src="{{asset('public/cms_panel/'.$show->image)}}" alt="image is not needed" height="100px;" width="100px;"></td>
                                                <td>
                                                     <a href="{{route('cms-edit',[$show->id])}}" class="btn btn-info btn-sm">
                                                        <i class="far fa-edit margin-right-css"></i>Edit
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <!--                                         new field button, delete button, search row start for second tab-->
                            <div class="row">
                                <div class="col-md-6 margin-bottom-css">
                                    <button type="button" class="btn btn-secondary shop-btn-bg" data-toggle="modal" data-target="#country"><i class="fas fa-flag margin-right-css"></i>Add Country & Currency</button>
                                </div>
                            </div>
                            <!--                                          new field button, delete button, search row end for second tab-->
                            <!--                                        table row start for second tab-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="shop-page-table-content table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Country Name</th>
                                                <th>Currency</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($countries as $key=> $country)
                                            <tr>
                                                <td align="center">{{$key+1}}</td>
                                                <td align="center">{{$country->country}}</td>
                                                <td align="center">{{$country->currency}}</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-id="{{$country->id}}" data-toggle="modal" data-target="#delete">
                                                        <i class="fa fa-trash margin-right-css"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--                                          pagination row end for second tab-->
                        </div>
                        <!--                                      shop page second tab end-->

                        <div class="tab-pane fade" id="option" role="tabpanel" aria-labelledby="option-tab">
                            <div class="row">
                                <div class="col-md-6 margin-bottom-css">
                                    <button type="button" class="btn btn-secondary shop-btn-bg" data-toggle="modal" data-target="#category"><i class="fas fa-flag margin-right-css"></i>Add Category</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="shop-page-table-content table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($categories as $key=> $category)
                                            <tr>
                                                <td align="center">{{$key+1}}</td>
                                                <td align="center">{{$category->currency}}</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-id="{{$category->id}}" data-toggle="modal" data-target="#delete">
                                                        <i class="fa fa-trash margin-right-css"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="unit" role="tabpanel" aria-labelledby="unit-tab">
                            <div class="row">
                                <div class="col-md-6 margin-bottom-css">
                                    <button type="button" class="btn btn-secondary shop-btn-bg" data-toggle="modal" data-target="#unit1"><i class="fas fa-flag margin-right-css"></i>Add Product Unit</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="shop-page-table-content table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Unit</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($units as $key=> $unit)
                                            <tr>
                                                <td align="center">{{$key+1}}</td>
                                                <td align="center">{{$unit->currency}}</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-id="{{$unit->id}}" data-toggle="modal" data-target="#delete">
                                                        <i class="fa fa-trash margin-right-css"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
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

<div class="modal fade" id="country" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Add Country & Currency </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('country-store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Country </label><br><br><label for="">Currency </label><br><br>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="section" value="cc">
                            <input type="text" name="country" class="form-control" placeholder="Country ...." required><br>
                            <input type="text" name="currency" class="form-control" placeholder="Currency ...." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
                        <button type="submit" class="btn btn-success mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-plus"></i> Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Add Industry Category </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('category-store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Category Name </label><br><br>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="category" class="form-control" placeholder="Category ...." required><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
                        <button type="submit" class="btn btn-success mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-plus"></i> Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="unit1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Add Product Unit </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('unit-store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Unit Name </label><br><br>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="unit" class="form-control" placeholder="Unit ...." required><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
                        <button type="submit" class="btn btn-success mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-plus"></i> Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>
                    Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('cc-destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="product-add-form">
                        <h6> Are you sure you want to delete this? </h6>
                    </div>
                    <input type="hidden" name="id" id="data_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; color: #fff;"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_title = button.data('title'); var data_description = button.data('description');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_title').val(data_title); modal.find('.modal-body #data_description').val(data_description);
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
    });
</script>
@endsection

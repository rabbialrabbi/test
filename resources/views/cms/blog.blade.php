@extends('layout.cmsLayout')
@section('title', 'Blog')
@section('cms')
<div class="row dashboard-right-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="dashboard-page-title"> Blog </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="shop-page-content">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-css">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add_blog">New Blog</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="shop-page-table-content table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No.</th><th>Title</th><th>Description</th>
                                        <th>Image</th><th>Date</th><th>Action</th>
                                    </tr>
                                    @foreach($shows as $key => $show)
                                    <tr>
                                        <td> {{$key+1}}</td> <td style="width: 250px;">{{$show->title}}</td>
                                        <td style="width: 650px;">{!!html_entity_decode($show->description)!!}</td>
                                        <td> <img src="{{asset('public/cms_panel/'.$show->image)}}" alt="image is not needed" height="100px;" width="100px;"></td>
                                        <td>{{$show->date->format('d/m/Y')}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm mb-2" data-id="{{$show->id}}" data-title="{{$show->title}}"
                                                    data-description="{{$show->description}}" data-toggle="modal" data-target="#edit">
                                                <i class="far fa-edit margin-right-css"></i>Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-id="{{$show->id}}" data-toggle="modal"
                                                    data-target="#delete"><i class="fa fa-trash margin-right-css"></i>Delete
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

<div class="modal fade" id="add_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('add-blog')}}" method="post" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="type" value="shop">
                            <input type="text" class="form-control mb-3" name="title" placeholder="Blog Title" required>
                            <textarea name="description" cols="10" rows="10" placeholder="Description"></textarea>
                            <input type="file" class="form-control mb-3" name="image">
                            <input type="date" class="form-control mb-3" name="date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Blog Information Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('blog-update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="text" class="form-control mb-3" name="title" id="data_title" value="" required>
                            <textarea name="description2" cols="10" rows="10" id="data_description"></textarea>
                            <input type="file" class="form-control mb-3" name="image">
                            <input type="date" class="form-control mb-3" name="date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-edit"></i> Update</button>
                    <button type="button" class="btn btn-danger mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
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
            <form action="{{route('blog-destroy')}}" method="post">
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
        var data_id = button.data('id');
        var data_title = button.data('title'); var data_description = button.data('description');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_title').val(data_title);
        modal.find('.modal-body #data_description').val(data_description);
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
    });
    CKEDITOR.replace( 'description');
    CKEDITOR.replace( 'description2');
</script>
@endsection

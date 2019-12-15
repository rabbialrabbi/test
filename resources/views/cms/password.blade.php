@extends('layout.cmsLayout')
@section('title', 'Password')
@section('cms')
<div class="row dashboard-right-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="dashboard-page-title">
                    Password Change
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="shop-page-content">
                    <div class="row new-sales-table-bg">
                        <div class="col-md-12">
                            <h4>Password Change</h4>
                            <div class="product-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <br><br>
                                        <form action="{{route('cms_update_password')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="old_email" value="{{ Session::get('loggedCms')['email']}}">
                                            <input type="text" name="email" placeholder="email..." class="form-control" required><br>
                                            <input type="password" name="old_pass" placeholder="old password..." class="form-control" required><br>
                                            <input type="password" name="password" placeholder="new password..." class="form-control" required><br>
                                            <br>
                                            <button type="submit" class="btn btn-success btn-sm" style="padding: 5px 10px; color: #fff;">
                                                Update
                                            </button>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    CMS Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('cms-update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Title</label><br><br><label for="">Description</label><br><br><label for="">Image</label><br><br>
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="text" class="form-control mb-3" name="title" id="data_title" value="" required>
                            <textarea class="form-control mb-3" cols="6" rows="5" name="description" id="data_description" value="" required></textarea>
                            <input type="file" class="form-control mb-3" name="image">
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
@include('custom_plugin.js_files')
<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_title = button.data('title');
        var data_description = button.data('description');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_title').val(data_title);
        modal.find('.modal-body #data_description').val(data_description);
    });
</script>
@endsection

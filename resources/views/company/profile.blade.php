@extends('layout.company.masterpage')
@section('title', 'Profile')
@section('masterpage')

<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>User Profile</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">User Profile</a>
                    </div>
                    <div class="bread-cumb-area float-left">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update">
                            <i class="fa fa-edit"></i> Update Profile </button>
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
                    <h2>User Detail Information</h2>
                    <div class="product-form">
                        <div class="row">
                            <div class="col-md-2">
                               
                                
                                
                               
                                
                                

                            </div>
                            <div class="col-md-6">
                                 <label style="font-weight:800; font-size:18px;" for="">Name:   </label>
                                <label>{{$shows->fname}} {{$shows->lname}}</label><br>
                                
                                <label style="font-weight:800; font-size:18px;" for="">Mobile:   </label>
                                <label>{{$shows->mobile}}</label><br>
                                
                                <label style="font-weight:800; font-size:18px;overflow-wrap: break-word;" for="">Email:  </label>
                                <label>{{$shows->email}}</label><br>
                                
                                 <label style="font-weight:800; font-size:18px;" for="">Industry:   </label>
                                <label>{{$shows->industry}}</label><br>
                                
                                <label style="font-weight:800; font-size:18px;" for="">Postcode:   </label>
                                <label>{{$shows->postcode}}</label><br>
                                
                                <label style="font-weight:800; font-size:18px;" for="">Country:   </label>
                                <label>{{$shows->country}}</label><br>

                                <label></label><br>
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

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-envelope margin-right-css"></i>
                    Edit User Profile </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <div class="row">

                    <div class="col-md-12">
                    <form action="{{route('edit-profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                         

                        <input type="hidden" name="id" class="form-control" value="{{$shows->id}}">
                        <label for="">First Name  </label><br>
                        <input type="text" name="fname" class="form-control" value="{{$shows->fname}}" required>
                        <label for="">Last Name  </label><br>
                        <input type="text" name="lname" class="form-control" value="{{$shows->lname}}" required>
                        <label for="">Mobile  </label><br>
                        <input type="text" name="mobile" class="form-control" value="{{$shows->mobile}}" required><br>
                        <label for="">Email </label><br>
                        <input type="text" name="email" class="form-control" value="{{$shows->email}}" required>
                        <label for="">Industry  </label><br>
                        <select name="industry" class="form-control mb-4" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->currency}}">{{$category->currency}}</option>
                            @endforeach
                        </select>
                        <label for="">Postcode  </label><br>
                        <input type="text" name="postcode" class="form-control" value="{{$shows->postcode}}" required>
                        <label for="">Country  </label><br>
                        <input type="text" name="country" class="form-control" value="{{$shows->country}}" required>
                         <label for="">Old Password  </label><br>
                        <input type="password" name="password" class="form-control"
                               placeholder="enter existing password for security reason...." required>

                        <button type="submit" class="btn btn-success mt-2" width="20px;"> Submit</button>
                        <button type="button" class="btn btn-info mt-2" data-dismiss="modal">Cancel
                        </button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
@endsection

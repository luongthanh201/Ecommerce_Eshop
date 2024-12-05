    @extends('frontend.layout.master')
    @section('content')
    <div class="col-sm-3">
        @include('frontend.layout.account-menu');
    </div>
    <div class="col-sm-9">
        <h2 class="title text-center">Create Product</h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-md-12"> Name</label>
                <div class="col-md-12">
                    <input type="text" placeholder="Name" class="form-control form-control-line" name="title" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="example-email" class="col-md-12">Price</label>
                <div class="col-md-12">
                    <input type="text" placeholder="Price" class="form-control form-control-line" name="price"
                        id="example-email" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">Select Category</label>
                <div class="col-sm-12">
                    <select class="form-control form-control-line" name="id_category">
                        @foreach($category as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach                                          
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">Select Brand</label>
                <div class="col-sm-12">
                    <select class="form-control form-control-line" name="id_brand">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach                                          
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" id="status" name="status">
                            <option name="sale" value="1"> New</option>
                            <option name="sale" value="0"> Sale</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="sale_price_div" style="display:none;">
                <label for="sale_price">Sale Price:</label>
                <input type="number" id="sale_price" name="sale_price" value=0>%
            </div>
            <div class="form-group">
                <label class="col-md-12">Company Profile</label>
                <div class="col-md-12">
                    <input type="text" placeholder="Company Profile" class="form-control form-control-line" name="company"
                        value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Image</label>
                <div class="col-md-12">
                    <input type="file" placeholder="" class="form-control form-control-line" name="img[]" value="" multiple>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Detail</label>
                <div class="col-md-12">
                    <textarea placeholder="Detail" rows="5" class="form-control form-control-line"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">Create Product</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $("#status").change(function () {
                var status = $("#status").val();
                if (status == "0") {
                $("#sale_price_div").show();
            } else {
                $("#sale_price_div").hide();
            }
            })
        })
    </script>
    @endsection
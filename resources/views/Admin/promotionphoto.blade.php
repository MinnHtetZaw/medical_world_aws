@extends('master')

@section('title','PromotionPhoto')

@section('place')

@endsection

@section('content')

@extends('master')

@section('title','PromotionPhoto')

@section('place')

@endsection

@section('content')


<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive text-black">
                    <table class="table text-center">
                            @if(session('danger'))
                            <div class="alert alert-danger">
                            {{ session('danger') }} </div>
                            @endif
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> @lang('Title')</th>
                                <th> @lang('Photo')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody id="promotionphoto_table">
                            <?php $i=1;?>


                            @foreach($promotionphotos as $promotionphoto)
                            <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $promotionphoto['promotionphoto_title'] }}</td>
                                    <td><img src="{{ asset('promotion_images/'. $promotionphoto['promotionphoto_photo'])}}" alt="" width="100px" height="70px"></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_item{{$promotionphoto->id}}"><i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-outline-danger" onclick="ApproveLeave('{{$promotionphoto->id}}')">
                                        <i class="fas fa-trash-alt"></i></a>
                                    </td>

                                    <div class="modal fade" id="edit_item{{$promotionphoto->id}}" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title">@lang('Edit PromotionPhoto form')</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>

                                        <div class="modal-body">
                                            <form class="form-material m-t-40" method="post" action="{{route('promotionphoto_update', $promotionphoto->id)}}"  enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="font-weight-bold">@lang('lang.title')</label>
                                                    <input type="text" name="promotionphoto_title" class="form-control" value="{{$promotionphoto->promotionphoto_title}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">Photo</label>
                                                    <input type="file" name="promotionphoto_photo" class="form-control" value="{{$promotionphoto->promotionphoto_photo}}">
                                                </div>

                                                <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="@lang('lang.save')">
                                            </form>
                                        </div>

                                  </div>
                                </div>
                                </div>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Create PromotionPhoto link</h3>
                <form action="{{ route('promotionphoto_create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="form-group">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" name="promotionphoto_title" id="promotionphoto_title" class="form-control @error('promotionphoto_title') is-invalid @enderror" placeholder="@lang('Enter PromotionPhoto title')" required>

                            @error('promotionphoto_title')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Photo</label>
                            <input type="file" name="promotionphoto_photo" id="promotionphoto_photo" class="form-control @error('promotionphoto_photo') is-invalid @enderror" placeholder="@lang('Enter PromotionPhoto photo')" required>

                            @error('promotionphoto_photo')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm float-end">Save PromotionpPhoto photo</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

    function ApproveLeave(value){

        var promotionphoto_id = value;

        swal({
            title: "@lang('lang.confirm')",
            icon:'warning',
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"]
        })

      .then((isConfirm)=>{

        if(isConfirm){

            $.ajax({
                type:'POST',
                url:'promotionphoto/delete',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "promotionphoto_id": promotionphoto_id,
                },

                success: function(){

                    swal({
                        title: "Success!",
                        text : "Successfully Deleted!",
                        icon : "success",
                    });

                    setTimeout(function(){window.location.reload()}, 1000);


                },
            });
        }
      });


    }

    function promotionphoto_store(){
        var promotionphoto_title = $('#promotionphoto_title ').val();
        var promotionphoto_photo = $('#promotionphoto_photo').val();
        console.log(promotionphoto_title,promotionphoto_photo);
        $.ajax({
                type:'POST',
                url:'{{ route('promotionphoto_store') }}',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "promotionphoto_title": promotionphoto_title,
                  "promotionphoto_link": promotionphoto_photo,
                },

                success: function(data){

                    swal({
                        title: "Success!",
                        text : "Category Saved!",
                        icon : "success",
                    });




                },
            });
    }





</script>
@endsection


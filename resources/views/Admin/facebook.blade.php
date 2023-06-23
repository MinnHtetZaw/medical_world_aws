@extends('master')

@section('title','Facebook')

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
                                <th> @lang('Description')</th>
                                <th style="width: 40%"> @lang('Photo')</th>
                                <th> @lang('Link')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody id="facebook_table">
                            <?php $i=1;?>


                            @foreach($facebook_links as $facebook)
                            <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $facebook['facebook_title'] }}</td>
                                    <td>{{ $facebook['facebook_description'] }}</td>
                                    <td>
                                        <img src="{{ asset('facebook_images/'. $facebook->facebook_photo)}}" alt="" width="100px" height="70px">
                                    </td>

                                    <td>{{ $facebook['facebook_link'] }}</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_item{{$facebook->id}}"><i class="fas fa-edit"></i>
                                        </a>


                                            {{-- <a href="{{ route('facebook_delete') }}" class="btn btn-outline-danger" onclick="ApproveLeave('{{$facebook->id}}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> --}}

                                        <a href="#" class="btn btn-outline-danger" onclick="ApproveLeave('{{$facebook->id}}')">

                                        <i class="fas fa-trash-alt"></i></a>
                                    </td>

                                    <div class="modal fade" id="edit_item{{$facebook->id}}" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title">@lang('Edit Facebook form')</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>

                                        <div class="modal-body">
                                            <form class="form-material m-t-40" method="post" action="{{route('facebook_update', $facebook->id)}}"  enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="font-weight-bold">@lang('lang.title')</label>
                                                    <input type="text" name="facebook_title" class="form-control" value="{{$facebook->facebook_title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">@lang('lang.description')</label>
                                                    <input type="text" name="facebook_description" class="form-control" value="{{$facebook->facebook_description}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Photo</label>
                                                    <input type="file" name="facebook_photo" class="form-control" value="{{$facebook->facebook_photo}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Link</label>
                                                    <input type="text" name="facebook_link" class="form-control" value="{{$facebook->facebook_link}}">
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
                <h3 class="card-title">Create Facebook link</h3>
                <form action="{{ route('facebook_create') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div>
                        <div class="form-group">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" name="facebook_title" id="facebook_title" class="form-control @error('facebook_title') is-invalid @enderror" placeholder="@lang('Enter facebook title')" required>

                            @error('facebook_title')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description</label>
                            <textarea name="facebook_description" id="facebook_description" cols="49" rows="5" class="form-control @error('facebook description') is-invalid @enderror" placeholder="@lang('Enter Facebook description')" required></textarea>
                            @error('facebook_description')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Photo</label><br>
                            <input type="file" name="facebook_photo" id="facebook_photo" class=" @error('facebook_photo') is-invalid @enderror"required>

                            @error('facebook_photo')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Link</label>
                            <input type="text" name="facebook_link" id="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" placeholder="@lang('Enter Facebook link')" required>

                            @error('facebook_link')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm float-end">Save facebook link</button>
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
        var facebook_id = value;
        swal({
            title: "@lang('lang.confirm')",
            icon:'warning',
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"]
        })
      .then((isConfirm)=>{
        if(isConfirm){
            $.ajax({
                type:'POST',
                url:'facebook/delete',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "facebook_id": facebook_id,
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
    // function facebook_store(){
    //     var facebook_title = $('#facebook_title ').val();
    //     var facebook_description = $('#facebook_description').val();
    //     var facebook_photo = $('#facebook_photo').val();
    //     var facebook_link = $('#facebook_link').val();
    //     console.log(facebook_title,facebook_description,facebook_photo,facebook_link);
    //     $.ajax({
    //             type:'POST',
    //             url:'{{ route('facebook_store') }}',
    //             dataType:'json',
    //             data:{
    //               "_token": "{{ csrf_token() }}",
    //               "facebook_title": facebook_title,
    //               "facebook_description": facebook_description,
    //               "facebook_photo": facebook_photo,
    //               "facebook_link": facebook_link,
    //             },
    //             success: function(data){
    //                 swal({
    //                     title: "Success!",
    //                     text : "Category Saved!",
    //                     icon : "success",
    //                 });
    //             },
    //         });
    // }
</script>
@endsection

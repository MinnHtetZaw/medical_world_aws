@extends('master')

@section('title','Youtube')

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
                                <th> @lang('Link')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody id="youtube_table">
                            <?php $i=1;?>


                            @foreach($youtube_links as $youtube)
                            <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $youtube['youtube_title'] }}</td>
                                    <td>{{ $youtube['youtube_link'] }}</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_item{{$youtube->id}}"><i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-outline-danger" onclick="ApproveLeave('{{$youtube->id}}')">
                                        <i class="fas fa-trash-alt"></i></a>
                                    </td>

                                    <div class="modal fade" id="edit_item{{$youtube->id}}" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title">@lang('Edit Youtube form')</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>

                                        <div class="modal-body">
                                            <form class="form-material m-t-40" method="post" action="{{route('youtube_update', $youtube->id)}}">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="font-weight-bold">@lang('lang.title')</label>
                                                    <input type="text" name="youtube_title" class="form-control" value="{{$youtube->youtube_title}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">@lang('lang.link')</label>
                                                    <input type="text" name="youtube_link" class="form-control" value="{{$youtube->youtube_link}}">
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
                <h3 class="card-title">Create Youtube link</h3>
                <form action="{{ route('youtube_create') }}" method="POST">
                    @csrf
                    <div>
                        <div class="form-group">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" name="youtube_title" id="youtube_title" class="form-control @error('youtube_title') is-invalid @enderror" placeholder="@lang('Enter youtube title')" required>

                            @error('youtube_title')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Link</label>
                            <input type="text" name="youtube_link" id="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" placeholder="@lang('Enter Youtube link')" required>

                            @error('youtube_link')
                                <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm float-end">Save youtube link</button>
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

        var youtube_id = value;

        swal({
            title: "@lang('lang.confirm')",
            icon:'warning',
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"]
        })

      .then((isConfirm)=>{

        if(isConfirm){

            $.ajax({
                type:'POST',
                url:'youtube/delete',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "youtube_id": youtube_id,
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

    function youtube_store(){
        var youtube_title = $('#youtube_title ').val();
        var youtube_link = $('#youtube_link').val();
        console.log(youtube_title,youtube_link);
        $.ajax({
                type:'POST',
                url:'{{ route('youtube_store') }}',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "youtube_title": youtube_title,
                  "youtube_link": youtube_link,
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


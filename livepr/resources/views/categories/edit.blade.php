@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">
						Categori Edit: <span class="text-danger">{{ $channel->channelName }}</span>
					</div>
					<div class="card-body">
                        @if(count($commongenres) > 0)
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Image({{ $channel-> channelName}})</h2>
                                <img src="{{ $channel-> stillImageName}}" width="100%">
                            </div>
                            <div class="col-md-8">
                                <form action="/categories/{{$channel->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
        						<div class="form-group row">
                                    <label for="channelName" class="col-md-4 col-form-label text-md-right">ChannelName : </label>
                                    <div class="col-md-6">
                                        <input id="channelName" type="text" class="form-control" name="channelName" value="{{ $channel-> channelName }}" required >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="programs" class="col-md-4 col-form-label text-md-right">Programs : </label>
                                    <div class="col-md-6">
                                        <input id="programs" type="text" class="form-control" name="programs" value="{{ $channel-> programs }}" disabled>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="hlsUrlPhoneAUTO" class="col-md-4 col-form-label text-md-right">HlsUrlPhoneAUTO : </label>
                                    <div class="col-md-6">
                                        <input id="hlsUrlPhoneAUTO" type="text" class="form-control" name="hlsUrlPhoneAUTO" value="{{ $channel-> hlsUrlPhoneAUTO }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Under19Content" class="col-md-4 col-form-label text-md-right">Under19Content : </label>
                                    <div class="col-md-6">
                                        <select name="under19Content" class="form-control">
                                            <option>1</option>
                                            <option>0</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="genreCd" class="col-md-4 col-form-label text-md-right">Category : </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="genreCd">
                                            @forelse($commongenres as $genres)
                                            <option value="{{$genres->id}}" @if($genres->id == $channel-> genreCd) selected @endif>{{$genres->cdName}}</option>
                                            @empty
                                            <option>Empty</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">State : </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="state">
                                            <option value="1" >Allow</option>
                                            <option value="0" @if($channel->state == 0) selected @endif >No Allow</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="StillImageName" class="col-md-4 col-form-label text-md-right">StillImageURL : </label>
                                    <div class="col-md-6">
                                        <input type="file" name="stillImageName" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a id="delbtn" class="btn btn-danger">Delete</a>
                                        <a href="/categories" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                                </form>

                                <form action="/categories/{{ $channel->id }}" id="delform" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="form-group row alert alert-danger">
                            <label for="error" class="col-md-12 col-form-label text-center">Whoops! You should create categories! If you create categories, click <a href="/commongenre">here</a></label>
                        </div>
                        @endif
					</div>
				</div>
			</div>
		</div>
	</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#delbtn").click(function(){
                if(confirm('Are you Sure Delete?')) {
                    $('#delform').submit();
                }
            });
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card card-primary">
				<div class="card-header">Create Channel</div>
				<div class="card-body">
					<!-- @component('layouts.alert')
						@slot('title')
							Forbidden
						@endslot
					 	Whoops <strong>Error</strong>!
					@endcomponent -->
					<form method="POST" action="/categories" enctype="multipart/form-data">
						@csrf

						<div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">Categories</label>

                            <div class="col-md-6">
                                <select class="form-control" name="genreCd">
                                	@forelse($genres as $channel)
                                	<option value="{{$channel->id}}">{{$channel->cdName}}</option>
                                	@empty
                                	<option>Empty</option>
                                	@endforelse
                                </select>
                            </div>
                        </div>
                        @if(count($genres) > 0)
                        <div class="form-group row">
                            <label for="channelName" class="col-md-4 col-form-label text-md-right">ChannelName</label>

                            <div class="col-md-6">
                                <input id="channelName" type="text" class="form-control" name="channelName" value="{{ old('channelName') }}" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="programs" class="col-md-4 col-form-label text-md-right">Programs</label>

                            <div class="col-md-6">
                                <input id="programs" type="text" class="form-control" name="programs" value="0" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hlsUrlPhoneAUTO" class="col-md-4 col-form-label text-md-right">HlsUrlPhoneAUTO</label>

                            <div class="col-md-6">
                                <input id="hlsUrlPhoneAUTO" type="text" class="form-control" name="hlsUrlPhoneAUTO" value="{{ old('hlsUrlPhoneAUTO') }}" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stillImageName" class="col-md-4 col-form-label text-md-right">StillImageName</label>

                            <div class="col-md-6">
                                <input type="file" id="stillImageName" class="form-control" name="stillImageName" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="under19Content" class="col-md-4 col-form-label text-md-right">Under19Content</label>

                            <div class="col-md-6">
                                <select class="form-control" name="under19Content">
                                	<option value="1">True</option>
                                	<option value="0">False</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <a href="/categories" class="btn btn-warning">Back</a>
                            </div>
                        </div>
                        @else
                        <div class="form-group row alert alert-danger">
                            <label for="error" class="col-md-12 col-form-label text-center">Whoops! You should create categories! If you create categories, click <a href="/commongenre">here</a></label>
                        </div>
                        @endif
					</form>
				</div>
			</div>
		</div>
	</div>	
</div>
@endsection

@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">
						Channel : <span class="text-danger">{{ $channel->channelName }}</span>
					</div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Image({{ $channel-> channelName}})</h2>
                                <img src="{{ $channel-> stillImageName}}" width="100%">
                            </div>
                            <div class="col-md-8">
        						<div class="form-group row">
                                    <label for="channelName" class="col-md-4 col-form-label text-md-right">ChannelName : </label>
                                    <label for="channelName" class="col-md-6 col-form-label">{{ $channel-> channelName}}</label>
                                </div>
                                <div class="form-group row">
                                    <label for="cdName" class="col-md-4 col-form-label text-md-right">Programs : </label>
                                    <label for="cdName" class="col-md-6 col-form-label">{{ $channel-> programs}}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="hlsUrlPhoneAUTO" class="col-md-4 col-form-label text-md-right">HlsUrlPhoneAUTO : </label>
                                    <label for="hlsUrlPhoneAUTO" class="col-md-6 col-form-label">{{ $channel-> hlsUrlPhoneAUTO}}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="under19Content" class="col-md-4 col-form-label text-md-right">Under19Content : </label>
                                    <label for="under19Content" class="col-md-6 col-form-label">
                                        @if($channel-> under19Content == 1)
                                            True
                                        @else
                                            False
                                        @endif
                                    </label>
                                </div>

                                <div class="form-group row">
                                    <label for="genreCd" class="col-md-4 col-form-label text-md-right">Category no : </label>
                                    <label for="genreCd" class="col-md-6 col-form-label">{{ $channel-> genreCd}}</label>
                                </div>
                                <div class="form-group row">
                                    <label for="state" class="col-md-4 col-form-label text-md-right">State : </label>
                                    <label for="state" class="col-md-6 col-form-label">
                                        @if ($channel->state == 1)
                                            Allowed
                                        @elseif ($channel->state == 0)
                                            Not allowed
                                        @else
                                            Admin
                                        @endif
                                    </label>
                                </div>

                                <form action="/categories/{{ $channel->id }}" id="delform" method="POST">
                                	@csrf
                                	{{ method_field('DELETE') }}
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <a href="/categories/{{ $channel->id }}/edit" class="btn btn-primary">Edit</a>
                                        <a id="delbtn" class="btn btn-danger">Delete</a>
                                        <a href="/categories" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
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
@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">
						Video Edit: <span class="text-danger">{{ $videos->channelName }}</span>
					</div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Image({{ $videos-> channelName}})</h2>
                                <img src="{{ $videos-> stillImageName}}" width="100%">
                            </div>
                            <div class="col-md-8">
                                <form action="/videos" method="POST" enctype="multipart/form-data">
                                    @csrf
        						
                                <div class="form-group row">
                                    <label for="programs" class="col-md-4 col-form-label text-md-right">Video : </label>
                                    <div class="col-md-6">
                                        <input id="streamUrl" type="file" class="form-control" name="streamUrl">
                                    </div>
                                </div>
                                <input type="hidden" name="categori_id" value="{{$videos->id}}">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <!-- <a id="delbtn" class="btn btn-danger">Delete</a> -->
                                        <a href="/videos" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                                </form>

                                <form action="/videos/{{ $videos->vid }}" id="delform" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
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
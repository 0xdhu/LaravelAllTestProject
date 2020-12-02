@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card card-default">
					<div class="card-header">
						user : <span class="text-danger">{{ $user->name }}</span>
					</div>
					<div class="card-body">
                        <form action="/users/{{$user->id}}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name : </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user-> name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email : </label>
                            <label for="email" class="col-md-6 col-form-label">{{ $user-> email}}</label>
                        </div>
                       
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">State : </label>
                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                    <option value="1" >Allow</option>
                                    <option value="0" @if($user->role == 0) selected @endif >No Allow</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a id="delbtn" class="btn btn-danger">Delete</a>
                                <a href="/users" class="btn btn-warning">Back</a>
                            </div>
                        </div>
                        </form>

                        <form action="/users/{{ $user->id }}" id="delform" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                        </form>
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
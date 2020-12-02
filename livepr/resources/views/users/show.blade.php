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
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name : </label>
                            <label for="name" class="col-md-6 col-form-label">{{ $user-> name}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Email : </label>
                            <label for="address" class="col-md-6 col-form-label">{{ $user-> email}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">State : </label>
                            <label for="gender" class="col-md-6 col-form-label">
                                @if ($user->role == 1)
                                    accept
                                @elseif ($user->role == 0)
                                    not allowed
                                @else
                                    Admin
                                @endif
                            </label>
                        </div>

                        <form action="/users/{{ $user->id }}" id="delform" method="POST">
                        	@csrf
                        	{{ method_field('DELETE') }}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
                                <a id="delbtn" class="btn btn-danger">Delete</a>
                                <a href="/users" class="btn btn-warning">Back</a>
                            </div>
                        </div>
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
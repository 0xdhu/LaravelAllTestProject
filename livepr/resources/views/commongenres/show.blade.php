@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card card-default">
					<div class="card-header">
						Categori : <span class="text-danger">{{ $categori->cdName }}</span>
					</div>
					<div class="card-body">
						<div class="form-group row">
                            <label for="cdno" class="col-md-4 col-form-label text-md-right">CDNo : </label>
                            <label for="cdno" class="col-md-6 col-form-label">{{ $categori-> id}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="cdName" class="col-md-4 col-form-label text-md-right">CDName : </label>
                            <label for="cdName" class="col-md-6 col-form-label">{{ $categori-> cdName}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">State : </label>
                            <label for="role" class="col-md-6 col-form-label">
                                @if ($categori->role == 1)
                                    accept
                                @elseif ($categori->role == 0)
                                    not allowed
                                @else
                                    Admin
                                @endif
                            </label>
                        </div>

                        <form action="/commongenre/{{ $categori->id }}" id="delform" method="POST">
                        	@csrf
                        	{{ method_field('DELETE') }}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/commongenre/{{ $categori->id }}/edit" class="btn btn-primary">Edit</a>
                                <a id="delbtn" class="btn btn-danger">Delete</a>
                                <a href="/commongenre" class="btn btn-warning">Back</a>
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
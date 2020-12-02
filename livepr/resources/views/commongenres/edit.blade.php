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
                        <form action="/commongenre/{{$categori->id}}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">cdNo : </label>
                            <label for="id" class="col-md-6 col-form-label">{{ $categori-> id }}</label>
                        </div>
						<div class="form-group row">
                            <label for="cdName" class="col-md-4 col-form-label text-md-right">cdName : </label>
                            <div class="col-md-6">
                                <input id="cdName" type="text" class="form-control" name="cdName" value="{{ $categori-> cdName }}" required autofocus>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">State : </label>
                            <div class="col-md-6">
                                <select class="form-control" name="state">
                                    <option value="1" >Allow</option>
                                    <option value="0" @if($categori->state == 0) selected @endif >No Allow</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a id="delbtn" class="btn btn-danger">Delete</a>
                                <a href="/commongenre" class="btn btn-warning">Back</a>
                            </div>
                        </div>
                        </form>

                        <form action="/commongenre/{{ $categori->id }}" id="delform" method="POST">
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
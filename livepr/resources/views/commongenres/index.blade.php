@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card card-default">
				<div class="card-header">Categories List</div>
				
				<div class="card-body">
					<div class="form-group">
						<a href="/commongenre/create" class="btn btn-primary">Create <span class="fa fa-plus"></span></a>
					</div>
					<div class="form-group">
						<span>Total records: {{$categories->total()}}</span>
					</div>
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>CNO</th>
								<th>Name</th>
								<th>State</th>
								<th>Updated_at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=($categories->currentPage()-1) * $categories->perPage() + 1; ?>
							@forelse($categories as $categori)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$categori->id}}</td>
								<td>{{$categori->cdName}}</td>
								<td>
									@if ($categori->state == 1)
	                                    accept
	                                @elseif ($categori->state == 0)
	                                    not allowed
	                                @else
	                                    Admin
	                                @endif
								</td>
								<td>{{$categori->updated_at}}</td>
								<td>
									<a href="/commongenre/{{$categori->id}}" class="btn btn-sm btn-success">View</a>
									<a href="/commongenre/{{$categori->id}}/edit" class="btn btn-sm btn-info">Edit</a>
									<a class="btn btn-sm btn-danger delbtn" data-id="{{ $categori->id}}" data-name="{{ $categori->cdName}}">Delete</a>
								</td>
							</tr>
							@empty
							<tr><td colspan="6">No Categories</td></tr>
							@endforelse
						</tbody>
					</table>
					</div>
					<div>
						{{ $categories->links() }}
					</div>
					<form action="" id="delform" method="POST">
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
    	var elems = $('.delbtn');
        elems.click(function(event){
        	event.preventDefault();
            if(confirm('Are you Sure Delete? : ' + $(this).data('name'))) {
                $('#delform').attr('action','/commongenres/' + $(this).data('id'));
                $('#delform').submit();
            }
        });
    });
</script>
@endsection

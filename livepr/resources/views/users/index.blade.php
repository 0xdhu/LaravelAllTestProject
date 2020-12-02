@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card card-default">
				<div class="card-header">users Table</div>
				
				<div class="card-body">
					<div class="form-group">
						<a href="/users/create" class="btn btn-primary">Create <span class="fa fa-plus"></span></a>
					</div>
					<div class="form-group">
						<span>Total records: {{$users->total()}}</span>
					</div>
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>State</th>
								<th>Updated_at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=($users->currentPage()-1) * $users->perPage() + 1; ?>
							@forelse($users as $user)
							@if($user->role != 100)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>
									@if ($user->role == 1)
	                                    accept
	                                @elseif ($user->role == 0)
	                                    not allowed
	                                @else
	                                    Admin
	                                @endif
	                            </td>
								<td>{{$user->updated_at}}</td>
								<td>
									<a href="/users/{{$user->id}}" class="btn btn-sm btn-success">View</a>
									<a href="/users/{{$user->id}}/edit" class="btn btn-sm btn-info">Edit</a>
									<a class="btn btn-sm btn-danger delbtn" data-id="{{ $user->id}}" data-name="{{ $user->name}}">Delete</a>
								</td>
							</tr>
							@endif
							@empty
							<tr><td colspan="6">No Users</td></tr>
							@endforelse
						</tbody>
					</table>
					</div>
					<div>
						{{ $users->links() }}
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
                $('#delform').attr('action','/users/' + $(this).data('id'));
                $('#delform').submit();
            }
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card card-default">
				<div class="card-header">channels List</div>
				
				<div class="card-body">
					<div class="form-group">
						<a href="/categories/create" class="btn btn-primary">Create <span class="fa fa-plus"></span></a>
					</div>
					<div class="form-group">
						<span>Total records: {{$channels->total()}}</span>
					</div>
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>ChannelName</th>
								<!-- <th>Programs</th>
								<th>HlsUrlPhoneAUTO</th> -->
								<th>StillImageName</th>
								<!-- <th>Under19Content</th> -->
								<th>Category</th>
								<th>State</th>
								<th>Updated_at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=($channels->currentPage()-1) * $channels->perPage() + 1; ?>
							@forelse($channels as $channel)
							<tr style="@if($channel->state == 1) color: red; font-weight: bold; @endif">
								<td>{{$i++}}</td>
								<td>{{$channel->channelName}}</td>
								<!-- <td>{{$channel->programs}}</td>
								<td>{{$channel->hlsUrlPhoneAUTO}}</td> -->
								<td><img src="{{$channel->stillImageName}}" width="50px" height="50px" alt="StillImage"></td>
								<!-- <td>{{$channel->under19Content}}</td> -->
								<td>
									@if ($channel->genreCd > 0)
	                                    {{$channel->genreCd}}
	                                @elseif ($channel->state == 0)
	                                    no exists
	                                @else
	                                    Unknown
	                                @endif
								</td>
								<td>
									@if ($channel->state == 1)
	                                    accept
	                                @elseif ($channel->state == 0)
	                                    not allowed
	                                @else
	                                    Admin
	                                @endif
								</td>
								<td>{{$channel->updated_at}}</td>
								<td>
									<a href="/categories/{{$channel->id}}" class="btn btn-sm btn-success">View</a>
									<a href="/categories/{{$channel->id}}/edit" class="btn btn-sm btn-info">Edit</a>
									<a class="btn btn-sm btn-danger delbtn" data-id="{{ $channel->id}}" data-name="{{ $channel->cdName}}">Delete</a>
								</td>
							</tr>
							@empty
							<tr><td colspan="10">No Channel</td></tr>
							@endforelse
						</tbody>
					</table>
					</div>
					<div>
						{{ $channels->links() }}
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
                $('#delform').attr('action','/categories/' + $(this).data('id'));
                $('#delform').submit();
            }
        });
    });
</script>
@endsection

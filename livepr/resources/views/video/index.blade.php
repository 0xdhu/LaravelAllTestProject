@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card card-default">
				<div class="card-header">Videos List</div>
				
				<div class="card-body">
					<div class="form-group">
						<span>Total records: {{$videos->total()}}</span>
					</div>
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>CategoryName</th>
								<th>ChannelName</th>
								<th>ChannelImage</th>
								<th>Videos</th>
								<th>Updated_at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=($videos->currentPage()-1) * $videos->perPage() + 1; ?>
							@forelse($videos as $video)
							<tr style="@if($video->state == 1) color: red; font-weight: bold; @endif">
								<td>{{$i++}}</td>
								<td>{{$video->genreCd}}</td>
								<td>{{$video->channelName}}</td>
								<td><img src="{{$video->stillImageName}}" width="50px" height="50px" alt="StillImage"></td>
								<td>
									@if ($video->state > 0)
	                                    Exists
	                                @elseif ($video->state == 0)
	                                    no exists
	                                @else
	                                    Unknown
	                                @endif
								</td>
								<td>{{$video->updated_at}}</td>
								<td>
									<!-- <a href="/videos/{{$video->id}}" class="btn btn-sm btn-success">View</a> -->

									<a href="/videos/{{$video->id}}/edit" class="btn btn-sm btn-info">Edit</a>
									<!-- <a class="btn btn-sm btn-danger delbtn" data-id="{{ $video->vid}}" data-name="{{ $video->channelName}}">Delete</a> -->
								</td>
							</tr>
							@empty
							<tr><td colspan="7">No video</td></tr>
							@endforelse
						</tbody>
					</table>
					</div>
					<div>
						{{ $videos->links() }}
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

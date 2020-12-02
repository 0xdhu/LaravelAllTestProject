@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card card-primary">
				<div class="card-header">Create user</div>
				<div class="card-body">
					<!-- @component('layouts.alert')
						@slot('title')
							Forbidden
						@endslot
					 	Whoops <strong>Error</strong>!
					@endcomponent -->
					<form method="POST" action="/users">
						@csrf
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" value="123456789" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">State</label>
                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                    <option value="1">Allow</option>
                                    <option value="0">No Allow</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <a href="/users" class="btn btn-warning">Back</a>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>	
</div>
@endsection

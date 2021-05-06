@extends('layouts.app')

@section('content')
    <form action="{{ route('users.update', ['user' => $user]) }}" class="form-horizontal" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img src="" alt="user image" class="img-thumbnail avatar rounded">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input class="form-control-file" name="avatar" type="file">
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" id="name" name="name" value="" type="text">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Save Changes">
                </div>
            </div>
        </div>
    </form>
@endsection

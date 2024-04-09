@extends('admin.index')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Sửa thông tin trường học</h3>
    </div>
    <form action="{{ route('school.update' , ['school' => $school->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $school->name }}">
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="{{ $school->address }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@extends('admin.index')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Sửa thông tin lớp học</h3>
    </div>
    <form action="{{ route('classes.update' , ['class' => $class->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>School</label>
                <select class="form-control" name="school">
                    @foreach ($schools as $key => $school)
                        <option value="{{ $school->id }}" @if ($school->id == $class->school_id) selected @endif>
                            {{ $school->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $class->name }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
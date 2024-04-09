@extends('admin.index')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm lớp học</h3>
        </div>
        <form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>School</label>
                    <select class="form-control" name="school">
                        <option>Chọn trường</option>
                        @foreach ($schools as $key => $school)
                            <option value="{{ $school->id }}">
                                {{ $school->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Class Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

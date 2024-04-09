@extends('admin.index')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm học sinh</h3>
        </div>
        <form action="{{ route('student.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="card-body">
                <label>Quyền cuả tài khoản</label>
                <div class="row">
                    @foreach ($roles as $key => $role)
                        <div class="form-group col-sm-3 ">
                            <div class="form-check">
                                <input class="form-check-input" name="role[]" type="checkbox" value="{{ $role->id }}"
                                    @foreach ($role_user as $key => $val)
                                    @if ($role->id == $val) checked @endif @endforeach>
                                <label class="form-check-label">{{ $role->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection

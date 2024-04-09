@extends('admin.index')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sửa thông tin giáo viên</h3>
        </div>
        <form action="{{ route('teacher.update', ['teacher' => $teacher->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $teacher->name }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $teacher->email }}" readonly >
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $teacher->address }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $teacher->phone }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" class="form-control" name="birthday" value="{{ $teacher->birthday }}">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Account</label>
                    <select class="form-control" name="account">
                        @foreach ($accounts as $key => $account)
                            <option @if ($teacher->account_id == $account->id) selected @endif value="{{ $account->id }}">
                                {{ $account->name }}</option>
                        @endforeach
                    </select>
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
                                    @if ($role->id == $val->role_id) checked @endif @endforeach>
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

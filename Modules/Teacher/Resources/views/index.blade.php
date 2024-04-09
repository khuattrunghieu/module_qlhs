@extends('admin.index')

@section('content')
    <div class="row m-1">
        <div class="float-left">
            <a href="{{ route('teacher.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Thêm</a>
        </div>
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('teacher.index') }}">
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" name='search'
                        placeholder="Type your keywords here">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Birthday</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        {{-- @dd($teachers->items());die; --}}

        <tbody>
            @foreach ($teachers->items() as $key => $teacher)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->address }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->birthday }}</td>
                    <td>
                        <a href="{{ route('teacher.edit', ['teacher' => $teacher->id]) }}" class="btn btn-success">Sửa</a>
                        <button class="btn-delete btn btn-danger"
                            data-href="{{ route('teacher.destroy', ['teacher' => $teacher->id]) }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $teachers->links() }}
@endsection

@section('cjs')
    <script>
        $('.btn-delete').click(function() {
            if (confirm('Bạn chắc chắn xóa?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).attr('data-href');
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: "json",
                    success: function(data) {
                        if (data.result) {
                            location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection

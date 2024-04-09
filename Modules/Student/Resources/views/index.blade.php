@extends('admin.index')

@section('content')
    <div class="row m-1">
        <div class="float-left">
            <a href="{{ route('student.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Thêm</a>
        </div>
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('student.index') }}">
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
        
        <tbody>
            @foreach ($students->items() as $key => $student)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->birthday }}</td>
                    <td>
                        <a href="{{ route('student.edit', ['student' => $student->id]) }}" class="btn btn-success">Sửa</a>
                        <button class="btn-delete btn btn-danger"
                            data-href="{{ route('student.destroy', ['student' => $student->id]) }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $students->links() }}
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

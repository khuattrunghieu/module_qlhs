@extends('admin.index')

@section('content')
    <div class="row m-1">
        <div class="float-left">
            <a href="{{ route('classes.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Thêm</a>
        </div>

        <div class="col-md-8 offset-md-2">
            <form action="{{ route('classes.index') }}">
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
                <th scope="col">Trường học</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes->items() as $key => $class)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->classSchool->name }}</td>
                    <td>
                        <a href="{{ route('classes.edit', ['class' => $class->id]) }}" class="btn btn-success">Sửa</a>
                        <button class="btn-delete btn btn-danger"
                            data-href="{{ route('classes.destroy', ['class' => $class->id]) }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
                    type: 'DELETE',
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result) {
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi Ajax:', error);
                        alert('Bạn không có quyền');
                    }
                });
            }
        });
    </script>
@endsection

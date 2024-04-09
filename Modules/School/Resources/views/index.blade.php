@extends('admin.index')

@section('content')
    <div class="row m-1">
        <div class="float-left">
            <a href="{{ route('school.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Thêm</a>
        </div>
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('school.index') }}">
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
                <th scope="col">Lớp trực thuộc</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($schools->items()) --}}
            @foreach ($schools->items() as $key => $school)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->address }}</td>
                    <td>
                        @foreach ($school->schoolClass as $key => $class)
                            <div class="mr2">{{ $class->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('school.edit', ['school' => $school->id]) }}" class="btn btn-success">Sửa</a>
                        <button class="btn-delete btn btn-danger"
                            data-href="{{ route('school.destroy', ['school' => $school->id]) }}">Xóa</button>
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

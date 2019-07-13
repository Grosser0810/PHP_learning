@extends('admin-panel')

@section('content')
    <a href="{{ route('categories.create') }}"
       class="btn btn-primary">Создать категорию</a>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Редактирование</th>
            <th>Удаление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->category }}</td>
                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">Редактировать</a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}

@endsection
@extends('admin-panel')

@section('content')
    <a href="{{ route('products.create') }}"
       class="btn btn-primary">Создать продукт</a>
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
                <th>Ссылка</th>
                <th>Цена</th>
                <th>Наличие</th>
                <th>Активность</th>
                <th>Редактирование</th>
                <th>Удаление</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->url }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->active }}</td>
                <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Редактировать</a></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{ $products->links() }}
@endsection
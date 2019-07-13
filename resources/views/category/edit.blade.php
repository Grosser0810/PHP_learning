@extends('admin-panel')

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-lg-6">
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="">Новое название категории</label>
                    <input type="text" class="form-control" name="category" value="{{$category->category}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Изменить категорию</button>
                </div>
            </form>
        </div>
    </div>
@endsection
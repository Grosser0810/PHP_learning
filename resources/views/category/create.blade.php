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
            <form action="{{ route('categories.store') }}"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Название категории</label>
                    <input type="text" class="form-control" name="category">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Создать категорию</button>
                </div>
            </form>
        </div>
    </div>
@endsection

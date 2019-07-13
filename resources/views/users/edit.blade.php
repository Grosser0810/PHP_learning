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
                    <div>


            @endif
        <div class="col-lg-6">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="">Новый Login</label>
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="">Новый Email</label>
                    <input type="text" class="form-control" name="email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="">Новый Password</label>
                    <input type="text" class="form-control" name="password" value="{{$user->password}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Изменить пользователя</button>
                </div>
            </form>
        </div>
    </div>
@endsection
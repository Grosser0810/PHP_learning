@extends('layout')
@section('content')

    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif
    @if(session('status'))
        {{session('status')}}
        @endif
    <form action="/login" method="post">
        <h1>Log In</h1>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group col-6">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="Enter email">

        </div>
        <div class="form-group col-6">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>

@endsection
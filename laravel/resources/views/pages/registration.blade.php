@extends('layout')
@section('content')
    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif

    <form action="/registration" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-6">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}">

        </div>
        <div class="form-group col-6">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="Enter email">

        </div>
        <div class="form-group col-6">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>

@endsection
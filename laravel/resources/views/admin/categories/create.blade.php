@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Добавить категорию
            <small>приятные слова..</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <form action="http://laravel/admin/categories" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{--добавить токен--}}

            <div class="box-header with-border">
                <h3 class="box-title">Добавляем категорию</h3>
                @if($errors->any())
                    <div>
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                    </div>
                    @endif

            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <button class="btn btn-success pull-right">Добавить</button>
            </div>
            <!-- /.box-footer-->
            </form>
        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
@endsection

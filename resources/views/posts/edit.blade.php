@extends('layouts.MasterLayout')

@section('content')

    <h1>Edit Page</h1>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{--<form method = "post" action="/posts/{{$it->id}}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value = "PUT">

        <input type="text"  name = "title" placeholder="Enter title" value = {{$it->title}}>
        <input type="submit"  name = "Submit" value = "Update">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>--}}


    {{--<form method = "post" action="/posts/{{$it->id}}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value = "DELETE">

        <input type="submit"  name = "Submit" value = "Delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>--}}



    {!! Form::model($it , ['method'=>'PATCH','action'=>['PostsController@update' , $it->id]])!!}
{{--
    {!! Form::open(['method'=>'PATCH','action'=>['PostsController@update' , $it->id]])!!}
--}}

        <div class="form-group">

            {!! Form::label('label' , 'Title: ') !!}
            {!! Form::text('title' , $it->title , ['class'=>'form-control']) !!}
            {!! Form::submit('Update' , ['class'=>'btn btn-property']) !!}

        </div>

    {!! Form::close() !!}




    {!! Form::open(['method'=>'DELETE','action'=>['PostsController@destroy' , $it->id]])!!}

        <div class="form-group">

            {!! Form::submit('Delete' , ['class'=>'btn btn-property']) !!}

        </div>

    {!! Form::close() !!}

@endsection
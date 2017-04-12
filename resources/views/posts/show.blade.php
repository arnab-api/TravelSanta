@extends('layouts.MasterLayout')
@section('content')
    <h1>
        {{--<a href="{{route('posts.edit' , $posts->id)}}">--}}
        <a href='/contact'>
            {{$posts->title}}
        </a>
    </h1>
@endsection
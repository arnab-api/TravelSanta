@extends('layouts.MasterLayout')

@section('content')

    <ul>
        @foreach($posts as $p)
            <li>
                <a href="{{route('posts.show' , $p->id)}}">
                    {{$p->title." ".$p->review}}
                </a>
            </li>
        @endforeach
    </ul>

@endsection
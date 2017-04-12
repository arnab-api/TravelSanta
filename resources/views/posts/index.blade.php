@extends('layouts.MasterLayout')

@section('content')

    <ul>
        @foreach($posts as $p)

            <div class="image-container">
                <img src="{{$p->path}}" alt="" height = 100>
            </div>

            <li>
                <a href="{{route('posts.show' , $p->id)}}">
                    {{$p->title." ".$p->review}}
                </a>
            </li>
        @endforeach
    </ul>

@endsection
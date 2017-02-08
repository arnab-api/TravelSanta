@extends('layouts.MasterLayout')

@section('content')
    <h1>You are in contact page</h1>
    
    @if(count($people))
    
    <ul>
        @foreach($people as $person)
            <li>{{$person}}</li>
        @endforeach
    </ul>
    
    @else 
    
        <li>Nothing to show<li>
    
    @endif
    

@stop

@section('footer')
<!--<script>alert('Hello Visitor')</script>-->
@stop
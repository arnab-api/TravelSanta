@extends('layouts.MasterLayout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <form method = "post" action="/posts">
        <input type="text"  name = "title" placeholder="Enter title">
        <input type="submit"  name = "Submit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    
    
    @yield('footer')
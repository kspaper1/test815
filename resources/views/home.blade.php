@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                Note: Date Range is only 2020-06-01 - 2020-07-06 from the given Excel
            </div>
        </div>
        <router-view></router-view>
    </div>
@endsection

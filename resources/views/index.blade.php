@extends('layout.app')


@section('container')
    <div class="container" style="margin-top: 20px">    
        <div class="content">
            @livewire('calculator')    
        </div>
    </div>
@endsection
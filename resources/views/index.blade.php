@extends('layouts.app')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <example-component></example-component>
    
                <a href="#">this is a link</a>
    
                <h1>Darkly</h1>
                <div>
                    <a href="#" class="btn btn-primary">Primary</a>
                    <a href="#" class="btn btn-secondary">Secondary</a>
                    <a href="#" class="btn btn-success">Success</a>
                    <a href="#" class="btn btn-info">Info</a>
                    <a href="#" class="btn btn-warning">Warning</a>
                    <a href="#" class="btn btn-danger">Danger</a>
                </div>
            </div>
        </div>
    </div>

@endsection
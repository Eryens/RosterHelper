@extends('layouts.app')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <order-list></order-list>

                <display-order></display-order>
            </div>
        </div>
    </div>

@endsection
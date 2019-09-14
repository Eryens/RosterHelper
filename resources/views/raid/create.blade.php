@extends('layouts.app')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <h4>Add a new Raid</h4>

                {!! Form::open(['action' => 'RaidController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
            
                        <br />

                        {{Form::label('currentRaid', 'Current raid')}}
                        {{Form::checkbox('currentRaid','', true)}}
                    </div>
            
                    {{Form::submit('Create', ['class' => 'btn btn-success'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
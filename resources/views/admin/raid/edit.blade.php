@extends('layouts.app')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{$raid->name}}</h4>
                <div class="form-group">
                    {!! Form::open(['action' => ['RaidController@update', $raid->id], 'method' => 'POST']) !!}
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', $raid->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        
                    <br />

                    {{Form::label('currentRaid', 'Current raid')}}
                    {{Form::checkbox('currentRaid', $raid->currentRaid, $raid->currentRaid)}}

                    <div class="row">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Edit Raid parameters', ['class' => 'btn btn-warning'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- <div class="row">
                    
                    <div class="col-lg-1" style="">
                        {!!Form::open(['action' => ['RaidController@destroy', $raid->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete this raid', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </div>
                </div> --}}
            </div>
        </div>
        <boss-list v-bind:id-raid="{{$raid->id}}"></boss-list>
    </div>

@endsection
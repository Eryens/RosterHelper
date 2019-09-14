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
                </div>
        
                {{Form::hidden('_method', 'PUT')}}

                <div class="row">
                    <div class="col-lg-11">
                        {{Form::submit('Edit', ['class' => 'btn btn-warning'])}}
                    </div>
                    {!! Form::close() !!}
                    <div class="col-lg-1" style="">
                        {!!Form::open(['action' => ['RaidController@destroy', $raid->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        @include('raid.boss.boss-list')
    </div>

@endsection

@section('js')

<script type="text/javascript" defer>
    $(function() {
        console.log( "ready!" );
    });
</script>

@endsection
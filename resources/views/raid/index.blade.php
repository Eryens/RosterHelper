@extends('layouts.app')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('raid.create')}}" class="btn btn-success">Add a raid</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- @if(count($raids) > 0) --}}
                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="">Name</th>
                                    <th class="td-action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($raids as $raid)
                                    <tr>
                                        <td>{{$raid->name}}</td>
                                        <td class="td-action">
                                            <a href="/raids/{{$raid->id}}/edit" class="btn btn-warning btn-action"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                {{-- @endif --}}
            </div>
        </div>
    </div>

@endsection
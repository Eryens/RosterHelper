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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="">Name</th>
                            <th class="td-action">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cool</td>
                            <td class="td-action">
                                <a href="" class="btn btn-warning btn-action"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger btn-action"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
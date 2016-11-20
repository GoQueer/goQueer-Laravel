@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Location List</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>X</th>
            <th>Y</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($locations as $key => $location)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $location->name }}</td>
                <td>{{ $location->description }}</td>
                <td>{{ $location->x }}</td>
                <td>{{ $location->y }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('location.show',$location->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('location.edit',$location->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['location.destroy', $location->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $locations->render() !!}
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('location.create') }}"> Create New Location</a>
    </div>
@endsection
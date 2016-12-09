@extends('dashboard')

@section('section')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Media List</h2>
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
            <th>ID</th>
            <th>Name</th>
            <th>Source</th>
            <th>Description</th>
            <th>File Name</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($medias as $key => $media)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $media->name }}</td>
                <td>{{ $media->source }}</td>
                <td>{{ $media->description }}</td>
                <td>{{ $media->filePath }}</td>

                <td>
                    <a class="btn btn-info" href="{{ route('media.show',$media->id) }}">Show</a>

                    {!! Form::open(['method' => 'DELETE','route' => ['media.destroy', $media->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $medias->render() !!}
    <div class="text-center">
        <a class="btn btn-success" href="{{ route('media.create') }}"> Add New Media</a>
    </div>
@endsection
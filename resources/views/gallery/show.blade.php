@extends('dashboard')

@section('section')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Gallery: {{ $gallery->name }}</h2>
            </div>

        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $gallery->description }}
            </div>
        </div>
    </div>





    <br>
    <br>
    <hr/>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Source</th>
            <th>Publish Date</th>
            <th>Description</th>
        </tr>
        @foreach ($medias as $key => $media)
            <tr>
                <td><div style="height:20px; overflow:hidden">{{ $media->id }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $media->name }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $media->source }}</div></td>
                <td><div style="height:20px;width:80px; overflow:hidden">{{ $media->date }}</div></td>
                <td><div style="height:20px;width:250px; overflow:hidden">{{ $media->description }}</div></td>

                <td>
                    <a class="btn btn-success" href="{{ route('gallery_media.create',Array('media_id' =>$media->id,'gallery_id' => $id)) }}">Add</a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr/>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Back</a>
    </div>















@endsection
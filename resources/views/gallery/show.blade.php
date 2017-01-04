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

    <hr/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3> Assigned Media</h3>
            </div>

        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Source</th>
            <th>Publish Date</th>
            <th>Description</th>
            <th>Action</th>

        </tr>
        @foreach ($assigned_medias as $key => $assigned_media)
            <tr>
                <td><div style="height:20px; overflow:hidden">{{ $assigned_media->finalId }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $assigned_media->name }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $assigned_media->source }}</div></td>
                <td><div style="height:20px;width:80px; overflow:hidden">{{ $assigned_media->date }}</div></td>
                <td><div style="height:20px;width:250px; overflow:hidden">{{ $assigned_media->description }}</div></td>
                <td><div style="height:35px; overflow:hidden">
                        {{--<a class="btn btn-danger" href="{{ route('gallery_media.destroy',Array('gallery_media_id' =>$assigned_media->id, 'gallery_id' => $id)) }}">Delete</a>--}}
                        {!! Form::open(['method' => 'DELETE','route' => ['gallery_media.destroy',Array($assigned_media->finalId,1)],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </td>

            </tr>
        @endforeach
    </table>






    <hr/>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Source</th>
            <th>Publish Date</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach ($all_medias as $key => $all_media)
            <tr>
                <td><div style="height:20px; overflow:hidden">{{ $all_media->id }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $all_media->name }}</div></td>
                <td><div style="height:20px; overflow:hidden">{{ $all_media->source }}</div></td>
                <td><div style="height:20px;width:80px; overflow:hidden">{{ $all_media->date }}</div></td>
                <td><div style="height:20px;width:250px; overflow:hidden">{{ $all_media->description }}</div></td>

                <td><div style="height:35px; overflow:hidden">
                    <a class="btn btn-success" href="{{ route('gallery_media.create',Array('media_id' =>$all_media->id,'gallery_id' => $id)) }}">Add</a>


                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr/>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Back</a>
    </div>















@endsection
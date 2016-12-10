@extends('dashboard')

@section('section')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Media</h2>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Source:</strong>
                {{ $media->source }}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $media->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $media->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File Path:</strong>
                {{ $media->filePath }}
            </div>
        </div>
    </div>



    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('media.index') }}"> Back</a>
    </div>
    <br>
    <br>
    <hr/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h3> Comments</h3>
            </div>

        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Time</th>
            <th>Sender's Name</th>
            <th>Content</th>
        </tr>
        @foreach ($comments as $key => $comment)
            <tr>
                <td width="100px">{{ $comment->created_at }}</td>
                <td width="150px">{{ $comment->name }}</td>
                <td>{{ $comment->content }}</td>
                {{--<td>hii</td>--}}
            </tr>
        @endforeach
    </table>


    {!! Form::open(array('action' => 'MessageController@store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" style="visibility: hidden">
        <div class="form-group">
            {{ Form::hidden('media_id', $media_id, array('id' => 'media_id')) }}
        </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                {!! Form::textarea('message', null, array('placeholder' => 'Leave a Comment','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-block">Send</button>
        </div>
    </div>
    {!! Form::close() !!}











@endsection
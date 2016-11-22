@extends('dashboard')

@section('section')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Add New Media</h2>
            </div>
        </div>
    </div>

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

    {!! Form::open(array('action' => 'MediaController@store','method'=>'POST')) !!}
    <div class="row" >

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Where it came from:</strong>
                {{ Form::select('location_id', $locations) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Which Location it is associated with:</strong>
                {!! Form::text('source', null, array('placeholder' => 'Source','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {!! Form::textarea('address', null, array('placeholder' => 'Address','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>File:</strong>
{{--                {!! Form::text('x', null, array('placeholder' => 'X','class' => 'form-control','id'=>'xCoordinate')) !!}--}}
                {!! Form::file('file', $attributes = array()) !!}
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div  class="container-fluid">
                <strong>Type:</strong>
                {{ Form::select('category', $types) }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('media.index') }}">Back</a>
        </div>

    </div>
    {!! Form::close() !!}



    <script>


    </script>






@endsection
@extends('dashboard')

@section('section')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Set: {{ $set->name }}</h2>
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

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $set->description }}
            </div>
        </div>
    </div>



    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('set.index') }}"> Back</a>
    </div>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Associated Hints:</h2>
            </div>
        </div>
    </div>


    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Content</th>


            <th width="150px">Action</th>
        </tr>
        @foreach ($hints as $key => $hint)
            <tr>
                <td><div style="height:40px; overflow:hidden">{{ ++$i }}</div></td>
                <td><div style="height:40px; overflow:hidden">{{ $hint->content }}</div></td>
                <td><div style="width:200px">
                        {!! Form::open(['method' => 'DELETE','route' => ['hint.destroy', $hint->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>

                </td>
            </tr>
        @endforeach
    </table>



    {!! Form::open(array('action' => 'HintController@store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" style="visibility: hidden">
            <div class="form-group">
                {{ Form::hidden('set_id', $set->id, array('id' => 'set_id')) }}
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                {!! Form::textarea('hint_text', null, array('placeholder' => 'Write your hint here','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-block">Add</button>
        </div>
    </div>
    {!! Form::close() !!}










@endsection
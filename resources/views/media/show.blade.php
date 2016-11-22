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
                <strong>Source</strong>
                {{ $media->source }}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $media->address }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $media->name }}
            </div>
        </div>



    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('media.index') }}"> Back</a>
    </div>

@endsection
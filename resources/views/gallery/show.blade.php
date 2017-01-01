@extends('dashboard')

@section('section')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Gallery: {{ $gallery->name }}</h2>
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $gallery->description }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="favoritesModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="favoritesModalLabel">{{$gallery->name}}</h4>
                </div>
                <div class="modal-body">
                    {{--<img src="{{ URL::to('/uploads/' .    $media->fileName) }}" class="img-responsive" alt="{{$media->name}}">--}}
                    <object  display="inline-block" clear="both"
                             float="left"   data="{{ URL::to('/uploads/' .    $gallery->fileName) }}"></object>

                </div>
                <div class="modal-footer ">
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <br>
    <br>
    <hr/>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Back</a>
    </div>















@endsection
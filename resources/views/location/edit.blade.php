@extends('dashboard')

@section('section')

    <script type="text/javascript" src="{{ URL::asset('js/src/leaflet-src.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/leaflet.css') }}" />
    <script type="text/javascript" src="{{ URL::asset('js/src/Leaflet.draw.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/Leaflet.Draw.Event.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/leaflet.draw.css') }}" />
    <script type="text/javascript" src="{{ URL::asset('js/src/Toolbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/Tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/GeometryUtil.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/LatLngUtil.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/LineUtil.Intersect.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/Polygon.Intersect.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/Polyline.Intersect.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/ext/TouchEvents.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/DrawToolbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Feature.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.SimpleShape.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Polyline.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Circle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Marker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Polygon.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/draw/handler/Draw.Rectangle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/EditToolbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/EditToolbar.Edit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/EditToolbar.Delete.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/Control.Draw.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/Edit.Poly.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/Edit.SimpleShape.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/Edit.Circle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/Edit.Rectangle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/src/edit/handler/Edit.Marker.js') }}"></script>






    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Location</h2>
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

    {!! Form::model($locations, ['method' => 'PATCH','route' => ['location.update', $locations->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Address</strong>
                {!! Form::text('address', null, array('placeholder' => 'address','class' => 'form-control')) !!}

            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Associated Gallery:</strong>
                {!! Form::select('id', $galleries, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-7 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('location.index') }}"> Back</a>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" >
                <div id="mapid1" style="width: 100%; height: 700px"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}



    <script>
        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">Go Queer</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
            map = new L.Map('mapid1', { center: new L.LatLng(53.523631, -113.5335), zoom: 11 }),
            drawnItems = L.featureGroup().addTo(map);
        L.control.layers({'osm': osm.addTo(map), "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',
            {
                attribution: 'google'
            })}, { 'drawlayer': drawnItems },
            { position: 'topleft', collapsed: true }
        ).addTo(map);
        function codeAddress() {
            var table = document.getElementById("coordinateTable");
            for (var i = 1, row; row = table.rows[i]; i++) {

                var json = JSON.parse(row.cells[0].innerText);
                L.geoJSON(json).addTo(map);

            }
        }
        window.onload = codeAddress;
    </script>



@endsection
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
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Where it came from:</strong>
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
            <div class="form-group">
                <strong>Type:</strong>
                {{--{!! Form::text('y', null, array('placeholder' => 'Y','class' => 'form-control','id' => 'yCoordinate')) !!}--}}
                {!! Form::select('size', array('1' => 'Video', '2' => 'Sound','3' => 'Picture' , '4' => 'PDF')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('media.index') }}">Back</a>
        </div>

    </div>
    {!! Form::close() !!}



    <script>

        var mymap = L.map('mapid1').setView([51.505, -0.09], 13);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
            maxZoom: 18,
            attribution: 'Go Queer &copy;' ,
            id: 'mapbox.streets'
        }).addTo(mymap);

        L.marker([51.5, -0.09]).addTo(mymap)
                .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

        L.circle([51.508, -0.11], 500, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5
        }).addTo(mymap).bindPopup("I am a circle.");

        L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(mymap).bindPopup("I am a polygon.");


        var popup = L.popup();

        function onMapClick(e) {
            popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
            var newMarker = new L.marker(e.latlng).addTo(mymap);
            document.getElementById("xCoordinate").value = e.latlng.lat;
            document.getElementById("yCoordinate").value = e.latlng.lng;
        }

        mymap.on('click', onMapClick);


/*
        var greenIcon = L.icon({
            iconUrl: 'leaf-green.png',
            shadowUrl: 'leaf-shadow.png',

            iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        L.marker([51.5, -0.09], {icon: greenIcon}).addTo(mymap);
*/
        var cities = new L.LayerGroup();

        L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.').addTo(cities),
                L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities),
                L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities),
                L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);


        var mbAttr = 'Go Queer &copy;' ,
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
                streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});

        var map = L.map('map', {
            center: [39.73, -104.99],
            zoom: 10,
            layers: [grayscale, cities]
        });

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cities": cities
        };

        L.control.layers(baseLayers, overlays).addTo(map);
/*
        ///////////////////////////////////
        var map, newMarker, markerLocation;
        $(function(){
            // Initialize the map
            var map = L.map('map').setView([38.487, -75.641], 8);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                maxZoom: 18
            }).addTo(map);
            newMarkerGroup = new L.LayerGroup();
            map.on('click', function(e){
                var newMarker = new L.marker(e.latlng).addTo(map);
            });
        });
*/
    </script>






@endsection
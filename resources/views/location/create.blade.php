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
                <h2>Create New Location</h2>
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
            <div class="col-lg-12 margin-tb">
                <div class="form-group" >
                    <strong>Select the Area:</strong>
                    <div id="mapid1" style="width: 100%; height: 600px;border: 2px solid black"></div>
                </div>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-lg-12 margin-tb">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Select the Coordinate:</strong>--}}
                {{--<div id="map" style="width: 100%; height: 800px;"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    {!! Form::open(array('action' => 'LocationController@store','method'=>'POST')) !!}


    <div class="row">


        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Title:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Enter the name of the place','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Address:</strong>
                {!! Form::text('address', null, array('placeholder' => 'Enter the full address here','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Enter additional information','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Coordinates:</strong>
                {!! Form::text('coordinates', null, array('placeholder' => 'Selected Coordinates','class' => 'form-control','id'=>'coordinates','readonly    php ')) !!}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('location.index') }}">Back</a>
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
            { position: 'topleft', collapsed: false }
        ).addTo(map);
    map.addControl(new L.Control.Draw({
        edit: {
            featureGroup: drawnItems,
            poly: {
                allowIntersection: false
            }
        },
        draw: {
            polygon: {
                allowIntersection: false,
                showArea: true
            }
        }
    }));
    map.on(L.Draw.Event.CREATED, function (event) {
        var layer = event.layer;
        drawnItems.addLayer(layer);
    });
    var myLayer = L.geoJSON().addTo(map);
    myLayer.addData(geojsonFeature);

//    function onMapClick(e) {
//       console.log('hi');
//        document.getElementById("coordinates").value += "(" + e.latlng.lat +"," + e.latlng.lng +")";
//        document.getElementById("yCoordinate").value = e.latlng.lng;
//        var coordinates = new Array(e.latlng.lat, e.latlng.lng);
//    }
    map.on('click', onMapClick);

//    map.on('draw:created', function (e) {
//        console.log('created')
//    })
    map.on('draw:edited', function (e) {
        console.log('edited')
    });
    map.on('draw:deleted', function (e) {
        document.getElementById("coordinates").value ="No Polygon Selected";
    });
//    map.on('draw:created', function (e) {
//        var type = e.layerType,
//                layer = e.layer;
//
//        if (type === 'polygon') {
//            var points = layer._latlngs;
//            console.log(points);
//            var geojson = layer.toGeoJSON();
//            console.log(geojson);
////            document.getElementById("coordinates").value = points;
//            document.getElementById("coordinates").value = geojson.stringify();
//        }
//        drawnItems.addLayer(layer);
//    });
    map.on('draw:created', function (e) {
        var type = e.layerType,
                layer = e.layer;

        if (type === 'polygon') {
            // here you got the polygon points
            var points = layer._latlngs;

            // here you can get it in geojson format
            var geojson = layer.toGeoJSON();
            document.getElementById("coordinates").value = JSON.stringify(geojson);
        }
        // here you add it to a layer to display it in the map
        drawnItems.addLayer(layer);
    });



    //        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
//            maxZoom: 18,
//            attribution: 'Go Queer &copy;' ,
//            id: 'mapbox.streets'
//        }).addTo(mymap);
//        var popup = L.popup();
//        var allcoordinates = new Array();
//        var lastPolygon ;
//        var markers = new L.FeatureGroup();
//        function onMapClick(e) {
//            mymap.removeLayer(markers);
//            popup
//                    .setLatLng(e.latlng)
//                    .setContent("You clicked the map at " + e.latlng.toString())
//                    .openOn(mymap);
//            var newMarker = new L.marker(e.latlng);
//            markers.addLayer(newMarker);
//            document.getElementById("xCoordinate").value = e.latlng.lat;
//            document.getElementById("yCoordinate").value = e.latlng.lng;
//            var coordinates = new Array(e.latlng.lat, e.latlng.lng);
//            allcoordinates.push(coordinates);
//            lastPolygon = L.polygon(allcoordinates);
//            markers.addLayer(lastPolygon)
//            //lastPolygon.addTo(mymap);
//            mymap.addLayer(markers);
//        }
//
//        mymap.on('click', onMapClick);

        // create a map in the "map" div, set the view to a given place and zoom
        //var map = L.map('map').setView([175.30867, -37.77914], 13);

        // add an OpenStreetMap tile layer
//        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
//            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
//        }).addTo(mymap);
//        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
//            maxZoom: 18,
//            attribution: 'Go Queer &copy;' ,
//            id: 'mapbox.streets'
//        }).addTo(mymap);

        // Initialize the FeatureGroup to store editable layers
//        var drawnItems = new L.FeatureGroup();
//        mymap.addLayer(drawnItems);
//
//        // Initialize the draw control and pass it the FeatureGroup of editable layers
//        var drawControl = new L.Control.Draw({
//            edit: {
//                featureGroup: drawnItems
//            }
//        });
//        mymap.addControl(drawControl);
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
//        var cities = new L.LayerGroup();
//
//        L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.').addTo(cities),
//                L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities),
//                L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities),
//                L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);
//
//
//        var mbAttr = 'Go Queer &copy;' ,
//                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
//
//        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
//                streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});
//
//        var map = L.map('map', {
//            center: [39.73, -104.99],
//            zoom: 10,
//            layers: [grayscale, cities]
//        });
//
//        var baseLayers = {
//            "Grayscale": grayscale,
//            "Streets": streets
//        };
//
//        var overlays = {
//            "Cities": cities
//        };
//
//        L.control.layers(baseLayers, overlays).addTo(map);
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
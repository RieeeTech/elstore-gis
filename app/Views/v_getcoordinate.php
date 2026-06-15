<div class="row">
    <div class="col-6">
        <div class="from-group">
            <label>Latitude</label>
            <input class="form-control" name="latitude" id="Latitude">
        </div>
    </div>

    <div class="col-6">
        <div class="from-group">
            <label>Longitude</label>
            <input class="form-control" name="longitude" id="Longitude">
        </div>
    </div>

    <div class="col-12">
        <div class="from-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi">
        </div>
    </div>

    <div class="col-12">
        <br>
        <div id="map" style="width: 100%; height: 100vh;"></div>
    </div>
</div>




<script>

    var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        attribution: '© Google Maps',
        maxZoom: 20,
    });

    var peta2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://carto.com/attributions">CARTO</a>'
    });

    var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Map data &copy; <a href="https://www.arcgis.com/">ArcGIS</a>'
    });

    var peta6 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    var peta7 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    const map = L.map('map', {
    center: [2.9836267951872615, 99.62783500071109],
    zoom: 16,
    layers: [peta3] 
});

const baseLayers = {

    'Google': peta1,
    'Satellite': peta2,
    'OSM': peta3,
    'Carto': peta4,
    'ESRI': peta5,
    'Hybrid': peta6,
    'Teranin': peta7,
};

const layerControl = L.control.layers(baseLayers, null, {collapsed: false}).addTo(map);


    //Get Coordinate
    var latInput = document.querySelector("[name=latitude]");
    var lngInput = document.querySelector("[name=longitude]");
    var posisi = document.querySelector("[name=posisi]");
    var curLocation = [2.9836267951872615, 99.62783500071109];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: true,
    });

    //Mengambil Coordinate Saat Marker Di Pindah
    marker.on('draggend', function (e) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            curLocation,
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng);
        $("#Posisi").val(position.lat + ',' + position.lng);
    });

    //Mengambil Coordinate Saat Di Click
    map.on('click', function (e){
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        latInput.value = lat;
        lngInput.value = lng;
        posisi.value = lat + ',' + lng;

    });

    map.addLayer(marker);
</script>
















<!-- <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label>Latitude</label>
            <input class="form-control" name="latitude" id="Latitude" readonly>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>Longitude</label>
            <input class="form-control" name="longitude" id="Longitude" readonly>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi" readonly>
        </div>
    </div>

    <div class="col-12">
        <button type="button" onclick="getLocation()" class="btn btn-primary">
            Gunakan Lokasi Saya
        </button>
    </div>

    <div class="col-12 mt-2">
        <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ================= BASEMAP =================
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

    var googleStreets = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20
    });

    var googleSatellite = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    // ================= INIT MAP =================
    var curLocation = [-1.438009, 119.739598];

    var map = L.map('map', {
        center: curLocation,
        zoom: 6,
        layers: [osm]
    });

    var baseMaps = {
        "OSM": osm,
        "Google Streets": googleStreets,
        "Satellite": googleSatellite
    };

    L.control.layers(baseMaps).addTo(map);

    // ================= INPUT =================
    var latInput = document.getElementById("Latitude");
    var lngInput = document.getElementById("Longitude");
    var posisi = document.getElementById("Posisi");

    function setInput(lat, lng) {
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
        posisi.value = lat.toFixed(6) + "," + lng.toFixed(6);
    }

    // ================= MARKER =================
    var marker = L.marker(curLocation, { draggable: true }).addTo(map);
    setInput(curLocation[0], curLocation[1]);

    marker.on('dragend', function () {
        var pos = marker.getLatLng();
        setInput(pos.lat, pos.lng);
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        setInput(e.latlng.lat, e.latlng.lng);
    });

    // ================= GEOLOCATION FIX =================
    window.getLocation = function () {

        if (!navigator.geolocation) {
            alert("Browser tidak mendukung geolocation");
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function (position) {

                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                var latlng = [lat, lng];

                map.setView(latlng, 16);
                marker.setLatLng(latlng);
                setInput(lat, lng);

            },
            function (error) {

                console.log(error);

                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Izin lokasi ditolak. Aktifkan GPS & permission browser.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Lokasi tidak tersedia.");
                        break;
                    case error.TIMEOUT:
                        alert("Request lokasi timeout.");
                        break;
                    default:
                        alert("Error tidak diketahui: " + error.message);
                        break;
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    };

    // ================= GEOJSON =================
    $.getJSON("<?= base_url('provinsi/11.geojson') ?>", function (data) {
        L.geoJSON(data, {
            style: {
                color: 'red',
                fillColor: 'red',
                fillOpacity: 0.3
            }
        }).addTo(map);
    });

    $.getJSON("<?= base_url('provinsi/12.geojson') ?>", function (data) {
        L.geoJSON(data, {
            style: {
                color: 'pink',
                fillColor: 'pink',
                fillOpacity: 0.3
            }
        }).addTo(map);
    });

});
</script> -->
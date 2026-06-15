<!-- ================= INPUT KOORDINAT ================= -->
<div style="padding:10px;">
    <label><b>Posisi</b></label>
    <input type="text" id="posisi" readonly 
           style="width:100%; padding:8px; margin-top:5px;">
</div>

<!-- ================= MAP ================= -->
<div id="map" style="width: 100%; height: 100vh;"></div>

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
        attribution: '&copy; OpenStreetMap contributors'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19
    });

    var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}');

    var peta6 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var peta7 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    // ================= KOORDINAT KAMPUS =================
    var lat = 2.9794741031746357;
    var lng = 99.63065028061588;

    // tampilkan ke input
    document.getElementById("posisi").value = lat + "," + lng;

    // ================= INIT MAP =================
    const map = L.map('map', {
        center: [lat, lng],
        zoom: 18,
        layers: [peta3],
        zoomControl: true,
        scrollWheelZoom: true
    });

    // ================= LAYER CONTROL =================
    const baseLayers = {
        'Google': peta1,
        'Satellite': peta2,
        'OSM': peta3,
        'Carto': peta4,
        'ESRI': peta5,
        'Hybrid': peta6,
        'Terrain': peta7,
    };

    L.control.layers(baseLayers, null, {collapsed: false}).addTo(map);

    // ================= MARKER =================
    var marker = L.marker([lat, lng]).addTo(map)
        .bindPopup("📍 Kampus 1 Universitas Royal (Lokasi Presisi)")
        .openPopup();

</script>








<!-- <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi">
        </div>
    </div>
</div>
<br>
<div id="map" style="width: 100%; height: 100vh;"></div>

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

    

const baseLayers = {

    'Google': peta1,
    'Satellite': peta2,
    'OSM': peta3,
    'Carto': peta4,
    'ESRI': peta5,
    'Hybrid': peta6,
    'Teranin': peta7,
};


    //Geo Location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else{
        alert ('Geo Location Tidak Support Pada Browser Yang Anda Gunakan!');
    }

    function showPosition(position) {
        document.getElementById("Posisi").value = position.coords.latitude + ',' + position.coords.longitude;

        //menampilkan posisi pada map
        const map = L.map('map', {
        center: [2.9841953741323266,99.6279060737258],
        zoom: 16,
        layers: [peta3] 
    });

    const layerControl = L.control.layers(baseLayers, null, {collapsed: false}).addTo(map);

    //Marker Posisi
    L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
    .bindPopup('Posisi Anda Sekarang')
    .openPopup();
    };

</script> -->

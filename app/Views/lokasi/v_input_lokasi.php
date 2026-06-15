<div class="row">
    <div class="col-sm-8">
        <div id="map"style="width: 100%; height: 100vh;"></div>
    </div>

    <div class="col-sm-4">
        <div class="row">
    <?php
    if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
    ?>
    <?php $errors = \Config\Services::validation()->getErrors(); ?>
    <?php echo form_open_multipart('Lokasi/insertData') ?>

    <div class="from-group">
        <label>Nama Lokasi</label>
        <input class="form-control" name="nama_lokasi">
        <p class="text-danger">
        <?= isset($errors['nama_lokasi']) == isset($errors['nama_lokasi']) ? validation_show_error('nama_lokasi') : ''?>
        </p>
    </div>

    <div class="form-group">
        <label>Alamat Lokasi</label>
        <input class="form-control" name="alamat_lokasi">
        <p class="text-danger">
        <?= isset($errors['alamat_lokasi']) == isset($errors['alamat_lokasi']) ? validation_show_error('alamat_lokasi') : ''?>
        </p>
    </div>

    <div class="form-group">
        <label>Latitude</label>
        <input class="form-control" name="latitude">
        <p class="text-danger">
        <?= isset($errors['latitude']) == isset($errors['latitude']) ? validation_show_error('latitude') : ''?>
        </p>
    </div>

    <div class="form-group">
        <label>Longitude</label>
        <input class="form-control"name="longitude">
        <p class="text-danger">
        <?= isset($errors['longitude']) == isset($errors['longitude']) ? validation_show_error('longitude') : ''?>
        </p>
    </div>

    <div class="form-group">
        <label>Foto Lokasi</label>
        <input type="file" class="form-control" name="foto_lokasi" accept="image/*">
        <p class="text-danger">
        <?= isset($errors['foto_lokasi']) == isset($errors['foto_lokasi']) ? validation_show_error('foto_lokasi') : ''?>
        </p>
    </div>
    <br>
        <button type="submit"class="btn btn-primary">Simpan</button>
        <button type="reset"class="btn btn-warning">Reset</button>

        <?php echo form_close() ?>
    </div>
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

const layerControl = L.control.layers(baseLayers, null, { collapsed: false }).addTo(map);

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
    });

    map.addLayer(marker);

</script>
























<!-- <div class="row">

    <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 100vh;"></div>
    </div>

    <div class="col-sm-4">
        <div class="row">
            <div class="from-group">
                <label>Nama Lokasi</label>
                <input class="form-control" name="nama_lokasi">
            </div>

            <div class="from-group">
                <label>Alamat Lokasi</label>
                <input class="form-control" name="alamat_lokasi">
            </div>

            <div class="from-group">
                <label>Latitude</label>
                <input class="form-control" name="latitude">
            </div>

            <div class="from-group">
                <label>Longitude</label>
                <input class="form-control" name="longitude">
            </div>

            <div class="from-group">
                <label>Foto Lokasi</label>
                <input type="file" class="form-control" name="foto_lokasi" accept="image/*">
            </div>

            <br>
            <div class="row justify-content-center">
                <br>
                <button type="submit" class="btn btn-primary col-sm-5">Simpan</button>
                <div class="col-sm-1"></div>
                <button type="reset" class="btn btn-warning col-sm-5">Reset</button>
            </div>
            
            

        </div>
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
    });

    map.addLayer(marker);


</script> -->


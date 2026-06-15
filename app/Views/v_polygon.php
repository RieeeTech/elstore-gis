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

    const map = L.map('map', {
    center: [2.991268003996933, 99.61431570002802],
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

//Polygon([
L.polygon([
    [2.983619929185453, 99.6721761545466], //titik a
    [2.982904749932276, 99.67214128582904], //titik b
    [2.9829261785308927, 99.67108985988337], //titik c
    [2.983614572039217, 99.67124811021702], //titik d
],{
    color: 'purple',
    weight: 4,
}).addTo(map)
.bindPopup("<img src='<?=base_url('gambar/perumahan.PNG')?>' width='300px'><br>" +
            "<b>Siumbut Umbut, Kec. Kota Kisaran Timur, Kabupaten Asahan, Sumatera Utara</b><br>" +
            "<b>Luas Perumahan : 9.500 m²</b><br>");

</script>
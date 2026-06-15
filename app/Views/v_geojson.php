<div id="map" style="width: 100%; height: 100vh;"></div>

<script>

    var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        attribution: '©️ Google Maps',
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
    center: [-2.175071714812419, 119.35348622521862],
    zoom: 4.4,
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

//GeoJSON
$.getJSON("<?= base_url('provinsi/11.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: 'red',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/12.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: 'purple',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/13.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: 'blue',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/14.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: '#42e9f5',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/15.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: '#e0f542',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/16.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: '#f542d4',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/17.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: '#42f5a4',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/18.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: 'Orange',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/19.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: 'Black',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
    //GeoJSON
$.getJSON("<?= base_url('provinsi/21.geojson') ?>", function (data) {
    L.geoJSON(data, {
    style: function (feature) {
        return {
            color: '#948585',
            fillOpacity: 1,
        }}
        }).addTo(map);
    });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/31.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#8EBA7F',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/32.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#00FFDC',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/33.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#5F2961 ',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/34.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#D9CECE',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//      //GeoJSON
// $.getJSON("<?= base_url('provinsi/35.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#4B827D',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/36.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#Yellow',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/51.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#Red',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/52.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Orange',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/53.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Green',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/61.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'White',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/62.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Blue',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/63.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#FF6161',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/64.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Red',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/65.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Black',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/71.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Purple',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/72.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Yellow',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/73.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#787373',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/74.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#E3D3A8',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/75.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Black',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/76.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#380034',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/81.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Blue',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/82.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Red',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/91.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: 'Pink',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//     //GeoJSON
// $.getJSON("<?= base_url('provinsi/94.geojson') ?>", function (data) {
//     L.geoJSON(data, {
//     style: function (feature) {
//         return {
//             color: '#B5FF99',
//             fillOpacity: 1,
//         }}
//         }).addTo(map);
//     });
//marker koordinat
L.marker([4.5911828980222085, 96.90292510362099])
.addTo(map)
.bindPopup(
"<b>Provinsi : Aceh |</b>" +
"<b> Ibukota : Banda Aceh</b>" +
"<br><img src='<?= base_url('gambar/aceh.jpg')?>' width='250px'>" +
"<br>Luas Wilayah : ±57.956 km²" +
"<br>Jumlah Penduduk : ±5,4 juta jiwa" +
"<br>Gubernur : H. Muzakir Manaf"
);

// //marker koordinat
// L.marker([2.310321608120318, 99.42978050520847])
// .addTo(map)
// .bindPopup(
// "<b>Provinsi : Sumatera Utara |</b>" +
// "<b> Ibukota : Medan</b>" +
// "<br><img src='<?= base_url('gambar/sumut.jpg')?>' width='250px'>" +
// "<br>Luas Wilayah : ±72.981 km²" +
// "<br>Jumlah Penduduk : ± 15juta jiwa" +
// "<br>Gubernur : Bobby Nasution"
// );

//marker koordinat
L.marker([-0.6869387476966385, 100.78771967939977])
.addTo(map)
.bindPopup(
"<b>Provinsi : Sumatera Barat |</b>" +
"<b> Ibukota : Padang</b>" +
"<br><img src='<?= base_url('gambar/sumbar.jpg')?>' width='250px'>" +
"<br>Luas Wilayah : ±42.013 km²" +
"<br>Jumlah Penduduk : ±5,6 juta" +
"<br>Gubernur : Mahyeldi"
);

//marker koordinat
L.marker([0.29082672374212976, 101.7984618927564])
.addTo(map)
.bindPopup(
"<b>Provinsi : Riau |</b>" +
"<b> Ibukota : Pekanbaru</b>" +
"<br><img src='<?= base_url('gambar/riau.jpg')?>' width='250px'>" +
"<br>Luas Wilayah : ±87.023 km²" +
"<br>Jumlah Penduduk : ±6,7 juta" +
"<br>Gubernur : Syamsuar"
);

// //marker koordinat
// L.marker([-1.5215837683130524, 102.40017298189193])
// .addTo(map)
// .bindPopup(
// "<b>Provinsi : Jambi |</b>" +
// "<b> Ibukota : Jambi</b>" +
// "<br><img src='<?= base_url('gambar/jambi.jpg')?>' width='250px'>" +
// "<br>Luas Wilayah : ±50.058 km²" +
// "<br>Jumlah Penduduk : ±3,7 juta" +
// "<br>Gubernur : Al Haris"
// );

// //marker koordinat
// L.marker([-3.2668173457255145, 103.79543664128882])
// .addTo(map)
// .bindPopup(
// "<b>Provinsi : Sumatera Selatan |</b>" +
// "<b> Ibukota : Palembang</b>" +
// "<br><img src='<?= base_url('gambar/sumsel.jpg')?>' width='250px'>" +
// "<br>Luas Wilayah : ±91.592 km²" +
// "<br>Jumlah Penduduk : ±8,6 juta" +
// "<br>Gubernur : Herman Deru"
// );

// //marker koordinat
// L.marker([-4.538250052695594, 105.23464561370025])
// .addTo(map)
// .bindPopup(
// "<b>Provinsi : Lampung |</b>" +
// "<b> Ibukota : Bandar Lampung</b>" +
// "<br><img src='<?= base_url('gambar/lampung.jpg')?>' width='250px'>" +
// "<br>Luas Wilayah : ±35.376 km²" +
// "<br>Jumlah Penduduk : ±9 juta" +
// "<br>Gubernur : Arinal Djunaidi"
// );
// //marker koordinat
// L.marker([1.98044260434859, 106.777657696897])
// .addTo(map)
// .bindPopup(
// "<b>Provinsi : Kepulauan Riau |</b>" +
// "<b> Ibukota : Tanjung Pinang</b>" +
// "<br><img src='<?= base_url('gambar/kepri.jpg')?>' width='250px'>" +
// "<br>Luas Wilayah : ±35.376 km²" +
// "<br>Jumlah Penduduk : ±9 juta" +
// "<br>Gubernur : Arinal Djunaidi"
// );
</script>
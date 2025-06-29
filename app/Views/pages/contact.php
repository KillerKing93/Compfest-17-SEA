<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<!-- Memuat CSS untuk Leaflet.js dan Geosearch -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />

<header class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-bold text-teal-600"><?= esc($title) ?></h1>
    <p class="text-lg text-gray-600 mt-2">Kami senang mendengar dari Anda. Hubungi kami melalui detail di bawah ini.</p>
</header>

<div class="bg-white p-8 rounded-lg shadow-md max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Contact Information -->
        <div class="space-y-6">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Manajer
                </h3>
                <p class="text-gray-600 mt-1 pl-9"><?= esc($contact['manager']) ?></p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Telepon
                </h3>
                <p class="text-gray-600 mt-1 pl-9"><?= esc($contact['phone']) ?></p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                     <svg class="w-6 h-6 text-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Email
                </h3>
                <p class="text-gray-600 mt-1 pl-9"><?= esc($contact['email']) ?></p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Alamat
                </h3>
                <p class="text-gray-600 mt-1 pl-9"><?= esc($contact['address']) ?></p>
            </div>
        </div>

        <!-- Peta Interaktif -->
        <div id="map" class="h-96 w-full rounded-lg shadow-inner z-0"></div>
    </div>
</div>

<!-- Memuat JS untuk Leaflet.js dan Geosearch -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Koordinat untuk lokasi kantor (contoh: Monas, Jakarta)
        const officeLat = -6.175392;
        const officeLng = 106.827153;

        // 1. Inisialisasi Peta
        const map = L.map('map').setView([officeLat, officeLng], 15);

        // 2. Tambahkan Tile Layer (gambar peta dari OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // 3. Tambahkan Marker untuk lokasi kantor
        const officeMarker = L.marker([officeLat, officeLng]).addTo(map)
            .bindPopup('<b>Kantor Pusat SEA Catering</b><br>Jl. Digital Raya No. 17, Jakarta.')
            .openPopup();

        // 4. Tambahkan Kontrol Pencarian
        const searchControl = new L.GeoSearch.GeoSearchControl({
            provider: new L.GeoSearch.OpenStreetMapProvider(),
            style: 'bar', // Tampilan bar pencarian
            showMarker: true, // Tampilkan marker pada hasil pencarian
            showPopup: false, // Jangan tampilkan popup otomatis
            marker: {
                icon: new L.Icon.Default(),
                draggable: false,
            },
            autoClose: true, // Tutup hasil pencarian setelah dipilih
            searchLabel: 'Cari alamat atau tempat...',
        });
        map.addControl(searchControl);
    });
</script>

<?= $this->endSection() ?>

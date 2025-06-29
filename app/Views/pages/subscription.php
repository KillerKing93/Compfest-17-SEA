<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<header class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-bold text-teal-600"><?= esc($title) ?></h1>
    <p class="text-lg text-gray-600 mt-2">Segera hadir! Halaman untuk Anda memulai langganan paket makanan sehat.</p>
</header>

<div class="bg-white p-8 rounded-lg shadow-md text-center">
    <p class="text-gray-700">
        Fitur formulir langganan sedang dalam pengembangan dan akan tersedia di Level 3. 
        Nantikan pembaruan dari kami!
    </p>
    <a href="<?= base_url('menu') ?>" class="mt-6 inline-block bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700 transition duration-300">
        Lihat Menu Kami
    </a>
</div>

<?= $this->endSection() ?>

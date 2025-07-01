<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<div class="text-center bg-white p-8 md:p-16 rounded-lg shadow-lg max-w-3xl mx-auto">
    <svg class="w-24 h-24 text-green-500 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    
    <h1 class="text-4xl font-bold text-gray-800"><?= esc($title) ?>!</h1>
    
    <?php if (session()->getFlashdata('success_message')): ?>
        <p class="text-lg text-gray-600 mt-4">
            <?= esc(session()->getFlashdata('success_message')) ?>
        </p>
    <?php endif; ?>

    <p class="mt-2 text-gray-600">
        Tim kami akan segera menghubungi Anda untuk konfirmasi pembayaran dan detail pengiriman.
    </p>

    <div class="mt-8">
        <a href="<?= base_url('/') ?>" class="bg-teal-600 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-teal-700 transition duration-300">
            Kembali ke Halaman Utama
        </a>
    </div>
</div>

<?= $this->endSection() ?>

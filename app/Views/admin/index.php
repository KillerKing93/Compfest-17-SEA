<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<header class="mb-8">
    <h1 class="text-4xl md:text-5xl font-bold text-teal-600">Admin Dashboard</h1>
    <p class="text-lg text-gray-600 mt-2">Monitor performa bisnis SEA Catering.</p>
</header>

<!-- Filter Tanggal -->
<div class="bg-white p-4 rounded-lg shadow-md mb-8">
    <form action="<?= base_url('admin') ?>" method="get" class="flex flex-col sm:flex-row items-center gap-4">
        <div>
            <label for="start_date" class="text-sm font-medium text-gray-700">Tanggal Mulai:</label>
            <input type="date" id="start_date" name="start_date" value="<?= esc($startDate) ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
        </div>
        <div>
            <label for="end_date" class="text-sm font-medium text-gray-700">Tanggal Akhir:</label>
            <input type="date" id="end_date" name="end_date" value="<?= esc($endDate) ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
        </div>
        <div class="self-end">
            <button type="submit" class="bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700 transition duration-300">Filter</button>
        </div>
    </form>
</div>

<!-- Kartu Metrik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Langganan Baru -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
        <h3 class="text-gray-500 text-sm font-medium uppercase">Langganan Baru</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2"><?= esc($stats['newSubscriptions']) ?></p>
        <p class="text-sm text-gray-500">Dalam rentang waktu yang dipilih</p>
    </div>
    <!-- MRR -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
        <h3 class="text-gray-500 text-sm font-medium uppercase">Monthly Recurring Revenue (MRR)</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">Rp<?= number_format($stats['mrr'], 0, ',', '.') ?></p>
        <p class="text-sm text-gray-500">Dari semua langganan aktif</p>
    </div>
    <!-- Pertumbuhan Langganan -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
        <h3 class="text-gray-500 text-sm font-medium uppercase">Pertumbuhan Langganan</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2"><?= esc($stats['subscriptionGrowth']) ?></p>
        <p class="text-sm text-gray-500">Total langganan aktif saat ini</p>
    </div>
    <!-- Reaktivasi -->
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
        <h3 class="text-gray-500 text-sm font-medium uppercase">Reaktivasi</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2"><?= esc($stats['reactivations']) ?></p>
        <p class="text-sm text-gray-500">(Fitur dalam pengembangan)</p>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<div x-data="{ isModalOpen: false, selectedSubscriptionId: null }">
    <header class="mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-teal-600">User Dashboard</h1>
        <p class="text-lg text-gray-600 mt-2">Kelola langganan makanan sehat Anda di sini.</p>
        <div class="mt-6">
            <a href="<?= base_url('subscription') ?>" class="inline-block bg-teal-600 text-white font-semibold py-2 px-6 rounded-lg shadow hover:bg-teal-700 transition duration-300">
                + Buat Langganan Baru
            </a>
        </div>
    </header>

    <!-- Menampilkan pesan sukses atau error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
            <p><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php endif; ?>

    <div class="space-y-6">
        <?php if (empty($subscriptions)): ?>
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-600">Anda belum memiliki langganan aktif.</p>
                <a href="<?= base_url('subscription') ?>" class="mt-4 inline-block bg-teal-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-300">
                    Mulai Berlangganan
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($subscriptions as $sub): ?>
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 <?= 
                    $sub['status'] === 'active' ? 'border-green-500' : 
                    ($sub['status'] === 'paused' ? 'border-yellow-500' : 'border-red-500') 
                ?>">
                    <div class="grid md:grid-cols-3 gap-4 items-center">
                        <!-- Kolom 1: Info Langganan -->
                        <div>
                            <span class="text-xs font-semibold uppercase px-2 py-1 rounded-full <?= 
                                $sub['status'] === 'active' ? 'bg-green-100 text-green-800' : 
                                ($sub['status'] === 'paused' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                            ?>"><?= esc(ucfirst($sub['status'])) ?></span>
                            <h3 class="text-2xl font-bold mt-2"><?= esc($sub['plan_name']) ?></h3>
                            <p class="text-gray-500">ID: #SUB-<?= esc($sub['id']) ?></p>
                            <?php if ($sub['status'] === 'paused'): ?>
                                <p class="text-sm text-yellow-600">Dijeda hingga: <?= date('d M Y', strtotime($sub['paused_until'])) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Kolom 2: Rincian -->
                        <div class="text-gray-700">
                            <p><strong>Tipe Makanan:</strong> <?= esc(str_replace(',', ', ', $sub['meal_types'])) ?></p>
                            <p><strong>Hari Pengiriman:</strong> <?= esc(str_replace(',', ', ', $sub['delivery_days'])) ?></p>
                            <p class="font-semibold text-lg mt-1">Rp<?= number_format($sub['total_price'], 0, ',', '.') ?> / bulan</p>
                        </div>
                        
                        <!-- Kolom 3: Aksi -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-2 md:space-y-0 md:space-x-2">
                            <?php if ($sub['status'] === 'active'): ?>
                                <button @click="isModalOpen = true; selectedSubscriptionId = <?= $sub['id'] ?>" class="w-full md:w-auto text-center bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-300 text-sm">Jeda</button>
                                <a href="<?= base_url('dashboard/cancel/' . $sub['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin membatalkan langganan ini?')" class="w-full md:w-auto text-center bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 transition duration-300 text-sm">Batalkan</a>
                            <?php elseif ($sub['status'] === 'paused'): ?>
                                 <a href="<?= base_url('dashboard/resume/' . $sub['id']) ?>" class="w-full md:w-auto text-center bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-300 text-sm">Aktifkan Kembali</a>
                            <?php else: // cancelled ?>
                                <p class="text-sm text-red-600 text-center md:text-right">Langganan Dibatalkan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Modal untuk Jeda Langganan -->
    <div x-show="isModalOpen" x-cloak
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div @click.away="isModalOpen = false" 
             class="bg-white rounded-lg shadow-xl w-full max-w-sm"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            
            <form :action="'<?= base_url('dashboard/pause/') ?>/' + selectedSubscriptionId" method="post" class="p-6">
                 <?= csrf_field() ?>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Jeda Langganan</h3>
                <p class="text-gray-600 mb-4">Pilih tanggal sampai kapan Anda ingin menjeda langganan ini.</p>
                <div>
                    <label for="pause_until" class="block text-sm font-medium text-gray-700">Jeda Hingga Tanggal:</label>
                    <input type="date" id="pause_until" name="pause_until" 
                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="isModalOpen = false" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600">Jeda Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

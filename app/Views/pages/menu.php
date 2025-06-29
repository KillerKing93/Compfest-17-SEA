<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<div x-data="{ isModalOpen: false, selectedPlan: {} }">
    <header class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-teal-600"><?= esc($title) ?></h1>
        <p class="text-lg text-gray-600 mt-2">Pilih paket makanan sehat yang sesuai dengan kebutuhan Anda.</p>
    </header>

    <!-- Meal Plan Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($mealPlans as $plan): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <img src="<?= esc($plan['image'], 'attr') ?>" alt="<?= esc($plan['name']) ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800"><?= esc($plan['name']) ?></h3>
                    <p class="text-xl font-semibold text-teal-600 mt-2"><?= esc($plan['price']) ?> / meal</p>
                    <p class="text-gray-600 mt-4 h-24"><?= esc($plan['description']) ?></p>
                    <button @click="isModalOpen = true; selectedPlan = <?= htmlspecialchars(json_encode($plan), ENT_QUOTES, 'UTF-8') ?>" 
                            class="mt-6 w-full bg-teal-600 text-white py-2 px-4 rounded-md hover:bg-teal-700 transition duration-300">
                        Lihat Detail
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal for Meal Plan Details -->
    <div x-show="isModalOpen" x-cloak
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="isModalOpen = false" 
             class="bg-white rounded-lg shadow-xl w-full max-w-2xl transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <div class="p-6 md:p-8">
                <div class="flex justify-between items-start">
                    <h2 class="text-3xl font-bold text-teal-600" x-text="selectedPlan.name"></h2>
                    <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <img :src="selectedPlan.image" :alt="selectedPlan.name" class="w-full h-64 object-cover rounded-md my-4">
                <p class="text-2xl font-semibold text-gray-800" x-text="selectedPlan.price + ' / meal'"></p>
                <p class="text-gray-600 mt-4" x-text="selectedPlan.details"></p>

                <div class="mt-8 text-right">
                    <button @click="isModalOpen = false" class="bg-gray-300 text-gray-800 py-2 px-6 rounded-md hover:bg-gray-400 transition duration-300 mr-2">
                        Tutup
                    </button>
                    <a href="<?= base_url('subscription') ?>" class="bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700 transition duration-300">
                        Langganan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

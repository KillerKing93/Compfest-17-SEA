<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<div x-data='subscriptionForm(<?= json_encode($mealPlans) ?>)'>
    <header class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-teal-600"><?= esc($title) ?></h1>
        <p class="text-lg text-gray-600 mt-2">Isi data di bawah ini untuk memulai hidup sehat bersama kami.</p>
    </header>

    <form action="<?= base_url('subscription/process') ?>" method="post" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?= csrf_field() ?>

        <!-- Kolom Kiri: Detail Pengguna dan Paket -->
        <div class="md:col-span-2 bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Langkah 1: Lengkapi Data Anda</h3>
            
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="full_name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap*</label>
                <input type="text" id="full_name" name="full_name" value="<?= old('full_name', 'Alif Nurhidayat') ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 <?= ($validation->hasError('full_name')) ? 'border-red-500' : '' ?>" required>
                <?php if($validation->hasError('full_name')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('full_name') ?></p>
                <?php endif; ?>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 font-semibold mb-2">Nomor Telepon Aktif*</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?= old('phone_number', '081368898090') ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 <?= ($validation->hasError('phone_number')) ? 'border-red-500' : '' ?>" required>
                 <?php if($validation->hasError('phone_number')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('phone_number') ?></p>
                <?php endif; ?>
            </div>

             <!-- Pilihan Paket -->
            <div class="mb-6">
                <label for="meal_plan_id" class="block text-gray-700 font-semibold mb-2">Pilih Paket*</label>
                <select id="meal_plan_id" name="meal_plan_id" x-model.number="selectedPlanId" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white <?= ($validation->hasError('meal_plan_id')) ? 'border-red-500' : '' ?>" required>
                    <option value="0" disabled>-- Pilih Paket Makanan --</option>
                    <?php foreach($mealPlans as $plan): ?>
                        <option value="<?= $plan['id'] ?>" <?= old('meal_plan_id') == $plan['id'] ? 'selected' : '' ?>><?= esc($plan['name']) ?> - Rp<?= number_format($plan['price'], 0, ',', '.') ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if($validation->hasError('meal_plan_id')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('meal_plan_id') ?></p>
                <?php endif; ?>
            </div>

            <hr class="my-8">

            <h3 class="text-2xl font-bold text-gray-800 mb-6">Langkah 2: Atur Jadwal Anda</h3>

            <!-- Tipe Makanan -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Tipe Makanan* <span class="text-sm font-normal">(pilih minimal satu)</span></label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <?php $mealTypes = ['Breakfast', 'Lunch', 'Dinner']; ?>
                    <?php foreach($mealTypes as $type): ?>
                    <label class="flex items-center p-3 border rounded-lg hover:bg-teal-50 cursor-pointer">
                        <input type="checkbox" name="meal_types[]" value="<?= $type ?>" x-model="selectedMealTypes" class="h-5 w-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 text-gray-700"><?= $type ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
                <?php if($validation->hasError('meal_types')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('meal_types') ?></p>
                <?php endif; ?>
            </div>

            <!-- Hari Pengiriman -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Hari Pengiriman* <span class="text-sm font-normal">(pilih minimal satu)</span></label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                     <?php $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']; ?>
                    <?php foreach($days as $day): ?>
                    <label class="flex items-center p-3 border rounded-lg hover:bg-teal-50 cursor-pointer">
                        <input type="checkbox" name="delivery_days[]" value="<?= $day ?>" x-model="selectedDeliveryDays" class="h-5 w-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 text-gray-700"><?= $day ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
                 <?php if($validation->hasError('delivery_days')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $validation->getError('delivery_days') ?></p>
                <?php endif; ?>
            </div>

            <!-- Alergi -->
            <div class="mb-4">
                <label for="allergies" class="block text-gray-700 font-semibold mb-2">Alergi <span class="text-sm font-normal">(opsional)</span></label>
                <textarea id="allergies" name="allergies" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Contoh: alergi kacang, tidak suka pedas"><?= old('allergies') ?></textarea>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Harga -->
        <div class="md:col-span-1">
            <div class="bg-white p-8 rounded-lg shadow-md sticky top-24">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Rincian Biaya</h3>
                
                <div class="space-y-4 text-gray-600">
                    <div class="flex justify-between">
                        <span>Harga Paket</span>
                        <span class="font-semibold" x-text="formatCurrency(selectedPlanPrice)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tipe Makanan</span>
                        <span class="font-semibold" x-text="selectedMealTypes.length + 'x'"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Hari Pengiriman</span>
                        <span class="font-semibold" x-text="selectedDeliveryDays.length + ' hari/minggu'"></span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <p class="text-sm text-gray-500">Total Biaya Bulanan</p>
                    <p class="text-3xl font-bold text-teal-600" x-text="formatCurrency(totalPrice)"></p>
                </div>

                <button type="submit" class="mt-8 w-full bg-teal-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-teal-700 transition-transform transform hover:scale-105 duration-300 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="!isFormValid()">
                    Langganan Sekarang
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function subscriptionForm(mealPlans) {
        return {
            mealPlans: mealPlans,
            selectedPlanId: <?= old('meal_plan_id', 0) ?>,
            selectedMealTypes: <?= json_encode(old('meal_types', [])) ?>,
            selectedDeliveryDays: <?= json_encode(old('delivery_days', [])) ?>,

            get selectedPlan() {
                return this.mealPlans.find(p => p.id == this.selectedPlanId) || { price: 0 };
            },
            get selectedPlanPrice() {
                return parseFloat(this.selectedPlan.price);
            },
            get totalPrice() {
                if (!this.selectedPlanId || this.selectedMealTypes.length === 0 || this.selectedDeliveryDays.length === 0) {
                    return 0;
                }
                // Formula: Plan Price * Meal Types * Delivery Days * 4.3 (average weeks in a month)
                return this.selectedPlanPrice * this.selectedMealTypes.length * this.selectedDeliveryDays.length * 4.3;
            },
            isFormValid() {
                return this.selectedPlanId > 0 && this.selectedMealTypes.length > 0 && this.selectedDeliveryDays.length > 0;
            },
            formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
            }
        }
    }
</script>

<?= $this->endSection() ?>

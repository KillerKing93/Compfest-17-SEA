<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="text-center bg-white p-8 md:p-12 rounded-lg shadow-md mb-12">
    <h1 class="text-4xl md:text-5xl font-bold text-teal-600">SEA Catering</h1>
    <p class="text-lg md:text-xl text-gray-600 mt-2">"Healthy Meals, Anytime, Anywhere"</p>
    <p class="max-w-3xl mx-auto mt-6 text-gray-700 leading-relaxed">
        Selamat datang di SEA Catering! Kami adalah solusi Anda untuk makanan sehat yang lezat, praktis, dan dapat disesuaikan. Kami mengantarkan kebahagiaan sehat ke seluruh penjuru Indonesia.
    </p>
    <a href="<?= base_url('menu') ?>" class="mt-8 inline-block bg-teal-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-teal-700 transition-transform transform hover:scale-105 duration-300">
        Lihat Paket Makanan
    </a>
</section>

<!-- Success Message Notification -->
<?php if ($session->getFlashdata('success_message')): ?>
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
     class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-md" role="alert">
    <p class="font-bold">Sukses!</p>
    <p><?= esc($session->getFlashdata('success_message')) ?></p>
</div>
<?php endif; ?>

<!-- Testimonials Section -->
<section id="testimonials" class="py-12">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Apa Kata Mereka?</h2>

        <div class="grid md:grid-cols-2 gap-10">
            <!-- Testimonial Slider/Carousel -->
            <div class="bg-white p-8 rounded-lg shadow-md" x-data="{
                activeTestimonial: 0,
                testimonials: <?= htmlspecialchars(json_encode($testimonials), ENT_QUOTES, 'UTF-8') ?>,
                autoplay() {
                    setInterval(() => {
                        this.activeTestimonial = (this.activeTestimonial + 1) % this.testimonials.length;
                    }, 5000);
                }
            }" x-init="autoplay()">
                <div class="relative h-72">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <div x-show="activeTestimonial === <?= $index ?>" x-cloak
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform -translate-x-4"
                             class="absolute w-full text-center">
                            
                            <!-- User Avatar -->
                            <img src="<?= esc($testimonial['avatar'], 'attr') ?>" alt="Avatar dari <?= esc($testimonial['name']) ?>" class="w-20 h-20 rounded-full mx-auto mb-4 border-2 border-teal-200 p-1 object-cover">

                            <!-- Rating -->
                            <div class="flex justify-center mb-4">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <svg class="w-6 h-6 <?= $i < $testimonial['rating'] ? 'text-yellow-400' : 'text-gray-300' ?>" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-600 italic mb-4">"<?= esc($testimonial['review']) ?>"</p>
                            <p class="font-semibold text-teal-600">- <?= esc($testimonial['name']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Testimonial Submission Form -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Bagikan Pengalaman Anda!</h3>
                <form action="<?= base_url('testimonial/add') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label for="customer_name" class="block text-gray-700 font-semibold mb-2">Nama Anda</label>
                        <input type="text" id="customer_name" name="customer_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="review_message" class="block text-gray-700 font-semibold mb-2">Ulasan</label>
                        <textarea id="review_message" name="review_message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required></textarea>
                    </div>
                    <div class="mb-6" x-data="{ rating: 0 }">
                        <label class="block text-gray-700 font-semibold mb-2">Rating</label>
                        <div class="flex items-center space-x-1">
                            <template x-for="star in 5" :key="star">
                                <button type="button" @click="rating = star" class="text-3xl focus:outline-none" :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'">
                                    ★
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="rating" x-model="rating">
                    </div>
                    <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-teal-700 transition duration-300">
                        Kirim Testimoni
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

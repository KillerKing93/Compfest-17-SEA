<?= $this->extend('templates/main_layout') ?>

<?= $this->section('content') ?>

<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
    <h2 class="text-3xl font-bold text-center text-teal-600 mb-8"><?= esc($title) ?></h2>

    <!-- Menampilkan pesan error validasi -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li class="list-disc ml-5"><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('register') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Nama Lengkap -->
        <div class="mb-4">
            <label for="full_name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>
        
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>

        <!-- Password -->
        <div class="mb-4" x-data="{ showPassword: false }">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <div class="relative">
                 <input :type="showPassword ? 'text' : 'password'" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 pr-10" required>
                 <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <button type="button" @click="showPassword = !showPassword" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg x-show="!showPassword" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg x-show="showPassword" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L6.228 6.228"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter, harus mengandung huruf besar, huruf kecil, angka, dan simbol.</p>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-6" x-data="{ showPassword: false }">
            <label for="password_confirm" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
            <div class="relative">
                 <input :type="showPassword ? 'text' : 'password'" id="password_confirm" name="password_confirm" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 pr-10" required>
                 <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <button type="button" @click="showPassword = !showPassword" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg x-show="!showPassword" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg x-show="showPassword" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L6.228 6.228"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-teal-700 transition duration-300">
            Register
        </button>
    </form>

    <p class="text-center text-gray-600 mt-6">
        Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-teal-600 hover:underline font-semibold">Login di sini</a>
    </p>
</div>

<?= $this->endSection() ?>

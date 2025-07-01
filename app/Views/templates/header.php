<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | SEA Catering</title>
    <!-- CSS & JS Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .nav-link-active { color: #0d9488; font-weight: 600; border-bottom: 2px solid #0d9488; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen" x-data="{ isMobileMenuOpen: false }">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="<?= base_url('/') ?>" class="text-2xl font-bold text-teal-600">SEA Catering</a>
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center">
                    <div class="space-x-6">
                        <a href="<?= base_url('/') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'home') ? 'nav-link-active' : '' ?>">Home</a>
                        <a href="<?= base_url('menu') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'menu') ? 'nav-link-active' : '' ?>">Menu</a>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a href="<?= base_url('dashboard') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'dashboard') ? 'nav-link-active' : '' ?>">Dashboard</a>
                        <?php else: ?>
                            <a href="<?= base_url('subscription') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'subscription') ? 'nav-link-active' : '' ?>">Subscription</a>
                        <?php endif; ?>
                        <a href="<?= base_url('contact') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'contact') ? 'nav-link-active' : '' ?>">Contact Us</a>
                        <!-- Admin Link -->
                        <?php if (session()->get('role') === 'admin'): ?>
                             <a href="<?= base_url('admin') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'admin_dashboard') ? 'nav-link-active' : '' ?>">Admin</a>
                        <?php endif; ?>
                    </div>
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-2 ml-6 border-l pl-6">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <span class="text-gray-700">Halo, <?= esc(explode(' ', session()->get('fullName'))[0]) ?>!</span>
                            <a href="<?= base_url('logout') ?>" class="bg-red-500 text-white text-sm py-2 px-4 rounded-md hover:bg-red-600 transition duration-300">Logout</a>
                        <?php else: ?>
                            <a href="<?= base_url('login') ?>" class="text-gray-600 hover:text-teal-600 transition duration-300">Login</a>
                            <a href="<?= base_url('register') ?>" class="bg-teal-600 text-white text-sm py-2 px-4 rounded-md hover:bg-teal-700 transition duration-300">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-600 hover:text-teal-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': isMobileMenuOpen, 'block': !isMobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            <path :class="{'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="isMobileMenuOpen" x-cloak class="md:hidden mt-4 border-t pt-4">
                <a href="<?= base_url('/') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'home') ? 'font-semibold text-teal-600' : '' ?>">Home</a>
                <a href="<?= base_url('menu') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'menu') ? 'font-semibold text-teal-600' : '' ?>">Menu</a>
                 <?php if (session()->get('isLoggedIn')): ?>
                    <a href="<?= base_url('dashboard') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'dashboard') ? 'font-semibold text-teal-600' : '' ?>">Dashboard</a>
                <?php else: ?>
                    <a href="<?= base_url('subscription') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'subscription') ? 'font-semibold text-teal-600' : '' ?>">Subscription</a>
                <?php endif; ?>
                <a href="<?= base_url('contact') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'contact') ? 'font-semibold text-teal-600' : '' ?>">Contact Us</a>
                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="<?= base_url('admin') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'admin_dashboard') ? 'font-semibold text-teal-600' : '' ?>">Admin</a>
                <?php endif; ?>

                <div class="mt-4 pt-4 border-t">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <div class="px-4 py-2">
                            <p class="text-sm text-gray-700">Halo, <?= esc(explode(' ', session()->get('fullName'))[0]) ?>!</p>
                            <a href="<?= base_url('logout') ?>" class="mt-2 w-full text-center block bg-red-500 text-white text-sm py-2 px-4 rounded-md hover:bg-red-600 transition duration-300">Logout</a>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded">Login</a>
                        <a href="<?= base_url('register') ?>" class="mt-2 w-full text-center block bg-teal-600 text-white text-sm py-2 px-4 rounded-md hover:bg-teal-700 transition duration-300">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <main class="container mx-auto p-6 md:p-12 flex-grow">

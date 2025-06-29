<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | SEA Catering</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Style untuk transisi smooth */
        [x-cloak] { display: none !important; }
        .nav-link-active {
            color: #0d9488; /* teal-600 */
            font-weight: 600;
            border-bottom: 2px solid #0d9488;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen" x-data="{ isMobileMenuOpen: false }">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="<?= base_url('/') ?>" class="text-2xl font-bold text-teal-600">SEA Catering</a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="<?= base_url('/') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'home') ? 'nav-link-active' : '' ?>">Home</a>
                    <a href="<?= base_url('menu') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'menu') ? 'nav-link-active' : '' ?>">Menu</a>
                    <a href="<?= base_url('subscription') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'subscription') ? 'nav-link-active' : '' ?>">Subscription</a>
                    <a href="<?= base_url('contact') ?>" class="py-2 px-2 text-gray-600 hover:text-teal-600 transition duration-300 <?= ($activePage === 'contact') ? 'nav-link-active' : '' ?>">Contact Us</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-600 hover:text-teal-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': isMobileMenuOpen, 'block': !isMobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            <path :class="{'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="isMobileMenuOpen" x-cloak 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="md:hidden mt-4">
                <a href="<?= base_url('/') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'home') ? 'font-semibold text-teal-600' : '' ?>">Home</a>
                <a href="<?= base_url('menu') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'menu') ? 'font-semibold text-teal-600' : '' ?>">Menu</a>
                <a href="<?= base_url('subscription') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'subscription') ? 'font-semibold text-teal-600' : '' ?>">Subscription</a>
                <a href="<?= base_url('contact') ?>" class="block py-2 px-4 text-sm hover:bg-teal-50 rounded <?= ($activePage === 'contact') ? 'font-semibold text-teal-600' : '' ?>">Contact Us</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6 md:p-12 flex-grow">

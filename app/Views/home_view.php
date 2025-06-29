<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Memuat Tailwind CSS untuk styling cepat dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto p-6 md:p-12">
        
        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-teal-600"><?= esc($businessName) ?></h1>
            <p class="text-lg md:text-xl text-gray-600 mt-2">"<?= esc($slogan) ?>"</p>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Welcome Section -->
            <section class="bg-white p-8 rounded-lg shadow-md mb-10">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang!</h2>
                <p class="text-gray-700 leading-relaxed">
                    <?= esc($welcomeMessage) ?>
                </p>
            </section>

            <!-- Features Section -->
            <section class="bg-white p-8 rounded-lg shadow-md mb-10">
                <h2 class="text-3xl font-bold mb-6">Layanan Unggulan Kami</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <?php foreach ($features as $feature): ?>
                        <div class="bg-teal-50 p-4 rounded-lg flex items-center">
                            <svg class="w-6 h-6 text-teal-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-gray-800"><?= esc($feature) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="text-center bg-teal-600 text-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold mb-4">Hubungi Kami</h2>
                <p class="text-lg">Untuk informasi lebih lanjut, silakan hubungi manajer kami:</p>
                <div class="mt-4 text-xl">
                    <p><strong>Manajer:</strong> <?= esc($contact['manager']) ?></p>
                    <p><strong>Telepon:</strong> <?= esc($contact['phone']) ?></p>
                </div>
            </section>
        </main>

    </div>

</body>
</html>

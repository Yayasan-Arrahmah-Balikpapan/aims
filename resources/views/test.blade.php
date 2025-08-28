<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EntrepreneurID</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow p-4 flex items-center justify-between">
    <h1 class="text-xl font-bold">EntrepreneurID</h1>
    <div class="flex items-center space-x-3">
      <button class="text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405M19 13V7a2 2 0 00-2-2h-3l-4-4H6a2 2 0 00-2 2v6" />
        </svg>
      </button>
      <img src="https://via.placeholder.com/40" alt="User"
        class="w-8 h-8 rounded-full">
    </div>
  </header>

  <!-- Search -->
  <div class="p-4">
    <input type="text" placeholder="Cari kursus, mentor..."
      class="w-full p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500">
  </div>

  <!-- Banner Promo -->
  <div class="p-4">
    <div class="bg-blue-500 rounded-xl text-white p-6 flex flex-col items-center text-center">
      <h2 class="text-lg font-bold mb-2">Promo Spesial!</h2>
      <p class="text-sm">Diskon hingga 50% untuk kursus pilihan.</p>
      <img src="https://via.placeholder.com/300x120" alt="Promo"
        class="rounded-lg mt-3">
    </div>
  </div>

  <!-- Kategori -->
  <div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Kategori</h3>
    <div class="grid grid-cols-4 gap-4 text-center">
      <div>
        <img src="https://via.placeholder.com/60" class="mx-auto rounded-full mb-2">
        <p class="text-sm">Bisnis</p>
      </div>
      <div>
        <img src="https://via.placeholder.com/60" class="mx-auto rounded-full mb-2">
        <p class="text-sm">Marketing</p>
      </div>
      <div>
        <img src="https://via.placeholder.com/60" class="mx-auto rounded-full mb-2">
        <p class="text-sm">Teknologi</p>
      </div>
      <div>
        <img src="https://via.placeholder.com/60" class="mx-auto rounded-full mb-2">
        <p class="text-sm">Keuangan</p>
      </div>
    </div>
  </div>

  <!-- Promo Cards -->
  <div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Promo & Flash Sale</h3>
    <div class="grid grid-cols-2 gap-4">
      <div class="bg-white rounded-xl shadow p-3">
        <img src="https://via.placeholder.com/150x100" class="rounded-lg mb-2">
        <p class="text-sm font-semibold">Kursus Startup</p>
        <p class="text-xs text-red-500">Diskon 40%</p>
      </div>
      <div class="bg-white rounded-xl shadow p-3">
        <img src="https://via.placeholder.com/150x100" class="rounded-lg mb-2">
        <p class="text-sm font-semibold">Digital Marketing</p>
        <p class="text-xs text-red-500">Diskon 30%</p>
      </div>
    </div>
  </div>

  <!-- Mentor -->
  <div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Pilihan Mentor</h3>
    <div class="flex space-x-4 overflow-x-auto pb-2">
      <div class="min-w-[120px] bg-white rounded-xl shadow p-3">
        <img src="https://via.placeholder.com/100" class="rounded-full mx-auto mb-2">
        <p class="text-center text-sm font-semibold">Budi</p>
      </div>
      <div class="min-w-[120px] bg-white rounded-xl shadow p-3">
        <img src="https://via.placeholder.com/100" class="rounded-full mx-auto mb-2">
        <p class="text-center text-sm font-semibold">Siti</p>
      </div>
      <div class="min-w-[120px] bg-white rounded-xl shadow p-3">
        <img src="https://via.placeholder.com/100" class="rounded-full mx-auto mb-2">
        <p class="text-center text-sm font-semibold">Andi</p>
      </div>
    </div>
  </div>

  <!-- Kursus Populer -->
  <div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Kursus Populer</h3>
    <div class="space-y-4">
      <div class="flex bg-white shadow rounded-xl p-3">
        <img src="https://via.placeholder.com/100" class="rounded-lg mr-3">
        <div>
          <p class="font-semibold">Manajemen Bisnis</p>
          <p class="text-xs text-gray-500">50 Siswa • 10 Jam</p>
        </div>
      </div>
      <div class="flex bg-white shadow rounded-xl p-3">
        <img src="https://via.placeholder.com/100" class="rounded-lg mr-3">
        <div>
          <p class="font-semibold">Investasi Dasar</p>
          <p class="text-xs text-gray-500">80 Siswa • 12 Jam</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Navigation -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white border-t shadow flex justify-around py-2">
    <button class="flex flex-col items-center text-blue-600">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
      </svg>
      <span class="text-xs">Home</span>
    </button>
    <button class="flex flex-col items-center text-gray-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 17h5l-1.405-1.405M19 13V7a2 2 0 00-2-2h-3l-4-4H6a2 2 0 00-2 2v6" />
      </svg>
      <span class="text-xs">Kursus</span>
    </button>
    <button class="flex flex-col items-center text-gray-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5.121 17.804A9 9 0 1118.364 4.561 9 9 0 015.121 17.804z" />
      </svg>
      <span class="text-xs">Profil</span>
    </button>
  </nav>

</body>
</html>

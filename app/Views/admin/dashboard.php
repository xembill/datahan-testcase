<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow">
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Toplam Ürün</div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white"><?= $totalProducts ?></div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow">
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Varyant Sayısı</div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white"><?= $totalVariants ?></div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow">
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Kayıtlı Kullanıcı</div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white"><?= $totalUsers ?></div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow">
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Son Giriş</div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white"><?= $lastLogin ?></div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-gray-700 dark:text-gray-200">
    <h2 class="text-xl font-semibold mb-2">Hoş geldiniz, <?= session('user.name') ?> 👋</h2>
    <p>Datahan yönetim paneline hoş geldiniz. Sol menüden içeriklere ulaşabilirsiniz.</p>
</div>

<?= $this->endSection() ?>

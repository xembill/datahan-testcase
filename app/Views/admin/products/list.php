<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Ürünler</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach($products as $product): ?>
            <a href="<?= base_url('products/' . $product['id']) ?>"
               class="block border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition">

                <?php if (!empty($product['main_image'])): ?>
                    <img src="<?= base_url('products/' . basename($product['main_image'])) ?>"
                         class="w-full h-48 object-cover" alt="<?= esc($product['name']) ?>">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                        Görsel Yok
                    </div>
                <?php endif; ?>

                <div class="p-4">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-1">
                        <?= esc($product['name']) ?>
                    </h2>
                    <p class="text-blue-600 font-semibold text-sm">
                        <?= number_format($product['price'], 2) ?> ₺
                    </p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>

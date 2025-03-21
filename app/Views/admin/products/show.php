<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<div class="max-w-5xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
            <?= esc($product['name']) ?>
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2 text-lg font-medium">
            <?= number_format($product['price'], 2) ?> ₺
        </p>
    </div>

    <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
    >
        <div class="px-6 py-5">
            <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90"
            >
                Görseller
            </h3>
        </div>
        <div
                class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6"
        >
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <?php foreach ($images as $img): ?>
                <div>
                    <img
                            src="<?= base_url('products/' . basename($img['image_path'])) ?>"
                            alt="image grid"
                            class="rounded-xl border border-gray-200 dark:border-gray-800"
                    />
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Varyantlar -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Varyantlar</h2>
        <?php if (!empty($options)): ?>
            <ul class="list-disc pl-6 text-sm text-gray-800 dark:text-gray-200 space-y-1">
                <?php foreach ($options as $opt): ?>
                    <li>
                        <strong><?= esc($opt['variant']) ?>:</strong> <?= esc($opt['value']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500 text-sm">Bu ürüne ait varyant tanımlanmamış.</p>
        <?php endif; ?>
    </div>

    <div class="mt-6">
        <a href="<?= base_url('admin/products') ?>"
           class="inline-block text-sm text-blue-600 hover:underline">
            ← Ürün listesine dön
        </a>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<div class="max-w-5xl mx-auto p-6">

    <!-- Başlık ve Yeni Ürün Butonu -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Ürün Listesi</h2>

        <a href="<?= base_url('admin/productsList') ?>" class="bg-green-600 hover:bg-green-700  font-medium py-2 px-4 rounded shadow text-sm">
            Ürün Listesini Gör
        </a>

        <a href="<?= base_url('admin/products/new') ?>" class="bg-green-600 hover:bg-green-700  font-medium py-2 px-4 rounded shadow text-sm">
            Yeni Ürün Ekle
        </a>
    </div>

    <!-- Live Search -->
    <div class="mb-4">
        <input
                type="text"
                id="searchInput"
                placeholder="Ürün adıyla ara..."
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
        >
    </div>

    <!-- Ürün Tablosu -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="productTable">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">

            <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="px-5 py-3 sm:px-6">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            ID
                        </p>
                    </div>
                </th>

                <th class="px-5 py-3 sm:px-6">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Ürün Adı
                        </p>
                    </div>
                </th>

                <th class="px-5 py-3 sm:px-6">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Fiyat
                        </p>
                    </div>
                </th>

                <th class="px-5 py-3 sm:px-6">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            İşlemler
                        </p>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <?php foreach($products as $product): ?>
                <tr class="product-row">
                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($product['id']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap product-name"><?= esc($product['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= number_format($product['price'], 2) ?> ₺</td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-4">
                        <a href="<?= base_url('admin/products/' . $product['id']) ?>" class="text-blue-600 hover:underline text-sm">Detay</a>
                        <form action="<?= base_url('admin/products/delete/' . $product['id']) ?>" method="post" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="text-red-600 hover:underline text-sm">Sil</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Live Search Script -->
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.product-row').forEach(row => {
            const name = row.querySelector('.product-name').textContent.toLowerCase();
            row.style.display = name.includes(keyword) ? '' : 'none';
        });
    });
</script>

<?= $this->endSection(); ?>

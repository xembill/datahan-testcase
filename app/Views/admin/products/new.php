<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Yeni Ürün Ekle</h2>

    <?php if (session('error')): ?>
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/products') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <!-- Ürün Adı -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Ürün Adı</label>
            <input type="text" name="name" required
                   value="<?= old('name') ?>"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>

        <!-- Fiyat -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Fiyat (₺)</label>
            <input type="number" step="0.01" name="price" required
                   value="<?= old('price') ?>"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>

        <!-- Görsel Yükleme -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-1">Ürün Görselleri</label>
            <input type="file" name="images[]" multiple accept="image/*" required
                   class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded file:bg-gray-100 file:text-sm file:font-medium">
            <p class="text-xs text-gray-500 mt-1">Ana görseli aşağıdan seçiniz.</p>
        </div>

        <!-- Ana Görsel Seçimi -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-1">Ana Görsel Sırası (0'dan başlar)</label>
            <input type="number" name="main_image" value="0" min="0" required
                   class="w-24 border border-gray-300 rounded px-3 py-2 text-sm">
        </div>

        <!-- Varyantlar -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-2">Varyant Seçimi</label>

            <?php foreach($variants as $variant): ?>
                <fieldset class="mb-4">
                    <legend class="text-sm font-semibold mb-1"><?= esc($variant['name']) ?></legend>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach($variant['options'] as $option): ?>
                            <label class="inline-flex items-center space-x-2 text-sm">
                                <input type="checkbox" name="variants[]" value="<?= esc($option['id']) ?>"
                                       class="text-blue-500 rounded">
                                <span><?= esc($option['value']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            <?php endforeach; ?>
        </div>

        <!-- Gönder Butonu -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 font-medium py-2 px-4 rounded shadow text-sm">
                Kaydet
            </button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

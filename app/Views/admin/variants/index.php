<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>
<div class="max-w-5xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Varyant Listesi</h2>
        <a href="<?= base_url('admin/variants/new') ?>" class="btn btn-success">Yeni Varyant Ekle</a>
    </div>
    <div class="bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Varyant Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detay</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach($variants as $variant): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($variant['id']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($variant['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if (!empty($variant['options'])): ?>
                            <?= implode(', ', array_map('esc', $variant['options'])) ?>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="<?= base_url('admin/variants/edit/'.$variant['id']) ?>" class="text-blue-600 hover:underline">Düzenle</a>
                        <form action="<?= base_url('admin/variants/delete/'.$variant['id']) ?>" method="post" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" >Sil</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>

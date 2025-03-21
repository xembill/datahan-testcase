<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                Varyantı Düzenle
            </h3>
        </div>
        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <form action="<?= base_url('admin/variants/update/' . $variant['id']) ?>" method="post">
                <?= csrf_field(); ?>

                <!-- Varyant Adı -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Varyant Adı
                    </label>
                    <div class="relative">
                        <input type="text" name="name" placeholder="Örneğin: Beden" required
                               value="<?= esc($variant['name']) ?>"
                               class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                </div>

                <!-- Alt Özellikler -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Alt Özellikler
                    </label>
                    <div class="relative">
                        <div id="tags-container" class="flex flex-wrap gap-2 mb-2">
                            <?php foreach ($options as $option): ?>
                            <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded">
                                    <?= esc($option['value']) ?>
                                    <button type="button" class="ml-2 text-red-500 font-bold" onclick="this.parentElement.remove();">&times;</button>
                                    <input type="hidden" name="options[]" value="<?= esc($option['value']) ?>">
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <input type="text" id="tag-input" placeholder="Bir alt özellik girin ve Enter'a basın"
                               class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                        Varyantı Güncelle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        // Alt özellik inputunda Enter tuşuna basıldığında tag ekle
        document.getElementById('tag-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                var value = this.value.trim();
                if (value !== '') {
                    addTag(value);
                    this.value = '';
                }
            }
        });

        function addTag(text) {
            var tagsContainer = document.getElementById('tags-container');
            var tag = document.createElement('span');
            tag.className = 'inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded';
            tag.textContent = text;

            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'ml-2 text-red-500 font-bold';
            removeBtn.textContent = '×';
            removeBtn.onclick = function() {
                tagsContainer.removeChild(tag);
            };
            tag.appendChild(removeBtn);

            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'options[]';
            hiddenInput.value = text;
            tag.appendChild(hiddenInput);

            tagsContainer.appendChild(tag);
        }
    </script>

<?= $this->endSection(); ?>

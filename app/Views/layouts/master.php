<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Panel | Datahan TestCase</title>
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>" crossorigin/>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Diğer CSS dosyaları -->
</head>
<body
        x-data="{ page: 'blank', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')); $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark bg-gray-900': darkMode === true}"
>

<!-- Preloader -->
<div
        x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
>
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
</div>

<!-- Page Wrapper -->
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <?= $this->include('layouts/partials/sidebar') ?>

    <!-- Content Area -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
        <!-- Small Device Overlay -->
        <div
                @click="sidebarToggle = false"
                :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"
        ></div>

        <!-- Header -->
        <?= $this->include('layouts/partials/topbar') ?>

        <!-- Main Content -->
        <main>
            <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>
    <!-- jQuery (eğer kullanıyorsanız) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        <?php if(session()->getFlashdata('success')): ?>
        toastr.success("<?= session()->getFlashdata('success'); ?>");
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
        toastr.error("<?= session()->getFlashdata('error'); ?>");
        <?php endif; ?>
    </script>
</div>

<script defer src="<?= base_url('assets/bundle.js') ?>"></script>
</body>
</html>
<?php
require 'functions.php';

$waifus = query("SELECT * FROM waifus");

// Jika tombol cari ditekan
if (isset($_POST['cari'])) {
    $waifus = cari($_POST['keyword']);
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Waifu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-700">

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="create.php" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Create</a>
        </div>

        <form class="py-2 px-2" action="" method="POST">
            <label for="cari" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="cari" name="keyword" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan kata kunci.." required autofocus autocomplete="off">
                <button type="submit" name="cari" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </nav>

    <div class="relative overflow-x-auto ">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Umur
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Source
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gambar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Update
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($waifus as $waifu) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $i; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $waifu["nama"]; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $waifu["usia"]; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $waifu["source"]; ?>
                        </td>
                        <td class="px-6 py-4">
                            <img src="img/<?= $waifu["image"]; ?>" alt="" width="100">
                        </td>
                        <td class="px-6 py-4">
                            <a href="edit.php?id=<?= $waifu["id"] ?>">Ubah</a> |
                            <a href="destroy.php?id=<?= $waifu["id"] ?>" onclick="return confirm('Yakin ingin menghapus waifu?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    </div>
</body>

</html>
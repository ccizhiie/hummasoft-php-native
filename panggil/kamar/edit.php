<!DOCTYPE html>
<html>
<head>
    <title>Data Kamar</title>
    <!-- Menambahkan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php
        // Memasukkan file koneksi.php
        require_once('koneksi.php');

        // Melakukan query ke database untuk mengambil data Kamar
        $query = $koneksi->query("SELECT * FROM kamar");
    ?>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Judul halaman -->
            <h3 class="text-2xl font-bold text-primary mb-4">Data Kamar</h3>
            <hr class="border-t border-gray-300">

            <!-- Tabel untuk menampilkan data Kamar -->
            <table class="w-full mt-6">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-bold">Nama Kamar</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-bold">Kelas</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-bold">Kapasitas</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-bold">Tarif</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_object($query)): ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-300"><?= $data->nama_kamar ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?= $data->kelas ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?= $data->kapasitas ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?= $data->harga ?></td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                <!-- Tombol Edit dan Hapus dengan tautan ke halaman edit dan hapus -->
                                <a href="edit_kamar.php?id_kamar=<?= $data->id_kamar ?>" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <a href="hapus_kamar.php?id_kamar=<?= $data->id_kamar ?>" class="text-red-500 hover:text-red-700">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

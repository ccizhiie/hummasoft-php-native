<?php
    /* Skrip ini tidak menggunakan OOP */
    /* Memanggil file koneksi hanya satu kali */
    require_once('koneksi.php');

    // Membuat query SQL untuk mengambil data dari beberapa tabel
    $query  = "SELECT detail_obat.id_detail, inap.id_inap, obat.nama_obat, obat.harga FROM ((detail_obat INNER JOIN inap ON detail_obat.id_inap=inap.id_inap) INNER JOIN obat ON detail_obat.id_obat=obat.id_obat)";
    $link   = "index.php?lihat=detail_obat/";
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Menetapkan judul halaman -->
    <title>Data Detail Obat</title>
    <!-- Mengimpor CSS Tailwind dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow">
            <!-- Menampilkan judul halaman -->
            <h3 class="text-primary text-center text-2xl font-bold p-4">Data Detail Obat</h3>
            <hr class="border-t border-gray-300">
            <!-- Tombol Tambah dengan tautan ke halaman tambah -->
            <a href="<?= $link . 'tambah' ?>" class="bg-green-500 text-white py-2 px-4 rounded-md inline-block my-4 ml-4">
                <span class="glyphicon glyphicon-plus"></span> Tambah
            </a>

            <!-- Menampilkan Tabel Data -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="py-2 px-4">No</th>
                            <th class="py-2 px-4">Id Inap</th>
                            <th class="py-2 px-4">Nama Obat</th>
                            <th class="py-2 px-4">Harga Obat</th>
                            <th class="py-2 px-4" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data = mysqli_query($koneksi, $query)) {
                            $no = 1;
                            while ($tampil = mysqli_fetch_object($data)) {
                                ?>
                                <tr>
                                    <td class="py-2 px-4"><?= $no ?></td>
                                    <td class="py-2 px-4"><?= $tampil->id_inap ?></td>
                                    <td class="py-2 px-4"><?= $tampil->nama_obat ?></td>
                                    <td class="py-2 px-4">Rp <?= number_format($tampil->harga, 0, ',', '.') ?></td>
                                    <td class="py-2 px-4 text-center">
                                        <a href="<?= $link . 'edit&id_detail=' . $tampil->id_detail ?>" class="bg-blue-500 text-white py-1 px-2 rounded-md">
                                            <!-- Tombol Edit -->
                                            <span class="glyphicon glyphicon-edit">edit</span>
                                        </a>
                                        <a onclick="return confirm('Apakah yakin data akan dihapus?')" href="<?= $link . 'hapus&id_detail=' . $tampil->id_detail ?>" class="bg-red-500 text-white py-1 px-2 rounded-md">
                                            <!-- Tombol Hapus dengan konfirmasi -->
                                            <span class="glyphicon glyphicon-trash">hapus</span>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                $no++;
                            } // Tutup while
                        } // Tutup if
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

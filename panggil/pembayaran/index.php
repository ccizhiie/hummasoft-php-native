<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <?php
    /*Skrip ini tidak menggunakan OOP
    /*Memanggil file koneksi hanya satu kali*/
    require_once('koneksi.php');

    $query  = "SELECT pembayaran.*, view_passien.nama_pasien, view_pembayaranobat.totalObat, view_pembayarankamar.bayarkamar FROM pembayaran INNER JOIN view_passien ON pembayaran.id_inap = view_passien.id_inap INNER JOIN view_pembayaranobat ON pembayaran.id_inap = view_pembayaranobat.id_inap INNER JOIN view_pembayarankamar ON pembayaran.id_inap = view_pembayarankamar.id_inap";
    $link   = "index.php?lihat=pembayaran/";
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-primary">Data Pembayaran</h3>
            <hr class="border-solid border-2 border-black" />
            <!-- Tombol Tambah -->
            <a href="<?= $link . 'tambah' ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-plus"></span> Tambah
            </a>
            <!-- Menampilkan Tabel -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered mt-10">
                    <tr class="bg-blue-500 text-white">
                        <th>No</th>
                        <th>Kode Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Id Inap</th>
                        <th>Nama Pasien</th>
                        <th>Harga Kamar</th>
                        <th>Total Obat</th>
                        <th>Total Bayar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    <?php
                    if ($data = mysqli_query($koneksi, $query)) {
                        $no = 1;
                        while ($tampil = mysqli_fetch_object($data)) {
                            // Format harga
                            $hargaKamar = number_format($tampil->bayarkamar, 0, ',', '.');
                            $totalObat = number_format($tampil->totalObat, 0, ',', '.');
                            $totalBayar = number_format($tampil->total, 0, ',', '.');

                            // Format tanggal
                            $tanggalPembayaran = date('d F Y', strtotime($tampil->tanggal));
                    ?>

                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $tampil->id_pembayaran ?></td>
                                <td><?= $tanggalPembayaran ?></td>
                                <td><?= $tampil->id_inap ?></td>
                                <td><?= $tampil->nama_pasien ?></td>
                                <td>Rp <?= $hargaKamar ?></td>
                                <td>Rp <?= $totalObat ?></td>
                                <td>Rp <?= $totalBayar ?></td>
                                <td class="text-center">
                                    <a href="<?= $link . 'edit&id_pembayaran=' . $tampil->id_pembayaran ?>" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-edit">edit</span>
                                    </a>
                                    <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?= $link . 'hapus&id_pembayaran=' . $tampil->id_pembayaran ?>" class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash">hapus</span>
                                    </a>
                                </td>
                            </tr>

                    <?php
                            $no++;
                        } //Tutup while
                    } //Tutup if
                    ?>

                </table>
            </div><!-- .table-responsive -->
        </div>
    </div>

</body>

</html>
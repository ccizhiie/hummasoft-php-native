<!DOCTYPE html>
<html>

<head>
</head>

<body>
  <?php
  /* Skrip ini tidak menggunakan OOP */
  /* Memanggil file koneksi hanya satu kali */
  require_once('koneksi.php');

  // Query untuk mengambil data Rawat Inap dengan menggabungkan tabel inap, pasien, dan kamar menggunakan INNER JOIN
  $query  = "SELECT inap.id_inap, pasien.nama_pasien, inap.tgl_masuk, inap.tgl_keluar, inap.lama, kamar.id_kamar FROM ((inap INNER JOIN pasien ON inap.id_pasien = pasien.id_pasien) INNER JOIN kamar ON inap.id_kamar = kamar.id_kamar)";
  $link   = "index.php?lihat=inap/";
  ?>

  <div class="container mx-auto py-8">
    <h3 class="text-2xl text-blue-500 font-bold">Data Rawat Inap</h3>
    <hr class="border-t-2 border-gray-500 my-4" />

    <!-- Tombol Tambah -->
    <a href="<?= $link . 'tambah' ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
      <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

    <!-- Menampilkan Tabel -->
    <div class="overflow-x-auto mt-8">
      <table class="table-auto w-full">
        <thead>
          <tr class="bg-blue-500 text-white">
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Id Inap</th>
            <th class="px-4 py-2">Nama Pasien</th>
            <th class="px-4 py-2">Tanggal Masuk</th>
            <th class="px-4 py-2">Tanggal Keluar</th>
            <th class="px-4 py-2">Lama Inap</th>
            <th class="px-4 py-2">Id Kamar</th>
            <th class="px-4 py-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data = mysqli_query($koneksi, $query)) {
            $no = 1;
            while ($tampil = mysqli_fetch_object($data)) {
          ?>
              <tr>
                <td class="border px-4 py-2"><?= $no ?></td>
                <td class="border px-4 py-2"><?= $tampil->id_inap ?></td>
                <td class="border px-4 py-2"><?= $tampil->nama_pasien ?></td>
                <td class="border px-4 py-2"><?= $tampil->tgl_masuk ?></td>
                <td class="border px-4 py-2"><?= $tampil->tgl_keluar ?></td>
                <td class="border px-4 py-2"><?= $tampil->lama ?></td>
                <td class="border px-4 py-2"><?= $tampil->id_kamar ?></td>
                <td class="border px-4 py-2 text-center">
                  <form action="<?= $link . 'edit&id_inap=' . $tampil->id_inap ?>" method="POST" class="inline">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                      Edit
                    </button>
                  </form>
                  <form action="<?= $link . 'hapus&id_inap=' . $tampil->id_inap ?>" method="POST" class="inline">
                    <button type="submit" onclick="return confirm('Apakah yakin data akan dihapus?')" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
          <?php
              $no++;
            } // Tutup while
          } // Tutup if
          ?>
        </tbody>
      </table>
    </div><!-- .table-responsive -->
  </div>

</body>

</html>
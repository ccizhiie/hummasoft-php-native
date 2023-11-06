<!DOCTYPE html>
<html>

<head>
  <title></title>
  <style></style>
</head>

<body>
  <!-- Form untuk menambah data obat -->
  <div class="container mx-auto">
    <div class="flex justify-center">
      <div class="w-full max-w-md">
        <h3 class="text-primary text-2xl font-bold mb-4">Tambah Data Obat</h3>
        <hr class="border-dotted border-gray-500 mb-4" />
        <form action="" method="POST">
          <div class="mb-4">
            <label for="nama_obat" class="block text-gray-700 font-bold mb-2">Nama Obat</label>
            <input type="text" id="nama_obat" name="nama_obat" placeholder="Masukan Nama Obat" required
              class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="harga" class="block text-gray-700 font-bold mb-2">Harga</label>
            <input type="text" id="harga" name="harga" placeholder="Masukan Harga" required
              class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <button type="submit"
            class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
            <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
          </button>
        </form>
      </div>
    </div>
  </div>

  <?php
  require_once('koneksi.php');

  if ($_POST) {
    try {
      // Menuliskan query tambah data obat
      $sql = "INSERT INTO obat (id_obat, nama_obat, harga) VALUES ('" . $_POST['id_obat'] . "', '" . $_POST['nama_obat'] . "', '" . $_POST['harga'] . "')";

      // Cek jika query salah
      if (!$koneksi->query($sql)) {
        echo $koneksi->error;
        die();
      }
    } catch (Exception $error) {
      // Cek jika terjadi error
      echo $error;
      die();
    }

    // Redirect ke halaman data obat setelah data ditambahkan
    echo "<script>
			window.location.href='index.php?lihat=obat/index';
		  </script>";
  }
  ?>
</body>

</html>
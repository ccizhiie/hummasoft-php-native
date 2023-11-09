<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style></style>
</head>

<body>
  <!-- Form untuk menambah data obat -->
  <div class="container mx-auto">
    <div class="flex justify-center">
      <div class="w-full max-w-md">
        <h3 class="text-primary text-2xl font-bold mb-4">Tambah Data Obat</h3>
        <hr class="border-dotted border-gray-500 mb-4" />
        <form action="" method="POST" id="formObat">
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

  <script>
    $(document).ready(function() {
      $('#formObat').submit(function(e) {
        var harga = $('#harga').val();

        // Cek jika harga bukan angka
        if (!$.isNumeric(harga)) {
          e.preventDefault(); // Mencegah form submit
          Swal.fire({
            icon: 'error',
            title: 'Data tidak valid',
            text: 'Harga harus berupa angka',
            showConfirmButton: false,
            timer: 1500
          });
        }
      });
    });
  </script>

  <?php
  require_once('koneksi.php');

  if ($_POST) {
    try {
      // Menghasilkan ID obat acak menggunakan md5()
        $id_obat = md5(uniqid(rand(), true));

      // Menuliskan query tambah data obat
      $sql = "INSERT INTO obat (id_obat, nama_obat, harga) VALUES ('$id_obat', '" . $_POST['nama_obat'] . "', '" . $_POST['harga'] . "')";

      // Cek jika query salah
      if (!$koneksi->query($sql)) {
        echo $koneksi->error;
        die();
      }

      // Menampilkan SweetAlert jika data berhasil ditambahkan
      echo "<script>
              $(document).ready(function() {
                Swal.fire({
                  icon: 'success',
                  title: 'Data berhasil ditambahkan',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'index.php?lihat=obat/index';
                });
              });
            </script>";
    } catch (Exception $error) {
      // Menampilkan SweetAlert jika terjadi error saat menambahkan data
      echo "<script>
                    $(document).ready(function() {
                Swal.fire({
                  icon: 'error',
                  title: 'Terjadi kesalahan saat menambahkan data',
                  showConfirmButton: false,
                  timer: 1500
                });
              });
            </script>";
    }
  }
  ?>
</body>

</html>

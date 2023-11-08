<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-1/2 bg-white p-8 shadow-md">
            <h3 class="text-primary text-2xl font-bold mb-4">Tambah Data Pasien</h3>
            <hr class="border-t-2 border-gray-300 mb-4">

            <form action="" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="nama_pasien">Nama</label>
                    <input type="text" class="border border-gray-300 rounded-md p-2 w-full" name="nama_pasien" placeholder="Masukkan Nama" >
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Jenis Kelamin</label>
                    <div>
                        <input name="jk" type="radio" value="Laki-laki" id="jk_laki" >
                        <label for="jk_laki" class="mr-2">Laki-laki</label>
                        <input name="jk" type="radio" value="Perempuan" id="jk_perempuan" >
                        <label for="jk_perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="no_telp">No Telp</label>
                    <input type="text" class="border border-gray-300 rounded-md p-2 w-full" name="no_telp" placeholder="Masukkan No Telp" >
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="alamat">Alamat</label>
                    <textarea class="border border-gray-300 rounded-md p-2 w-full" name="alamat" placeholder="Masukkan Alamat" ></textarea>
                </div>

                <button type="submit" class="bg-green-500 text-white rounded-md py-2 px-4">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                </button>
            </form>
        </div>
    </div>

    <?php
    require_once('koneksi.php');

    if($_POST){
        $nama_pasien = $_POST['nama_pasien'];

// Memeriksa apakah input nama mengandung angka
if (preg_match('/\d/', $nama_pasien)) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Inputkan Huruf!"
        });
    </script>';
    die(); // Menghentikan eksekusi script
}
        // Mengecek setiap input untuk validasi
        $nama_pasien = $_POST['nama_pasien'];
        $jk = $_POST['jk'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];

        if (empty($nama_pasien) || empty($jk) || empty($no_telp) || empty($alamat)) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Harap isi semua kolom yang diperlukan!"
                });
            </script>';
        } else {
            try {
                // Menuliskan query tambah
                $sql = "INSERT INTO pasien (nama_pasien, jk, no_telp, alamat) VALUES ('".$nama_pasien."','".$jk."','".$no_telp."','".$alamat."')";

                // Cek jika query salah
                if(!$koneksi->query($sql)){
                    echo $koneksi->error;
                    die();
                }

                // Data berhasil ditambahkan, tampilkan SweetAlert
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Data berhasil ditambahkan",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?lihat=pasien/index";
                        }
                    });
                </script>';

            } catch (Exception $error) {
                echo $error;
                die();
            }
        }
    }
    ?>
</body>
</html>

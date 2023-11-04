<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Rawat Inap</title>
    <!-- Tambahkan stylesheet Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan library SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <?php
        require_once('koneksi.php');
        if(isset($_POST['id_inap'])){
            $date1 = $_POST['tgl_masuk'];
            $date2 = $_POST['tgl_keluar'];

            if(empty($date1) || empty($date2)) {
                // Tampilkan SweetAlert jika tanggal tidak diisi
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data harus diisi',
                }).then((result) => {
                    // Redirect ke halaman sebelumnya
                    window.history.back();
                });
                </script>";
                exit;
            }

            $lama = ((abs(strtotime ($date2) - strtotime ($date1)))/(60*60*24));

            $sql = "UPDATE inap SET tgl_masuk='".$_POST['tgl_masuk']."', tgl_keluar='".$_POST['tgl_keluar']."', lama='".$lama."', id_pasien='".$_POST['id_pasien']."', id_kamar='".$_POST['id_kamar']."' WHERE id_inap=".$_POST['id_inap'];

            if ($koneksi->query($sql) === TRUE) {
                echo "<script>
                window.location.href='index.php?lihat=inap/index';
                </script>";
            } else {
                echo "Gagal: " . $koneksi->error;
            }

            $koneksi->close();
        }
        else{
            $query = $koneksi->query("SELECT * FROM inap WHERE id_inap=".$_GET['id_inap']);

            if($query->num_rows > 0){
                $data = mysqli_fetch_object($query);
            } else {
                echo "Data tidak tersedia";
                die();
            }
        }
    ?>

    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-primary text-2xl font-bold">Edit Data Rawat Inap</h3>
            <hr class="border-t border-gray-300">
            <form action="" method="POST" class="mt-4" onsubmit="return validateForm()">
                <input type="hidden" name="id_inap" value="<?= $data->id_inap ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="id_pasien">Nama Pasien</label>
                    <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_pasien" value="<?= $data->id_pasien ?>">
                        <?php
                        $con = mysqli_connect("localhost","root","","rumah_sakit");
                        $result = mysqli_query($con,"SELECT * FROM pasien ORDER BY id_pasien");
                        echo "<option>--Pilih nama pasien--</option>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value=".$row['id_pasien'].">".$row['nama_pasien']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date" value="<?= $data->tgl_masuk ?>" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_masuk">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tgl_keluar">Tanggal Keluar</label>
                    <input type="date" value="<?= $data->tgl_keluar ?>" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_keluar">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="id_kamar">Id Kamar</label>
                    <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_kamar" value="<?= $data->id_kamar ?>">
                        <?php
                        $con = mysqli_connect("localhost","root","","rumah_sakit");
                        $result = mysqli_query($con,"SELECT * FROM kamar ORDER BY id_kamar");
                        echo "<option>--Pilih nama kamar--</option>";
                       while($row = mysqli_fetch_assoc($result)){
                            echo "<option value=".$row['id_kamar'].">".$row['id_kamar']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">
                    <!-- Tombol untuk mengirimkan form -->
                    <span class="glyphicon glyphicon-pencil"></span> Ubah
                </button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var tglMasuk = document.getElementsByName("tgl_masuk")[0].value;
            var tglKeluar = document.getElementsByName("tgl_keluar")[0].value;

            if (tglMasuk === "" || tglKeluar === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data harus diisi',
                });
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
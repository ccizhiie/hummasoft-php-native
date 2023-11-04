<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <div class="flex justify-center mt-8">
        <div class="w-1/2">
            <h3 class="text-primary text-center text-2xl mb-4">Tambah Data Pembayaran</h3>
            <hr class="border-solid border-2 border-black my-4" />

            <form action="" method="POST" class="w-full mb-4">
                <div class="mb-4">
                    <label class="block">Tanggal Pembayaran</label>
                    <input type="date" class="form-input w-full" name="tanggal" required>
                </div>
                <div class="mb-4">
                    <label class="block">Id Inap</label>
                    <select class="form-select w-full" name="id_inap">
                        <option>--PILIH ID INAP--</option>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                        $result = mysqli_query($con, "SELECT *FROM inap where status=0 ORDER BY id_inap ");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='$row[id_inap]'>$row[id_inap]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Total Pembayaran</label>
                    <input type="number" class="form-input w-full" name="total" required>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                </button>
            </form>

            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="border">Tanggal Pembayaran</th>
                        <th class="border">Id Inap</th>
                        <th class="border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data pembayaran dari database
                    $result = mysqli_query($con, "SELECT * FROM pembayaran");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='border'>" . $row['tanggal'] . "</td>";
                        echo "<td class='border'>" . $row['id_inap'] . "</td>";
                        echo "<td class='border'>" . $row['total'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <?php
    require_once('koneksi.php');

    if ($_POST) {
        try {
            //Menuliskan query tambah
            $sql = "INSERT INTO pembayaran (tanggal, id_inap, total) VALUES ('" . $_POST['tanggal'] . "','" . $_POST['id_inap'] . "','" . $_POST['total'] . "')";
            
            //Cek jika query salah
            if (!$koneksi->query($sql)) {
                echo $koneksi->error;
                die();
            }
        }
        //Cek jika terjadi error
        catch (Exception $error) {
            echo $error;
            die();
        }

        echo "<script>
            window.location.href='index.php?lihat=pembayaran/index';
          </script>";
    }
    ?>

</body>

</html> 
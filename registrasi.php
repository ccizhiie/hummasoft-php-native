<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-50">
<?php
$koneksi = new mysqli('localhost', 'root', '', 'rumah_sakit');

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Ambil data dari form jika ada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $upass = $_POST['upass'];
    $fullname = $_POST['fullname'];
    $uemail = $_POST['uemail'];

    // Query untuk memeriksa apakah email sudah digunakan sebelumnya
    $checkQuery = "SELECT * FROM users WHERE uemail = '$uemail'";
    $result = $koneksi->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Email sudah digunakan. Silakan gunakan email lain.');
                window.location.href = 'registrasi.php';
              </script>";
        die();
    }

    // Query untuk menyimpan data ke tabel users
    $sql = "INSERT INTO `users` (`uname`, `upass`, `fullname`, `uemail`) VALUES ('$uname', '$upass', '$fullname', '$uemail')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>
                alert('Registrasi berhasil!');
                window.location.href = 'login.php';
              </script>";
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
                Register
            </h2>
            <form class="space-y-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="uid" value="">
                <div>
                    <label for="uname" class="sr-only">Username</label>
                    <input id="uname" name="uname" type="text" autocomplete="uname" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Username">
                </div>
                <div>
                    <label for="upass" class="sr-only">Password</label>
                    <input id="upass" name="upass" type="password" autocomplete="current-password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Password">
                </div>
                <div>
                    <label for="fullname" class="sr-only">Full Name</label>
                    <input id="fullname" name="fullname" type="text" autocomplete="fullname" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Full Name">
                </div>
                <div>
                    <label for="uemail" class="sr-only">Email</label>
                    <input id="uemail" name="uemail" type="email" autocomplete="uemail" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Email">
                </div>
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a href="login.php" class="text-blue-600 underline">Login</a>
            </div>
        </div>
    </div>
</body>

</html>
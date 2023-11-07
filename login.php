<!DOCTYPE html>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
     // Query untuk memeriksa kecocokan username dan password
     $sql = "SELECT * FROM users WHERE uname = '$uname' AND upass = '$upass'";
     $result = $koneksi->query($sql);
     if ($result->num_rows > 0) {
        // Login berhasil
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: 'Anda telah berhasil login!',
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>";
        die();
    } else {
        // Login gagal
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Username atau password salah',
                showConfirmButton: false,
                timer: 2000
            });
        </script>";
    }
}
?>
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-8 rounded shadow">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
            Login
        </h2>
        <form class="space-y-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                <button type="submit"
                    class="w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
                </button>
            </div>
        </form>
        <div class="text-center mt-4">
        <a href="registrasi.php" class="text-blue-600 underline">Register</a>
            </div>
        </div>
    </div>
    <
</html>
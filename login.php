<!DOCTYPE html>
<html>

<head>
    <title>Opon Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <h1 class="text-4xl text-center mt-8">Rumah Sakit Oponn</h1>

    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/3">
            <p class="text-2xl text-center mb-8">Login User</p>

            <form method="post" action="action.php">
                <div class="mb-4">
                    <label class="block">Username</label>
                    <input type="text" name="username" class="border border-gray-300 px-4 py-2 rounded-lg w-full" placeholder="Username atau email ..">
                </div>

                <div class="mb-4">
                    <label class="block">Password</label>
                    <input type="password" name="password" class="border border-gray-300 px-4 py-2 rounded-lg w-full" placeholder="Password ..">
                </div>

                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer w-full" value="LOGIN">
            </form>

            <div class="text-center mt-4">
                <p>Tidak punya akun?</p>
                <a href="registrasi.php" class="text-blue-500 hover:text-blue-700">Register</a>
            </div>
        </div>
    </div>

</body>

</html>
<?php 
session_start();
include_once 'include/class.user.php';
$user = new User();

if (isset($_POST['submit'])) { 
    extract($_POST);   
    $login = $user->check_login($emailusername, $password);
    if ($login) {
        // Registration Success
        header("location:index1.php");
    } else {
        // Registration Failed
        echo 'Wrong username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

  <div id="container" class="container mx-auto mt-20">
    <h1 class="text-3xl font-bold mb-8">Login Here</h1>
    <form action="" method="post" name="login">
      <table class="border-collapse">
        <tr>
          <th class="py-2">UserName or Email:</th>
          <td>
            <input type="text" name="emailusername" required class="py-1 px-2 border rounded">
          </td>
        </tr>
        <tr>
          <th class="py-2">Password:</th>
          <td>
            <input type="password" name="password" required class="py-1 px-2 border rounded">
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" name="submit" value="Login" onclick="return(submitlogin());">
          </td>
        </tr>
      </table>
    </form>
  </div>
  
  <script>
    function submitlogin() {
      var form = document.login;
      if (form.emailusername.value == "") {
        alert("Enter email or username.");
        return false;
      } else if (form.password.value == "") {
        alert("Enter password.");
        return false;
      }
    }
  </script>

</body>

</html>
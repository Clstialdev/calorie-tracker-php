<?php
$rootPath = ROOT;
require_once $rootPath . '/Config/Globals.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?=BASE_APP_DIR?>/public/css/colors.css" />
  <link rel="stylesheet" href="<?=BASE_APP_DIR?>/public/css/global.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>

<body>
  <!-- HEADER -->
  <?php
  include_once VIEWSDIR.DS.'components'.DS.'header.php';
  ?>
  <!-- BODY -->
  <div class="w-full min-h-screen pl-[180px] bg-bg">
    <!-- Login Form-->
    <div class="w-full items-center flex-column flex min-h-screen pt-24">
      <h1 class="text-5xl font-bold">Register</h1>
      <form class="bg-gray w-[500px] rounded min-h-[400px] mt-14 p-8" id="form-data" action="" method="post">
        <div class="flex flex-column">
          <label for="fullname" class="font-bold text-white">Full Name</label>
          <input type="text" name="fullname" placeholder="Ex: John Doe" class="py-3 px-4 rounded mt-2" required />
        </div>

        <div class="flex flex-column mt-4">
          <label class="font-bold text-white">Email</label>
          <input type="email" name="email" placeholder="Ex:john.doe@gmail.com" class="py-3 px-4 rounded mt-2" required />
        </div>
        <div class="flex flex-column mt-4">
          <label class="font-bold text-white">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" class="py-3 px-4 rounded mt-2" required />
        </div>
        <div class="flex flex-column mt-4">
          <label class="font-bold text-white">Repeat Password</label>
          <input type="password" id="confPassword" name="confPassword" placeholder="Repeat Password" class="py-3 px-4 rounded mt-2" required />
        </div>

        <div class="flex flex-column mt-4">
          <input type="submit" class="py-3 px-4 bg-[#d6ff92] rounded w-full" name="register" id="register" value="Register">


        </div>
      </form>
    </div>
  </div>

  <script src="<?=BASE_APP_DIR?>/public/js/ajax.js"></script>

  <script type="text/javascript">
    $("#register").click(function(e) {
      console.log("dans register");
      if ($("#form-data")[0].checkValidity()) {
        e.preventDefault();

        var password = $("#password").val();
        var confirmPassword = $("#confPassword").val();

        // Check if passwords match
        if (password !== confirmPassword) {
          Swal.fire({
            title: 'Registration failed!',
            text: 'Passwords do not match.',
            icon: 'error'
          });
          return; // Don't submit the form data
        }

        performAjaxRequest(
          "POST",
          "register",
          "",
          "User added successfully!",
          ""
        );
      }
    });
  </script>
</body>

</html>
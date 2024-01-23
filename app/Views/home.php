<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="/calorie-tracker-php/public/css/colors.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="/calorie-tracker-php/public/css/global.css" />

  </head>
  <body>
    <!-- HEADER -->
    <?php
    include_once 'header.php';
    ?>

        <div class="w-full min-h-screen pl-[180px] bg-bg">
      <!-- Login Form-->
      <div class="w-full items-center flex-column flex min-h-screen pt-24">
        <h1 class="text-5xl font-bold">Welcome ,
        <?php if(isset($_SESSION['id'])){
            echo explode(" ", $_SESSION['fullname'])[0];
        }else{
            echo 'Guest';
        }
        ?>
        </h1>
        
      </div>
    </div>
  </body>
</html>

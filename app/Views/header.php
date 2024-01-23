<?php
session_start();
$rootPath = realpath(dirname(__FILE__));
require_once $rootPath . '/../../Config/Globals.php'
?>

<header class="d-flex flex-column justify-content-between align-items-center bg-main position-fixed left-0 top-0" style="width: 180px; height: 100vh; padding: 80px 0;">
  <div>
    <!-- Logo -->
    <div class="logo">
      <img src="../calorie-tracker-php/public/images/logo.png" alt="" />
    </div>
    <!-- Nav -->
    <nav class="" style="padding-top: 130px">
      <ul class="d-flex flex-column align-items-center list-unstyled" style="gap: 5rem;">
        <li>
          <a href=""><img src=" /calorie-tracker-php/public/images/icons/home.png" alt="" /></a>
        </li>
        <li>
          <a href=""><img src="/calorie-tracker-php/public/images/icons/calender.png" alt="" /></a>
        </li>
        <li>
          <a href=""><img src="/calorie-tracker-php/public/images/icons/market.png" alt="" /></a>
        </li>
        <li>
          <a href="index.php?view=settings"><img src="/calorie-tracker-php/public/images/icons/user.png" alt="" /></a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- Disconnect / Connect -->
  <?php if (!isset($_SESSION['id'])) : ?>
    <a class="logo" href="index.php?view=login">
      Login
      <img src="" alt="" />
    </a>
    <a class="logo" href="index.php?view=register">
      S'inscrire
      <img src="" alt="" />
    </a>

  <?php else : ?>
    <a class="logo" href="">
      <img name="logout" id="logout" src="/../../public/images/icons/disconnect.png" alt="" />
    </a>
  <?php endif; ?>
</header>

<script src="../../public/js/ajax.js"></script>
<script type="text/javascript">
  $("#logout").click(function(e) {
    e.preventDefault();
    performAjaxRequest(
      "/calorie-tracker-php/app/controllers/Users.php",
      "logout",
      "&q=logout",
      "User logout successfully!",
      "Logout failed!"
    );
  });
</script>
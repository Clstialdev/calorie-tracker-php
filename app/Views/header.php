<?php
session_start();

?>

<header class="flex flex-column justify-between items-center p-12 bg-main w-[180px] h-screen fixed left-0 top-0">
  <div>
    <!-- Logo -->
    <div class="logo h-[66px] w-[66px]">
      <img src="../../public/images/logo.png" alt="" />
    </div>
    <!-- Nav -->
    <nav class="pt-24">
      <ul class="flex flex-column items-center gap-20">
        <li>
          <a href=""><img src="../../public/images/icons/home.png" alt="" /></a>
        </li>
        <li>
          <a href=""><img src="../../public/images/icons/calender.png" alt="" /></a>
        </li>
        <li>
          <a href=""><img src="../../public/images/icons/market.png" alt="" /></a>
        </li>
        <li>
          <a href=""><img src="../../public/images/icons/user.png" alt="" /></a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- Disconnect / Connect -->
  <?php if (!isset($_SESSION['id'])) : ?>
    <a class="logo h-[66px] w-[66px] self-end" href="index.php?view=login">
      Login
      <img src="" alt="" />
    </a>
    <a class="logo h-[66px] w-[66px] self-end" href="index.php?view=register">
      S'inscrire
      <img src="" alt="" />
    </a>

  <?php else : ?>
    <a class="logo h-[66px] w-[66px] self-end" href="">
      <img name="logout" id="logout" src="../../public/images/icons/disconnect.png" alt="" />
    </a>
  <?php endif; ?>
</header>

<script type="text/javascript">
  jQuery("#logout").click(function(e) {

    e.preventDefault();

    jQuery.ajax({
      url: "../controllers/Users.php",
      type: "GET",
      data: "&q=logout",
      dataType: 'json', // Expect JSON response
      success: function(response) {
        if (response.success) {
          Swal.fire({
            title: 'User logout successfully!',
            icon: 'success'
          }).then(function() {
            window.location = 'login.php'; // Redirect to home.php
          });
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire({
          title: 'AJAX error!',
          text: 'Please try again. (' + textStatus + ')',
          icon: 'error'
        });
      }
    });

  });
</script>
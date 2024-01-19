<?php
session_start();
$rootPath = realpath(dirname(__FILE__));
require_once $rootPath.'/../../config/Globals.php'
?>

<header
      class="flex flex-column justify-between items-center p-12 bg-main w-[180px] h-screen fixed left-0 top-0"
    >
      <div>
        <!-- Logo -->
        <div class="logo h-[66px] w-[66px]">
          <img src="<?= BASE_APP_DIR ?>/public/images/logo.png" alt="" />
        </div>
        <!-- Nav -->
        <nav class="pt-24">
          <ul class="flex flex-column items-center gap-20">
            <li>
              <a href=""><img src="<?= BASE_APP_DIR ?>/public/images/icons/home.png" alt="" /></a>
            </li>
            <li>
              <a href=""><img src="<?= BASE_APP_DIR ?>/public/images/icons/calender.png" alt="" /></a>
            </li>
            <li>
              <a href=""><img src="<?= BASE_APP_DIR ?>/public/images/icons/market.png" alt="" /></a>
            </li>
            <li>
              <a href="/calorie-tracker-php/app/views/user/settings.php"><img src="<?= BASE_APP_DIR ?>/public/images/icons/user.png" alt="" /></a>
            </li>
          </ul>
        </nav>
      </div>
      <!-- Disconnect / Connect -->
      <?php if(!isset($_SESSION['id'])) : ?>
        <a class="logo h-[66px] w-[66px] self-end" href="login.php">
          Login
        <img src="" alt="" />
      </a>
      <a class="logo h-[66px] w-[66px] self-end" href="register.php">
          S'inscrire
        <img src="" alt="" />
      </a>

        <?php else: ?>
      <a class="logo h-[66px] w-[66px] self-end" href="">
        <img name="logout" id="logout" src="<?= BASE_APP_DIR ?>/public/images/icons/disconnect.png" alt="" />
      </a>
      <?php endif; ?>
    </header>

    <script type="text/javascript">

$("#logout").click(function(e){
  
        e.preventDefault();
        
        $.ajax({
            url: "/calorie-tracker-php/app/controllers/Users.php",
            type: "GET",
            data: "&q=logout",
            dataType: 'json', // Expect JSON response
            success: function(response){
                if(response.success) {
                    Swal.fire({
                        title: 'User logout successfully!',
                        icon: 'success'
                    }).then(function() {
                        window.location = '/calorie-tracker-php/app/views/login.php'; // Redirect to home.php
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
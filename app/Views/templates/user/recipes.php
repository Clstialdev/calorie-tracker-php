<?php
$rootPath = ROOT;
require_once $rootPath . '/Config/Globals.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?=BASE_APP_DIR?>/public/css/colors.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="<?=BASE_APP_DIR?>/public/css/global.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

</head>

<body>
  <!-- HEADER -->
  <?php
 include_once VIEWSDIR.DS.'components'.DS.'header.php';
  ?>

  <div class="w-full min-h-screen pl-[180px] bg-bg">
    <!-- Login Form-->
    <div class="w-full items-center flex-column flex min-h-screen pt-24">
      <h1 class="text-5xl font-bold">Recipes 
      </h1>


    <div class="container">
        <div class="row">
          <div class="col lg 12">
          <h1 class="text-5xl font-bold"> Recipes Table</h1>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">

          </div>
          <div class="col-lg-6">
            <button type="button" class="btn btn-primary m1 float-right " data-toggle="modal" data-target="#addModel"> <i class="fas fa-user-plus fa-lg"></i> Add new user </button>
          </div>
        </div>
        <hr class="my-1">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive" id="showRecipes">
                
                
                    
              </div>
            </div>
          </div>
        </hr>
      </div>
    </div>
      </div>
      </div>

       

      </div>
<!-- Correct Order and Single Version of jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap and Other Dependencies -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>




  <script src="<?=BASE_APP_DIR?>/public/js/ajax.js"></script>

  <script type="text/javascript">
     $(document).ready(function(){

     // performAjaxRequest(
      //    "GET",
       //   "showAllRecipes",
        //  "",
        //  "",
         // ""
        //);
     });
    
  </script>



</body>

</html>
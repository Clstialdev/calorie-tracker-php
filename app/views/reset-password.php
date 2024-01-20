<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../public/css/colors.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../../public/css/global.css" />

  </head>
  <body>
    <!-- HEADER -->
    <?php
    include_once 'header.php';
    ?>
    <!-- BODY -->
    <div class="w-full min-h-screen pl-[180px] bg-bg">
      <!-- Login Form-->
      <div class="w-full items-center flex-column flex min-h-screen pt-24">
        <h1 class="text-5xl font-bold">New password Request</h1>
        <form
          
          class="bg-gray w-[500px] rounded min-h-[400px] mt-14 p-8"
          id="form-data" 
          action=""
          method="POST" 
          
        >

          <div class="flex flex-column mt-4">
            <label class="font-bold text-white">Email</label>
            <input
              type="email"
              name="email"
              placeholder="Ex:john.doe@gmail.com"
              class="py-3 px-4 rounded mt-2"
              required
            />
          </div>
          <div class="flex flex-column mt-4">
            <input type="submit" 
             class="py-3 px-4 bg-[#d6ff92] rounded w-full" 
             name="resetPassword" 
             id="resetPassword" 
             value="Receive Email">
          </div>
        </form>
        
      </div>
    </div>



<script type="text/javascript">

$("#resetPassword").click(function(e){
    if($("#form-data")[0].checkValidity()){
        e.preventDefault();
        
        $.ajax({
            url: "../controllers/ResetPasswords.php",
            type: "POST",
            data: $("#form-data").serialize() + "&action=resetPassword",
            dataType: 'json', // Expect JSON response
            
            success: function(response){
               // console.log(response.message);
                if(response.success) {
                    Swal.fire({
                        title: 'New password Email sent successfully!',
                        icon: 'success'
                    }).then(function() {
                        window.location = 'login.php'; // Redirect to home.php
                    });
                    $("#form-data")[0].reset(); // Reset form only on success
                } else {
                    Swal.fire({
                        title: 'Reset password request failed!',
                        text: response.message, // Display the error message from the server
                        icon: 'error'
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
    }
});
   
</script>
  </body>
</html>

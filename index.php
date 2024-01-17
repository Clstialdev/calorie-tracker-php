<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration and Login</title>
    <link rel="stylesheet" href="public/css/formulaire.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

   
</head>
<body>

<?php  
       include_once './app/views/header.php'; 
       include_once './app/helpers/session_helper.php';

?>

<h1 class="header">Please Signup or Login</h1>

<!-- Toggle Buttons -->
<button onclick="showForm('form-data')">Register</button>
<button onclick="showForm('login')">Login</button>

<!-- Registration Form -->

<form id="form-data" action="" method="post" onsubmit="return validatePassword()">

    <?php flash('register') ?>
    
    
    <input type="text" id="fullname" name="fullname" placeholder="Full Name" required><br><br>


    <input type="password" id="password" name="password" placeholder="Password" required><br><br>
    <input type="password" id="confPassword" name="confPassword" placeholder="Confirm Password" required><br><br>


    <input type="email" id="email" name="email" placeholder="email" required><br><br>

    <input type="number" id="age" name="age" placeholder="Age" required><br><br>

    <input type="number" step="0.01" id="weight" name="weight" placeholder="Weight (kg)" required><br><br>

    <input type="number" step="0.01" id="height" name="height" placeholder="Height (cm)" required><br><br>

    <input type="number" id="dailyCalorieGoal" name="dailyCalorieGoal" placeholder="Daily Calorie Goal" required><br><br>

    <select id="role" name="role" required>
    <option value="" selected disabled hidden>Role</option>
    <option value="nutritionist">Nutritionist</option>
    <option value="client">Client</option>
</select><br><br>



    <input type="submit" name="register" id="register" value="Register">
</form>

<!-- Login Form -->


<form  id="login" method="post" action="">
    <input type="hidden" name="type" value="login">
    <input type="text" name="usersUid" placeholder="Username or Email">
    <input type="password" name="usersPwd" placeholder="Password">
    <button type="submit" name="submit">Login</button>
</form>


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

<!-- Other scripts -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
function showForm(formId) {
    // Hide both forms
    document.getElementById('form-data').style.display = 'none';
    document.getElementById('login').style.display = 'none';
    
    // Show the requested form
    document.getElementById(formId).style.display = 'block';
}


function validatePassword() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confPassword").value;
    if(password != confirm_password) {
        alert("Passwords do not match.");
        return false; // Prevent the form from submitting
    }
    return true; // Allow the form submission if passwords match
}

$("#register").click(function(e){
    if($("#form-data")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
            url: "./app/controllers/Users.php",
            type: "POST",
            data: $("#form-data").serialize() + "&action=register",
            dataType: 'json', // Expect JSON response
            success: function(response){
                if(response.success) {
                    Swal.fire({
                        title: 'User added successfully!',
                        icon: 'success'
                    });
                    $("#form-data")[0].reset(); // Reset form only on success
                } else {
                    Swal.fire({
                        title: 'Registration failed!',
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

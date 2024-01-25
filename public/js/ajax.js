function handleAjaxResponse(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=first-login';
        });
        $("#form-data")[0].reset();
    } else {
        Swal.fire({
            title: 'Operation failed!',
            text: response.message,
            icon: 'error'
        });
    }
}
function handleAjaxResponseRegister(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=login';
        });
        $("#form-data")[0].reset();
    } else {
        Swal.fire({
            title: 'Operation failed!',
            text: response.message,
            icon: 'error'
        });
    }
}

function handleAjaxResponseFirstLogin(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=home';
        });
        $("#form-data")[0].reset();
    } else {
        Swal.fire({
            title: 'Operation failed!',
            text: response.message,
            icon: 'error'
        });
    }
}

function handleAjaxResponseLogout(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=login';
        });
    } else {
        Swal.fire({
            title: 'Operation failed!',
            text: response.message,
            icon: 'error'
        });
    }
}

function handleAjaxError(jqXHR, textStatus, errorThrown) {
    console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
    Swal.fire({
        title: 'AJAX error !',
        text: 'Please try again. (' + textStatus +'/ //' +  jqXHR.responseText +')',
        icon: 'error'
    });
}

function handleAjaxResponseResetPassword(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=login';
        });
        $("#form-data")[0].reset();
    } else {
        Swal.fire({
            title: 'Reset password request failed!',
            text: response.message,
            icon: 'error'
        });
    }
}

function handleAjaxResponseNewPassword(response, successTitle, successMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location.href = 'index.php?view=login';
        });
        $("#form-data")[0].reset();
    } else {
        Swal.fire({
            title: 'Reset password request failed!',
            text: response.message,
            icon: 'error'
        });
    }
}

function performAjaxRequest(requestType, action, additionalData, successTitle, successMessage) {
    console.log("dans ajax.js");
    $.ajax({
        url: "index.php",
        type: requestType,
        data: $("#form-data").serialize() + "&action=" + action + additionalData,
        dataType: 'json',
        success: function (response) {
            if (action == 'register') {
                handleAjaxResponseRegister(response, successTitle, successMessage);
            } else if (action == 'first-login') {
                handleAjaxResponseFirstLogin(response, successTitle, successMessage);
            } else if (action == 'logout') {
                handleAjaxResponseLogout(response, successTitle, successMessage);
            } else if (action == 'resetPassword'){
                handleAjaxResponseResetPassword(response, successTitle, successMessage);
            } else if (action == 'newPassword'){
                handleAjaxResponseNewPassword(response, successTitle, successMessage);
            }
            else {
                handleAjaxResponse(response, successTitle, successMessage);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            handleAjaxError(jqXHR, textStatus, errorThrown);
        }
    });
}

function handleAjaxResponse(response, successTitle, successMessage, errorMessage) {
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
            text: errorMessage + ' ' + response.message,
            icon: 'error'
        });
    }
}
function handleAjaxResponseRegister(response, successTitle, successMessage, errorMessage) {
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
            text: errorMessage + ' ' + response.message,
            icon: 'error'
        });
    }
}
function handleAjaxError(jqXHR, textStatus) {
    Swal.fire({
        title: 'AJAX error !',
        text: 'Please try again. (' + textStatus + ')',
        icon: 'error'
    });
}

function performAjaxRequest(action, additionalData, successTitle, successMessage, errorMessage) {
    console.log("dans ajax.js");
    $.ajax({
        url: "index.php",
        type: "POST",
        data: $("#form-data").serialize() + "&action=" + action + additionalData,
        dataType: 'json',
        success: function (response) {
            if (action == 'register') {
                handleAjaxResponseRegister(response, successTitle, successMessage, errorMessage);
            } else {
                handleAjaxResponse(response, successTitle, successMessage, errorMessage);

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            handleAjaxError(jqXHR, textStatus);
        }
    });
}

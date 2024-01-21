function handleAjaxResponse(response, successTitle, successMessage, errorMessage) {
    if (response.success) {
        Swal.fire({
            title: successTitle,
            text: successMessage,
            icon: 'success'
        }).then(function () {
            window.location = 'first-login.php';
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
        title: 'AJAX error!',
        text: 'Please try again. (' + textStatus + ')',
        icon: 'error'
    });
}

function performAjaxRequest(url, action, additionalData, successTitle, successMessage, errorMessage) {
    $.ajax({
        url: url,
        type: "POST",
        data: $("#form-data").serialize() + "&action=" + action + additionalData,
        dataType: 'json',
        success: function (response) {
            handleAjaxResponse(response, successTitle, successMessage, errorMessage);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            handleAjaxError(jqXHR, textStatus);
        }
    });
}

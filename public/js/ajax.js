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

/**
 * @description Affiche le message d'erreur lorsqu'une requête Ajax échoue.
 * Si l'erreur est envoyé 2 fois (comme pour register()), filtre le JSON pour 
 * éviter le doublon
 * 
 * @param {*} jqXHR l'erreur récupérée depuis Users.php 
 * @param {*} textStatus 
 * @param {*} errorThrown 
 */
function handleAjaxError(jqXHR, textStatus, errorThrown) {
    let errorMessage = textStatus;

    if (jqXHR.responseText) {
        const responseText = jqXHR.responseText.trim();
        const jsonRegex = /\{.*?\}/g;
        const jsonResults = responseText.match(jsonRegex);
        if (jsonResults.length > 0) {
            const responseObject = JSON.parse(jsonResults[0]);
            errorMessage = responseObject.message;
        }
        console.error(errorMessage);
        Swal.fire({
            title: 'AJAX error!',
            text: 'Please try again. (' + errorMessage + ')',
            icon: 'error'
        });
    }
}

function handleAjaxErrorOld(jqXHR, textStatus, errorThrown) {
    Swal.fire({
        title: 'AJAX error !',
        text: 'Please try again. (' + textStatus + ')',
        icon: 'error'
    });
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

/*
function performAjaxRequestGet(action, additionalData, successTitle, successMessage) {
    console.log("dans logout ajax.js");
    $.ajax({
        url: "index.php",
        type: "GET",
        data: "q=" + action + additionalData,
        dataType: 'json',
        success: function (response) {
            if (action == 'logout') {
                handleAjaxResponseLogout(response, successTitle, successMessage);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            handleAjaxError(jqXHR, textStatus);
        }
    });
}
*/
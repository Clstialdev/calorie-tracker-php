function performAjax(action, data, successCallback, errorCallback) {
    $.ajax({
        url: 'index.php?ajax_action=' + action,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    });
}

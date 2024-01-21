function performAjax(data, successCallback, errorCallback) {
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    });
}

const verifyUrlExist = function (url) {
    
    let xhr = new XMLHttpRequest();
    xhr.open('HEAD', url, false);
    xhr.send();
     
    return xhr.status !== 404;
}
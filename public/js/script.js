function backToTop() {
    window.scrollTo(0,0);
}

function updateFileName() {
    var input = document.getElementById('image');
    var fileNameDisplay = document.getElementById('selectedFileName');
    if (input.files.length > 0) {
        var fileName = input.files[0].name;
        fileNameDisplay.innerText = fileName;
    } else {
        fileNameDisplay.innerText = '';
    }
}
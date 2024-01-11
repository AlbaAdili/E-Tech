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

function updateImagePreview() {
    var input = document.getElementById('image');
    var imagePreview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
    }
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this product?');
}
function previewImage(inputId, imgId) {
    const input = document.getElementById(inputId);
    const img = document.getElementById(imgId);

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result;
                img.classList.remove('d-none');
            };

            reader.readAsDataURL(file);
        } else {
            img.src = '#';
            img.classList.add('d-none');
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    previewImage('main-image-input', 'main-image-preview');
});

window.previewImage = previewImage;
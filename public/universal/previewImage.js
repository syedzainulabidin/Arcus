document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileinput');
    const imgPreview = document.querySelector('.picture-container img');

    if (fileInput && imgPreview) {
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imgPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

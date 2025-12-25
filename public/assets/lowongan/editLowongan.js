
function previewImage() {
    const input = document.querySelector('#input-gambar');
    const preview = document.querySelector('#preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            // Mengubah src gambar preview menjadi data URL file yang baru dipilih
            preview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const btnEdit = document.getElementById('btnEditProfile');
    const editModalElement = document.getElementById('editDataModal');
    
    // Pastikan elemen modal ada sebelum mencoba menginisialisasinya
    if (editModalElement) {
        // Inisialisasi Modal Bootstrap
        const editModal = new bootstrap.Modal(editModalElement);
        
        // 1. Logika untuk menampilkan modal ketika tombol edit diklik
        if (btnEdit) {
            btnEdit.addEventListener('click', function() {
                editModal.show();
            });
        }

        // 2. Logika untuk menampilkan notifikasi jika ada pesan sukses (diambil dari data-attribute)
        const successMessage = editModalElement.getAttribute('data-success-message');
        
        // Cek apakah pesan sukses ada dan tidak kosong (karena Blade bisa mengembalikan string kosong)
        if (successMessage && successMessage !== '0') { 
            const successToastElement = document.getElementById('successToast');
            
            // Pastikan elemen Toast ditemukan
            if (successToastElement) {
                const toastBody = successToastElement.querySelector('.toast-body');
                toastBody.textContent = successMessage;
                
                const toast = new bootstrap.Toast(successToastElement);
                toast.show();
            }
        }

        // 3. Logika untuk menampilkan modal kembali jika terjadi error validasi (diambil dari data-attribute)
        const hasErrors = editModalElement.getAttribute('data-has-errors') === 'true';
        
        if (hasErrors) {
             editModal.show();
        }
    }
});
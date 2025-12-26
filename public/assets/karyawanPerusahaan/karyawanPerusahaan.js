document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('karyawanModal');
    const closeModal = document.getElementById('closeModal');
    const modalKategori = document.getElementById('modalKategori');
    const modalList = document.getElementById('modalKaryawanList');

    document.querySelectorAll('.btn-lihat').forEach(btn => {
        btn.addEventListener('click', () => {
            const kategori = btn.dataset.kategori;

            modalKategori.innerText = `Kategori: ${kategori}`;
            modalList.innerHTML = '<p>Loading...</p>';

            fetch(`/perusahaan/karyawan/by-kategori/${kategori}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        modalList.innerHTML = '<p>Tidak ada karyawan</p>';
                        return;
                    }

                    modalList.innerHTML = data.map(k => `
                        <div class="karyawan-item">
                            <strong>${k.nama}</strong>
                            <p>Posisi: ${k.posisi}</p>
                        </div>
                    `).join('');
                });

            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) modal.style.display = 'none';
    });
});

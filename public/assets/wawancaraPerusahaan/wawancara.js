document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('detailModal');
    const closeModal = document.getElementById('closeModal');

    let wawancaraId = null;
    let pelamarId = null;
    let lowonganId = null;

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            wawancaraId = btn.dataset.id;
            pelamarId = btn.dataset.pelamar;
            lowonganId = btn.dataset.lamaran;

            document.getElementById('modalPosisi').innerText = btn.dataset.posisi;
            document.getElementById('modalNama').innerText = btn.dataset.nama;
            document.getElementById('modalTanggal').innerText = btn.dataset.tanggal;
            document.getElementById('modalJam').innerText = btn.dataset.jam;
            document.getElementById('modalPesan').innerText = btn.dataset.pesan || '-';

            modal.style.display = 'flex';
        });
    });

    document.getElementById('btnTerima').addEventListener('click', () => {
        fetch(`/perusahaan/wawancara/${wawancaraId}/terima`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => location.reload());
    });

    document.getElementById('btnTolak').addEventListener('click', () => {
        fetch(`/perusahaan/wawancara/${wawancaraId}/tolak`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => location.reload());
    });

    closeModal.addEventListener('click', () => modal.style.display = 'none');
});

document.addEventListener('DOMContentLoaded', () => {

    const tabs = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card');

    function filterCards(status) {
        cards.forEach(card => {
            card.style.display =
                card.dataset.status === status ? 'block' : 'none';
        });
    }

    filterCards('akan-datang');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('tab-active'));
            tab.classList.add('tab-active');

            filterCards(tab.dataset.tab);
        });
    });

    const modal = document.getElementById('detailModal');
    const closeModal = document.getElementById('closeModal');

    let wawancaraId = null;

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            wawancaraId = btn.dataset.id;

            document.getElementById('modalPosisi').innerText = btn.dataset.posisi;
            document.getElementById('modalNama').innerText = btn.dataset.nama;
            document.getElementById('modalTanggal').innerText = btn.dataset.tanggal;
            document.getElementById('modalJam').innerText = btn.dataset.jam;
            document.getElementById('modalPesan').innerText = btn.dataset.pesan || '-';

            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

});

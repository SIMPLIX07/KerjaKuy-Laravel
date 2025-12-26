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

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalPosisi').innerText = btn.dataset.posisi;
            document.getElementById('modalPerusahaan').innerText = btn.dataset.perusahaan;
            document.getElementById('modalTanggal').innerText = btn.dataset.tanggal;
            document.getElementById('modalJam').innerText = btn.dataset.jam;
            document.getElementById('modalPesan').innerText = btn.dataset.pesan || '-';

            const statusText = btn.dataset.status === 'proses'
                ? 'Akan Datang'
                : 'Selesai';

            document.getElementById('modalStatus').innerText = statusText;

            const modalLink = document.getElementById('modalLink');
            if (btn.dataset.link) {
                modalLink.href = btn.dataset.link;
                modalLink.style.display = 'inline-block';
            } else {
                modalLink.style.display = 'none';
            }

            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});

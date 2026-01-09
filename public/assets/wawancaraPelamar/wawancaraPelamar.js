document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card-wawancara');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-button');

    function filterAll() {
        const activeTab = document.querySelector('.tab-btn.tab-active');
        const activeStatus = activeTab ? activeTab.dataset.tab : 'proses';
        const searchText = searchInput.value.toLowerCase();

        cards.forEach(card => {
            const statusCocok = card.dataset.status === activeStatus;

            const posisi = card.querySelector('.posisi-pekerjaan').textContent.toLowerCase();
            const perusahaan = card.querySelector('.nama-perusahaan').textContent.toLowerCase();
            const searchCocok = posisi.includes(searchText) || perusahaan.includes(searchText);

            if (statusCocok && searchCocok) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('tab-active'));
            tab.classList.add('tab-active');
            filterAll(); 
        });
    });

    if (searchButton) searchButton.addEventListener('click', filterAll);
    if (searchInput) searchInput.addEventListener('keyup', filterAll);

    filterAll();

    const modal = document.getElementById('detailModal');
    const closeModal = document.getElementById('closeModal');

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalPosisi').innerText = btn.dataset.posisi;
            document.getElementById('modalPerusahaan').innerText = btn.dataset.perusahaan;
            document.getElementById('modalTanggal').innerText = btn.dataset.tanggal;
            document.getElementById('modalJam').innerText = btn.dataset.jam;
            document.getElementById('modalPesan').innerText = btn.dataset.pesan || '-';

            const statusText = btn.dataset.status === 'proses' ? 'Akan Datang' : 'Selesai';
            document.getElementById('modalStatus').innerText = statusText;

            const modalLink = document.getElementById('modalLink');
            if (btn.dataset.link) {
                modalLink.href = btn.dataset.link;
                modalLink.style.display = 'inline-block';
            } else {
                modalLink.style.display = 'none';
            }

            if (modal) modal.style.display = 'flex';
        });
    });

    if (closeModal) {
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card');

    function filterCards(status) {
        cards.forEach(card => {
            card.style.display =
                card.dataset.status === status ? 'block' : 'none';
        });
    }

    // default: Akan Datang
    filterCards('akan-datang');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('tab-active'));
            tab.classList.add('tab-active');

            filterCards(tab.dataset.tab);
        });
    });
});

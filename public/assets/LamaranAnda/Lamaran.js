// document.addEventListener("DOMContentLoaded", async function () {
//     const container = document.querySelector(".cards-container");
//     const username = document.querySelector(".user-margin").textContent.trim();

//     try {
//         const response = await fetch("assets/LamaranAnda/dataLamaran.json");
//         const data = await response.json();

//         const user = data.userPelamar.find(u => u.username === username);

//         if (!user || !user.lamaran || user.lamaran.length === 0) {
//             container.innerHTML = "<p style='text-align:center;'>Kamu belum mengajukan lamaran.</p>";
//             return;
//         }

//         user.lamaran.forEach(lamaran => {
//             const card = document.createElement("div");
//             card.classList.add("card");

//             const status = document.createElement("div");
//             status.classList.add("status", lamaran.status.toLowerCase());

//             const body = document.createElement("div");
//             body.classList.add("card-body");

//             const title = document.createElement("h5");
//             title.classList.add("card-title");
//             title.textContent = lamaran.posisiLamaran;

//             const perusahaanNama = document.createElement("p");
//             perusahaanNama.classList.add("card-perusahaan");
//             perusahaanNama.textContent = lamaran.perusahaan;

//             const pesan = document.createElement("p");
//             pesan.classList.add("card-pesan");

//             const statusLower = lamaran.status.toLowerCase();
//             if (statusLower === "diterima") {
//                 pesan.textContent = `Selamat, anda diterima di ${lamaran.perusahaan}.`;
//             } else if (statusLower === "ditolak") {
//                 pesan.textContent = `Maaf, anda belum diterima di ${lamaran.perusahaan}. Tetap semangat!`;
//             } else if (statusLower === "diproses" || statusLower === "proses") {
//                 pesan.textContent = `Lamaran anda sedang diproses oleh ${lamaran.perusahaan}, sabar ya.`;
//             }

//             body.appendChild(title);
//             body.appendChild(perusahaanNama);
//             body.appendChild(pesan);
//             card.appendChild(status);
//             card.appendChild(body);
//             container.appendChild(card);
//         });
//     } catch (error) {
//         console.error("Gagal memuat data lamaran:", error);
//         container.innerHTML = "<p style='text-align:center; color:red;'>Gagal memuat data lamaran.</p>";
//     }
// });

document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-button');

    function filterAll() {
        const activeStatus = document.querySelector('.tab-btn.tab-active').dataset.tab;
        const searchText = searchInput.value.toLowerCase();

        cards.forEach(card => {
            const statusCocok = card.dataset.status === activeStatus;
            
            // Ambil teks untuk pencarian
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const company = card.querySelector('.card-company').textContent.toLowerCase();
            const searchCocok = title.includes(searchText) || company.includes(searchText);

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

    searchButton.addEventListener('click', filterAll);

    searchInput.addEventListener('keyup', filterAll);

    filterAll();
});
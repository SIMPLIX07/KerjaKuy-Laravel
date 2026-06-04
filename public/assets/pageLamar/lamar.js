document.addEventListener("DOMContentLoaded", () => {
    const btnLamars = document.querySelectorAll(".button");
    const modal = document.getElementById("modalCv");
    const btnTutup = document.getElementById("btnTutup");
    const cvList = document.getElementById("cvList");
    const btnKirim = document.getElementById("btnKirimLamaran");
    const pelamarId = document.querySelector('meta[name="pelamar-id"]')?.content;
    const lowonganId = document.querySelector('meta[name="lowongan-id"]')?.content;

    let selectedCvId = null;

    if (!pelamarId || !lowonganId || !btnLamars.length) {
        console.error("Missing pelamar-id or lowongan-id meta tag");
        btnLamars.forEach(btn => {
            btn.disabled = true;
            btn.textContent = "Gagal memuat lamaran";
        });
        return;
    }

    btnLamars.forEach(btnLamar => {
        btnLamar.addEventListener("click", async () => {
        modal.style.display = "flex";
        btnKirim.disabled = true;
        cvList.innerHTML = "Memuat CV...";
        console.log("PELAMAR_ID:", pelamarId);


        const res = await fetch("/pelamar/cv");
        const data = await res.json();

        if (!data.length) {
            cvList.innerHTML = `
                <div style="grid-column:1/-1; text-align:center; padding:20px;">
                    <p><b>Maaf, kamu belum memiliki CV.</b></p>
                    <p>Silakan buat CV terlebih dahulu sebelum melamar.</p>
                </div>
            `;
            return;
        }

        cvList.innerHTML = "";

        data.forEach(cv => {
            const div = document.createElement("div");
            div.classList.add("cv-card");

            div.innerHTML = `
                <div class="cv-title">${cv.nama_file ?? "CV #" + cv.id}</div>
                <div class="cv-date">ID: ${cv.id}</div>
            `;

            div.addEventListener("click", () => {
                document.querySelectorAll(".cv-card")
                    .forEach(c => c.classList.remove("active"));

                div.classList.add("active");
                selectedCvId = cv.id;
                btnKirim.disabled = false;
            });

            cvList.appendChild(div);
        });
        });
    });

    if (btnTutup) {
        btnTutup.addEventListener("click", () => {
            modal.style.display = "none";
            selectedCvId = null;
        });
    }

    btnKirim.addEventListener("click", async () => {
        if (!selectedCvId) return;

        const response = await fetch("/lamaran/insert", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                pelamar_id: pelamarId,
                lowongan_id: lowonganId,
                cv_id: selectedCvId
            })
        });

        const result = await response.json();

        if (response.ok) {
            const modalCv = document.getElementById("modalCv");
            const successModal = document.getElementById("successModal");
            const btnOk = document.getElementById("btnOk");
            modalCv.style.display = "none";
            selectedCvId = null;
            btnKirim.disabled = true;
            successModal.style.display = "flex";
            btnOk.onclick = () => {
                window.location.href = "/lamaran-anda";
            };
        }


        else {
            alert(result.message || "Gagal mengirim lamaran");
        }
    });
});

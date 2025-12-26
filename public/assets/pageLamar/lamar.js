document.addEventListener("DOMContentLoaded", () => {
    const btnLamar = document.querySelector(".button");
    const modal = document.getElementById("modalCv");
    const btnTutup = document.getElementById("btnTutup");
    const cvList = document.getElementById("cvList");
    const btnKirim = document.getElementById("btnKirimLamaran");

    let selectedCvId = null;

    btnLamar.addEventListener("click", async () => {
        modal.style.display = "flex";
        btnKirim.disabled = true;
        cvList.innerHTML = "Memuat CV...";
        console.log("PELAMAR_ID:", window.PELAMAR_ID);


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

    btnTutup.addEventListener("click", () => {
        modal.style.display = "none";
        selectedCvId = null;
    });

    btnKirim.addEventListener("click", async () => {
        if (!selectedCvId) return;

        const response = await fetch("/lamaran/insert", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                pelamar_id: window.PELAMAR_ID,
                lowongan_id: window.LOWONGAN_ID,
                cv_id: selectedCvId
            })
        });

        const result = await response.json();

        if (response.ok) {
            alert("Lamaran berhasil dikirim!");
            window.location.href = "/lamaran-anda";
        } else {
            alert(result.message || "Gagal mengirim lamaran");
        }
    });
});

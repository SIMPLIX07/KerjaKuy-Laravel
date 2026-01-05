const express = require('express');
const mysql = require('mysql2');
const bcrypt = require('bcryptjs');
const cors = require('cors');
require('dotenv').config();

const app = express();
app.use(cors({
    origin: '*',
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type']
}));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// konek db
const db = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: process.env.DB_NAME,
    port: process.env.DB_PORT
});

db.connect(err => {
    if (err) {vis
        console.error('DB Error:', err);
    } else {
        console.log('MySQL Connected');
    }
});

// API Wawancara
app.post('/log-wawancara', (req, res) => {
    console.log("Ada request masuk ke /log-wawancara"); 
    console.log("Body Data:", req.body);

    const { perusahaan, pelamar, room } = req.body;

    if (!perusahaan || !pelamar) {
        console.log("Data tidak lengkap!");
        return res.status(400).json({ message: 'Data incomplete' });
    }

    console.log(`===== NOTIFIKASI WAWANCARA =====`);
    console.log(`Perusahaan : ${perusahaan}`);
    console.log(`Pelamar    : ${pelamar}`);
    console.log(`Link Room  : ${room}`);
    console.log(`Waktu      : ${new Date().toLocaleTimeString()}`);

    res.json({ status: 'success' });
});

// LOGIN API
app.post('/login-pelamar', (req, res) => {
    const { username, password } = req.body;

    console.log('=== LOGIN ATTEMPT ===');
    console.log('Username input:', username);
    console.log('Password input:', password);

    db.query(
        'SELECT * FROM pelamars WHERE username = ?',
        [username],
        async (err, result) => {
            if (err) {
                console.log('DB ERROR:', err);
                return res.status(500).json({ message: 'Database error' });
            }
            if (result.length === 0) {
                console.log('USER NOT FOUND');
                return res.status(401).json({ message: 'Username tidak ditemukan' });
            }
            const pelamar = result[0];
            console.log('Password HASH from DB:', pelamar.password);
            const inputPassword = password.trim();
            const hashFromDb = pelamar.password.toString();
            const valid = await bcrypt.compare(inputPassword, hashFromDb);
            console.log('BCRYPT RESULT:', valid);

            if (!valid) {
                console.log('LOGIN FAILED: PASSWORD MISMATCH');
                return res.status(401).json({ message: 'Password salah' });
            }
            console.log('LOGIN SUCCESS');
            res.json({
                id: pelamar.id,
                username: pelamar.username,
                nama: pelamar.nama_lengkap
            });
        }
    );
});

// GET LOWONGAN
app.get('/lowongan', (req, res) => {
    const { kategori, lokasi } = req.query;

    let sql = `
        SELECT 
            l.id,
            l.posisi_pekerjaan,
            l.kategori_pekerjaan,
            l.lokasi,
            l.gaji,
            p.nama_perusahaan
        FROM lowongans l
        JOIN perusahaans p ON l.perusahaan_id = p.id
        WHERE 1=1
    `;

    const params = [];

    if (kategori) {
        sql += ' AND l.kategori_pekerjaan = ?';
        params.push(kategori);
    }

    if (lokasi) {
        sql += ' AND l.lokasi = ?';
        params.push(lokasi);
    }

    db.query(sql, params, (err, results) => {
        if (err) {
            console.error('DB ERROR:', err);
            return res.status(500).json({ message: 'Database error' });
        }

        res.json({
            status: 'success',
            total: results.length,
            data: results
        });
    });
});


const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});


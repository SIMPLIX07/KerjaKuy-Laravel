const express = require('express');
const mysql = require('mysql2');
const bcrypt = require('bcryptjs');
const cors = require('cors');
require('dotenv').config();

const app = express();
app.use(cors());
app.use(express.json());

// konek db
const db = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: process.env.DB_NAME,
    port: process.env.DB_PORT
});

db.connect(err => {
    if (err) {
        console.error('DB Error:', err);
    } else {
        console.log('MySQL Connected');
    }
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

app.listen(process.env.PORT, () => {
    console.log(`Node Auth running on port ${process.env.PORT}`);
});

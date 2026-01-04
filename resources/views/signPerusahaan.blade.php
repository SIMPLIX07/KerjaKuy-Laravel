<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kerja Kuy</title>
  <link rel="stylesheet" href="/assets/SignupPerusahaan/signPerusahaan.css" />
</head>

<body>
  <div class="container">
    <h2>Sign Up Perusahaan</h2>

    @if ($errors->any())
      <div style="color:red; margin-bottom:10px;">
        <ul>
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('register.perusahaan') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="username">
        <label for="username">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" id="usn" class="form_input" placeholder=" Masukan Nama Perusahaan"
          value="{{ old('nama_perusahaan') }}" />
      </div>

      <div class="email">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form_input" placeholder=" Masukan Email"
          value="{{ old('email') }}" />
      </div>

      <div class="password">
        <label for="password">Password</label>
        <input type="password" name="password" id="pass" class="form_input" placeholder=" Masukan Password" />
      </div>

      <div class="telepon">
        <label for="telepon">Nomor Telepon Perusahaan</label>
        <input type="text" name="telepon" id="telepon" class="form_input"
          placeholder=" Masukan Nomor Telepon Perusahaan" value="{{ old('telepon') }}" />
      </div>

      <div class="npwp">
        <label for="npwp">NPWP Perusahaan</label>
        <input type="text" name="npwp" id="npwp" class="form_input" placeholder=" Misal: 00.000.000.0-000.000"
          value="{{ old('npwp') }}" />
      </div>

      <div class="uploadFotoProfil">
        <label class="upload-btn">
          Upload Foto Profil
          <input type="file" name="foto_profil" hidden accept="image/*">
        </label>
      </div>



      <div class="uploadSertif">
        <label for="fileInput">Sertifikat Perusahaan</label>
        <label class="upload-btn">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117 9a3 3 0 013 3 3 3 0 01-3 3H7z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v9m0 0l-3-3m3 3l3-3" />
          </svg>
          Upload File
          <input type="file" hidden id="fileInput" name="sertifikat" />
        </label>
      </div>

      <div class="link">
        <label id="forgot"><a href="#">Lupa password?</a></label>
        <label id="register"><a href="/login/perusahaan">Sudah punya akun?</a></label>
      </div>

      <button type="submit" id="next">Lanjut</button>
    </form>
  </div>

  <script>
    document.querySelector('form').addEventListener('submit', async function (e) {
      e.preventDefault(); // Menghentikan pengiriman form otomatis

      const form = this;
      const submitButton = document.getElementById('next');

      // Nonaktifkan tombol agar tidak diklik dua kali
      submitButton.disabled = true;
      submitButton.innerText = "Memproses...";

      // Ambil data dari input
      const formData = {
        nama_perusahaan: document.getElementById('usn').value,
        email: document.getElementById('email').value,
        password: document.getElementById('pass').value,
        telepon: document.getElementById('telepon').value,
        npwp: document.getElementById('npwp').value,
      };

      try {
        // 1. Kirim ke Node.js (Port 3001)
        const response = await fetch('http://localhost:3001/register-perusahaan', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (result.success) {
          console.log('Node.js Success:', result.message);

          // 2. Kirim ke Laravel secara paksa untuk mengurus Session & Redirect
          // Kita hapus listener submit agar tidak terjadi looping (pemanggilan berulang)
          form.submit();
        } else {
          alert('Gagal di Node.js: ' + result.message);
          submitButton.disabled = false;
          submitButton.innerText = "Lanjut";
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Server Node.js belum jalan atau error!');
        submitButton.disabled = false;
        submitButton.innerText = "Lanjut";
      }
    });
  </script>
</body>

</html>
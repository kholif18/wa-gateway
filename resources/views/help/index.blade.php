@extends('layouts.app')
@section('title', 'Help')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4">📘 Panduan Penggunaan R Gateway</h2>

        <div class="mb-4">
            <h4>🔐 1. Login</h4>
            <p>Gunakan akun yang telah terdaftar. Satu akun akan mewakili satu sesi WhatsApp.</p>
        </div>

        <div class="mb-4">
            <h4>📲 2. Hubungkan WhatsApp</h4>
            <ol>
                <li>Masuk ke halaman <strong>Login WhatsApp</strong>.</li>
                <li>QR Code akan muncul.</li>
                <li>Buka WhatsApp di ponsel Anda:
                    <ul>
                        <li>Ketuk ikon titik tiga → <em>Perangkat tertaut</em>.</li>
                        <li>Pilih <em>Tautkan perangkat</em>, lalu <strong>scan QR Code</strong>.</li>
                    </ul>
                </li>
                <li>Status akan berubah menjadi <strong>Terkoneksi</strong>.</li>
            </ol>
        </div>

        <div class="mb-4">
            <h4>💬 3. Kirim Pesan WhatsApp</h4>
            <p>Masuk ke halaman <strong>Kirim Pesan</strong>, isi formulir berikut:</p>
            <ul>
                <li>Nomor penerima (format internasional, contoh: <code>6281234567890</code>)</li>
                <li>Isi pesan</li>
                <li>Klik tombol <strong>Kirim</strong></li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>📄 4. Format Nomor</h4>
            <p>Gunakan <strong>kode negara</strong>, tanpa tanda tambah <code>+</code> atau angka <code>0</code> di depan.</p>
            <ul>
                <li><strong>Benar:</strong> <code>6281234567890</code></li>
                <li><strong>Salah:</strong> <code>081234567890</code></li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>📊 5. Riwayat Pengiriman</h4>
            <p>Anda dapat melihat log pengiriman pada halaman <strong>Riwayat</strong>:</p>
            <ul>
                <li>Isi pesan</li>
                <li>Nomor tujuan</li>
                <li>Waktu kirim</li>
                <li>Status pengiriman (sukses, gagal, atau tertunda)</li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>⚙️ 6. Pengaturan Lanjutan</h4>
            <p>Anda dapat mengatur beberapa fitur lanjutan:</p>
            <ul>
                <li>API Token <a href="{{ route('help.api') }}">Dokumentasi API</a></li>
                <li>Default sender</li>
                <li>Waktu timeout dan retry</li>
                <li>Logging dan sistem antrean</li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>⚠️ 7. Tips & Catatan</h4>
            <ul>
                <li>Jangan logout dari WhatsApp di ponsel, agar sesi tetap aktif.</li>
                <li>Jika QR Code terus muncul, sesi Anda mungkin terputus. Silakan scan ulang.</li>
                <li>Hindari menggunakan nomor WhatsApp yang sama di lebih dari satu akun.</li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>❓ Butuh Bantuan?</h4>
            <p>Silakan hubungi admin sistem, atau lihat dokumentasi ini kapan saja melalui menu bantuan.</p>
        </div>

        <div class="mb-4">
            <h4>📌 Penutup</h4>
            <p>WA Gateway dirancang untuk kebutuhan otomatisasi pengiriman pesan seperti:</p>
            <ul>
                <li>Notifikasi pelanggan</li>
                <li>Pengingat pembayaran</li>
                <li>Broadcast informasi</li>
            </ul>
            <p>Gunakan layanan ini dengan bijak dan sesuai kebijakan penggunaan WhatsApp.</p>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Panduan API')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">🔗 Panduan API - R Gateway</h2>

        <div class="mb-4">
            <p>
                API R Gateway memungkinkan aplikasi pihak ketiga mengirim pesan WhatsApp secara otomatis menggunakan token otentikasi.
            </p>
        </div>

        <div class="mb-4">
            <h4>🔐 1. Autentikasi</h4>
            <p>Gunakan <code>Authorization: Bearer {API_TOKEN}</code> pada header setiap permintaan.</p>
        </div>

        <div class="mb-4">
            <h4>✉️ 2. Endpoint Kirim Pesan</h4>
            <pre><code>POST /api/send</code></pre>
            <strong>Header:</strong>
            <pre><code>
    Authorization: Bearer {API_TOKEN}
    Content-Type: application/json
            </code></pre>

            <strong>Body JSON:</strong>
            <pre><code>{
    "phone": "6281234567890",
    "message": "Halo dari aplikasi Anda"
    }</code></pre>
        </div>

        <div class="mb-4">
            <h4>📥 3. Response</h4>
            <strong>Sukses:</strong>
            <pre><code>{
    "status": "success",
    "message": "Pesan berhasil dikirim",
    "data": {
        "phone": "6281234567890",
        "status": "sent",
        "sent_at": "2025-06-28T19:26:15"
    }
    }</code></pre>

            <strong>Gagal:</strong>
            <pre><code>{
    "status": "failed",
    "message": "Token tidak valid atau sesi tidak tersedia"
    }</code></pre>
        </div>

        <div class="mb-4">
            <h4>💡 4. Contoh Kode Integrasi</h4>

            <h5 class="mt-3">PHP (cURL)</h5>
            <pre><code class="language-php">\$curl = curl_init();
    curl_setopt_array(\$curl, [
        CURLOPT_URL => 'https://your-domain.com/api/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer YOUR_API_TOKEN',
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => json_encode([
            'phone' => '6281234567890',
            'message' => 'Pesan dari PHP'
        ])
    ]);

    \$response = curl_exec(\$curl);
    curl_close(\$curl);
    echo \$response;</code></pre>

            <h5 class="mt-4">JavaScript (Fetch)</h5>
            <pre><code class="language-js">fetch('https://your-domain.com/api/send', {
    method: 'POST',
    headers: {
        'Authorization': 'Bearer YOUR_API_TOKEN',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        phone: '6281234567890',
        message: 'Pesan dari JavaScript'
    })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));</code></pre>

            <h5 class="mt-4">Python (requests)</h5>
            <pre><code class="language-python">import requests

    url = 'https://your-domain.com/api/send'
    headers = {
        'Authorization': 'Bearer YOUR_API_TOKEN',
        'Content-Type': 'application/json'
    }
    data = {
        'phone': '6281234567890',
        'message': 'Pesan dari Python'
    }

    response = requests.post(url, headers=headers, json=data)
    print(response.json())</code></pre>
        </div>

        <div class="mb-4">
            <h4>⚠️ 5. Catatan Penting</h4>
            <ul>
                <li>Nomor harus dalam format internasional tanpa + atau 0.</li>
                <li>Token harus valid dan sesuai dengan sesi WhatsApp yang aktif.</li>
                <li>Gunakan HTTPS untuk keamanan.</li>
            </ul>
        </div>

        <div class="mb-4">
            <h4>📞 Butuh Bantuan?</h4>
            <p>Silakan hubungi admin sistem jika mengalami kendala dalam integrasi API.</p>
        </div>
    </div>
@endsection

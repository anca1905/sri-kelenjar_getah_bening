@extends('layouts.publik')

@section('title', 'Beranda - Sistem Pakar KGB')
@section('description', 'Sistem Pakar Diagnosis Penyakit Kelenjar Getah Bening berbasis metode Forward Chaining dan Certainty Factor. Dikembangkan sebagai tugas akhir Sri Nurlia, USN Kolaka.')

@push('styles')
<style>
    /* ===== HERO ===== */
    .hero {
        background: linear-gradient(135deg, #1a3c6e 0%, #2563a8 60%, #0ea5b0 100%);
        color: #fff;
        padding: 70px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 340px; height: 340px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        pointer-events: none;
    }
    .hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -50px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(14,165,176,0.08);
        pointer-events: none;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 20px;
        font-size: 0.78rem;
        padding: 4px 14px;
        margin-bottom: 18px;
        letter-spacing: 0.5px;
    }
    .hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 16px;
    }
    .hero h1 span { color: #7dd3e8; }
    .hero p {
        font-size: 0.95rem;
        opacity: 0.88;
        max-width: 520px;
        line-height: 1.7;
        margin-bottom: 28px;
    }
    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-hero-main {
        background: #fff;
        color: #1a3c6e;
        font-weight: 700;
        padding: 11px 26px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.92rem;
        display: inline-flex; align-items: center; gap: 8px;
        transition: background 0.2s, transform 0.15s;
    }
    .btn-hero-main:hover { background: #e8f1fb; color: #1a3c6e; transform: translateY(-1px); }
    .btn-hero-outline {
        background: transparent;
        color: #fff;
        font-weight: 600;
        padding: 11px 24px;
        border-radius: 6px;
        border: 1.5px solid rgba(255,255,255,0.5);
        text-decoration: none;
        font-size: 0.92rem;
        display: inline-flex; align-items: center; gap: 8px;
        transition: border-color 0.2s, background 0.2s;
    }
    .btn-hero-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); color: #fff; }

    /* ===== STATS BAR ===== */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #dde3ea;
    }
    .stats-bar .container { display: flex; flex-wrap: wrap; justify-content: center; gap: 0; }
    .stat-item {
        padding: 18px 36px;
        text-align: center;
        border-right: 1px solid #eee;
        flex: 1; min-width: 140px;
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
        font-size: 1.6rem;
        font-weight: 800;
        color: #1a3c6e;
        line-height: 1;
    }
    .stat-label {
        font-size: 0.78rem;
        color: #888;
        margin-top: 4px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    /* ===== SECTION UMUM ===== */
    .section { padding: 56px 0; }
    .section-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #1a3c6e;
        margin-bottom: 8px;
    }
    .section-sub {
        font-size: 0.88rem;
        color: #888;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    /* ===== CARA KERJA ===== */
    .step-card {
        background: #fff;
        border: 1px solid #dde3ea;
        border-radius: 8px;
        padding: 24px 20px;
        height: 100%;
        transition: box-shadow 0.2s;
    }
    .step-card:hover { box-shadow: 0 4px 16px rgba(26,60,110,0.09); }
    .step-num {
        width: 36px; height: 36px;
        background: #e8f1fb;
        color: #1a3c6e;
        font-weight: 800;
        font-size: 0.9rem;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
    }
    .step-card h5 { font-size: 0.95rem; font-weight: 700; color: #1a3c6e; margin-bottom: 8px; }
    .step-card p { font-size: 0.85rem; color: #666; margin: 0; line-height: 1.6; }

    /* ===== PENYAKIT CARD ===== */
    .penyakit-card {
        background: #fff;
        border: 1px solid #dde3ea;
        border-radius: 8px;
        padding: 18px 20px;
        display: flex; align-items: flex-start; gap: 14px;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .penyakit-card:hover { box-shadow: 0 3px 12px rgba(26,60,110,0.08); border-color: #2563a8; }
    .penyakit-icon {
        width: 40px; height: 40px;
        background: #e8f1fb;
        color: #2563a8;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .penyakit-card h6 { font-size: 0.9rem; font-weight: 700; color: #1a3c6e; margin-bottom: 4px; }
    .penyakit-card p { font-size: 0.82rem; color: #777; margin: 0; line-height: 1.5; }

    /* ===== CTA ===== */
    .cta-section {
        background: linear-gradient(to right, #1a3c6e, #2563a8);
        color: #fff;
        padding: 52px 0;
        text-align: center;
    }
    .cta-section h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 10px; }
    .cta-section p { font-size: 0.9rem; opacity: 0.85; margin-bottom: 24px; max-width: 480px; margin-left: auto; margin-right: auto; }
    .btn-cta {
        background: #0ea5b0;
        color: #fff;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.93rem;
        display: inline-flex; align-items: center; gap: 8px;
        transition: background 0.2s;
    }
    .btn-cta:hover { background: #0c8d98; color: #fff; }

    /* ===== INFO SECTION ===== */
    .info-highlight {
        background: #f5f7fa;
        border-radius: 8px;
        padding: 20px 22px;
        border-left: 4px solid #2563a8;
        font-size: 0.87rem;
        color: #444;
        line-height: 1.7;
    }
    .info-highlight strong { color: #1a3c6e; }

    @media (max-width: 768px) {
        .hero { padding: 50px 0 44px; }
        .hero h1 { font-size: 1.7rem; }
        .stat-item { padding: 14px 20px; }
    }
    @media (max-width: 576px) {
        .hero-actions { flex-direction: column; }
        .btn-hero-main, .btn-hero-outline { justify-content: center; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="hero-badge">
                    <i class="bi bi-cpu me-1"></i> Sistem Pakar &mdash; Forward Chaining &amp; Certainty Factor
                </span>
                <h1>Kenali Gangguan <span>Kelenjar Getah Bening</span> Sejak Dini</h1>
                <p>
                    Isi kuesioner gejala dan dapatkan analisis awal kemungkinan jenis penyakit kelenjar getah bening yang Anda alami. Sistem ini menggunakan data medis yang sudah divalidasi.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('konsultasi') }}" class="btn-hero-main">
                        <i class="bi bi-clipboard2-pulse"></i> Mulai Konsultasi
                    </a>
                    <a href="{{ route('info') }}" class="btn-hero-outline">
                        <i class="bi bi-info-circle"></i> Info Penyakit
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                <div style="background:rgba(255,255,255,0.07);border-radius:16px;padding:30px 36px;border:1px solid rgba(255,255,255,0.15);max-width:320px;width:100%;">
                    <div style="font-size:0.78rem;opacity:0.7;margin-bottom:14px;text-transform:uppercase;letter-spacing:1px;">Contoh Hasil Analisis</div>
                    <div style="background:rgba(255,255,255,0.1);border-radius:8px;padding:14px 16px;margin-bottom:10px;">
                        <div style="font-size:0.8rem;opacity:0.75;margin-bottom:4px;">Penyakit Terdeteksi</div>
                        <div style="font-weight:700;font-size:1rem;">Limfadenitis Kronis</div>
                    </div>
                    <div style="display:flex;gap:8px;margin-bottom:8px;">
                        <div style="flex:1;background:rgba(255,255,255,0.08);border-radius:6px;padding:10px;text-align:center;">
                            <div style="font-size:1.1rem;font-weight:800;color:#7dd3e8;">78%</div>
                            <div style="font-size:0.72rem;opacity:0.7;margin-top:2px;">Keyakinan CF</div>
                        </div>
                        <div style="flex:1;background:rgba(255,255,255,0.08);border-radius:6px;padding:10px;text-align:center;">
                            <div style="font-size:1.1rem;font-weight:800;color:#7dd3e8;">5</div>
                            <div style="font-size:0.72rem;opacity:0.7;margin-top:2px;">Gejala Cocok</div>
                        </div>
                    </div>
                    <div style="font-size:0.76rem;opacity:0.6;line-height:1.5;">* Ilustrasi hasil. Tidak menggantikan diagnosa dokter.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS BAR --}}
{{-- <div class="stats-bar">
    <div class="container">
        <div class="stat-item">
            <div class="stat-num">6+</div>
            <div class="stat-label">Jenis Penyakit</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">30+</div>
            <div class="stat-label">Data Gejala</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">CF</div>
            <div class="stat-label">Certainty Factor</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">FC</div>
            <div class="stat-label">Forward Chaining</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">Gratis</div>
            <div class="stat-label">Tanpa Biaya</div>
        </div>
    </div>
</div> --}}

{{-- CARA KERJA --}}
<section class="section" style="background:#f5f7fa;">
    <div class="container">
        <div class="row mb-2">
            <div class="col-12">
                <h2 class="section-title">Bagaimana Cara Kerjanya?</h2>
                <p class="section-sub">Proses konsultasi dirancang sesederhana mungkin. Cukup tiga langkah dan Anda sudah mendapatkan hasil analisis awal.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-num">1</div>
                    <h5>Isi Kuesioner Gejala</h5>
                    <p>Jawab setiap pertanyaan sesuai gejala yang Anda rasakan saat ini. Pilih tingkat keyakinan Anda terhadap setiap gejala yang ditanyakan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-num">2</div>
                    <h5>Sistem Melakukan Analisis</h5>
                    <p>Jawaban Anda diproses menggunakan metode Forward Chaining untuk menelusuri aturan, lalu Certainty Factor menghitung tingkat kepastian hasilnya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-num">3</div>
                    <h5>Baca Hasil &amp; Saran</h5>
                    <p>Sistem menampilkan kemungkinan penyakit beserta nilai keyakinan dan saran penanganan awal. Hasil tersimpan dan bisa dilihat kembali di riwayat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PENYAKIT YANG BISA DIDETEKSI --}}
<section class="section" style="background:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="section-title">Penyakit yang Dapat Dideteksi</h2>
                <p class="section-sub">
                    Sistem ini mencakup beberapa jenis gangguan pada kelenjar getah bening yang umum ditemukan. Data gejala dan aturan dikompilasi berdasarkan referensi medis.
                </p>
                <div class="info-highlight">
                    <strong>Penting:</strong> Hasil dari sistem ini bersifat informatif dan tidak menggantikan pemeriksaan langsung oleh tenaga medis profesional. Segera konsultasikan ke dokter jika gejala berlanjut.
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-virus2"></i></div>
                            <div>
                                <h6>Limfadenitis Akut</h6>
                                <p>Peradangan kelenjar getah bening yang terjadi tiba-tiba, biasanya akibat infeksi bakteri atau virus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-activity"></i></div>
                            <div>
                                <h6>Limfadenitis Kronis</h6>
                                <p>Pembengkakan kelenjar getah bening yang berlangsung lama, seringkali tanpa rasa sakit yang jelas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-lungs"></i></div>
                            <div>
                                <h6>Limfoma Hodgkin</h6>
                                <p>Kanker pada jaringan limfatik dengan ciri khas sel Reed-Sternberg dan pola penyebaran yang khas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-shield-exclamation"></i></div>
                            <div>
                                <h6>Limfoma Non-Hodgkin</h6>
                                <p>Kelompok kanker limfatik yang lebih beragam, bisa berkembang lambat atau cepat tergantung jenisnya.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-droplet-half"></i></div>
                            <div>
                                <h6>Tuberkulosis Limfadenitis</h6>
                                <p>Infeksi TB yang menyerang kelenjar getah bening, paling sering di area leher.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="penyakit-card">
                            <div class="penyakit-icon"><i class="bi bi-bandaid"></i></div>
                            <div>
                                <h6>Limfedema</h6>
                                <p>Pembengkakan akibat gangguan aliran cairan limfa, sering terjadi pada tungkai atau lengan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TENTANG SISTEM --}}
<section class="section" style="background:#f5f7fa;border-top:1px solid #dde3ea;">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Tentang Sistem Ini</h2>
                <p style="font-size:0.9rem;color:#555;line-height:1.75;margin-bottom:16px;">
                    Sistem ini dikembangkan sebagai tugas akhir program studi Sistem Informasi, Universitas Sembilanbelas November (USN) Kolaka. Tujuannya adalah membantu masyarakat dalam mengenali gejala-gejala awal penyakit kelenjar getah bening.
                </p>
                <p style="font-size:0.9rem;color:#555;line-height:1.75;margin-bottom:20px;">
                    Dua metode utama yang dipakai adalah <strong>Forward Chaining</strong> untuk penelusuran aturan berbasis gejala, dan <strong>Certainty Factor</strong> untuk menghitung seberapa yakin sistem terhadap setiap kemungkinan diagnosis yang dihasilkan.
                </p>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <span style="background:#e8f1fb;color:#1a3c6e;padding:6px 14px;border-radius:20px;font-size:0.82rem;font-weight:600;">
                        <i class="bi bi-check2 me-1"></i>Forward Chaining
                    </span>
                    <span style="background:#e8f1fb;color:#1a3c6e;padding:6px 14px;border-radius:20px;font-size:0.82rem;font-weight:600;">
                        <i class="bi bi-check2 me-1"></i>Certainty Factor
                    </span>
                    <span style="background:#e8f1fb;color:#1a3c6e;padding:6px 14px;border-radius:20px;font-size:0.82rem;font-weight:600;">
                        <i class="bi bi-check2 me-1"></i>Basis Pengetahuan Pakar
                    </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background:#fff;border:1px solid #dde3ea;border-radius:10px;padding:28px 28px 22px;">
                    <div style="font-size:0.75rem;text-transform:uppercase;letter-spacing:1px;color:#aaa;margin-bottom:16px;font-weight:600;">Informasi Pengembang</div>
                    <table style="width:100%;font-size:0.88rem;border-collapse:collapse;">
                        <tr>
                            <td style="padding:8px 0;color:#888;width:40%;vertical-align:top;">Nama</td>
                            <td style="padding:8px 0;font-weight:600;color:#222;">Sri Nurlia</td>
                        </tr>
                        <tr style="border-top:1px solid #f0f0f0;">
                            <td style="padding:8px 0;color:#888;vertical-align:top;">NIM</td>
                            <td style="padding:8px 0;font-weight:600;color:#222;">221210601</td>
                        </tr>
                        <tr style="border-top:1px solid #f0f0f0;">
                            <td style="padding:8px 0;color:#888;vertical-align:top;">Program Studi</td>
                            <td style="padding:8px 0;font-weight:600;color:#222;">Sistem Informasi</td>
                        </tr>
                        <tr style="border-top:1px solid #f0f0f0;">
                            <td style="padding:8px 0;color:#888;vertical-align:top;">Universitas</td>
                            <td style="padding:8px 0;font-weight:600;color:#222;">USN Kolaka</td>
                        </tr>
                        <tr style="border-top:1px solid #f0f0f0;">
                            <td style="padding:8px 0;color:#888;vertical-align:top;">Tahun</td>
                            <td style="padding:8px 0;font-weight:600;color:#222;">2026</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container">
        <h2>Siap Mencoba Konsultasi?</h2>
        <p>Tidak perlu mendaftar atau login. Langsung isi formulir gejala dan dapatkan hasil analisis dalam hitungan detik.</p>
        <a href="{{ route('konsultasi') }}" class="btn-cta">
            <i class="bi bi-play-circle"></i> Mulai Sekarang
        </a>
    </div>
</section>

@endsection

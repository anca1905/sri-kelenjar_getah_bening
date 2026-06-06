@extends('layouts.main')

@section('content')
<section class="hero-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 5%;">
        
        <div class="card hero-card" style="padding: 4rem; border: none; background: white; box-shadow: 0 20px 40px rgba(0,0,0,0.05); border-radius: 30px; position: relative; overflow: hidden;">
            
            {{-- Decorative Background Elements --}}
            <div style="position: absolute; top: -10%; right: -5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(13, 148, 136, 0.05) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -10%; left: -5%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(14, 165, 233, 0.05) 0%, transparent 70%); border-radius: 50%;"></div>

            <div class="hero-wrapper" style="position: relative; z-index: 1;">
                
                <div class="hero-text">
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: #f0fdfa; color: var(--public-primary); padding: 8px 16px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; margin-bottom: 2rem; border: 1px solid rgba(13, 148, 136, 0.1);">
                        <i class="fa-solid fa-microchip"></i> SISTEM PAKAR CERDAS
                    </div>

                    <h1 style="font-size: 3.5rem; line-height: 1.1; font-weight: 800; color: var(--text-main); margin-bottom: 1.5rem;">
                        Diagnosis <span style="color: var(--public-primary);">Kelenjar Getah Bening</span> Lebih Cepat.
                    </h1>

                    <p style="font-size: 1.15rem; color: var(--text-muted); margin-bottom: 2.5rem; max-width: 500px; line-height: 1.6;">
                        Gunakan teknologi cerdas untuk mendeteksi dini kesehatan Anda. Berbasis metode <strong>Forward Chaining</strong> dan <strong>Certainty Factor</strong> untuk hasil yang lebih akurat.
                    </p>

                    <div class="hero-buttons" style="display: flex; gap: 1rem;">
                        <a href="{{ url('/pasien') }}" class="btn btn-primary" style="padding: 16px 32px; font-size: 1rem; display: flex; align-items: center; gap: 12px; border-radius: 14px;">
                            Mulai Konsultasi Gratis <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="{{ url('/login') }}" class="btn btn-outline" style="padding: 16px 32px; font-size: 1rem; border-radius: 14px; display: flex; align-items: center; gap: 12px;">
                            <i class="fa-solid fa-lock"></i> Login Admin
                        </a>
                    </div>
                </div>

                <div class="hero-image">
                    <div style="position: relative;">
                        <img src="https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" alt="Medis" style="max-width: 100%; height: auto; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));">
                        
                        {{-- Floating Badge --}}
                        <div style="position: absolute; bottom: 20px; left: -20px; background: white; padding: 15px; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 12px; border: 1px solid var(--border-color);">
                            <div style="width: 40px; height: 40px; background: #dcfce7; color: #166534; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 500;">Status Sistem</div>
                                <div style="font-weight: 700; color: var(--text-main);">Optimal & Akurat</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Branding & Footer Section --}}
        <div style="margin-top: 5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; text-align: left;">
            <div>
                <h4 style="margin-bottom: 1rem; color: var(--text-main);">Tentang Sistem</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Sistem ini dikembangkan untuk membantu masyarakat dalam melakukan deteksi awal gangguan kesehatan pada kelenjar getah bening menggunakan basis pengetahuan pakar.</p>
            </div>
            <div>
                <h4 style="margin-bottom: 1rem; color: var(--text-main);">Metode yang Digunakan</h4>
                <ul style="color: var(--text-muted); font-size: 0.9rem;">
                    <li style="margin-bottom: 8px;"><i class="fa-solid fa-check" style="color: var(--public-primary); margin-right: 10px;"></i> Forward Chaining</li>
                    <li><i class="fa-solid fa-check" style="color: var(--public-primary); margin-right: 10px;"></i> Certainty Factor</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <h4 style="margin-bottom: 1rem; color: var(--text-main);">Pengembang</h4>
                <p style="color: var(--text-main); font-weight: 700; margin-bottom: 4px;">Sri Nurlia</p>
                <p style="color: var(--text-muted); font-size: 0.85rem;">NIM: 221210601</p>
                <p style="color: var(--text-muted); font-size: 0.85rem;">Sistem Informasi - USN Kolaka</p>
            </div>
        </div>

    </div>
</section>
@endsection
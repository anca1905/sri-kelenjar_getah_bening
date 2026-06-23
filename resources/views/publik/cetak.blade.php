<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil Diagnosis - {{ $riwayat->kode_sesi }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: "Times New Roman", Times, serif; background: white; color: #1a1a1a; }
        @page { size: A4; margin: 15mm; }
        .print-container { max-width: 210mm; margin: 0 auto; padding: 10mm; }
        @media print { 
            body { padding: 0; } 
            .no-print { display: none !important; }
        }
    </style>
</head>
<body onload="setTimeout(function() { window.print(); }, 500);">
    
    <div class="no-print" style="text-align: center; margin: 20px; font-family: Arial, sans-serif;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; background: #1a3c6e; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Sekarang</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 16px; background: #e2e8f0; color: #333; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Tutup</button>
    </div>

    <div class="print-container">
        {{-- Header Cetak Resmi --}}
        <div style="border-bottom: 3px solid #1a1a1a; padding-bottom: 12px; margin-bottom: 2px; text-align: center; position: relative;">
            <div style="font-size: 26px; font-weight: 900; text-transform: uppercase; color: #1a1a1a;">WEBSITE SISTEM PAKAR</div>
            <div style="font-size: 15px; font-weight: 700; color: #333; margin-top: 4px;">DETEKSI DINI PENYAKIT PADA KELENJAR GETAH BENING</div>
            <div style="font-size: 12px; color: #444; margin-top: 5px;">Jl. Kesehatan No. 123, Kota Sehat, Provinsi Maju 12345</div>
            <div style="font-size: 12px; color: #444;">Telp: (021) 123-4567 | Email: info@klinikkesehatan.com | Web: www.klinikkesehatan.com</div>
        </div>
        <div style="border-bottom: 1px solid #1a1a1a; margin-bottom: 24px;"></div>

        <div style="text-align: center; margin-bottom: 24px;">
            <div style="font-size: 18px; font-weight: bold; text-decoration: underline; text-transform: uppercase;">Hasil Analisis Awal Gejala</div>
            <div style="font-size: 12px; margin-top: 4px;">Nomor Rekam / Sesi: <strong>{{ $riwayat->kode_sesi }}</strong></div>
        </div>

        {{-- Biodata --}}
        <div style="margin-bottom: 24px;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <tr>
                    <td style="width: 15%; padding: 4px 0; font-weight: bold;">Nama Pasien</td>
                    <td style="width: 2%; padding: 4px 0;">:</td>
                    <td style="width: 33%; padding: 4px 0;">{{ $riwayat->nama_pasien ?? '-' }}</td>
                    
                    <td style="width: 15%; padding: 4px 0; font-weight: bold;">Tanggal Periksa</td>
                    <td style="width: 2%; padding: 4px 0;">:</td>
                    <td style="width: 33%; padding: 4px 0;">{{ $riwayat->created_at->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px 0; font-weight: bold;">Umur</td>
                    <td style="padding: 4px 0;">:</td>
                    <td style="padding: 4px 0;">{{ $riwayat->umur ? $riwayat->umur . ' Tahun' : '-' }}</td>
                    
                    <td style="padding: 4px 0; font-weight: bold;">Jenis Kelamin</td>
                    <td style="padding: 4px 0;">:</td>
                    <td style="padding: 4px 0;">{{ $riwayat->jenis_kelamin ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- Diagnosis Utama --}}
        @php
            $utama = null;
            if(!empty($riwayat->detail_hasil) && count($riwayat->detail_hasil) > 0) {
                $utama = $riwayat->detail_hasil[0];
            }
        @endphp
        
        @if($utama)
        <div style="border: 2px solid #1a3c6e; border-radius: 10px; padding: 20px 24px; margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #0ea5b0; margin-bottom: 6px;">★ Diagnosis Utama</div>
            <div style="font-size: 22px; font-weight: 800; color: #1a3c6e; margin-bottom: 12px;">{{ $utama['penyakit'] }}</div>

            @if(isset($utama['foto']) && $utama['foto'])
            <div style="margin-bottom: 16px; text-align: center;">
                <img src="{{ asset('storage/' . $utama['foto']) }}" alt="Foto {{ $utama['penyakit'] }}" style="max-width: 100%; max-height: 250px; border-radius: 8px;">
            </div>
            @endif
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                <div style="flex: 1; height: 10px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                    <div style="width: {{ $utama['cf_persen'] }}%; height: 100%; background: linear-gradient(to right, #1a3c6e, #0ea5b0); border-radius: 10px;"></div>
                </div>
                <div style="font-size: 24px; font-weight: 800; color: #1a3c6e;">{{ $utama['cf_persen'] }}%</div>
            </div>

            @if(isset($utama['deskripsi']) && $utama['deskripsi'])
            <div style="margin-bottom: 14px;">
                <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; margin-bottom: 8px;">Deskripsi</div>
                <p style="font-size: 12px; color: #475569; line-height: 1.7; margin: 0;">{{ $utama['deskripsi'] }}</p>
            </div>
            @endif

            @if(isset($utama['solusi']) && $utama['solusi'])
            <div>
                <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; margin-bottom: 8px;">Anjuran & Penanganan</div>
                @foreach(explode("\n", $utama['solusi']) as $s)
                    @if(trim($s))
                    <div style="font-size: 12px; color: #475569; padding: 3px 0; display: flex; gap: 8px;">
                        <span style="color: #0ea5b0; font-weight: 700; font-family: Arial, sans-serif;">✓</span>
                        <span>{{ trim($s) }}</span>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
        @endif

        {{-- Diagnosis Lain --}}
        @if(!empty($riwayat->detail_hasil) && count($riwayat->detail_hasil) > 1)
        <div style="margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px; font-family: Arial, sans-serif;">Kemungkinan Diagnosis Lain</div>
            <table style="width: 100%; border-collapse: collapse; font-size: 12px; font-family: Arial, sans-serif;">
                @foreach($riwayat->detail_hasil as $i => $h)
                    @if($i == 0) @continue @endif
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 6px 8px; width: 30px; color: #94a3b8; font-weight: 700;">{{ $i + 1 }}</td>
                        <td style="padding: 6px 8px; font-weight: 600; color: #334155;">{{ $h['penyakit'] }}</td>
                        <td style="padding: 6px 8px; width: 120px;">
                            <div style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                                <div style="width: {{ $h['cf_persen'] }}%; height: 100%; background: #94a3b8; border-radius: 10px;"></div>
                            </div>
                        </td>
                        <td style="padding: 6px 8px; text-align: right; font-weight: 700; color: #64748b; white-space: nowrap; width: 40px;">{{ $h['cf_persen'] }}%</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @endif

        {{-- Gejala --}}
        @if(!empty($riwayat->detail_gejala))
        <div style="margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px; font-family: Arial, sans-serif;">Gejala yang Dilaporkan ({{ count($riwayat->detail_gejala) }} Gejala)</div>
            <div style="font-family: Arial, sans-serif;">
                @foreach($riwayat->detail_gejala as $g)
                    <span style="display: inline-block; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 600; margin: 2px 3px 2px 0;">{{ $g['nama'] }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Footer --}}
        <div style="border-top: 1px solid #e2e8f0; padding-top: 12px; font-size: 10px; color: #94a3b8; text-align: center; line-height: 1.6; font-family: Arial, sans-serif;">
            <strong>⚠ Perhatian:</strong> Hasil ini merupakan analisis awal dari sistem pakar dan <strong>bukan pengganti diagnosa dokter</strong>. Segera konsultasikan dengan tenaga medis profesional.<br>
            Dicetak oleh Sistem Pakar KGB &bull; {{ now()->format('d F Y, H:i') }} WIB
        </div>
    </div>
</body>
</html>

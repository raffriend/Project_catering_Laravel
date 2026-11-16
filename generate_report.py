# -*- coding: utf-8 -*-
"""
Script to generate the complete IMK Project Report in HTML and compile it to PDF.
Kelompok 7: Pengelolaan dan Pemesanan Rumah Makan CV. Kedai Agung
"""
import os
import sys
import subprocess
import shutil

html_file = os.path.abspath('laporan_imk_lengkap.html')
pdf_file_workspace = os.path.abspath('Laporan_IMK_Kelompok_7_CV_Kedai_Agung.pdf')
pdf_file_brain = r'C:\Users\ASUS\.gemini\antigravity\brain\64074190-8b09-4280-b51d-3535789a318f\Laporan_IMK_Kelompok_7_CV_Kedai_Agung.pdf'

html_content = """<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Laporan Proyek Semester IMK - Kelompok 7 (CV. Kedai Agung)</title>
<style>
  @page {
    size: A4;
    margin: 22mm 18mm 22mm 18mm;
  }
  * {
    box-sizing: border-box;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
  body {
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
    font-size: 10pt;
    line-height: 1.55;
    color: #1e293b;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
  }

  /* Page Break Helpers */
  .page-break {
    page-break-before: always;
    break-before: page;
  }
  .no-break {
    page-break-inside: avoid;
    break-inside: avoid;
  }

  /* COVER STYLING */
  .cover-container {
    height: 98vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
    padding: 20px 10px;
  }
  .cover-top {
    border-bottom: 2px solid #0284c7;
    padding-bottom: 18px;
  }
  .cover-inst-title {
    font-size: 11pt;
    font-weight: 700;
    text-transform: uppercase;
    color: #0f172a;
    letter-spacing: 0.8px;
    margin: 0 0 4px 0;
  }
  .cover-inst-sub {
    font-size: 9.5pt;
    color: #475569;
    font-weight: 500;
    margin: 0;
  }
  .cover-middle {
    margin: 30px 0;
  }
  .cover-badge {
    display: inline-block;
    padding: 5px 14px;
    background-color: #e0f2fe;
    color: #0369a1;
    border-radius: 20px;
    font-size: 8.5pt;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 16px;
    border: 1px solid #bae6fd;
  }
  .cover-main-title {
    font-size: 20pt;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.25;
    text-transform: uppercase;
    margin: 0 0 12px 0;
  }
  .cover-subtitle {
    font-size: 11pt;
    color: #475569;
    line-height: 1.5;
    max-width: 620px;
    margin: 0 auto 30px auto;
  }
  .cover-card-team {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 24px;
    max-width: 480px;
    margin: 0 auto;
    text-align: left;
  }
  .cover-card-team h4 {
    margin: 0 0 10px 0;
    font-size: 10pt;
    color: #0369a1;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 6px;
    text-align: center;
  }
  .team-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
  }
  .team-table td {
    padding: 5px 8px;
    border: none;
    font-size: 9.5pt;
  }
  .team-table td.name {
    font-weight: 600;
    color: #0f172a;
  }
  .team-table td.role {
    color: #64748b;
    text-align: right;
  }
  .cover-bottom {
    border-top: 1px solid #cbd5e1;
    padding-top: 16px;
  }
  .cover-bottom p {
    margin: 3px 0;
    font-size: 9pt;
    color: #64748b;
    text-align: center;
  }

  /* HEADINGS */
  h1.bab-title {
    font-size: 16pt;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 2px solid #0284c7;
    padding-bottom: 6px;
    margin-top: 0;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  h2.subbab-title {
    font-size: 12pt;
    font-weight: 700;
    color: #0369a1;
    margin-top: 20px;
    margin-bottom: 10px;
    border-left: 4px solid #0284c7;
    padding-left: 10px;
  }
  h3.section-title {
    font-size: 10.5pt;
    font-weight: 700;
    color: #1e293b;
    margin-top: 14px;
    margin-bottom: 6px;
  }
  p {
    margin: 0 0 10px 0;
    text-align: justify;
  }

  /* TABLES */
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0 16px 0;
    font-size: 8.5pt;
  }
  th, td {
    border: 1px solid #cbd5e1;
    padding: 7px 9px;
    vertical-align: top;
    text-align: left;
  }
  th {
    background-color: #f1f5f9;
    color: #0f172a;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 8pt;
    letter-spacing: 0.3px;
  }
  tr:nth-child(even) td {
    background-color: #f8fafc;
  }

  /* BADGES */
  .badge {
    display: inline-block;
    padding: 2px 6px;
    border-radius: 4px;
    font-family: Consolas, 'Courier New', monospace;
    font-size: 7.5pt;
    font-weight: 700;
  }
  .b-blue { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
  .b-green { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
  .b-amber { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
  .b-purple { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
  .b-rose { background: #ffe4e6; color: #be123c; border: 1px solid #fecdd3; }

  /* CALLOUT BOXES */
  .callout {
    padding: 10px 14px;
    margin: 12px 0;
    border-radius: 6px;
    border-left: 4px solid;
    font-size: 9pt;
  }
  .c-info { background: #f0f9ff; border-color: #0284c7; color: #0369a1; }
  .c-alert { background: #fffbeb; border-color: #f59e0b; color: #92400e; }
  .c-quote { background: #f8fafc; border-color: #64748b; color: #334155; font-style: italic; }

  /* PERSONA CARD */
  .persona-box {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #ffffff;
    margin: 14px 0 20px 0;
    overflow: hidden;
  }
  .persona-top {
    background: linear-gradient(135deg, #0369a1, #0284c7);
    color: #ffffff;
    padding: 10px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .persona-top h4 {
    margin: 0;
    font-size: 11.5pt;
    font-weight: 700;
  }
  .persona-top .role-badge {
    background: rgba(255,255,255,0.25);
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 8pt;
    font-weight: 600;
  }
  .persona-quote-banner {
    background: #f0fdf4;
    border-bottom: 1px solid #e2e8f0;
    padding: 8px 14px;
    font-style: italic;
    font-size: 8.5pt;
    color: #166534;
  }
  .persona-grid {
    padding: 12px 14px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  .persona-col h5 {
    margin: 0 0 5px 0;
    font-size: 8.5pt;
    font-weight: 700;
    color: #0369a1;
    text-transform: uppercase;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 3px;
  }
  .persona-col ul {
    margin: 0;
    padding-left: 16px;
    font-size: 8pt;
  }
  .persona-col li {
    margin-bottom: 3px;
  }

  /* EMPATHY MAP */
  .empathy-card {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    overflow: hidden;
    margin: 14px 0 20px 0;
  }
  .empathy-head {
    background: #0f172a;
    color: #ffffff;
    padding: 8px 12px;
    font-size: 9.5pt;
    font-weight: 700;
  }
  .empathy-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: #e2e8f0;
    gap: 1px;
  }
  .empathy-quad {
    background: #ffffff;
    padding: 10px 12px;
  }
  .empathy-quad h5 {
    margin: 0 0 6px 0;
    font-size: 8.5pt;
    font-weight: 700;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .empathy-quad.says h5 { color: #0284c7; }
  .empathy-quad.thinks h5 { color: #7c3aed; }
  .empathy-quad.does h5 { color: #059669; }
  .empathy-quad.feels h5 { color: #e11d48; }
  .empathy-quad ul {
    margin: 0;
    padding-left: 14px;
    font-size: 8pt;
  }
  .empathy-quad li {
    margin-bottom: 4px;
  }

  /* AFFINITY STICKY CONTAINER */
  .affinity-group {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    margin-bottom: 12px;
  }
  .affinity-group-head {
    font-size: 9.5pt;
    font-weight: 700;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .sticky-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
  }
  .sticky-note {
    padding: 7px 9px;
    border-radius: 6px;
    font-size: 8pt;
    line-height: 1.35;
    border-left: 3px solid;
    background: #ffffff;
  }
  .st-green { background: #f0fdf4; border-color: #22c55e; }
  .st-orange { background: #fff7ed; border-color: #f97316; }
  .st-pink { background: #fdf2f8; border-color: #ec4899; }
  .st-yellow { background: #fefce8; border-color: #eab308; }

  /* 4-QUADRANT MATRIX */
  .matrix-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin: 14px 0;
  }
  .matrix-cell {
    border: 1px solid;
    border-radius: 8px;
    padding: 10px;
    background: #ffffff;
  }
  .m-q1 { border-color: #10b981; background: #f0fdf4; }
  .m-q2 { border-color: #0284c7; background: #f0f9ff; }
  .m-q3 { border-color: #f59e0b; background: #fffbeb; }
  .m-q4 { border-color: #94a3b8; background: #f8fafc; }
  .matrix-cell h5 {
    margin: 0 0 4px 0;
    font-size: 9pt;
    font-weight: 700;
  }
  .matrix-cell p.meta {
    font-size: 7.5pt;
    color: #64748b;
    margin: 0 0 6px 0;
  }
  .matrix-cell ul {
    margin: 0;
    padding-left: 14px;
    font-size: 8pt;
  }

  /* TOC */
  .toc-container {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px 20px;
    margin: 16px 0 24px 0;
  }
  .toc-title {
    font-size: 11pt;
    font-weight: 700;
    color: #0f172a;
    border-bottom: 2px solid #cbd5e1;
    padding-bottom: 6px;
    margin-bottom: 10px;
    text-transform: uppercase;
  }
  .toc-row {
    display: flex;
    justify-content: space-between;
    padding: 4px 0;
    font-size: 9pt;
    border-bottom: 1px dotted #e2e8f0;
  }
  .toc-row.main {
    font-weight: 700;
    color: #0369a1;
  }
  .toc-row.sub {
    padding-left: 16px;
    color: #475569;
    font-size: 8.5pt;
  }
</style>
</head>
<body>

<!-- ========================================== -->
<!-- 1. COVER PAGE                              -->
<!-- ========================================== -->
<div class="cover-container">
  <div class="cover-top">
    <div class="cover-inst-title">TUGAS PROYEK INTERAKSI MANUSIA DAN KOMPUTER (IMK)</div>
    <div class="cover-inst-sub">Kolaborasi Bersama Mata Kuliah Bengkel Pemrograman Framework (Laravel)</div>
  </div>

  <div class="cover-middle">
    <div class="cover-badge">Laporan Riset & Desain Solusi Interaksi</div>
    <div class="cover-main-title">PENGELOLAAN DAN PEMESANAN RUMAH MAKAN DARI BADAN USAHA CV. KEDAI AGUNG</div>
    <div class="cover-subtitle">
      Dokumentasi Komprehensif Hasil Investigasi Masalah, Riset Kebutuhan Pengguna, dan Perancangan Interaksi Berbasis Pendekatan Design Thinking (Empathize, Define, dan Ideate)
    </div>

    <div class="cover-card-team">
      <h4>Kelompok 7</h4>
      <table class="team-table">
        <tr>
          <td class="name">1. Muhammad Raffli Habibie</td>
          <td class="role">Anggota Tim</td>
        </tr>
        <tr>
          <td class="name">2. Jhonatan Permadi Silaban</td>
          <td class="role">Anggota Tim</td>
        </tr>
        <tr>
          <td class="name">3. Muhammad Daffariz</td>
          <td class="role">Anggota Tim</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="cover-bottom">
    <p><strong>Dosen Pengampu:</strong> Ibu Rika PS</p>
    <p><strong>Fokus Dokumen:</strong> Bab 1 Sampul, Bab 2 Gambaran Studi Kasus, Bab 3 Proses Bisnis, Bab 4 Tahap Empathize, Bab 5 Tahap Define, Bab 6 Tahap Ideate</p>
    <p>Semester Ganjil / Genap &bull; Tahun Akademik 2026/2027</p>
  </div>
</div>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- RINGKASAN EKSEKUTIF & DAFTAR ISI          -->
<!-- ========================================== -->
<div class="no-break">
  <h1 class="bab-title">Ringkasan Eksekutif (Executive Summary)</h1>
  <div class="callout c-info">
    <p><strong>Rangkuman Laporan Proyek Semester IMK:</strong> Dokumen ini menyajikan hasil eksplorasi perancangan sistem interaksi untuk rumah makan dan jasa katering <strong>CV. Kedai Agung</strong>, yang dijalankan beriringan sebagai fondasi antarmuka dan kebutuhan pengguna bagi implementasi web pada mata kuliah Bengkel Pemrograman Framework (Laravel). Fokus studi mencakup 4 kategori pengguna utama: Pemilik/Pengelola Usaha, Pelanggan Ampera (penjualan langsung), Pelanggan Katering Harian (langganan instansi pemerintah dan warga), serta Pelanggan Katering Acara (event/nasi kotak besar).</p>
    <p>Berdasarkan investigasi lapangan mendalam dan observasi operasional, ditemukan 3 akar masalah kritis: (1) Pengelolaan pesanan katering manual via obrolan WhatsApp yang rentan terlewat dan keliru catat, (2) Ketiadaan katalog informasi menu dan harga pasti yang mandiri sehingga membingungkan pembeli dan membuat pemilik lupa kesepakatan harga, serta (3) Tata kelola pencatatan status pembayaran dan piutang katering yang belum terstruktur sehingga menahan modal perputaran bahan baku. Melalui siklus <em>Empathize, Define,</em> dan <em>Ideate</em>, tim merumuskan 8 modul fitur interaksi terpadu dengan prioritas utama pada Dashboard Pengelolaan Katering, Katalog Menu/Paket Terbuka, serta Pelacak Status Pembayaran & Piutang.</p>
  </div>
</div>

<div class="toc-container no-break">
  <div class="toc-title">Daftar Isi Laporan</div>
  <div class="toc-row main"><span>1. Cover & Informasi Proyek</span><span>Halaman 1</span></div>
  <div class="toc-row main"><span>Ringkasan Eksekutif & Daftar Isi</span><span>Halaman 2</span></div>
  <div class="toc-row main"><span>2. Gambaran Studi Kasus</span><span>Halaman 3</span></div>
  <div class="toc-row sub"><span>2.1 Latar Belakang dan Konteks Usaha</span><span>Halaman 3</span></div>
  <div class="toc-row sub"><span>2.2 Pihak Terkait (Aktor) dan Ruang Lingkup Sistem</span><span>Halaman 3</span></div>
  <div class="toc-row sub"><span>2.3 Tujuan dan Pelaksanaan Proyek Desain IMK</span><span>Halaman 4</span></div>
  <div class="toc-row main"><span>3. Proses Bisnis (Dijelaskan per Aktivitas)</span><span>Halaman 5</span></div>
  <div class="toc-row sub"><span>3.1 Aktivitas Penjualan Langsung (Ampera)</span><span>Halaman 5</span></div>
  <div class="toc-row sub"><span>3.2 Aktivitas Katering Harian (Langganan Kantor & Warga)</span><span>Halaman 5</span></div>
  <div class="toc-row sub"><span>3.3 Aktivitas Katering Acara (Event / Partai Besar)</span><span>Halaman 6</span></div>
  <div class="toc-row sub"><span>3.4 Aktivitas Pengelolaan Operasional, Stok & Keuangan</span><span>Halaman 6</span></div>
  <div class="toc-row sub"><span>3.5 Matriks Alur Aktivitas Saat Ini dan Titik Masalah</span><span>Halaman 7</span></div>
  <div class="toc-row main"><span>4. Tahap Empathize</span><span>Halaman 8</span></div>
  <div class="toc-row sub"><span>4.1 Persiapan User Research & Kebutuhan Penggalian</span><span>Halaman 8</span></div>
  <div class="toc-row sub"><span>4.2 Metode, Partisipan, dan Pelaksanaan Riset</span><span>Halaman 8</span></div>
  <div class="toc-row sub"><span>4.3 Panduan Pertanyaan Wawancara & Lembar Observasi</span><span>Halaman 9</span></div>
  <div class="toc-row sub"><span>4.4 Ringkasan Jawaban Wawancara & Catatan Observasi (Bukti W & O)</span><span>Halaman 10</span></div>
  <div class="toc-row sub"><span>4.5 Temuan User Research (Analisis Pola & Kesenjangan)</span><span>Halaman 11</span></div>
  <div class="toc-row main"><span>5. Tahap Define</span><span>Halaman 12</span></div>
  <div class="toc-row sub"><span>5.1 User Persona & Empathy Map (4 Kategori Pengguna)</span><span>Halaman 12</span></div>
  <div class="toc-row sub"><span>5.2 Affinity Diagram (Pengelompokan Bukti Temuan Riset)</span><span>Halaman 15</span></div>
  <div class="toc-row sub"><span>5.3 Sintesis Insight dan Pernyataan Kebutuhan Pengguna</span><span>Halaman 16</span></div>
  <div class="toc-row sub"><span>5.4 Penentuan dan Evaluasi Masalah Prioritas</span><span>Halaman 17</span></div>
  <div class="toc-row sub"><span>5.5 Rumusan Point of View (POV)</span><span>Halaman 18</span></div>
  <div class="toc-row sub"><span>5.6 How Might We (HMW) dan Perumusan Tujuan UX</span><span>Halaman 18</span></div>
  <div class="toc-row main"><span>6. Tahap Ideate</span><span>Halaman 19</span></div>
  <div class="toc-row sub"><span>6.1 Teknik Eksplorasi & Alternatif Ide Solusi per HMW</span><span>Halaman 19</span></div>
  <div class="toc-row sub"><span>6.2 Pemetaan dan Pengelompokan Ide Menjadi Usulan Fitur</span><span>Halaman 20</span></div>
  <div class="toc-row sub"><span>6.3 Evaluasi Solusi & Matriks Prioritas 4 Kuadran (Impact vs Effort)</span><span>Halaman 21</span></div>
  <div class="toc-row sub"><span>6.4 Daftar Fitur Terpilih dan Batasan Cakupan Prototipe</span><span>Halaman 22</span></div>
</div>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- 2. GAMBARAN STUDI KASUS                   -->
<!-- ========================================== -->
<h1 class="bab-title">2. Gambaran Studi Kasus</h1>

<h2 class="subbab-title">2.1 Latar Belakang dan Konteks Usaha</h2>
<p>
  <strong>CV. Kedai Agung</strong> merupakan sebuah badan usaha yang bergerak di bidang penyediaan makanan siap saji dengan format rumah makan ampera (masakan rumahan Indonesia) sekaligus melayani jasa katering berskala menengah hingga besar. Menu andalan yang paling diminati oleh pelanggan meliputi ayam geprek, sarden balado, cincang ayam, aneka sarapan pagi, gulai, masakan basah, dan berbagai sajian tradisional khas Nusantara lainnya.
</p>
<p>
  Usaha ini memiliki kapasitas produksi yang sangat substansial, di mana dalam satu hari operasional dapur mampu memproduksi hingga kurang lebih <strong>500 potong lauk</strong>. Usaha ini beroperasi di wilayah Pekanbaru dengan jangkauan utama di seputaran Ranca, Paus, dan memiliki cabang dapur di kawasan Balam. Dari sisi legalitas, usaha ini berbentuk Persekutuan Komanditer (CV) yang sah, dilengkapi dengan kop surat resmi, cap stempel badan usaha, NPWP, serta tanda tangan direktur untuk keperluan penerbitan kuitansi formal dan penagihan ke instansi pemerintah.
</p>
<p>
  <strong>Keterkaitan Antara Mata Kuliah IMK dan Bengkel Pemrograman Framework (Laravel):</strong><br>
  Proyek ini merupakan proyek kolaboratif lintas mata kuliah. Mata kuliah Bengkel Pemrograman Framework bertugas membangun fondasi arsitektur perangkat lunak berbasis framework Laravel (database, route, controller, Eloquent ORM, dan autentikasi). Namun, pengembangan sistem informasi web tidak akan berhasil tanpa pemahaman yang mendalam mengenai kebutuhan pengguna nyata. Oleh sebab itu, mata kuliah <em>Interaksi Manusia dan Komputer (IMK)</em> berperan penting dalam menyediakan riset kebutuhan pengguna (<em>user research</em>), identifikasi <em>pain points</em>, pemetaan alur interaksi (<em>user flow</em>), hingga spesifikasi antarmuka yang intuitif dan mudah diakses oleh operator maupun pelanggan.
</p>

<h2 class="subbab-title">2.2 Pihak Terkait (Aktor) dan Ruang Lingkup Sistem</h2>
<p>
  Berdasarkan observasi dan wawancara lapangan, pihak-pihak yang terlibat dalam interaksi sistem dikelompokkan ke dalam 4 aktor utama:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 12%;">Kode Aktor</th>
      <th style="width: 25%;">Nama Peran</th>
      <th style="width: 38%;">Deskripsi Tugas & Kepentingan</th>
      <th style="width: 25%;">Tingkat Kemahiran Digital</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-blue">AKTOR-01</span></td>
      <td><strong>Pemilik / Pengelola (Owner)</strong></td>
      <td>Mengatur jadwal masak dapur, menerima pesanan via telepon/WA, mengelola tenaga kerja, menetapkan harga, mencatat rekapitulasi penjualan, dan menagih piutang katering.</td>
      <td>Menengah ke bawah; terbiasa dengan WhatsApp, enggan menggunakan sistem POS yang rumit saat jam sibuk.</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">AKTOR-02</span></td>
      <td><strong>Pelanggan Ampera (Makan Langsung)</strong></td>
      <td>Warga lokal, mahasiswa, dan pekerja kantor yang datang langsung pada jam istirahat makan siang (11.30–13.00 WIB) untuk memilih lauk di etalase.</td>
      <td>Umum/Heterogen; mengutamakan kecepatan layanan, kepastian ketersediaan lauk, dan kemudahan pembayaran non-tunai (QRIS).</td>
    </tr>
    <tr>
      <td><span class="badge b-green">AKTOR-03</span></td>
      <td><strong>Pelanggan Katering Harian</strong></td>
      <td>Instansi pemerintah (seperti Dinas Perhubungan, ±60 porsi/hari yang dibagi ke 4 bidang kerja) serta warga/tetangga sekitar perumahan yang berlangganan makan siang harian.</td>
      <td>Terbiasa berkoordinasi via WhatsApp malam hari; membutuhkan kejelasan variasi lauk harian dan dokumen tagihan resmi (invoice/kuitansi).</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">AKTOR-04</span></td>
      <td><strong>Pelanggan Katering Acara (Event)</strong></td>
      <td>Panitia acara rapat kantor, syukuran keluarga, atau event sosial yang memesan nasi kotak dalam jumlah 50 hingga ratusan kotak dengan tenggat waktu tertentu.</td>
      <td>Membutuhkan katalog paket harga pasti, informasi bonus (misal bolu), kepastian pengantaran tepat waktu, dan konfirmasi bukti bayar.</td>
    </tr>
  </tbody>
</table>

<div class="callout c-info">
  <strong>Batasan Ruang Lingkup Proyek (Scope):</strong>
  Sistem yang dirancang berfokus pada antarmuka web responsif (desktop untuk dashboard pemilik, mobile-friendly untuk pelanggan) yang mencakup modul informasi menu terbuka, pemesanan katering mandiri, pencatatan antrean pesanan harian, dan monitoring piutang katering. Sistem tidak mencakup integrasi sistem kasir POS perangkat keras eksternal (mesin barcode/printer thermal) maupun integrasi API logistik pihak ketiga (seperti Grab/Gojek instant dispatch), mengingat pengantaran dilakukan secara mandiri oleh kurir internal CV.
</div>

<h2 class="subbab-title">2.3 Tujuan dan Pelaksanaan Proyek Desain IMK</h2>
<p>
  Tujuan utama proyek desain interaksi ini adalah mentransformasi proses pemesanan dan pengelolaan CV. Kedai Agung dari yang sebelumnya serba manual, terfragmentasi, dan rentan salah catat menjadi proses digital yang terpadu, transparan, dan berpusat pada kenyamanan pengguna (<em>user-centered design</em>).
</p>

<table>
  <thead>
    <tr>
      <th style="width: 25%;">Nama Anggota Tim</th>
      <th style="width: 25%;">Peran Utama IMK</th>
      <th style="width: 50%;">Rincian Kontribusi dalam Proyek</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Muhammad Raffli Habibie</strong></td>
      <td>Lead User Researcher & Problem Analyst</td>
      <td>Melakukan wawancara langsung kepada pemilik CV. Kedai Agung, menyusun transkrip verbatim, merumuskan User Persona Pemilik & Pelanggan Katering Harian, serta menyusun tabel Insight dan POV.</td>
    </tr>
    <tr>
      <td><strong>Jhonatan Permadi Silaban</strong></td>
      <td>Field Observer & Information Architect</td>
      <td>Melakukan observasi alur antrean jam makan siang ampera, menyusun catatan observasi lapangan, memetakan matriks proses bisnis saat ini, dan menyusun sintesis Affinity Mapping (Kelompok A–E).</td>
    </tr>
    <tr>
      <td><strong>Muhammad Daffariz</strong></td>
      <td>Interaction Designer & Solution Ideator</td>
      <td>Menyusun kerangka How Might We (HMW), memfasilitasi sesi brainstorming alternatif ide, mengelompokkan ide menjadi 8 modul usulan fitur, serta memetakan matriks prioritas dampak vs usaha.</td>
    </tr>
  </tbody>
</table>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- 3. PROSES BISNIS (PER AKTIVITAS)          -->
<!-- ========================================== -->
<h1 class="bab-title">3. Proses Bisnis (Dijelaskan per Aktivitas)</h1>
<p>
  Berdasarkan penelusuran alur kerja eksisting sebelum adanya sistem informasi digital, operasional CV. Kedai Agung terbagi menjadi empat kelompok aktivitas bisnis utama:
</p>

<h2 class="subbab-title">3.1 Aktivitas Penjualan Langsung (Ampera)</h2>
<p>Aktivitas penjualan langsung melayani pembeli eceran yang makan di tempat (<em>dine-in</em>) atau bungkus (<em>take-away</em>):</p>
<ul>
  <li><strong>Aktivitas 1.1: Persiapan Masakan Ampera:</strong> Dimulai pukul 06.30 WIB oleh tim juru masak. Jika ada pesanan katering, katering dimasak terlebih dahulu. Masakan ampera baru mulai diolah setelahnya dan ditata bertahap hingga display etalase penuh sekitar pukul 10.30 WIB.</li>
  <li><strong>Aktivitas 1.2: Pemilihan Menu oleh Pelanggan:</strong> Pelanggan datang langsung ke meja etalase kaca, melihat pilihan lauk secara visual, dan menanyakan harga kepada pelayan karena tidak ada papan daftar harga yang terpasang.</li>
  <li><strong>Aktivitas 1.3: Pelayanan dan Pembungkusan:</strong> Pelayan mengambilkan nasi dan lauk sesuai instruksi lisan pembeli. Pada puncak jam makan siang (11.30–13.00 WIB), antrean memadat sehingga pelayan sering kewalahan melayani permintaan khusus.</li>
  <li><strong>Aktivitas 1.4: Pembayaran di Kasir:</strong> Pelayan menghitung total belanjaan dalam ingatan atau coretan kertas kecil. Pembeli membayar menggunakan uang tunai (cash) atau memindai barcode QRIS statis di meja kasir.</li>
  <li><strong>Aktivitas 1.5: Rekapitulasi Kas Harian:</strong> Pada sore hari menjelang tutup, pemilik menghitung uang tunai di laci dan mencocokkan mutasi rekening QRIS, kemudian mencatat total omzet harian ke dalam buku kas fisik sederhana.</li>
</ul>

<h2 class="subbab-title">3.2 Aktivitas Katering Harian (Langganan Kantor & Warga)</h2>
<p>Aktivitas ini melayani pelanggan tetap dengan frekuensi harian (kontrak bulanan):</p>
<ul>
  <li><strong>Aktivitas 2.1: Pemesanan dan Konfirmasi Porsi Harian:</strong> Pelanggan (misalnya perwakilan staf administrasi dari 4 bidang di Dinas Perhubungan) mengirimkan pesan WhatsApp pada malam hari (pukul 20.00–22.00 WIB) untuk memastikan jumlah porsi kotak makan siang esok hari (rata-rata 60 kotak).</li>
  <li><strong>Aktivitas 2.2: Penentuan Kombinasi Lauk:</strong> Pemilik menentukan komposisi menu harian secara sepihak dengan formula wajib: 50% porsi berlauk ayam dan 50% porsi variasi ikan/daging/telur. Pelanggan jarang dapat memilih menu spesifik karena memasak dilakukan dalam kuali besar sekaligus.</li>
  <li><strong>Aktivitas 2.3: Pengolahan dan Pengemasan Pagi:</strong> Memasak katering diprioritaskan sejak pukul 06.30 hingga 09.30 WIB. Makanan dimasukkan ke dalam kotak karton bersama sendok dan pelengkap.</li>
  <li><strong>Aktivitas 2.4: Distribusi dan Pengantaran:</strong> Pukul 10.00–11.00 WIB, kurir internal (anggota laki-laki) mengantar pesanan menggunakan sepeda motor ke kantor instansi (lantai 1 s/d lantai 4) atau mengantar keliling ke rumah-rumah tetangga langganan dalam sekali rute. Area pengantaran dibatasi hanya seputaran Ranca, Paus, dan Balam.</li>
  <li><strong>Aktivitas 2.5: Penagihan dan Pencairan Anggaran:</strong> Untuk katering kantor pemerintah, sistem pembayaran menggunakan termin bulanan (setelah makanan dikonsumsi). Pemilik mencetak kuitansi bermaterai dengan kop surat CV dan cap resmi direktur. Pencairan melalui Bank Riau/Dekopin dijadwalkan tanggal 10 atau 15 setiap bulan, namun kerap mundur 2–3 hari akibat verifikasi berkas dinas.</li>
</ul>

<h2 class="subbab-title">3.3 Aktivitas Katering Acara (Event / Partai Besar)</h2>
<p>Aktivitas pesanan insidental untuk hajatan, syukuran, rapat dinas luar, atau seminar:</p>
<ul>
  <li><strong>Aktivitas 3.1: Konsultasi Awal dan Pemesanan:</strong> Pemesan menghubungi pemilik melalui telepon seluler atau chat WhatsApp minimal H-7 atau selambat-lambatnya H-4 sebelum acara. Pemesan menyebutkan jumlah kotak (misal 50–200 kotak) dan menanyakan kisaran harga per kotak.</li>
  <li><strong>Aktivitas 3.2: Negosiasi dan Penawaran Bonus:</strong> Pemilik menawarkan variasi lauk beserta promo volume (misal: pesanan 50 kotak ke atas mendapatkan bonus 1 loyang kue bolu gratis). Namun penawaran ini hanya disampaikan secara lisan tanpa selebaran resmi.</li>
  <li><strong>Aktivitas 3.3: Pengadaan Bahan & Pengerahan Tenaga Tambahan:</strong> Jika kuota pesanan acara melebihi kapasitas harian, pemilik memesan bahan baku tambahan ke pasar dan memanggil tenaga kerja cadangan (<em>freelance/relile</em>) untuk membantu proses potong dan bungkus.</li>
  <li><strong>Aktivitas 3.4: Pelaksanaan Distribusi:</strong> Makanan diantar ke lokasi acara menggunakan kendaraan operasional sesuai jam yang disepakati.</li>
  <li><strong>Aktivitas 3.5: Pelunasan Pasca-Konsumsi:</strong> Pelanggan acara sering kali baru mentransfer pelunasan setelah acara selesai. Masalah timbul ketika pemilik lupa berapa harga pasti per kotak yang disepakati saat awal chat, karena tumpukan pesan WhatsApp sudah terdorong ke bawah oleh percakapan lain.</li>
</ul>

<h2 class="subbab-title">3.4 Aktivitas Pengelolaan Operasional, Stok & Keuangan</h2>
<ul>
  <li><strong>Aktivitas 4.1: Pengadaan Bahan Mentah & Penyesuaian Harga Pasar:</strong> Pemilik berbelanja komoditas cabai, bawang, dan daging. Saat hari besar keagamaan atau akhir tahun ketika harga cabai melonjak drastis, pemilik memilih mengurangi porsi kerupuk atau meniadakan bonus daripada menaikkan harga jual yang berisiko ditinggal pelanggan.</li>
  <li><strong>Aktivitas 4.2: Pemantauan Sisa Lauk (Stok):</strong> Pemilik memantau sisa lauk hanya dengan menengok etalase kaca. Tidak ada data stok terukur yang dapat diakses publik, sehingga pemilik tidak berani mendaftarkan usahanya ke platform GrabFood/GoFood karena takut pesanan online masuk saat lauk sudah ludes terjual di ampera.</li>
  <li><strong>Aktivitas 4.3: Pengarsipan Berkas CV:</strong> Dokumen legalitas (izin usaha, akta CV, NPWP, kuitansi bermeterai) disimpan di laci kantor untuk keperluan administrasi tagihan instansi negara.</li>
</ul>

<div class="page-break"></div>

<h2 class="subbab-title">3.5 Matriks Alur Aktivitas Saat Ini dan Titik Masalah</h2>
<p>
  Tabel berikut merangkum runtutan alur kerja saat ini, aktor penanggung jawab, aliran data/informasi, serta potensi titik kegagalan (<em>pain points</em>) yang teridentifikasi:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 15%;">Tahapan Aktivitas</th>
      <th style="width: 15%;">Pelaku (Aktor)</th>
      <th style="width: 25%;">Alur & Langkah Kerja</th>
      <th style="width: 20%;">Perpindahan Informasi</th>
      <th style="width: 25%;">Titik Masalah / Informasi Belum Terkonfirmasi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>1. Penjualan Ampera</strong></td>
      <td>Pelanggan & Pelayan</td>
      <td>Pelanggan datang langsung, antre di depan etalase, memesan secara lisan, dan membayar di kasir.</td>
      <td>Visual fisik etalase & instruksi lisan tatap muka.</td>
      <td>Tidak ada daftar harga; pelanggan harus menanyakan harga satu per satu; antrean padat pukul 11.30–13.00 WIB.</td>
    </tr>
    <tr>
      <td><strong>2. Pemesanan Katering Harian</strong></td>
      <td>Admin Instansi & Pemilik Usaha</td>
      <td>Pelanggan mengirim WA malam hari; pemilik membaca dan menyalin ulang ke buku catatan harian dapur.</td>
      <td>Chat pesan instan (WhatsApp) &rarr; buku tulis kertas.</td>
      <td>Pesan WhatsApp rawan tenggelam atau terlewat saat pemilik sibuk; pelanggan tidak tahu pilihan variasi lauk esok hari.</td>
    </tr>
    <tr>
      <td><strong>3. Pemesanan Katering Acara</strong></td>
      <td>Panitia Acara & Pemilik Usaha</td>
      <td>Pelanggan menelepon/chat H-7 s/d H-4; negosiasi menu, jumlah kotak, harga, dan bonus kue bolu.</td>
      <td>Percakapan telepon & chat WhatsApp tidak terstruktur.</td>
      <td>Tidak ada katalog paket resmi; pemilik kerap lupa nominal harga per kotak yang sudah disepakati di awal saat penagihan.</td>
    </tr>
    <tr>
      <td><strong>4. Distribusi Pengantaran</strong></td>
      <td>Kurir (Anggota) & Penerima</td>
      <td>Kurir membawa kotak nasi keliling ke 4 bidang dinas dan tetangga sekitar Ranca/Paus/Balam.</td>
      <td>Kertas memo alamat dan daftar kuota porsi.</td>
      <td>Jika ada perubahan mendadak jumlah porsi, kurir baru tahu di lapangan; jangkauan terbatas karena keterbatasan armada.</td>
    </tr>
    <tr>
      <td><strong>5. Penagihan & Pembayaran</strong></td>
      <td>Pemilik Usaha & Bendahara Instansi</td>
      <td>Pemilik membuat kuitansi bertanda tangan direktur & cap CV; menunggu pencairan dana APBD (tgl 10/15).</td>
      <td>Kuitansi fisik bermeterai & bukti transfer bank.</td>
      <td>Pencairan sering mundur 2–3 hari; modal pemilik tertahan; tidak ada rekap digital tagihan jatuh tempo.</td>
    </tr>
    <tr>
      <td><strong>6. Monitoring Stok Lauk</strong></td>
      <td>Pemilik Usaha & Tim Dapur</td>
      <td>Pemilik mengecek baskom lauk di etalase; jika lauk habis langsung dihapus dari penawaran lisan.</td>
      <td>Pengamatan visual mata tanpa pencatatan kuantitas.</td>
      <td>Pelanggan baru tahu lauk habis setelah tiba di lokasi; pemilik tidak berani buka kanal online delivery (GoFood/Grab).</td>
    </tr>
  </tbody>
</table>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- 4. TAHAP EMPATHIZE                        -->
<!-- ========================================== -->
<h1 class="bab-title">4. Tahap Empathize</h1>

<h2 class="subbab-title">4.1 Persiapan User Research & Kebutuhan Penggalian</h2>
<p>
  Tahap <em>Empathize</em> merupakan fase fondasional dalam metodologi Design Thinking yang berfokus pada pembangunan pemahaman emosional dan kontekstual terhadap pengguna. Riset ini bertujuan untuk menggali:
</p>
<ol>
  <li>Apa yang dialami, dirasakan, dan dilakukan oleh pemilik usaha serta para pelanggan dalam rutinitas transaksi pemesanan dan operasional rumah makan?</li>
  <li>Informasi apa saja yang mereka butuhkan secara kritis namun saat ini belum tersedia secara transparan?</li>
  <li>Hambatan kognitif, operasional, dan finansial apa saja yang terjadi, serta bagaimana harapan solusi masa depan yang mereka inginkan?</li>
</ol>
<p>
  Sebelum turun ke lapangan, instrumen pedoman wawancara mendalam (<em>in-depth interview guide</em>) dan lembar catatan observasi etnografis dipersiapkan untuk memastikan seluruh data faktual dan emosional dapat terdokumentasi tanpa bias asumsi pengembang.
</p>

<h2 class="subbab-title">4.2 Metode, Partisipan, dan Pelaksanaan Riset</h2>
<p>
  Riset lapangan dilaksanakan dengan mengombinasikan dua metode utama: <strong>Wawancara Kualitatif Mendalam (In-depth Interview)</strong> dan <strong>Observasi Etnografis Langsung (Field Observation)</strong> di gerai CV. Kedai Agung.
</p>

<table>
  <thead>
    <tr>
      <th style="width: 15%;">ID Responden</th>
      <th style="width: 25%;">Kategori Partisipan</th>
      <th style="width: 35%;">Kriteria Pemilihan Partisipan</th>
      <th style="width: 25%;">Konteks Pelaksanaan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-blue">PEM01</span></td>
      <td>Pemilik / Pengelola Usaha (Owner)</td>
      <td>Pendiri dan penanggung jawab penuh operasional CV. Kedai Agung selama bertahun-tahun.</td>
      <td>Wawancara langsung di rumah makan saat jam istirahat sore; durasi ±45 menit.</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">PEL01</span></td>
      <td>Pelanggan Ampera (Makan Langsung)</td>
      <td>Konsumen aktif yang rutin membeli makanan secara langsung di etalase ampera minimal 3x seminggu.</td>
      <td>Wawancara singkat di tempat setelah selesai makan siang; durasi ±15 menit.</td>
    </tr>
    <tr>
      <td><span class="badge b-green">KAH01</span></td>
      <td>Pelanggan Katering Harian (Dinas/Warga)</td>
      <td>Penanggung jawab pemesanan makan siang kantor pemerintah (Dinas Perhubungan) dan tetangga langganan.</td>
      <td>Wawancara via tatap muka & verifikasi chat; durasi ±20 menit.</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">KAA01</span></td>
      <td>Pelanggan Katering Acara (Event)</td>
      <td>Pernah memesan paket nasi kotak katering acara di atas 50 kotak dalam 3 bulan terakhir.</td>
      <td>Wawancara mendalam via telepon dan temu langsung; durasi ±20 menit.</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01</span></td>
      <td>Sesi Observasi Lapangan Tim</td>
      <td>Pengamatan langsung aktivitas persiapan dapur, antrean kasir, proses pengantaran kurir, dan rekap manual.</td>
      <td>Pengamatan di lokasi pukul 07.00–13.30 WIB pada hari kerja.</td>
    </tr>
  </tbody>
</table>

<h2 class="subbab-title">4.3 Panduan Pertanyaan Wawancara & Lembar Observasi</h2>
<p>Pertanyaan disusun secara terfokus untuk membongkar kendala spesifik pada tiap tahapan perjalanan pengguna:</p>
<ul>
  <li><strong>Panduan Aktor Pemilik (PEM01):</strong> Bagaimana alur Bapak/Ibu mengelola pesanan katering dari malam hingga siap diantar? Kesulitan apa yang paling dirasakan ketika mengandalkan chat WhatsApp? Bagaimana mengatasi pelanggan yang menuntut menu beragam? Bagaimana Bapak/Ibu memantau status piutang katering yang pembayarannya mundur? Mengapa ragu memakai aplikasi digital modern?</li>
  <li><strong>Panduan Aktor Pembeli Ampera (PEL01):</strong> Bagaimana pengalaman Anda memilih lauk di jam makan siang? Bagaimana cara Anda mengetahui harga tiap item lauk? Kendala apa yang dirasakan saat jam antrean ramai?</li>
  <li><strong>Panduan Aktor Katering Harian (KAH01):</strong> Bagaimana prosedur kantor Anda memesan 60 kotak tiap hari? Apakah Anda mengetahui menu apa yang akan datang esok hari? Bagaimana prosedur pencairan uang katering bulanan kantor ke CV?</li>
  <li><strong>Panduan Aktor Katering Acara (KAA01):</strong> Bagaimana cara Anda mengetahui katalog harga paket dan bonus katering? Kendala apa yang ditemui terkait kejelasan harga dan pembayaran setelah acara selesai?</li>
  <li><strong>Panduan Observasi Lapangan (O-01):</strong> Mengamati interaksi mata pembeli terhadap etalase, frekuensi pelayan menjawab pertanyaan harga, tumpukan chat WA yang masuk ke gawai pemilik, serta cara pemilik mencatat uang kas masuk di buku fisik.</li>
</ul>

<div class="page-break"></div>

<h2 class="subbab-title">4.4 Ringkasan Jawaban Wawancara & Catatan Observasi (Bukti W & O)</h2>
<p>
  Setiap butir data lapangan diberi identitas kode unik (<strong>W-</strong> untuk Wawancara, <strong>O-</strong> untuk Observasi) untuk menjamin ketertelusuran ilmiah (<em>traceability</em>) hingga ke tahap Define dan Ideate:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 14%;">ID Bukti</th>
      <th style="width: 16%;">Tahapan</th>
      <th style="width: 50%;">Kutipan Verbatim / Parafrasa Jawaban Responden</th>
      <th style="width: 20%;">Sumber Partisipan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-blue">W-PEM01-01</span></td>
      <td>Jadwal Masak</td>
      <td><em>"Setengah tujuh kami mulai masak. Kalau ada katering, dahulukan dulu katering pagi-pagi, baru masak untuk yang dijual di ampera depan. Jam 11.00 sudah siap semua melayani pembeli langsung."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-02</span></td>
      <td>Pemesanan WA</td>
      <td><em>"Mereka itu nge-chatnya malam lewat WhatsApp. Besok segini porsinya atau mau menu ini. Kalau yang sudah langganan seperti Dishub 60 kotak ya segitu terus kecuali dia konfirmasi berubah."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-03</span></td>
      <td>Pencatatan Buku</td>
      <td><em>"Paling rekapannya sore di buku catatan manual. Tapi kalau katering kantor dinas itu lengkap ada kuitansi resmi, cap basah CV, dan tanda tangan direktur untuk pencairan anggaran per hari."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-04</span></td>
      <td>Keterlambatan Bayar</td>
      <td><em>"Pemerintah pencairannya tanggal 10 atau 15, tapi sering meleset 2 hari. Intinya modal kita harus kuat nalangin belanja bahan duluan sebelum uang cair ke Bank Riau."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-05</span></td>
      <td>Bahan Baku Naik</td>
      <td><em>"Kalau harga cabai naik dekat tahun baru atau lebaran, harga katering gak bisa kita naikkan tiba-tiba. Ya kita siasati kerupuknya dihilangin atau bonus dikurangi, ukuran lauk tetap dipertahankan."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-06</span></td>
      <td>Menu Katering</td>
      <td><em>"Pelanggan boleh request, tapi kalau gak ada ya terserah koki. Yang jelas separuh wajib ayam, separuhnya lagi lauk lain. Kita masak kuali besar, gak bisa turuti menu beda-beda per orang."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-07</span></td>
      <td>Pemesanan Acara</td>
      <td><em>"Kalau katering acara minimal H-7 atau paling mepet 4 hari sebelumnya, supaya sempat siapkan belanja dan cari tenaga tambahan (relile) kalau pas pesanan ratusan kotak."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-08</span></td>
      <td>Keraguan Sistem</td>
      <td><em>"Pernah kepikir pakai sistem tablet/POS, tapi anggota kita masih jadul. Kalau stok lauk mendadak habis pas ramai di depan, siapa yang sempat update aplikasinya? Mau tutup aplikasi kan ribet."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-09</span></td>
      <td>Jangkauan Kirim</td>
      <td><em>"Yang jauh-jauh kita tolak karena gak sempat antar. Cuma seputaran Ranca, Paus, sama cabang di Balam. Sekali jalan kurir kita antar langsung ke kantor dinas."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">W-PEM01-10</span></td>
      <td>Lupa Harga Sepakat</td>
      <td><em>"Kadang pemilik lupa harga pasti yang telah disepakati sebelumnya, apalagi kalau katering acara yang bayarnya belakangan setelah acara selesai."</em></td>
      <td>Pemilik Usaha</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">W-PEL01-01</span></td>
      <td>Info Menu Ampera</td>
      <td><em>"Saya datang langsung lihat apa yang ada di etalase. Kadang jam 11 belum semua lauk matang. Harganya gak ada tertulis, jadi tiap ambil lauk baru saya tanya harganya berapa."</em></td>
      <td>Pelanggan Ampera</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">W-PEL01-02</span></td>
      <td>Antrean Ramai</td>
      <td><em>"Kalau pas jam 12.00 itu ramai luar biasa, antreannya padat. Kadang kalau terburu-buru mau balik ke kantor agak kerepotan menunggu dilayani."</em></td>
      <td>Pelanggan Ampera</td>
    </tr>
    <tr>
      <td><span class="badge b-green">W-KAH01-01</span></td>
      <td>Pemesanan Rutin</td>
      <td><em>"Tiap malam kami WA orang dapur untuk konfirmasi porsi besok. Tapi kami sering gak tahu besok dapat menu apa, pasrah aja sama yang dikirim koki."</em></td>
      <td>Pelanggan Katering Harian</td>
    </tr>
    <tr>
      <td><span class="badge b-green">W-KAH01-02</span></td>
      <td>Pencairan Berkas</td>
      <td><em>"Kami butuh kuitansi resmi bertanda tangan direktur dan cap stempel CV untuk SPJ kantor. Kalau kuitansinya terlambat dibuatkan, pencairan dana juga otomatis mundur."</em></td>
      <td>Pelanggan Katering Harian</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">W-KAA01-01</span></td>
      <td>Katalog Acara</td>
      <td><em>"Waktu mau pesan 100 kotak syukuran kemarin susah nentuin menu karena gak ada buku menu katering yang ada harganya. Mesti bolak-balik nanya lewat telepon."</em></td>
      <td>Pelanggan Katering Acara</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">W-KAA01-02</span></td>
      <td>Info Promo Bolu</td>
      <td><em>"Untung pas nanya dikasih tahu kalau pesan 50 kotak dapat bonus kue bolu seloyang. Harusnya info promo kayak gini dipasang jelas biar orang tahu."</em></td>
      <td>Pelanggan Katering Acara</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">W-KAA01-03</span></td>
      <td>Bayar Belakangan</td>
      <td><em>"Kami transfer pembayaran setelah acara selesai. Sempat ada selisih hitungan sedikit karena pemilik agak lupa harga per kotak yang diomongin waktu awal chat WA."</em></td>
      <td>Pelanggan Katering Acara</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01-01</span></td>
      <td>Pajangan Etalase</td>
      <td>Pelanggan berdiri lama di depan etalase kaca memicingkan mata dan bertanya nama serta harga lauk ke pelayan secara bergantian.</td>
      <td>Catatan Observasi</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01-02</span></td>
      <td>Antrean Kasir</td>
      <td>Pukul 11.45–12.30 WIB antrean mencapai 8–10 orang berjejer, pelayan menghitung belanjaan secara mental (ingatan) tanpa struk cetak.</td>
      <td>Catatan Observasi</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01-03</span></td>
      <td>Gawai Pemilik</td>
      <td>Pesan WhatsApp masuk beruntun saat jam sibuk; beberapa notifikasi pesanan katering tertimpa oleh obrolan grup pribadi keluarga pemilik.</td>
      <td>Catatan Observasi</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01-04</span></td>
      <td>Stok Habis</td>
      <td>Dua orang pembeli batal membeli cincang ayam karena lauk tersebut sudah habis di etalase, padahal mereka sudah mengantre selama 7 menit.</td>
      <td>Catatan Observasi</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">O-01-05</span></td>
      <td>Buku Kas Fisik</td>
      <td>Buku catatan harian berceceran noda minyak di dekat meja dapur; coretan nominal uang ada yang ditimpa angka baru karena salah hitung.</td>
      <td>Catatan Observasi</td>
    </tr>
  </tbody>
</table>

<h2 class="subbab-title">4.5 Temuan User Research (Analisis Pola & Kesenjangan)</h2>
<p>
  Dari sintesis data wawancara dan observasi di atas, teridentifikasi beberapa pola perilaku serta kesenjangan operasional yang sangat jelas:
</p>
<ul>
  <li><strong>Pola Kesulitan Pengelolaan Pesanan:</strong> Ketergantungan absolut pada aplikasi pesan instan WhatsApp menciptakan celah risiko tinggi berupa pesan tenggelam, kelupaan mencatat kuota porsi, dan distorsi informasi alamat pengantaran.</li>
  <li><strong>Kesenjangan Keterbukaan Informasi Menu & Harga:</strong> Pelanggan membutuhkan transparansi harga dan pilihan variasi makanan secara mandiri, namun pemilik belum memiliki media visual resmi selain mengandalkan pertanyaan lisan berulang.</li>
  <li><strong>Hambatan Tata Kelola Piutang Usaha:</strong> Terdapat jeda kritis antara pengeluaran kas belanja modal dapur dengan penerimaan pencairan katering instansi/acara, yang diperparah oleh ketiadaan pencatatan riwayat jatuh tempo tagihan yang sistematis.</li>
  <li><strong>Paradoks Kebutuhan Sistem Digital:</strong> Pemilik menyadari keterbatasan pencatatan manual di buku fisik, namun resisten terhadap sistem POS yang rumit karena khawatir staf dapur kesulitan mengoperasikannya saat kondisi rumah makan sedang diserbu pembeli.</li>
</ul>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- 5. TAHAP DEFINE                           -->
<!-- ========================================== -->
<h1 class="bab-title">5. Tahap Define</h1>

<h2 class="subbab-title">5.1 User Persona & Empathy Map (4 Kategori Pengguna)</h2>
<p>
  Untuk mengarahkan perancangan solusi agar berorientasi pada karakteristik pengguna nyata, disusun 4 profil <em>User Persona</em> yang dilengkapi dengan <em>Empathy Map</em> 4 kuadran:
</p>

<!-- PERSONA 1: PEMILIK -->
<div class="persona-box no-break">
  <div class="persona-top">
    <h4>Hj. Rosmawati (52 Tahun)</h4>
    <span class="role-badge">Owner & Pengelola CV. Kedai Agung</span>
  </div>
  <div class="persona-quote-banner">
    &ldquo;Saya mau sistem yang sederhana dan gak bikin pusing anggota dapur. Yang penting pesanan katering gak ada yang kelewat, dan tagihan katering tercatat rapi biar modal gak macet.&rdquo;
  </div>
  <div class="persona-grid">
    <div class="persona-col">
      <h5>Profil & Konteks Harian</h5>
      <ul>
        <li>Mengelola seluruh operasional rumah makan dan jasa katering sejak subuh (06.30 WIB).</li>
        <li>Bertanggung jawab atas resep masakan, pembelian bahan di pasar, penerimaan order via WhatsApp, dan pembagian tugas kurir.</li>
        <li>Dasar Bukti: W-PEM01-01 s/d W-PEM01-10; O-01-03, O-01-05.</li>
      </ul>
      <h5>Tujuan Utama (Goals)</h5>
      <ul>
        <li>Mencatat seluruh pesanan katering harian dan katering acara tanpa ada yang tercecer.</li>
        <li>Memantau status tagihan piutang pelanggan instansi yang belum cair secara akurat.</li>
        <li>Menghindari lupa nominal harga yang disepakati dengan pelanggan acara.</li>
      </ul>
    </div>
    <div class="persona-col">
      <h5>Hambatan & Frustrasi (Pains)</h5>
      <ul>
        <li>Kewalahan meladeni chat WA pesanan katering saat bersamaan dengan jam masak sibuk.</li>
        <li>Modal usaha tertahan karena pencairan anggaran dinas sering mundur beberapa hari.</li>
        <li>Anggota dapur masih belum terbiasa dengan aplikasi komputer/tablet yang ribet.</li>
      </ul>
      <h5>Informasi yang Diperlukan</h5>
      <ul>
        <li>Daftar urutan pesanan katering harian (nama instansi, porsi, alamat, jam antar).</li>
        <li>Tabel status pembayaran (Lunas / Belum Lunas / Tanggal Jatuh Tempo).</li>
      </ul>
    </div>
  </div>
</div>

<div class="empathy-card no-break">
  <div class="empathy-head">Empathy Map: Hj. Rosmawati (Pemilik Usaha)</div>
  <div class="empathy-layout">
    <div class="empathy-quad says">
      <h5>Says (Apa yang Diucapkan)</h5>
      <ul>
        <li>"Rekapan sore manual pakai buku catatan, kuitansi dinas pakai cap CV." [W-PEM01-03]</li>
        <li>"Kadang saya lupa harga pasti yang disepakati waktu awal pesan." [W-PEM01-10]</li>
        <li>"Kalau pas ramai, siapa yang sempat buka-buka aplikasi?" [W-PEM01-08]</li>
      </ul>
    </div>
    <div class="empathy-quad thinks">
      <h5>Thinks (Apa yang Dipikirkan)</h5>
      <ul>
        <li>Khawatir pesanan katering kantor terlewat karena chat WA tertutup chat keluarga.</li>
        <li>Bingung memutar uang kas ketika modal tertahan di piutang katering dinas.</li>
        <li>Berpikir cara praktis agar menu dan harga bisa dilihat pelanggan tanpa perlu bertanya terus.</li>
      </ul>
    </div>
    <div class="empathy-quad does">
      <h5>Does (Apa yang Dilakukan)</h5>
      <ul>
        <li>Memasak mendahulukan katering pagi hari, baru memasak lauk ampera. [W-PEM01-01]</li>
        <li>Mencatat manual pesanan dan kas masuk di buku tulis bersampul kertas. [O-01-05]</li>
        <li>Mengurangi bonus/kerupuk saat harga cabai dan bumbu melonjak di pasar. [W-PEM01-05]</li>
      </ul>
    </div>
    <div class="empathy-quad feels">
      <h5>Feels (Apa yang Dirasakan)</h5>
      <ul>
        <li>Cemas modal operasional terhambat akibat pembayaran katering pasca-konsumsi terlambat.</li>
        <li>Lelah dan stres harus menjawab pertanyaan menu dan harga yang berulang-ulang via telepon.</li>
      </ul>
    </div>
  </div>
</div>

<div class="page-break"></div>

<!-- PERSONA 2: PELANGGAN AMPERA -->
<div class="persona-box no-break">
  <div class="persona-top">
    <h4>Bambang Irawan (29 Tahun)</h4>
    <span class="role-badge">Pegawai Kantor Sekitar / Pembeli Ampera</span>
  </div>
  <div class="persona-quote-banner">
    &ldquo;Jam istirahat cuma satu jam. Saya mau cepat tahu lauk apa yang masih ada dan harganya berapa, tanpa harus desak-desakan nanya ke pelayan.&rdquo;
  </div>
  <div class="persona-grid">
    <div class="persona-col">
      <h5>Profil & Konteks Harian</h5>
      <ul>
        <li>Pekerja swasta di Jalan Paus yang memiliki waktu istirahat makan siang terbatas (12.00–13.00 WIB).</li>
        <li>Mencari makan siang dengan porsi mengenyangkan dan harga terjangkau.</li>
        <li>Dasar Bukti: W-PEL01-01, W-PEL01-02; O-01-01, O-01-04.</li>
      </ul>
      <h5>Tujuan Utama (Goals)</h5>
      <ul>
        <li>Mendapatkan makanan favorit (Ayam Geprek/Cincang) tanpa kehabisan stok.</li>
        <li>Mengetahui harga menu secara pasti sebelum memilih lauk.</li>
        <li>Menyelesaikan proses pembelian dan pembayaran secara cepat.</li>
      </ul>
    </div>
    <div class="persona-col">
      <h5>Hambatan & Frustrasi (Pains)</h5>
      <ul>
        <li>Harus mengantre lama dan berdesakan saat jam makan siang ramai.</li>
        <li>Kecewa ketika sudah lama mengantre ternyata lauk yang diinginkan sudah habis terjual.</li>
        <li>Sungkan harus menanyakan harga setiap lauk ke pelayan yang sedang sibuk.</li>
      </ul>
      <h5>Informasi yang Diperlukan</h5>
      <ul>
        <li>Daftar ketersediaan menu lauk harian secara real-time.</li>
        <li>Daftar harga makanan dan minuman yang terpampang jelas.</li>
      </ul>
    </div>
  </div>
</div>

<div class="empathy-card no-break">
  <div class="empathy-head">Empathy Map: Bambang Irawan (Pelanggan Ampera)</div>
  <div class="empathy-layout">
    <div class="empathy-quad says">
      <h5>Says (Apa yang Diucapkan)</h5>
      <ul>
        <li>"Harganya gak ada tertulis, jadi tiap ambil lauk baru saya tanya." [W-PEL01-01]</li>
        <li>"Jam 12 ramai banget, kalau buru-buru agak kerepotan antre." [W-PEL01-02]</li>
      </ul>
    </div>
    <div class="empathy-quad thinks">
      <h5>Thinks (Apa yang Dipikirkan)</h5>
      <ul>
        <li>Apakah lauk cincang ayam masih tersedia atau sudah habis?</li>
        <li>Apakah uang pas-pasan mencukupi kalau mengambil dua jenis lauk berbeda?</li>
      </ul>
    </div>
    <div class="empathy-quad does">
      <h5>Does (Apa yang Dilakukan)</h5>
      <ul>
        <li>Berdiri mengamati etalase kaca sambil menunggu antrean terurai. [O-01-01]</li>
        <li>Membayar pesanan menggunakan pemindaian QRIS statis.</li>
      </ul>
    </div>
    <div class="empathy-quad feels">
      <h5>Feels (Apa yang Dirasakan)</h5>
      <ul>
        <li>Khawatir terlambat kembali ke kantor karena terhambat antrean kasir.</li>
        <li>Kecewa saat mendapati lauk yang diidamkan habis tanpa pemberitahuan sebelumnya.</li>
      </ul>
    </div>
  </div>
</div>

<!-- PERSONA 3: PELANGGAN KATERING HARIAN -->
<div class="persona-box no-break">
  <div class="persona-top">
    <h4>Siti Rahayu (36 Tahun)</h4>
    <span class="role-badge">Staf Administrasi Dinas Perhubungan / Pengelola Katering</span>
  </div>
  <div class="persona-quote-banner">
    &ldquo;Kami butuh kepastian 60 kotak makan siang diantar tepat waktu ke 4 bidang dinas, menu tidak monoton, dan kuitansi CV harus resmi untuk pencairan kas dinas.&rdquo;
  </div>
  <div class="persona-grid">
    <div class="persona-col">
      <h5>Profil & Konteks Harian</h5>
      <ul>
        <li>Bertanggung jawab mengoordinasikan jatah makan siang harian pegawai di 4 bidang kerja instansi dinas.</li>
        <li>Menghubungi katering tiap malam dan menyusun rekap kuitansi bulanan untuk bendahara APBD.</li>
        <li>Dasar Bukti: W-KAH01-01, W-KAH01-02; W-PEM01-02, W-PEM01-04.</li>
      </ul>
      <h5>Tujuan Utama (Goals)</h5>
      <ul>
        <li>Memastikan pesanan 60 kotak terkirim konsisten sebelum pukul 11.30 WIB.</li>
        <li>Mengetahui rotasi menu lauk harian agar staf dinas tidak merasa bosan.</li>
        <li>Mendapatkan kuitansi resmi bertanda tangan direktur dan cap stempel CV tepat waktu.</li>
      </ul>
    </div>
    <div class="persona-col">
      <h5>Hambatan & Frustrasi (Pains)</h5>
      <ul>
        <li>Menu yang dikirim sering kali tidak terduga karena koki menentukan sepihak.</li>
        <li>Proses verifikasi manual berkas tagihan sering terhambat jika kuitansi tidak lengkap.</li>
        <li>Sulit merequest variasi menu khusus saat ada rapat mendadak di kantor.</li>
      </ul>
      <h5>Informasi yang Diperlukan</h5>
      <ul>
        <li>Jadwal menu mingguan katering harian.</li>
        <li>Rekapitulasi total kotak harian berjalan dan invoice tagihan per periode.</li>
      </ul>
    </div>
  </div>
</div>

<div class="empathy-card no-break">
  <div class="empathy-head">Empathy Map: Siti Rahayu (Pelanggan Katering Harian)</div>
  <div class="empathy-layout">
    <div class="empathy-quad says">
      <h5>Says (Apa yang Diucapkan)</h5>
      <ul>
        <li>"Tiap malam kami WA konfirmasi porsi, tapi gak tahu besok menunya apa." [W-KAH01-01]</li>
        <li>"Kami butuh kuitansi resmi cap CV untuk laporan SPJ dinas." [W-KAH01-02]</li>
      </ul>
    </div>
    <div class="empathy-quad thinks">
      <h5>Thinks (Apa yang Dipikirkan)</h5>
      <ul>
        <li>Semoga katering diantar sebelum waktu ishoma pegawai dimulai.</li>
        <li>Apakah bisa meminta variasi lauk selain ayam tanpa biaya tambahan berlebih?</li>
      </ul>
    </div>
    <div class="empathy-quad does">
      <h5>Does (Apa yang Dilakukan)</h5>
      <ul>
        <li>Mengirim chat WhatsApp konfirmasi kuota kotak makan malam hari.</li>
        <li>Menerima paket pengantaran kurir di lobi dinas dan membagikannya ke 4 bidang.</li>
      </ul>
    </div>
    <div class="empathy-quad feels">
      <h5>Feels (Apa yang Dirasakan)</h5>
      <ul>
        <li>Was-was jika kurir terlambat datang saat jam makan pegawai sudah tiba.</li>
        <li>Puas dengan cita rasa masakan rumahan Kedai Agung yang cocok di lidah pegawai.</li>
      </ul>
    </div>
  </div>
</div>

<div class="page-break"></div>

<!-- PERSONA 4: PELANGGAN KATERING ACARA -->
<div class="persona-box no-break">
  <div class="persona-top">
    <h4>Hendri Kurniawan (41 Tahun)</h4>
    <span class="role-badge">Ketua Panitia Acara / Pemesan Katering Event</span>
  </div>
  <div class="persona-quote-banner">
    &ldquo;Waktu pesan 100 kotak kemarin saya bingung karena gak ada pilihan paket menu dan harganya. Saya mau pemesanan transparan dan ada kepastian bonus yang dijanjikan.&rdquo;
  </div>
  <div class="persona-grid">
    <div class="persona-col">
      <h5>Profil & Konteks Harian</h5>
      <ul>
        <li>Kerap menyelenggarakan acara syukuran keluarga, reuni, dan rapat paguyuban warga di wilayah Pekanbaru.</li>
        <li>Memesan nasi kotak dalam jumlah berkisar 50 hingga 150 kotak.</li>
        <li>Dasar Bukti: W-KAA01-01 s/d W-KAA01-03; W-PEM01-06, W-PEM01-07, W-PEM01-10.</li>
      </ul>
      <h5>Tujuan Utama (Goals)</h5>
      <ul>
        <li>Melihat opsi paket nasi kotak lengkap dengan rincian harga per kotak.</li>
        <li>Memperoleh penawaran promo/bonus resmi (bonus kue bolu untuk pemesanan &ge;50 kotak).</li>
        <li>Mendapatkan rekaman pesanan resmi agar tidak ada selisih hitung saat pelunasan.</li>
      </ul>
    </div>
    <div class="persona-col">
      <h5>Hambatan & Frustrasi (Pains)</h5>
      <ul>
        <li>Harus menanyakan menu dan harga berulang kali lewat pesan WA yang panjang.</li>
        <li>Adanya kesalahpahaman nominal total bayar saat pelunasan setelah acara.</li>
        <li>Khawatir pesanan keliru atau tidak tercatat jika pemilik sedang sibuk.</li>
      </ul>
      <h5>Informasi yang Diperlukan</h5>
      <ul>
        <li>Katalog paket menu katering acara beserta rincian lauk dan harga fix.</li>
        <li>Ketentuan batas pemesanan (H-4 s/d H-7) dan syarat klaim bonus bolu.</li>
      </ul>
    </div>
  </div>
</div>

<div class="empathy-card no-break">
  <div class="empathy-head">Empathy Map: Hendri Kurniawan (Pelanggan Katering Acara)</div>
  <div class="empathy-layout">
    <div class="empathy-quad says">
      <h5>Says (Apa yang Diucapkan)</h5>
      <ul>
        <li>"Susah nentuin menu karena gak ada buku menu katering yang ada harganya." [W-KAA01-01]</li>
        <li>"Untung dikasih tahu pesan 50 kotak dapat bonus bolu seloyang." [W-KAA01-02]</li>
        <li>"Sempat ada selisih hitungan sedikit karena pemilik agak lupa harga di awal." [W-KAA01-03]</li>
      </ul>
    </div>
    <div class="empathy-quad thinks">
      <h5>Thinks (Apa yang Dipikirkan)</h5>
      <ul>
        <li>Apakah pesanan dalam jumlah besar ini akan diantar tepat waktu ke alamat acara?</li>
        <li>Mengapa tidak ada bukti ringkasan pesanan digital yang bisa disimpan panitia?</li>
      </ul>
    </div>
    <div class="empathy-quad does">
      <h5>Does (Apa yang Dilakukan)</h5>
      <ul>
        <li>Menelepon pemilik usaha untuk mendiskusikan menu dan menanyakan potongan harga.</li>
        <li>Mentransfer pembayaran pelunasan setelah makanan dikonsumsi para tamu.</li>
      </ul>
    </div>
    <div class="empathy-quad feels">
      <h5>Feels (Apa yang Dirasakan)</h5>
      <ul>
        <li>Khawatir acara gagal hanya karena masalah keterlambatan atau salah menu katering.</li>
        <li>Senang memperoleh bonus bolu yang menghemat anggaran konsumsi acara.</li>
      </ul>
    </div>
  </div>
</div>

<div class="page-break"></div>

<h2 class="subbab-title">5.2 Affinity Diagram (Pengelompokan Bukti Temuan Riset)</h2>
<p>
  Berdasarkan prinsip <em>Affinity Mapping</em>, seluruh temuan kualitatif (kartu sticky notes) dikelompokkan secara induktif berdasarkan kesamaan tema persoalan alami pengguna. Pengelompokan ini mengoreksi kesalahan pemetaan manual sebelumnya dan menghasilkan 5 klaster tematik yang kohesif:
</p>

<!-- KLASTER A -->
<div class="affinity-group no-break">
  <div class="affinity-group-head">
    <span style="color: #15803d;">Tema A: Pemesanan dan Pengelolaan Pesanan Katering</span>
    <span class="badge b-green">8 Bukti Terelaborasi</span>
  </div>
  <div class="sticky-wrapper">
    <div class="sticky-note st-green"><strong>A1:</strong> Pemilik masih menerima pesanan katering via WhatsApp atau telepon seluler. <span class="badge b-blue">W-PEM01-02</span></div>
    <div class="sticky-note st-green"><strong>A2:</strong> Pesanan masuk via WA berisiko lambat ditangani karena chat tertumpuk obrolan lain. <span class="badge b-rose">O-01-03</span></div>
    <div class="sticky-note st-green"><strong>A3:</strong> Detail pesanan katering (menu, porsi, alamat, jam) berisiko salah catat atau tertukar. <span class="badge b-blue">W-PEM01-07</span></div>
    <div class="sticky-note st-green"><strong>A4:</strong> Pemilik harus menyalin manual menu dan jumlah porsi ke buku kertas dapur. <span class="badge b-blue">W-PEM01-03</span></div>
    <div class="sticky-note st-green"><strong>A5:</strong> Lokasi pengantaran (4 bidang dinas & tetangga) harus dicatat jelas agar kurir tidak salah rute. <span class="badge b-blue">W-PEM01-09</span></div>
    <div class="sticky-note st-green"><strong>A6:</strong> Pemilik sangat membutuhkan sistem terorganisir namun harus ramah bagi anggota dapur. <span class="badge b-blue">W-PEM01-08</span></div>
    <div class="sticky-note st-green"><strong>A7:</strong> Pelanggan berharap bisa memesan mandiri tanpa harus berulang kali bertanya via WA. <span class="badge b-purple">W-KAA01-01</span></div>
    <div class="sticky-note st-green"><strong>A8:</strong> Pelanggan berharap bisa pesan makanan tanpa wajib datang ke gerai ampera. <span class="badge b-green">W-KAH01-01</span></div>
  </div>
</div>

<!-- KLASTER B -->
<div class="affinity-group no-break">
  <div class="affinity-group-head">
    <span style="color: #c2410c;">Tema B: Transparansi Informasi Menu dan Kepastian Harga</span>
    <span class="badge b-amber">7 Bukti Terelaborasi</span>
  </div>
  <div class="sticky-wrapper">
    <div class="sticky-note st-orange"><strong>B1:</strong> Pelanggan masih harus bertanya lisan untuk tahu harga lauk ampera maupun katering. <span class="badge b-amber">W-PEL01-01</span></div>
    <div class="sticky-note st-orange"><strong>B2:</strong> Menu dan paket harga katering belum terdata tertulis sehingga pembeli susah menentukan pilihan. <span class="badge b-purple">W-KAA01-01</span></div>
    <div class="sticky-note st-orange"><strong>B3:</strong> Pelanggan ragu menentukan jumlah porsi sebelum mengetahui ketersediaan lauk pasti. <span class="badge b-amber">W-PEL01-01</span></div>
    <div class="sticky-note st-orange"><strong>B4:</strong> Informasi menu harian perlu dipublikasikan agar pembeli tahu lauk apa yang matang. <span class="badge b-green">W-KAH01-01</span></div>
    <div class="sticky-note st-orange"><strong>B5:</strong> Pemilik ingin info menu tersampaikan mudah tanpa repot mengetik ulang di tiap chat. <span class="badge b-blue">W-PEM01-02</span></div>
    <div class="sticky-note st-orange"><strong>B6:</strong> Pemilik kerap lupa nominal harga pasti yang telah disepakati saat awal negosiasi katering. <span class="badge b-blue">W-PEM01-10</span></div>
    <div class="sticky-note st-orange"><strong>B7:</strong> Ketiadaan papan daftar harga fisik di etalase memperlambat antrean jam makan siang. <span class="badge b-rose">O-01-01</span></div>
  </div>
</div>

<!-- KLASTER C -->
<div class="affinity-group no-break">
  <div class="affinity-group-head">
    <span style="color: #be185d;">Tema C: Tata Kelola Pembayaran dan Arus Kas Piutang</span>
    <span class="badge b-rose">6 Bukti Terelaborasi</span>
  </div>
  <div class="sticky-wrapper">
    <div class="sticky-note st-pink"><strong>C1:</strong> Pembayaran katering instansi dan acara dilakukan pasca-konsumsi (mundur). <span class="badge b-blue">W-PEM01-04</span></div>
    <div class="sticky-note st-pink"><strong>C2:</strong> Pencairan dana katering pemerintah kerap mundur 2–3 hari dari tanggal perjanjian. <span class="badge b-blue">W-PEM01-04</span></div>
    <div class="sticky-note st-pink"><strong>C3:</strong> Modal belanja harian terancam tertahan jika piutang belum tertagih tuntas. <span class="badge b-blue">W-PEM01-04</span></div>
    <div class="sticky-note st-pink"><strong>C4:</strong> Pemilik membutuhkan pemantauan jelas mana pesanan lunas dan mana yang masih tertagih. <span class="badge b-blue">W-PEM01-03</span></div>
    <div class="sticky-note st-pink"><strong>C5:</strong> Usaha sudah menerima tunai, transfer, dan QRIS namun bukti bayar tercecer di mutasi. <span class="badge b-blue">W-PEM01-04</span></div>
    <div class="sticky-note st-pink"><strong>C6:</strong> Pelanggan acara membutuhkan rekap tagihan resmi dan panduan nomor rekening tujuan transfer. <span class="badge b-purple">W-KAA01-03</span></div>
  </div>
</div>

<!-- KLASTER D & E -->
<div class="affinity-group no-break">
  <div class="affinity-group-head">
    <span style="color: #a16207;">Tema D & E: Operasional Pelayanan dan Promosi Usaha</span>
    <span class="badge b-amber">8 Bukti Terelaborasi</span>
  </div>
  <div class="sticky-wrapper">
    <div class="sticky-note st-yellow"><strong>D1:</strong> Jam ampera buka 08.00 WIB (lengkap 10.30 WIB), katering mulai masak subuh 06.30 WIB. <span class="badge b-blue">W-PEM01-01</span></div>
    <div class="sticky-note st-yellow"><strong>D2:</strong> Puncak keramaian ampera pukul 11.30–13.00 WIB menimbulkan antrean padat di kasir. <span class="badge b-rose">O-01-02</span></div>
    <div class="sticky-note st-yellow"><strong>D3:</strong> Kapasitas produksi mencapai 500 lauk/hari namun pencatatan stok masih mental di kepala. <span class="badge b-rose">O-01-04</span></div>
    <div class="sticky-note st-yellow"><strong>D4:</strong> Sulit memenuhi pesanan katering dengan menu berbeda-beda karena masak sekaligus di kuali besar. <span class="badge b-blue">W-PEM01-06</span></div>
    <div class="sticky-note st-yellow"><strong>E1:</strong> Ada bonus 1 loyang kue bolu untuk pemesanan katering minimal 50 kotak. <span class="badge b-blue">W-PEM01-06</span></div>
    <div class="sticky-note st-yellow"><strong>E2:</strong> Informasi promo bolu belum tersosialisasi terstruktur, hanya disampaikan secara lisan. <span class="badge b-purple">W-KAA01-02</span></div>
    <div class="sticky-note st-yellow"><strong>E3:</strong> Pelanggan ingin tahu bonus sebelum memesan agar bisa mengoptimalkan anggaran acara. <span class="badge b-purple">W-KAA01-02</span></div>
    <div class="sticky-note st-yellow"><strong>D5:</strong> Jangkauan kurir pengantaran dibatasi wilayah Ranca, Paus, dan Balam saja. <span class="badge b-blue">W-PEM01-09</span></div>
  </div>
</div>

<div class="page-break"></div>

<h2 class="subbab-title">5.3 Sintesis Insight dan Pernyataan Kebutuhan Pengguna</h2>
<p>
  Berdasarkan pola yang terbentuk pada Affinity Mapping, dilakukan sintesis mendalam untuk merumuskan <strong>Insight</strong> (penjelasan mengapa masalah tersebut terjadi) dan <strong>Kebutuhan Pengguna</strong> (kondisi kapabilitas yang harus dicapai tanpa menyebut solusi fitur terlebih dahulu):
</p>

<table>
  <thead>
    <tr>
      <th style="width: 10%;">ID Insight</th>
      <th style="width: 40%;">Rumusan Sintesis Insight (Akar Penyebab)</th>
      <th style="width: 10%;">ID Butuh</th>
      <th style="width: 40%;">Pernyataan Kebutuhan Pengguna (User Needs)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-green">I-A</span></td>
      <td>
        <strong>Pemesanan Terfragmentasi:</strong> Komunikasi pesanan katering hanya via WhatsApp menyebabkan data porsi, menu, alamat, dan jam antar rawan tenggelam di antara obrolan pribadi, sementara salin manual ke buku dapur rentan keliru.
      </td>
      <td><span class="badge b-green">K-A1<br>K-A2</span></td>
      <td>
        <strong>Pemilik:</strong> Membutuhkan cara terstruktur untuk mencatat, mengonsolidasi, dan memantau status pesanan katering harian dan acara secara terpusat.<br>
        <strong>Pelanggan:</strong> Membutuhkan media pemesanan mandiri yang dapat diakses kapan saja dengan konfirmasi ringkasan pesanan yang pasti.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-amber">I-B</span></td>
      <td>
        <strong>Asimetri Informasi Menu & Harga:</strong> Ketiadaan katalog terbuka memaksa pelanggan bertanya berulang secara lisan, sementara pemilik rentan mengalami distorsi ingatan atas harga negosiasi katering yang disepakati di awal.
      </td>
      <td><span class="badge b-amber">K-B1<br>K-B2</span></td>
      <td>
        <strong>Pelanggan:</strong> Membutuhkan akses mandiri terhadap daftar menu, komposisi paket lauk, dan harga pasti sebelum melakukan pemesanan.<br>
        <strong>Pemilik:</strong> Membutuhkan media penyajian menu harian yang mudah diperbarui serta rekaman harga kesepakatan yang terkunci di sistem.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-rose">I-C</span></td>
      <td>
        <strong>Ketidakpastian Arus Kas Piutang:</strong> Kebiasaan pembayaran pasca-konsumsi oleh dinas/acara tanpa pelacak tagihan sistematis menciptakan risiko tertahannya modal belanja bahan harian pemilik usaha.
      </td>
      <td><span class="badge b-rose">K-C1<br>K-C2</span></td>
      <td>
        <strong>Pemilik:</strong> Membutuhkan visibilitas status tagihan (lunas vs belum lunas) serta notifikasi jatuh tempo piutang katering agar modal belanja tetap terjaga.<br>
        <strong>Pelanggan:</strong> Membutuhkan informasi rincian tagihan resmi (invoice) dan konfirmasi penerimaan bukti bayar yang jelas.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-purple">I-D</span></td>
      <td>
        <strong>Keterbatasan Operasional Skala Besar:</strong> Memasak kapasitas 500 lauk dalam kuali besar membatasi fleksibilitas kustomisasi menu eceran, sementara antrean kasir ampera jam makan siang menghabiskan energi pelayan.
      </td>
      <td><span class="badge b-purple">K-D1<br>K-D2</span></td>
      <td>
        <strong>Pemilik & Dapur:</strong> Membutuhkan standarisasi paket kombinasi lauk katering (formula fix 50% ayam + 50% variasi) agar dapur tidak kewalahan.<br>
        <strong>Pelanggan Ampera:</strong> Membutuhkan estimasi ketersediaan lauk terpopuler agar tidak kecewa setelah mengantre.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-blue">I-E</span></td>
      <td>
        <strong>Promosi Lisan yang Tidak Efektif:</strong> Pemberian bonus kue bolu untuk order &ge;50 kotak tidak optimal mendongkrak penjualan karena mayoritas calon pembeli baru mengetahuinya secara kebetulan saat bertanya.
      </td>
      <td><span class="badge b-blue">K-E1</span></td>
      <td>
        <strong>Pelanggan & Pemilik:</strong> Membutuhkan transparansi informasi promo dan kalkulasi otomatis perolehan bonus saat kuota pesanan memenuhi syarat kuota.
      </td>
    </tr>
  </tbody>
</table>

<h2 class="subbab-title">5.4 Penentuan dan Evaluasi Masalah Prioritas</h2>
<p>
  Untuk menentukan fokus perancangan, calon masalah dievaluasi berdasarkan tiga kriteria utama: (1) Dampak terhadap kelangsungan tugas dan arus kas usaha, (2) Kekuatan dukungan bukti empiris lapangan, serta (3) Kelayakan penyelesaian melalui antarmuka sistem web/mobile:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 15%;">Kode Masalah</th>
      <th style="width: 25%;">Calon Masalah</th>
      <th style="width: 45%;">Pertimbangan Evaluasi Kriteria</th>
      <th style="width: 15%;">Keputusan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>MP-01</strong></td>
      <td>Pengelolaan Pesanan Katering yang Manual dan Terfragmentasi di WhatsApp</td>
      <td>Dukungan bukti sangat kuat (W-PEM01-02, W-PEM01-07, O-01-03). Berdampak fatal jika pesanan 60 kotak dinas terlewat atau salah catat jam antar. Solusi antarmuka form & dashboard sangat relevan.</td>
      <td><span class="badge b-green">Prioritas Utama 1</span></td>
    </tr>
    <tr>
      <td><strong>MP-02</strong></td>
      <td>Ketiadaan Akses Mandiri terhadap Informasi Menu, Paket, dan Kepastian Harga</td>
      <td>Didukung oleh seluruh kategori narasumber (W-PEL01-01, W-KAA01-01, W-PEM01-10, O-01-01). Memicu kebingungan pelanggan, memperlambat antrean, dan menyebabkan pemilik lupa harga sepakat.</td>
      <td><span class="badge b-green">Prioritas Utama 2</span></td>
    </tr>
    <tr>
      <td><strong>MP-03</strong></td>
      <td>Pemantauan Status Pembayaran dan Piutang Katering yang Belum Terstruktur</td>
      <td>Didukung bukti kritis keuangan pemilik (W-PEM01-04, W-KAA01-03, O-01-05). Mengancam likuiditas modal belanja dapur harian akibat pencairan APBD dinas yang kerap meleset.</td>
      <td><span class="badge b-green">Prioritas Utama 3</span></td>
    </tr>
    <tr>
      <td><strong>MP-04</strong></td>
      <td>Antrean Panjang di Jam Makan Siang Ampera dan Fluktuasi Bahan Baku</td>
      <td>Fakta nyata lapangan, namun sebagian besar dipengaruhi oleh faktor fisik kapasitas gerai dan dinamika makroekonomi pasar yang berada di luar jangkauan perangkat lunak.</td>
      <td><span class="badge b-amber">Prioritas Pendukung</span></td>
    </tr>
  </tbody>
</table>

<div class="page-break"></div>

<h2 class="subbab-title">5.5 Rumusan Point of View (POV)</h2>
<p>
  Rumusan masalah desain disusun menggunakan pola standar metodologi Design Thinking: <strong>[Pengguna dalam Konteks] membutuhkan [Kebutuhan] karena [Insight yang Mendasari]</strong>:
</p>

<div class="callout c-info no-break">
  <p><strong>Rumusan POV-01 (Pengelolaan Pesanan Katering):</strong><br>
  <strong>Hj. Rosmawati (Pemilik CV. Kedai Agung)</strong> yang setiap hari mengoordinasikan pesanan katering puluhan hingga ratusan kotak bersamaan dengan jam masak sibuk <strong>membutuhkan</strong> media pencatatan pesanan terstruktur yang mengonsolidasi detail menu, kuota porsi, alamat, dan jadwal pengantaran dalam satu tampilan ringkas <strong>karena</strong> komunikasi pesanan yang bertumpu pada obrolan pesan instan WhatsApp sangat rentan terlewat, tertumpuk chat pribadi, dan rawan salah salin ke catatan dapur fisik.</p>
  <p style="font-size: 8pt; color: #475569; margin: 4px 0 0 0;"><em>Dasar: MP-01 | Insight I-A | Bukti: W-PEM01-02, W-PEM01-07, O-01-03</em></p>
</div>

<div class="callout c-info no-break">
  <p><strong>Rumusan POV-02 (Transparansi Menu dan Harga):</strong><br>
  <strong>Pelanggan (Pembeli Ampera, Pelanggan Katering Harian, dan Panitia Acara)</strong> yang hendak memesan makanan di CV. Kedai Agung <strong>membutuhkan</strong> akses mandiri terhadap katalog menu, ketersediaan lauk harian, dan rincian harga paket pasti <strong>karena</strong> ketiadaan media informasi terbuka memaksa mereka bertanya berulang kali secara lisan, memicu keraguan dalam menentukan porsi, serta menyebabkan pemilik sendiri kerap lupa harga kesepakatan di awal saat penagihan.</p>
  <p style="font-size: 8pt; color: #475569; margin: 4px 0 0 0;"><em>Dasar: MP-02 | Insight I-B | Bukti: W-PEL01-01, W-KAA01-01, W-PEM01-10, O-01-01</em></p>
</div>

<div class="callout c-info no-break">
  <p><strong>Rumusan POV-03 (Tata Kelola Piutang dan Pembayaran):</strong><br>
  <strong>Pemilik CV. Kedai Agung</strong> yang melayani katering instansi pemerintah dan katering acara dengan sistem pembayaran tempo pasca-konsumsi <strong>membutuhkan</strong> pencatatan status tagihan terpusat yang memisahkan pesanan lunas dan belum lunas serta memantau tanggal jatuh tempo <strong>karena</strong> keterlambatan pencairan dana APBD dinas tanpa pelacak digital menahan modal kas usaha yang sangat dibutuhkan untuk belanja bahan baku harian.</p>
  <p style="font-size: 8pt; color: #475569; margin: 4px 0 0 0;"><em>Dasar: MP-03 | Insight I-C | Bukti: W-PEM01-04, W-KAA01-03, O-01-05</em></p>
</div>

<h2 class="subbab-title">5.6 How Might We (HMW) dan Perumusan Tujuan UX</h2>
<p>
  Pertanyaan <em>How Might We</em> (HMW) mentransformasi pernyataan masalah POV menjadi pertanyaan pemantik solusi kreatif, yang dipasangkan dengan <em>Tujuan UX (User Experience Goals)</em>:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 12%;">ID HMW</th>
      <th style="width: 48%;">Rumusan Pertanyaan HMW (Utama & Pendukung)</th>
      <th style="width: 40%;">Tujuan UX yang Ingin Dicapai (UX Goals)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-green">HMW-01</span></td>
      <td>
        <strong>Bagaimana kita dapat membantu pemilik mengelola pesanan katering secara terstruktur dan bebas dari risiko salah catat?</strong><br>
        <span style="font-size: 7.5pt; color: #64748b;">
          &bull; HMW-01a: Bagaimana membantu pelanggan memasukkan detail porsi & alamat tanpa chat berbelit?<br>
          &bull; HMW-01b: Bagaimana menyajikan ringkasan antrean dapur yang mudah dipahami staf operasional?
        </span>
      </td>
      <td>
        <strong>Kejelasan & Ketenangan Pikiran (Peace of Mind):</strong> Pemilik merasa tenang karena seluruh pesanan terekam pasti; pelanggan merasa yakin pesanannya terkonfirmasi tanpa harus mengejar via telepon berulang.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-amber">HMW-02</span></td>
      <td>
        <strong>Bagaimana kita dapat menyediakan informasi menu, variasi lauk, dan harga secara transparan dan mudah diakses mandiri?</strong><br>
        <span style="font-size: 7.5pt; color: #64748b;">
          &bull; HMW-02a: Bagaimana menampilkan katalog paket nasi kotak beserta opsi promo bonus bolu?<br>
          &bull; HMW-02b: Bagaimana mengunci nominal harga kesepakatan agar tidak terjadi selisih saat penagihan?
        </span>
      </td>
      <td>
        <strong>Transparansi & Efisiensi Kognitif:</strong> Mengurangi beban tanya-jawab harga; pelanggan dapat mengambil keputusan cepat; interaksi terasa adil dan transparan bagi kedua belah pihak.
      </td>
    </tr>
    <tr>
      <td><span class="badge b-rose">HMW-03</span></td>
      <td>
        <strong>Bagaimana kita dapat membantu pemilik memantau status piutang dan pembayaran katering agar modal usaha tidak tertahan?</strong><br>
        <span style="font-size: 7.5pt; color: #64748b;">
          &bull; HMW-03a: Bagaimana memberi penanda visual yang kontras antara tagihan lunas dan tertunggak?<br>
          &bull; HMW-03b: Bagaimana menyediakan format invoice katering resmi CV yang siap cetak untuk bendahara?
        </span>
      </td>
      <td>
        <strong>Kontrol & Keamanan Finansial:</strong> Pemilik memiliki kendali penuh atas arus kas keluar-masuk; bendahara dinas mendapatkan dokumen penagihan formal yang akuntabel.
      </td>
    </tr>
  </tbody>
</table>

<div class="page-break"></div>

<!-- ========================================== -->
<!-- 6. TAHAP IDEATE                           -->
<!-- ========================================== -->
<h1 class="bab-title">6. Tahap Ideate</h1>

<h2 class="subbab-title">6.1 Teknik Eksplorasi & Alternatif Ide Solusi per HMW</h2>
<p>
  Tahap <em>Ideate</em> mengeksplorasi sebanyak mungkin alternatif solusi kreatif guna menjawab tantangan HMW. Tim menggunakan teknik <strong>Brainstorming Terstruktur</strong> dan <strong>Crazy Eights Sketching</strong> untuk memunculkan ide-ide antarmuka tanpa membatasi imajinasi awal:
</p>

<!-- TABEL IDE HMW-01 -->
<h3 class="section-title">Eksplorasi Ide untuk HMW-01 (Pengelolaan Pesanan Katering)</h3>
<table>
  <thead>
    <tr>
      <th style="width: 12%;">ID Ide</th>
      <th style="width: 25%;">Konsep Alternatif Ide</th>
      <th style="width: 40%;">Mekanisme Cara Kerja Awal</th>
      <th style="width: 23%;">Aspek Pengujian (Testing Focus)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-green">ID-A1</span></td>
      <td>Formulir Pemesanan Katering Online Mandiri</td>
      <td>Pelanggan membuka web, memilih tanggal acara, jumlah porsi, variasi paket lauk, serta mengisi form alamat dan titik antar.</td>
      <td>Apakah form cukup ringkas dan mudah diisi lewat HP tanpa membingungkan?</td>
    </tr>
    <tr>
      <td><span class="badge b-green">ID-A2</span></td>
      <td>Dashboard Kanban Antrean Dapur & Pengantaran</td>
      <td>Pemilik melihat kartu pesanan dalam kolom: <em>Masuk &rarr; Dimasak &rarr; Diantar Kurir &rarr; Selesai</em> dalam satu layar.</td>
      <td>Apakah anggota dapur yang "jadul" dapat memahami kartu status visual ini?</td>
    </tr>
    <tr>
      <td><span class="badge b-green">ID-A3</span></td>
      <td>Manajemen Data Langganan Tetap (Kantor Dinas)</td>
      <td>Menyimpan profil instansi Dishub dengan kuota default 60 kotak/hari; pemilik tinggal mengklik centang konfirmasi harian.</td>
      <td>Apakah fitur template langganan mempercepat tugas pemilik tiap malam?</td>
    </tr>
    <tr>
      <td><span class="badge b-green">ID-A4</span></td>
      <td>Surat Jalan & Rute Pengantaran Kurir Cetak</td>
      <td>Sistem merangkum alamat kantor dinas (lantai 1 s/d 4) dan rumah tetangga menjadi memo rute kurir sekali jalan.</td>
      <td>Apakah memo digital/cetak membantu kurir agar tidak ada kotak tertinggal?</td>
    </tr>
  </tbody>
</table>

<!-- TABEL IDE HMW-02 -->
<h3 class="section-title">Eksplorasi Ide untuk HMW-02 (Transparansi Menu dan Harga)</h3>
<table>
  <thead>
    <tr>
      <th style="width: 12%;">ID Ide</th>
      <th style="width: 25%;">Konsep Alternatif Ide</th>
      <th style="width: 40%;">Mekanisme Cara Kerja Awal</th>
      <th style="width: 23%;">Aspek Pengujian (Testing Focus)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-amber">ID-B1</span></td>
      <td>Katalog Menu Digital Terbuka & Filter Lauk</td>
      <td>Halaman publik web menampilkan foto makanan, nama lauk, komposisi bahan, dan harga per porsi secara transparan.</td>
      <td>Apakah pembeli ampera dapat mengecek menu sebelum datang ke gerai?</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">ID-B2</span></td>
      <td>Katalog Paket Nasi Kotak & Kalkulator Bonus</td>
      <td>Paket katering (Hemat, Standar, Premium). Jika jumlah kotak diinput &ge;50, otomatis muncul badge: <em>"Bonus 1 Loyang Bolu"</em>.</td>
      <td>Apakah penegasan visual bonus bolu menarik minat pemesan acara?</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">ID-B3</span></td>
      <td>Pengunci Riwayat Harga Kesepakatan (Price Lock)</td>
      <td>Harga per kotak yang disetujui saat pemesanan langsung tersimpan permanen di invoice dan tidak dapat berubah sepihak.</td>
      <td>Apakah fitur ini sukses mencegah selisih hitung saat pelunasan pasca-acara?</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">ID-B4</span></td>
      <td>Toggle Ketersediaan Lauk Harian (Ready/Habis)</td>
      <td>Tombol saklar 1-klik di dashboard pemilik untuk menandai lauk yang sudah habis agar etalase digital langsung terupdate.</td>
      <td>Apakah pemilik mau menyempatkan diri mengklik saklar saat jam sibuk?</td>
    </tr>
  </tbody>
</table>

<!-- TABEL IDE HMW-03 -->
<h3 class="section-title">Eksplorasi Ide untuk HMW-03 (Tata Kelola Piutang dan Pembayaran)</h3>
<table>
  <thead>
    <tr>
      <th style="width: 12%;">ID Ide</th>
      <th style="width: 25%;">Konsep Alternatif Ide</th>
      <th style="width: 40%;">Mekanisme Cara Kerja Awal</th>
      <th style="width: 23%;">Aspek Pengujian (Testing Focus)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-rose">ID-C1</span></td>
      <td>Pelacak Status Piutang & Tagihan Jatuh Tempo</td>
      <td>Tabel khusus pemilik yang menyorot pesanan katering belum lunas dengan badge warna: <em>Kuning (Menunggu Tempo), Merah (Lewat Tempo)</em>.</td>
      <td>Apakah pewarnaan status membantu pemilik memprioritaskan penagihan dinas?</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">ID-C2</span></td>
      <td>Generator Invoice & Kuitansi Resmi CV (PDF/Cetak)</td>
      <td>Tombol otomatis untuk membuat lembar kuitansi lengkap dengan kop surat CV. Kedai Agung, stempel legal, dan rincian kotak harian.</td>
      <td>Apakah format cetak sesuai dengan syarat administrasi SPJ bendahara dinas?</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">ID-C3</span></td>
      <td>Upload Bukti Transfer & Konfirmasi QRIS Mandiri</td>
      <td>Pelanggan mengunggah tangkapan layar bukti transfer bank/QRIS ke formulir web untuk diverifikasi pemilik sekali klik.</td>
      <td>Apakah pelanggan merasa nyaman dan mudah mengunggah foto resi bayar?</td>
    </tr>
  </tbody>
</table>

<div class="page-break"></div>

<h2 class="subbab-title">6.2 Pemetaan dan Pengelompokan Ide Menjadi Usulan Fitur</h2>
<p>
  Sebelas alternatif ide di atas kemudian dikelompokkan dan dikonsolidasikan ke dalam <strong>8 Usulan Modul Fitur Sistem</strong> yang terhubung langsung dengan arsitektur web aplikasi (Laravel backend):
</p>

<table>
  <thead>
    <tr>
      <th style="width: 10%;">ID Fitur</th>
      <th style="width: 25%;">Nama Modul Fitur</th>
      <th style="width: 20%;">Ide Penyusun</th>
      <th style="width: 25%;">Kebutuhan yang Dilayani</th>
      <th style="width: 20%;">Peran Antarmuka (UI Role)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>F-01</strong></td>
      <td><strong>Dashboard Pengelolaan Katering Terpadu</strong></td>
      <td>ID-A2, ID-A4</td>
      <td>K-A1, K-D1 (Pemilik & Dapur)</td>
      <td>Tampilan web admin untuk monitoring antrean masak, kuota porsi harian, dan rute kurir.</td>
    </tr>
    <tr>
      <td><strong>F-02</strong></td>
      <td><strong>Formulir Pemesanan Katering Mandiri</strong></td>
      <td>ID-A1, ID-B2</td>
      <td>K-A2, K-A3, K-E1 (Pelanggan)</td>
      <td>Antarmuka form interaktif mobile bagi panitia acara/warga untuk input tanggal, porsi, paket, dan lokasi.</td>
    </tr>
    <tr>
      <td><strong>F-03</strong></td>
      <td><strong>Modul Pelanggan Tetap (Langganan Dinas)</strong></td>
      <td>ID-A3</td>
      <td>K-A1, K-A4 (Pemilik & Instansi)</td>
      <td>Manajemen profil kontrak bulanan dinas (Dishub 60 kotak/hari) dengan 1-klik konfirmasi harian.</td>
    </tr>
    <tr>
      <td><strong>F-04</strong></td>
      <td><strong>Katalog Menu & Paket Harga Transparan</strong></td>
      <td>ID-B1, ID-B2</td>
      <td>K-B1, K-B2 (Semua Pelanggan)</td>
      <td>Halaman katalog interaktif berisi pilihan lauk ampera, paket nasi kotak, dan kalkulator bonus bolu otomatis.</td>
    </tr>
    <tr>
      <td><strong>F-05</strong></td>
      <td><strong>Price Lock & Rekam Jejak Negosiasi</strong></td>
      <td>ID-B3</td>
      <td>K-B2 (Pemilik & Pelanggan Acara)</td>
      <td>Penyimpanan permanen harga kesepakatan per kotak di database agar tidak berubah saat pelunasan.</td>
    </tr>
    <tr>
      <td><strong>F-06</strong></td>
      <td><strong>Pelacak Piutang & Pengingat Tempo</strong></td>
      <td>ID-C1</td>
      <td>K-C1, K-C2 (Pemilik Usaha)</td>
      <td>Tabel pemantau status pembayaran pelanggan katering dengan indikator visual keterlambatan pencairan.</td>
    </tr>
    <tr>
      <td><strong>F-07</strong></td>
      <td><strong>Generator Invoice & Kuitansi Resmi CV</strong></td>
      <td>ID-C2</td>
      <td>K-C1, K-C3 (Instansi & Pemilik)</td>
      <td>Pencetakan dokumen PDF kuitansi resmi ber-kop CV dan tanda tangan direktur untuk SPJ APBD.</td>
    </tr>
    <tr>
      <td><strong>F-08</strong></td>
      <td><strong>Portal Verifikasi Bukti Bayar & QRIS</strong></td>
      <td>ID-C3</td>
      <td>K-C2, K-C3 (Pelanggan & Pemilik)</td>
      <td>Halaman konfirmasi pembayaran non-tunai lengkap dengan nomor rekening dan fasilitas upload struk.</td>
    </tr>
  </tbody>
</table>

<h2 class="subbab-title">6.3 Evaluasi Solusi & Matriks Prioritas 4 Kuadran (Impact vs Effort)</h2>
<p>
  Setiap modul fitur dianalisis berdasarkan <strong>Tingkat Dampak bagi Pengguna (Impact)</strong> terhadap pemecahan masalah krusial, dibandingkan dengan <strong>Tingkat Usaha Pengembangan (Effort)</strong> pembuatan prototipe dan coding framework:
</p>

<div class="matrix-box no-break">
  <div class="matrix-cell m-q1">
    <h5 style="color: #15803d;">KUADRAN I: QUICK WINS (Prioritas Utama)</h5>
    <p class="meta">Dampak Tinggi &bull; Usaha Rendah/Sedang &bull; Wajib Dibuat Segera</p>
    <ul>
      <li><strong>F-04: Katalog Menu & Paket Transparan:</strong> Memberi dampak instan bagi pembeli ampera & pemesan acara; implementasi UI relatif cepat.</li>
      <li><strong>F-06: Pelacak Piutang & Pengingat Tempo:</strong> Menyelesaikan persoalan fatal arus kas modal pemilik; struktur data berbasis tabel sederhana.</li>
      <li><strong>F-05: Price Lock Rekam Negosiasi:</strong> Mencegah perselisihan pelunasan katering acara; implementasi field database terkunci.</li>
    </ul>
  </div>

  <div class="matrix-cell m-q2">
    <h5 style="color: #0369a1;">KUADRAN II: MAJOR PROJECTS (Proyek Inti)</h5>
    <p class="meta">Dampak Tinggi &bull; Usaha Tinggi &bull; Fondasi Sistem Prototipe</p>
    <ul>
      <li><strong>F-01: Dashboard Pengelolaan Katering:</strong> Pusat kendali operasional dapur dan kurir; membutuhkan desain alur status yang sangat matang.</li>
      <li><strong>F-02: Formulir Pemesanan Katering Mandiri:</strong> Fitur transaksi inti bagi pelanggan; membutuhkan validasi input tanggal (H-4) & alamat.</li>
      <li><strong>F-07: Generator Kuitansi Resmi CV:</strong> Krusial untuk pencairan APBD dinas; membutuhkan template print layout PDF akurat.</li>
    </ul>
  </div>

  <div class="matrix-cell m-q3">
    <h5 style="color: #b45309;">KUADRAN III: FILL-INS (Fitur Pendukung)</h5>
    <p class="meta">Dampak Sedang/Rendah &bull; Usaha Rendah &bull; Pelengkap Fleksibel</p>
    <ul>
      <li><strong>F-08: Portal Verifikasi Bukti Bayar & QRIS:</strong> Membantu verifikasi struk transfer foto, namun dapat didukung manual via chat jika waktu sempit.</li>
    </ul>
  </div>

  <div class="matrix-cell m-q4">
    <h5 style="color: #475569;">KUADRAN IV: RECONSIDER / PHASE 2 (Ditunda)</h5>
    <p class="meta">Dampak Terbatas &bull; Usaha Tinggi &bull; Direncanakan Pasca-MVP</p>
    <ul>
      <li><strong>F-03: Otomasi Kontrak Pelanggan Tetap:</strong> Mengingat pesanan Dishub bersifat sangat stabil (60 porsi/hari), otomasi kompleks ditunda ke fase rilis berikutnya.</li>
    </ul>
  </div>
</div>

<div class="page-break"></div>

<h2 class="subbab-title">6.4 Daftar Fitur Terpilih dan Batasan Cakupan Prototipe</h2>
<p>
  Berdasarkan matriks prioritas di atas, diputuskan ruang lingkup fitur yang masuk ke dalam fase pembuatan prototipe interaktif (Figma / Web Laravel MVP) adalah sebagai berikut:
</p>

<table>
  <thead>
    <tr>
      <th style="width: 12%;">Kode Fitur</th>
      <th style="width: 25%;">Nama Fitur Terpilih</th>
      <th style="width: 20%;">Sasaran Pengguna</th>
      <th style="width: 43%;">Komponen Antarmuka yang Akan Dibuat & Diuji</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge b-green">FITUR-01</span></td>
      <td><strong>Katalog Menu & Paket Katering Interaktif (F-04)</strong></td>
      <td>Pelanggan Ampera & Pemesan Acara</td>
      <td>Daftar kartu menu dengan foto, badge harga fix, filter kategori (Ayam, Ikan, Sayur), kalkulator porsi katering, dan penampil otomatis banner promo bolu (&ge;50 kotak).</td>
    </tr>
    <tr>
      <td><span class="badge b-blue">FITUR-02</span></td>
      <td><strong>Formulir Pemesanan Katering Mandiri (F-02)</strong></td>
      <td>Pelanggan Katering Acara & Harian</td>
      <td>Formulir multi-step: input kuota porsi, pilihan tanggal acara (validasi minimal H-4), dropdown paket lauk, input alamat dinas/rumah, dan tombol submit ringkasan order.</td>
    </tr>
    <tr>
      <td><span class="badge b-purple">FITUR-03</span></td>
      <td><strong>Dashboard Antrean Pesanan Dapur (F-01)</strong></td>
      <td>Pemilik Usaha & Tim Dapur</td>
      <td>Tampilan tabel/kartu antrean pesanan harian berisi informasi instansi pemesan, jumlah kotak, catatan menu, alamat antar kurir, dan tombol ubah status pesanan.</td>
    </tr>
    <tr>
      <td><span class="badge b-rose">FITUR-04</span></td>
      <td><strong>Pelacak Piutang & Status Pembayaran (F-06 & F-05)</strong></td>
      <td>Pemilik Usaha (Owner)</td>
      <td>Tabel monitoring kas piutang dengan indikator visual lunas vs belum lunas, tanggal jatuh tempo dinas, ringkasan harga terkunci (price lock), dan tombol konfirmasi pelunasan.</td>
    </tr>
    <tr>
      <td><span class="badge b-amber">FITUR-05</span></td>
      <td><strong>Cetak Kuitansi Resmi CV Kedai Agung (F-07)</strong></td>
      <td>Pemilik Usaha & Bendahara Instansi</td>
      <td>Format layout cetak faktur penagihan resmi ber-kop CV. Kedai Agung, memuat nomor kuitansi, rincian hari katering, total porsi, nominal rupiah, cap, dan tanda tangan direktur.</td>
    </tr>
  </tbody>
</table>

<div class="callout c-alert">
  <strong>Catatan Pengendalian Ruang Lingkup (Scope Governance):</strong>
  Fitur yang ditunda pengembangannya pada fase prototipe ini mencakup modul integrasi otomatisasi SMS/WhatsApp Gateway API berbayar dan pelacakan GPS live armada kurir. Pengantaran tetap dijalankan secara terkoordinasi melalui penugasan rute di dashboard, dan konfirmasi bukti bayar difokuskan pada pengunggahan gambar resi standar. Keputusan ini diambil agar fokus perancangan IMK tetap tajam pada penyelesaian masalah prioritas tanpa membebani kompleksitas teknis pengujian pengguna.
</div>

<div class="callout c-quote" style="margin-top: 24px; text-align: center;">
  <strong>Dokumen Hasil Pekerjaan Kelompok 7 &bull; Mata Kuliah Interaksi Manusia dan Komputer (IMK)</strong><br>
  Disusun berdasarkan data primer wawancara lapangan dan observasi faktual badan usaha CV. Kedai Agung.<br>
  <em>(Muhammad Raffli Habibie, Jhonatan Permadi Silaban, Muhammad Daffariz)</em>
</div>

</body>
</html>
"""

print("Menulis file HTML...")
with open(html_file, 'w', encoding='utf-8') as f:
    f.write(html_content)

print(f"File HTML berhasil dibuat di: {html_file}")
print("Memulai kompilasi PDF menggunakan headless Chrome...")

chrome_path = r'C:\Program Files\Google\Chrome\Application\chrome.exe'
cmd = [
    chrome_path,
    '--headless=new',
    '--disable-gpu',
    '--no-sandbox',
    '--no-pdf-header-footer',
    f'--print-to-pdf={pdf_file_workspace}',
    html_file
]

res = subprocess.run(cmd, capture_output=True, text=True)
if res.returncode == 0 and os.path.exists(pdf_file_workspace):
    size_kb = os.path.getsize(pdf_file_workspace) / 1024
    print(f"BERHASIL! PDF dibuat di workspace: {pdf_file_workspace} ({size_kb:.2f} KB)")
    
    # Salin ke direktori artifact agar bisa langsung diakses / diunduh user
    try:
        shutil.copy2(pdf_file_workspace, pdf_file_brain)
        print(f"Salinan PDF juga berhasil disimpan di brain artifacts: {pdf_file_brain}")
    except Exception as e:
        print(f"Gagal menyalin ke brain: {e}")
else:
    print(f"Gagal membuat PDF. Returncode: {res.returncode}")
    print(f"Stderr: {res.stderr}")

# LAPORAN TAHAP EMPATHIZE & DEFINE (DESIGN THINKING)
## Mata Kuliah: Interaksi Manusia dan Komputer (IMK)

**Judul Proyek:** Pengelolaan dan Pemesanan Rumah Makan dari Badan Usaha CV. Kedai Agung  
**Dosen Pengampu:** Ibu Rika PS  
**Kelompok 7:**
1. Muhammad Raffli Habibie
2. Jhonatan Permadi Silaban
3. Muhammad Daffariz

---

## 01. IDENTIFIKASI PROSES BISNIS LAYANAN CV. KEDAI AGUNG

Berdasarkan hasil observasi dan wawancara terhadap pemilik CV. Kedai Agung, pembeli langsung di rumah makan (Ampera), pelanggan katering harian, serta pemesan katering acara, berikut adalah alur proses bisnis saat ini (*as-is*):

### A. Alur Pemesanan Katering (Harian & Acara) Saat Ini
| Tahap | Aktor | Proses yang Terjadi |
| :--- | :--- | :--- |
| **1. Pengajuan Pesanan** | Pelanggan & Pemilik | Pelanggan menghubungi pemilik melalui WhatsApp atau telepon seluler untuk menanyakan ketersediaan menu dan harga. |
| **2. Negosiasi & Penentuan Menu** | Pelanggan & Pemilik | Terjadi percakapan berulang karena daftar menu dan harga katering belum terdokumentasi secara pasti. Terkadang pelanggan meminta menu khusus yang sulit dipenuhi karena skala masak massal. |
| **3. Pencatatan Pesanan** | Pemilik | Pemilik mencatat detail pesanan (menu, jumlah porsi, alamat, dan waktu pengiriman) secara manual atau mengandalkan riwayat *chat* WhatsApp, sehingga berisiko terlambat diproses atau tertukar. |
| **4. Produksi Makanan** | Bagian Dapur / Produksi | Dapur mulai beroperasi pukul 07.30 untuk katering (kapasitas total mencapai ~500 potong lauk per hari). Jika ada pesanan 50 kotak ke atas, disiapkan bonus satu loyang kue bolu. |
| **5. Pengiriman Makanan** | Kurir / Pengantar & Pelanggan | Makanan dikirim ke lokasi pelanggan sesuai waktu yang dijanjikan. |
| **6. Pembayaran & Pelunasan** | Pelanggan & Pemilik | Sebagian pelanggan membayar di awal, namun banyak pesanan katering (terutama instansi/acara) yang pembayarannya dilakukan setelah makanan dikonsumsi. |
| **7. Monitoring Keuangan** | Pemilik | Karena dicatat manual, pemilik sering lupa nominal pasti yang disepakati, pembayaran terlambat masuk, dan modal kerja untuk membeli bahan baku esok hari menjadi tertahan. |

### B. Alur Pembelian Langsung di Rumah Makan (Ampera) Saat Ini
| Tahap | Aktor | Proses yang Terjadi |
| :--- | :--- | :--- |
| **1. Kedatangan Pembeli** | Pembeli Langsung | Rumah makan buka pukul 08.00, namun menu/lauk lengkap biasanya baru tersedia sekitar pukul 10.30. |
| **2. Pemilihan Menu** | Pembeli & Pelayan | Pembeli memilih lauk di etalase (menu favorit: ayam geprek, cincang ayam, sarden). Jam tersibuk adalah pukul 11.30–13.00. |
| **3. Antrean & Pelayanan** | Pembeli & Pelayan | Terjadi antrean panjang saat jam makan siang yang memperlambat pelayanan langsung. |
| **4. Pembayaran** | Pembeli & Kasir | Pembayaran diselesaikan di kasir menggunakan uang tunai (cash), transfer bank, atau scan QRIS. |

---

## 02. HASIL PENGGALIAN DATA (EMPATHIZE)

### Kode Bukti Riset:
- **W-PEM**: Wawancara Pemilik CV. Kedai Agung
- **W-PEL**: Wawancara Pelanggan (Katering Harian, Katering Acara, Pembeli Langsung)
- **O-RM**: Observasi Lapangan di Rumah Makan dan Dapur CV. Kedai Agung

| ID Bukti | Sumber & Aktor | Rangkuman Temuan Wawancara / Observasi |
| :--- | :--- | :--- |
| **W-PEM-01** | Pemilik | Masih menerima pesanan katering, nasi kotak, dan katering acara via WhatsApp. |
| **W-PEM-02** | Pemilik | Sering lupa harga pasti yang disepakati jika pelanggan membayar setelah konsumsi. |
| **W-PEM-03** | Pemilik | Modal kerja harian sering tertahan karena piutang katering belum dibayar. |
| **W-PEM-04** | Pemilik | Sulit memenuhi permintaan menu khusus yang beraneka ragam karena proses masak dilakukan massal (~500 potong lauk/hari). |
| **W-PEM-05** | Pemilik | Harga bahan baku (seperti cabai) sering fluktuatif sehingga mempengaruhi biaya produksi dan margin keuntungan. |
| **W-PEM-06** | Pemilik | Memberikan bonus 1 loyang bolu untuk pesanan minimal 50 kotak, namun promo ini belum tersampaikan secara konsisten ke publik. |
| **W-PEL-01** | Pelanggan Katering | Kesulitan mengetahui menu harian dan variasi paket katering tanpa harus chat pemilik berulang kali. |
| **W-PEL-02** | Pelanggan Katering | Konfirmasi pesanan via WhatsApp kadang lambat dibalas saat pemilik sedang sibuk melayani jam makan siang. |
| **W-PEL-03** | Pelanggan Langsung | Mengeluhkan antrean panjang pada jam sibuk makan siang (11.30–13.00) dan takut menu favorit (ayam geprek, cincang) habis. |
| **O-RM-01** | Observasi Rumah Makan | Dapur katering mulai bergerak 07.30, rumah makan buka 08.00, namun display etalase baru komplit pukul 10.30. |
| **O-RM-02** | Observasi Rumah Makan | Jam ramai puncak terjadi pada 11.30–13.00; transaksi pembayaran sudah didukung tunai, transfer, dan QRIS. |

---

## 03. USER PERSONA

### Persona 1: Pemilik Usaha
| Aspek | Deskripsi |
| :--- | :--- |
| **Nama & Peran** | **Pak Agung (46 Tahun)** — Pemilik & Pengelola Operasional CV. Kedai Agung |
| **Konteks** | Mengelola produksi 500 potong lauk per hari, melayani pembeli langsung di rumah makan Ampera, sekaligus melayani katering instansi dan acara keluarga. |
| **Tujuan** | 1. Memiliki pencatatan pesanan katering yang rapi (menu, porsi, alamat, jam kirim).<br>2. Memantau piutang/pembayaran pelanggan secara akurat agar modal kerja harian tidak macet.<br>3. Menginformasikan menu, paket katering, dan bonus (promo bolu) dengan mudah. |
| **Perilaku** | Menerima pesanan lewat WhatsApp sambil mengawasi dapur dan kasir; menghitung rekap tagihan secara manual di buku nota. |
| **Kesulitan (Pain Points)** | Chat pesanan menumpuk dan berisiko salah catat/tertukar; sering lupa nominal harga yang telah disepakati sebelumnya; modal tertahan karena pelanggan membayar pasca-makan. |
| **Perasaan** | Cemas modal belanja bahan baku esok hari terganggu, lelah menjawab pertanyaan menu yang sama secara berulang di WhatsApp. |
| **Pernyataan Representatif** | *"Kalau pesanan masuk lewat WA pas jam makan siang lagi ramai, kadang lupa kecatat atau harganya lupa berapa yang sudah disepakati. Ujung-ujungnya modal buat belanja besok tertahan karena tagihan belum dibayar."* |

---

### Persona 2: Pelanggan Katering (Kantor / Acara)
| Aspek | Deskripsi |
| :--- | :--- |
| **Nama & Peran** | **Ibu Rina (34 Tahun)** — Staf Administrasi / Pelanggan Katering Acara & Harian |
| **Konteks** | Sering memesan makan siang kotak untuk rapat kantor dan acara keluarga dalam jumlah 30–70 kotak. |
| **Tujuan** | 1. Mendapatkan kepastian menu, rincian harga pasti, dan jam pengantaran yang tepat waktu.<br>2. Mengetahui promo/bonus (seperti bonus bolu pesanan 50 kotak) secara transparan.<br>3. Memiliki bukti rincian tagihan resmi untuk pencairan kas kantor. |
| **Perilaku** | Menghubungi katering via WhatsApp, menanyakan katalog menu yang tersedia, meminta opsi pembayaran transfer/tempo. |
| **Kesulitan (Pain Points)** | Respon WA lambat saat jam sibuk; menu dan harga katering tidak ada daftar pastinya sehingga harus selalu tanya; khawatir pesanan salah tanggal atau salah alamat. |
| **Perasaan** | Was-was jika makanan datang terlambat atau menu yang dikirim tidak sesuai dengan yang dipesan rekan kantor. |
| **Pernyataan Representatif** | *"Saya ingin lihat katalog menu dan daftar harga yang pasti dari awal, jadi nggak perlu bolak-balik nunggu balasan chat pemilik hanya untuk nanya harga dan pilihan lauk."* |

---

## 04. EMPATHY MAP

### A. Empathy Map: Pak Agung (Pemilik CV. Kedai Agung)
- **SAYS (Apa yang dikatakan):**
  - "Saya masih terima pesanan lewat WA, kadang ada yang terlambat kebaca atau salah rekap."
  - "Kalau bayarnya belakangan setelah acara selesai, saya kadang lupa harga pasti yang disepakati."
  - "Kalau pesanan 50 kotak biasanya saya kasih bonus bolu 1 loyang."
- **THINKS (Apa yang dipikirkan):**
  - Perlu cara praktis agar pesanan katering langsung tercatat tanpa bolak-balik cek chat.
  - Modal belanja cabai dan ayam untuk besok pagi jangan sampai tertahan tagihan yang belum lunas.
  - Memasak dalam porsi 500 potong tidak memungkinkan untuk menuruti menu khusus tiap orang secara terpisah.
- **DOES (Apa yang dilakukan):**
  - Mencatat pesanan katering di buku nota kertas atau menandai bintang di pesan WhatsApp.
  - Mengingatkan pelanggan katering secara manual terkait pembayaran setelah acara selesai.
  - Membagi fokus antara mengawasi dapur pukul 07.30, etalase jam 10.30, dan melayani kasir jam 11.30–13.00.
- **FEELS (Apa yang dirasakan):**
  - Khawatir dan stres jika ada detail pesanan nasi kotak yang tertukar atau terlambat diantar.
  - Pusing saat modal belanja tertahan akibat penagihan katering yang menumpuk.

### B. Empathy Map: Ibu Rina (Pelanggan Katering)
- **SAYS (Apa yang dikatakan):**
  - "Harga kateringnya berapa per kotak? Menunya ada pilihan apa saja untuk hari ini?"
  - "Bisa minta tolong diantar tepat jam 11.30 ya, karena rapat kami mulai jam 12.00."
  - "Apakah ada bonus kalau kami pesan lebih dari 50 kotak?"
- **THINKS (Apa yang dipikirkan):**
  - Mengapa tidak ada daftar menu dan harga resmi yang bisa diakses langsung agar tidak perlu menunggu balasan chat?
  - Apakah pemilik mengingat detail pesanan saya tanpa ada yang tertukar?
- **DOES (Apa yang dilakukan):**
  - Menanyakan variasi menu via WhatsApp berulang kali sebelum memesan.
  - Mengonfirmasi ulang pesanan beberapa jam sebelum jadwal pengantaran.
  - Melakukan pembayaran melalui transfer bank atau QRIS setelah rincian tagihan jelas.
- **FEELS (Apa yang dirasakan):**
  - Ragu memesan jika respon lambat dan pilihan menu tidak transparan.
  - Lega jika mendapatkan rincian pesanan yang jelas beserta kepastian jam pengiriman.

---

## 05. AFFINITY MAPPING (PENGELOMPOKAN 38 STICKY NOTES)

Affinity mapping dilakukan dengan mengelompokkan 38 kartu bukti (*sticky notes*) hasil wawancara dan observasi ke dalam 6 tema utama:

### Tabel Kartu Bukti dan Pengelompokannya

| ID Kartu | Isi Kartu Bukti (*Sticky Note*) | Kategori / Tema | Sumber Terkait |
| :---: | :--- | :--- | :---: |
| **SN-01** | Pemilik masih menerima pesanan katering melalui WhatsApp. | **Kelompok 1: Pemesanan Katering** *(Warna Biru)* | W-PEM-01 |
| **SN-02** | Pesanan yang masuk melalui percakapan WhatsApp berisiko terlambat ditangani. | Kelompok 1: Pemesanan Katering *(Warna Biru)* | W-PEM-01, W-PEL-02 |
| **SN-03** | Detail pesanan katering berisiko salah dicatat atau tertukar. | Kelompok 1: Pemesanan Katering *(Warna Biru)* | W-PEM-01 |
| **SN-04** | Pemilik perlu mencatat menu dan jumlah porsi setiap pesanan. | Kelompok 1: Pemesanan Katering *(Warna Biru)* | W-PEM-01 |
| **SN-05** | Informasi pelanggan, lokasi, dan waktu pengiriman perlu dicatat dengan jelas. | Kelompok 1: Pemesanan Katering *(Warna Biru)* | W-PEM-01, W-PEL-02 |
| **SN-06** | Pelanggan berharap dapat melakukan pemesanan tanpa harus menghubungi pemilik berulang kali. | Kelompok 1: Pemesanan Katering *(Warna Biru)* | W-PEL-01, W-PEL-02 |
| **SN-07** | Menu dan harga katering belum terdata dengan pasti. | **Kelompok 2: Informasi Menu & Harga** *(Warna Hijau)* | W-PEL-01, W-PEM-02 |
| **SN-08** | Pelanggan masih harus bertanya langsung kepada pemilik untuk mengetahui harga katering. | Kelompok 2: Informasi Menu & Harga *(Warna Hijau)* | W-PEL-01 |
| **SN-09** | Pelanggan kesulitan menentukan menu dan jumlah pesanan sebelum mengetahui pilihan yang tersedia. | Kelompok 2: Informasi Menu & Harga *(Warna Hijau)* | W-PEL-01 |
| **SN-10** | Menu harian perlu diinformasikan agar pelanggan mengetahui makanan yang tersedia. | Kelompok 2: Informasi Menu & Harga *(Warna Hijau)* | W-PEL-01, O-RM-01 |
| **SN-11** | Ayam geprek, sarden, dan cincang ayam termasuk menu yang banyak diminati pelanggan. | Kelompok 2: Informasi Menu & Harga *(Warna Hijau)* | W-PEM-01, W-PEL-03 |
| **SN-12** | Pemilik berharap informasi menu dan harga dapat disampaikan dengan lebih mudah kepada pelanggan. | Kelompok 2: Informasi Menu & Harga *(Warna Hijau)* | W-PEM-01 |
| **SN-13** | Beberapa pelanggan katering melakukan pembayaran setelah makanan dikonsumsi. | **Kelompok 3: Pembayaran & Keuangan** *(Warna Kuning)* | W-PEM-03 |
| **SN-14** | Pembayaran katering terkadang terlambat diterima oleh pemilik. | Kelompok 3: Pembayaran & Keuangan *(Warna Kuning)* | W-PEM-03 |
| **SN-15** | Modal untuk membeli bahan baku dapat tertahan karena pembayaran belum diterima. | Kelompok 3: Pembayaran & Keuangan *(Warna Kuning)* | W-PEM-03 |
| **SN-16** | Pemilik terkadang lupa harga pasti yang telah disepakati sebelumnya. | Kelompok 3: Pembayaran & Keuangan *(Warna Kuning)* | W-PEM-02 |
| **SN-17** | Pemilik perlu mengetahui pesanan yang sudah dibayar dan yang belum dibayar. | Kelompok 3: Pembayaran & Keuangan *(Warna Kuning)* | W-PEM-02, W-PEM-03 |
| **SN-18** | Pembayaran dapat dilakukan melalui tunai, transfer, dan QRIS. | Kelompok 3: Pembayaran & Keuangan *(Warna Kuning)* | O-RM-02 |
| **SN-19** | Pelanggan paling ramai datang sekitar pukul 11.30–13.00. | **Kelompok 4: Pelayanan & Operasional RM** *(Warna Ungu)* | O-RM-02, W-PEL-03 |
| **SN-20** | Antrean pembelian langsung dapat membuat pelayanan menjadi lebih lama. | Kelompok 4: Pelayanan & Operasional RM *(Warna Ungu)* | W-PEL-03, O-RM-02 |
| **SN-21** | Menu atau lauk biasanya lebih lengkap sekitar pukul 10.30. | Kelompok 4: Pelayanan & Operasional RM *(Warna Ungu)* | O-RM-01 |
| **SN-22** | Kegiatan katering dimulai sekitar pukul 07.30, sedangkan rumah makan beroperasi sekitar pukul 08.00. | Kelompok 4: Pelayanan & Operasional RM *(Warna Ungu)* | O-RM-01 |
| **SN-23** | Kapasitas produksi dapat mencapai sekitar 500 potong lauk dalam sehari. | Kelompok 4: Pelayanan & Operasional RM *(Warna Ungu)* | W-PEM-04 |
| **SN-24** | Pelanggan membutuhkan proses pelayanan yang lebih cepat ketika rumah makan sedang ramai. | Kelompok 4: Pelayanan & Operasional RM *(Warna Ungu)* | W-PEL-03 |
| **SN-25** | Permintaan menu katering dari setiap pelanggan dapat berbeda-beda. | **Kelompok 5: Pengelolaan Produksi & Promo** *(Warna Pink)* | W-PEM-04 |
| **SN-26** | Pemilik tidak selalu dapat memenuhi permintaan menu khusus setiap pelanggan secara terpisah. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-04 |
| **SN-27** | Harga bahan baku seperti cabai dapat mengalami kenaikan sewaktu-waktu. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-05 |
| **SN-28** | Kenaikan harga bahan baku membuat pemilik perlu mempertimbangkan kembali biaya produksi dan harga jual. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-05 |
| **SN-29** | Pesanan dalam jumlah tertentu dapat memperoleh bonus dari pemilik. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-06 |
| **SN-30** | Pesanan 50 kotak dapat memperoleh bonus satu loyang kue bolu. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-06 |
| **SN-31** | Informasi promo dan bonus perlu disampaikan kepada pelanggan dengan lebih teratur. | Kelompok 5: Pengelolaan Produksi & Promo *(Warna Pink)* | W-PEM-06, W-PEL-01 |
| **SN-32** | Pemilik membutuhkan sistem untuk mengelola pesanan katering dengan lebih terorganisir. | **Kelompok 6: Kebutuhan & Harapan Pengguna** *(Warna Abu-abu)* | W-PEM-01 |
| **SN-33** | Pemilik membutuhkan pencatatan data pelanggan dan detail pesanan. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEM-01, W-PEL-02 |
| **SN-34** | Pemilik membutuhkan informasi status pembayaran untuk memantau tagihan pelanggan. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEM-03 |
| **SN-35** | Pelanggan membutuhkan informasi menu dan harga yang mudah diakses. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEL-01 |
| **SN-36** | Pelanggan berharap dapat melakukan pemesanan dengan lebih mudah tanpa harus datang langsung. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEL-01, W-PEL-02 |
| **SN-37** | Pelanggan membutuhkan informasi mengenai metode pembayaran dan promo yang tersedia. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEL-01, W-PEM-06 |
| **SN-38** | Pemilik membutuhkan pengelolaan informasi usaha yang tidak hanya bergantung pada pencatatan manual. | Kelompok 6: Kebutuhan & Harapan Pengguna *(Warna Abu-abu)* | W-PEM-01, W-PEM-03 |

---

### Ringkasan Pola dari Setiap Kelompok

| Kelompok | Pola yang Terlihat | Hal yang Masih Perlu Diperiksa |
| :--- | :--- | :--- |
| **Kelompok 1 — Pemesanan Katering** | Penggunaan WhatsApp sebagai saluran utama menimbulkan risiko salah rekap, keterlambatan respon, dan hilangnya data penting (jadwal/alamat). | Bagaimana alur konfirmasi pesanan antara pemilik dan pelanggan agar kedua pihak memegang rekapan yang sah? |
| **Kelompok 2 — Informasi Menu & Harga** | Ketiadaan katalog terbuka memicu komunikasi bolak-balik yang menghabiskan waktu pemilik dan membingungkan pemesan. | Bagaimana memperbarui ketersediaan menu harian mengingat jam masak lauk lengkap baru terjadi pukul 10.30? |
| **Kelompok 3 — Pembayaran & Keuangan** | Sistem pembayaran pasca-konsumsi tanpa bukti tagihan baku menimbulkan piutang macet, lupa harga kesepakatan, dan modal harian tertahan. | Batas waktu pelunasan yang disepakati untuk pesanan katering dan mekanisme pengingat tagihan jatuh tempo. |
| **Kelompok 4 — Operasional & Pelayanan** | Penumpukan antrean makan siang (11.30–13.00) dan kapasitas dapur (~500 porsi) perlu disinkronkan agar katering dan rumah makan berjalan selaras. | Apakah menu katering perlu dibedakan dengan stok etalase rumah makan langsung agar tidak saling memotong persediaan? |
| **Kelompok 5 — Produksi & Promo** | Skala masak massal tidak fleksibel untuk pesanan kustom perorangan; promo menarik (bonus bolu) belum dikomunikasikan secara luas. | Standarisasi paket menu katering agar pelanggan tidak meminta kombinasi yang mengganggu proses dapur massal. |
| **Kelompok 6 — Harapan Pengguna** | Kedua aktor (pemilik dan pelanggan) sepakat membutuhkan wadah terstruktur untuk katalog, pemesanan, dan pemantauan pembayaran. | Siapa yang akan mengoperasikan sistem di sisi toko saat jam sibuk berlangsung? |

---

## 06. INSIGHT, KEBUTUHAN PENGGUNA, DAN MASALAH PRIORITAS

### A. Perumusan Insight (Berdasarkan Pola Bukti)
1. **Insight I-1 (Keandalan Pencatatan Pesanan):**  
   *Ketergantungan pada obrolan WhatsApp menyebabkan pencatatan pesanan tersebar dalam pesan teks yang rawan tertumpuk atau terhapus, sehingga meningkatkan risiko salah tanggal, salah porsi, atau salah alamat.*
2. **Insight I-2 (Aksesibilitas Informasi Menu & Harga):**  
   *Ketiadaan katalog harga dan variasi menu yang terdata membuat pelanggan enggan atau lambat memesan, sementara pemilik kehabisan waktu produktif hanya untuk menjawab pertanyaan seputar menu berulang kali.*
3. **Insight I-3 (Arus Kas dan Pengendalian Piutang):**  
   *Pembayaran pasca-konsumsi tanpa sistem pencatatan tagihan yang terpusat memicu pemilik lupa pada harga kesepakatan awal dan kesulitan menagih piutang, yang berakibat langsung pada tertahannya modal belanja bahan baku segar harian.*
4. **Insight I-4 (Manajemen Kapasitas & Jam Sibuk):**  
   *Jam sibuk makan siang (11.30–13.00) menyedot konsentrasi seluruh staf rumah makan, sehingga pesanan katering yang masuk pada jendela waktu ini sangat rentan diabaikan atau terlambat ditangani.*
5. **Insight I-5 (Standarisasi Menu vs Fleksibilitas Dapur):**  
   *Produksi massal 500 potong lauk membutuhkan standarisasi paket katering agar dapur tetap efisien tanpa harus menolak pelanggan yang menginginkan variasi menu.*

---

### B. Perumusan Kebutuhan Pengguna
> **Prinsip Utama:** Kebutuhan pengguna dirumuskan sebagai kemampuan untuk mengetahui, memahami, atau melakukan sesuatu tanpa langsung menyebutkan fitur atau solusi teknologi tertentu.

| ID Kebutuhan | Aktor | Rumusan Kebutuhan Pengguna | Tujuan Pengguna |
| :---: | :--- | :--- | :--- |
| **K-01** | Pemilik Usaha | Mengetahui dan merekap rincian pesanan (menu, porsi, alamat, waktu pengantaran) secara terpusat dan terurut. | Mencegah terjadinya pesanan yang tertukar, terlambat, atau terlewat ditangani. |
| **K-02** | Pelanggan Katering | Mengetahui pilihan menu katering, harga per paket, dan ketersediaan menu harian sebelum memesan. | Mengambil keputusan pemesanan secara mandiri tanpa harus menunggu konfirmasi manual berulang. |
| **K-03** | Pelanggan Katering | Menyampaikan detail pesanan dan lokasi pengiriman dengan format yang jelas dan pasti. | Memastikan pesanan sampai di tempat yang tepat pada waktu yang dikehendaki. |
| **K-04** | Pemilik Usaha | Memantau status pembayaran pesanan (lunas vs belum lunas) dan histori kesepakatan harga per pelanggan. | Memastikan modal usaha harian tidak tertahan dan piutang tertagih dengan tepat. |
| **K-05** | Pelanggan | Memperoleh rincian tagihan yang jelas serta informasi metode pembayaran yang sah (tunai, transfer, QRIS). | Mempermudah pelaporan keuangan (instansi) dan mempercepat penyelesaian transaksi. |
| **K-06** | Pelanggan & Pemilik | Mengetahui ketentuan bonus pesanan (seperti bonus bolu untuk pesanan minimal 50 kotak) secara terbuka. | Memberikan nilai tambah bagi pelanggan dan meningkatkan volume penjualan bagi pemilik. |

---

### C. Penentuan Masalah Prioritas

Penilaian dilakukan berdasarkan kriteria: (1) Dampak terhadap kelangsungan usaha & kepuasan pelanggan, (2) Kekuatan dukungan bukti dari 38 kartu, (3) Keterkaitan antar-aktor, serta (4) Kelayakan diselesaikan dalam lingkup proyek.

| Calon Masalah | Pertimbangan Evaluasi | Status Keputusan |
| :--- | :--- | :---: |
| **1. Pengelolaan & Akurasi Pemesanan Katering** (Didukung SN-01 s.d SN-06, SN-32, SN-33) | Pemesanan via WhatsApp berisiko salah rekap, tertukar, dan terlambat diantar. Katering adalah sumber pemasukan skala besar bagi CV. Kedai Agung. | **Prioritas Utama (MP-01)** |
| **2. Monitoring Pembayaran & Pengendalian Piutang** (Didukung SN-13 s.d SN-17, SN-34, SN-38) | Pembayaran setelah makan membuat pemilik lupa harga dan modal harian macet. Berdampak langsung pada kelangsungan dapur membeli bahan baku. | **Prioritas Utama (MP-02)** |
| **3. Transparansi Menu, Harga, & Ketentuan Promo** (Didukung SN-07 s.d SN-12, SN-29 s.d SN-31, SN-35, SN-37) | Pelanggan kesulitan menentukan pesanan karena harga belum terdata; pemilik terbebani chat berulang; promo bonus bolu belum termanfaatkan optimal. | **Prioritas Utama (MP-03)** |
| **4. Antrean Jam Sibuk Rumah Makan Ampera** (Didukung SN-19 s.d SN-24) | Terjadi di jam makan siang, namun lebih banyak dipengaruhi oleh penataan alur fisik etalase. | *Prioritas Pendukung* |
| **5. Fluktuasi Harga Bahan Baku (Cabai, dsb)** (Didukung SN-27, SN-28) | Faktor eksternal pasar yang memerlukan penyesuaian harga jual berkala di master data. | *Prioritas Pendukung* |

---

## 07. POINT OF VIEW (POV)

Sesuai pola baku Design Thinking:  
**`[Pengguna dalam konteks tertentu]` membutuhkan `[kebutuhan]` karena `[insight yang mendasari]`**

### POV-01 (Pengelolaan Pemesanan Katering)
> **Pemilik CV. Kedai Agung dan pelanggan katering** membutuhkan **mekanisme pencatatan dan konfirmasi pesanan (menu, porsi, lokasi, dan jadwal pengiriman) yang terstruktur dan terpusat**, karena **penggunaan obrolan WhatsApp sering menimbulkan keterlambatan penanganan serta risiko kesalahan rekap pesanan di tengah kesibukan operasional harian.**

- *Dasar Bukti:* MP-01, I-1, K-01, K-03 (SN-01, SN-02, SN-03, SN-04, SN-05, SN-06).
- *Batasan:* Sistem harus tetap mudah dipahami oleh pemilik tanpa menambah beban administratif yang rumit.

---

### POV-02 (Pengendalian Piutang & Status Pembayaran)
> **Pemilik CV. Kedai Agung** membutuhkan **sarana pemantauan status tagihan pesanan katering dan rekaman kesepakatan harga yang transparan**, karena **sistem pembayaran pasca-konsumsi yang dicatat secara manual sering menyebabkan lupa harga pasti dan keterlambatan pelunasan, sehingga menahan perputaran modal kerja untuk membeli bahan baku esok hari.**

- *Dasar Bukti:* MP-02, I-3, K-04, K-05 (SN-13, SN-14, SN-15, SN-16, SN-17).
- *Batasan:* Fleksibilitas pembayaran tempo bagi instansi langganan tetap dipertahankan, namun status jatuh tempo harus terpantau jelas.

---

### POV-03 (Akses Informasi Menu, Harga, & Promo)
> **Pelanggan katering dan rumah makan** membutuhkan **kemudahan untuk mengakses daftar menu harian yang tersedia, rincian harga paket katering, serta ketentuan bonus pesanan secara mandiri**, karena **ketiadaan informasi yang pasti membuat pelanggan kesulitan merencanakan pesanan dan memaksa proses tanya-jawab berulang yang memperlambat pelayanan.**

- *Dasar Bukti:* MP-03, I-2, K-02, K-06 (SN-07, SN-08, SN-09, SN-10, SN-30, SN-31).
- *Batasan:* Informasi menu harus dapat diperbarui pemilik secara dinamis mengikuti ketersediaan lauk di dapur.

---

## 08. HOW MIGHT WE (HMW) & PERTANYAAN EKSPLORASI

Rumusan How Might We mengubah rumusan POV menjadi pertanyaan pemantik terbuka (*generative questions*) sebagai jembatan menuju tahap **Ideate** (perancangan antarmuka & fungsionalitas sistem):

| ID HMW | Rumusan HMW Utama | Fokus Tujuan |
| :---: | :--- | :--- |
| **HMW-01** | **Bagaimana kita dapat membantu pemilik CV. Kedai Agung mengelola dan mengonfirmasi pesanan katering secara akurat tanpa risiko tertukar atau terlambat?** | Mengatasi kendala pemesanan WhatsApp dan pencatatan manual. |
| **HMW-02** | **Bagaimana kita dapat membantu pemilik memantau status pembayaran katering dan mencegah tertahannya modal usaha harian?** | Menyelesaikan masalah piutang macet dan lupa nominal kesepakatan. |
| **HMW-03** | **Bagaimana kita dapat menyajikan informasi menu, paket harga katering, dan promo bonus secara transparan dan mudah diakses pelanggan?** | Menghilangkan hambatan tanya-jawab menu dan meningkatkan daya tarik penjualan. |

### Pertanyaan Pendukung untuk Eksplorasi Tahap Ideate (Brainstorming Solusi)

#### Terkait HMW-01 (Pengelolaan Pesanan):
1. *Bagaimana kita dapat merancang formulir pemesanan katering yang ringkas agar pelanggan dapat langsung mengisi jumlah porsi, pilihan lauk, tanggal/jam antar, dan alamat pengiriman?*
2. *Bagaimana kita dapat memberikan notifikasi rekapitulasi pesanan otomatis yang dapat langsung dilihat oleh pemilik dapur dan pemesan sebagai bukti valid?*
3. *Bagaimana sistem dapat membatasi atau mengelompokkan pesanan jika kapasitas produksi harian (~500 lauk) sudah mendekati batas maksimal?*

#### Terkait HMW-02 (Pembayaran & Keuangan):
1. *Bagaimana sistem dapat mengunci nominal tagihan pesanan sejak awal disepakati, sehingga pemilik tidak lagi lupa saat pelunasan dilakukan setelah acara?*
2. *Bagaimana kita dapat menampilkan daftar piutang katering dengan penanda visual yang jelas (misal: "Belum Lunas", "Jatuh Tempo", "Lunas") di dashboard pemilik?*
3. *Bagaimana cara memfasilitasi verifikasi bukti transfer dan integrasi QRIS agar pencatatan kas masuk terjadi secara otomatis?*

#### Terkait HMW-03 (Informasi Menu & Promo):
1. *Bagaimana kita dapat menampilkan katalog menu favorit (ayam geprek, cincang ayam, sarden) lengkap dengan foto, porsi, dan harga secara menarik?*
2. *Bagaimana cara memberikan kalkulasi otomatis bagi pemesanan 50 kotak ke atas agar notifikasi "Bonus 1 Loyang Bolu" langsung muncul di ringkasan pesanan pelanggan?*
3. *Bagaimana kita membantu pemilik mengaktifkan status "Tersedia" atau "Habis" pada menu harian hanya dengan satu klik?*

---

## 09. REKOMENDASI TAHAP SELANJUTNYA (IDEATE KE PROTOTYPING)

Berdasarkan hasil analisis Define di atas, sistem **"Pengelolaan dan Pemesanan Rumah Makan CV. Kedai Agung"** yang akan dibangun dengan Laravel direkomendasikan memiliki dua antarmuka utama:
1. **Sisi Pengguna / Pelanggan (Customer Facing - Web Responsive):**
   - Halaman Beranda & Informasi Usaha (profil CV. Kedai Agung, jam operasional).
   - Katalog Menu Harian & Paket Katering (harga pasti, deskripsi porsi, info menu favorit).
   - Formulir Pemesanan Katering (pilihan lauk, porsi, tanggal & jam antar, alamat tujuan, auto-kalkulasi bonus bolu pesanan ≥50 kotak).
   - Ringkasan Pesanan & Pembayaran (metode tunai, transfer rekening, QRIS, serta unggah bukti bayar).
2. **Sisi Pemilik / Admin (Dashboard Operasional):**
   - Manajemen Pesanan Katering (tabel pesanan masuk, jadwal pengiriman, status proses dapur).
   - Manajemen Keuangan & Piutang (status tagihan, rekap pesanan belum lunas pasca-konsumsi, histori pendapatan).
   - Manajemen Menu & Stok Lauk (atur harga, variasi lauk, status ketersediaan lauk harian).

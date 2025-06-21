# Giveat

GivEat adalah sebuah platform berbasis web yang berfungsi sebagai perantara antara pemilik makanan berlebih dan penerima makanan yang membutuhkan. Dengan menggunakan GivEat, pengguna dapat dengan mudah mendonasikan makanan yang masih layak konsumsi, mengklaim makanan yang tersedia, serta berkontribusi dalam mengurangi limbah makanan di Indonesia. Selain itu, platform ini juga menyediakan fitur tambahan seperti berita terkini terkait isu lingkungan, forum diskusi, serta laporan kontribusi pengguna.

Fitur Utama :
1. Landing Page (Sebelum Login) Halaman awal yang menampilkan informasi umum mengenai Giveat.
2. Register & Login Multi User Sistem autentikasi sudah terintegrasi dengan pembagian hak akses :
   - Admin tidak bisa mengakses halaman user dan mitra.
   - User tidak bisa mengakses halaman admin dan mitra.
   - Mitra tidak bisa mengakses halaman admin dan user.
   Role-based authentication dengan proteksi rute Laravel Breeze.
3. Home Page (Setelah Login) Tampilan awal setelah login user yang menampilkan donasi makanan dan seputar websitenya.
4. Admin (Admin Panel) Admin dapat mengelola seluruh konten website melalui fitur CRUD berikut :
   - Dashboard Admin
   - CRUD FAQ
   - CRUD Berita
   - CRUD Forum
   - CRUD Manajemen Mitra
6. Mitra (Mitra Panel) Mitra dapat mengelola makanan yang akan didonasikan :
   - Dashboard Mitra
   - CRUD Donation
   - Review
   - History

Fitur Tambahan :
   - Output Peta Donasi Visualisasi lokasi tempat donasi menggunakan peta interaktif.
   - Download Bukti Klaim Donasi dalam Format PDF Pengguna dapat mengunduh Bukti Klaim Donasi secara langsung sebagai file PDF.
   - Download Riwayat Donasi dalam Format PDF Mitra dapat mengunduh Riwayat Donasi secara langsung sebagai file PDF.
   - Visualisasi Data Registrasi Menampilkan grafik atau diagram dari data pengguna yang telah mendaftar.
   - Filter Riwayat Donasi seperti "Pesanan Selesai", "Belum Diambil" dan "Tidak Diambil".

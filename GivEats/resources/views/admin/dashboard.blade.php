<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <h1 class="text-2xl font-bold mb-6">Selamat Datang, Admin!</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-5">
                <h2 class="text-md font-semibold text-green-700">Jumlah Mitra Terdaftar</h2>
                {{-- Tampilkan jumlah mitra dari variabel $totalMitra --}}
                <p class="text-3xl font-bold mt-2">{{ $totalMitra ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5">
                <h2 class="text-md font-semibold text-green-700">Jumlah User Terdaftar</h2>
                {{-- Tampilkan jumlah user dari variabel $totalUsers --}}
                <p class="text-3xl font-bold mt-2">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>

        {{-- Bagian Visualisasi Data --}}
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-lg font-semibold text-green-700 mb-4">Visualisasi Data Pengguna</h2>
            <div style="width: 80%; margin: auto;">
                <canvas id="userTypeChart"></canvas>
            </div>
        </div>

        <!-- MODAL -->
        <div id="detailModal" class="fixed z-50 inset-0 bg-black bg-opacity-40 hidden justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-bold text-green-700 mb-4">Detail Pengguna</h2>
                <ul class="text-sm text-gray-700 space-y-2">
                    <li><strong>Nama:</strong> <span id="modal-name"></span></li>
                    <li><strong>Email:</strong> <span id="modal-email"></span></li>
                    <li><strong>Password:</strong> <span id="modal-password"></span></li>
                    <li><strong>Tanggal Registrasi:</strong> <span id="modal-created"></span></li>
                    <li><strong>Jumlah Transaksi:</strong> <span id="modal-transactions"></span></li>
                </ul>
                <div class="mt-6 text-right">
                    <button onclick="closeModal()" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Tutup</button>
                </div>
            </div>
        </div>

        {{-- Tambahkan library Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Ambil data dari variabel Blade
            const totalMitra = {{ $totalMitra ?? 0 }};
            const totalUsers = {{ $totalUsers ?? 0 }};

            // Dapatkan konteks canvas
            const ctx = document.getElementById('userTypeChart').getContext('2d');

            // Buat grafik
            const userTypeChart = new Chart(ctx, {
                type: 'bar', // Jenis grafik: batang
                data: {
                    labels: ['Mitra', 'User'], // Label untuk batang
                    datasets: [{
                        label: 'Jumlah Pengguna', // Label untuk dataset
                        data: [totalMitra, totalUsers], // Data jumlah
                        backgroundColor: [ // Warna batang
                            'rgba(21, 128, 61, 0.8)', // Warna hijau untuk Mitra
                            'rgba(59, 130, 246, 0.8)' // Warna biru untuk User
                        ],
                        borderColor: [ // Warna border batang
                            'rgba(21, 128, 61, 1)',
                            'rgba(59, 130, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true, // Grafik responsif
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai sumbu Y dari 0
                            ticks: {
                                stepSize: 1 // Langkah sumbu Y per 1 unit
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda jika hanya ada satu dataset
                        },
                        title: {
                            display: true,
                            text: 'Perbandingan Jumlah Mitra dan User' // Judul grafik
                        }
                    }
                }
            });

            function showModal(user) {
                document.getElementById('modal-name').textContent = user.name;
                document.getElementById('modal-email').textContent = user.email;
                document.getElementById('modal-password').textContent = user.password;
                document.getElementById('modal-created').textContent = new Date(user.created_at).toLocaleString();
                document.getElementById('modal-transactions').textContent = user.donations_count ?? 0;
                document.getElementById('detailModal').classList.remove('hidden');
                document.getElementById('detailModal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('detailModal').classList.remove('flex');
                document.getElementById('detailModal').classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
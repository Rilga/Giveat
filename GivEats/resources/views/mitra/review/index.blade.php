<x-app-layout>
     <div class="container-fluid py-4">
        <!-- Welcome Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">Review</h2>
                    <p class="text-muted">Hai {{ auth()->user()->name ?? 'Robert' }}, lihat ulasan penerima</p>
                </div>
            </div>
            <!-- Review Section -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Review Penerima</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
                @foreach ($reviews as $review)
                    <div class="bg-white p-5 rounded-xl shadow-md" @dusk("review-penerima")>
                        <p class="text-8xl text-green-600 leading-none">“</p>
                        <p class="text-sm mb-2 italic text-gray-500">Menu: {{ $review->nama_hidangan }}</p>
                        <p class="text-sm mb-4">{{ $review->deskripsi_ulasan }}</p>
                        <div class="flex items-center mt-4">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" 
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <span class="text-sm font-medium ml-2">User</span>
                        </div>
                    </div>
                @endforeach
            </div>
</x-app-layout>
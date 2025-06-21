<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Ulasan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow" style="font-family: 'Poppins', sans-serif;">
            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Nama Restoran</label>
                    <input type="text" name="nama_restoran" class="w-full border rounded p-2" placeholder="contoh: Makanan Sunda" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Nama Hidangan</label>
                    <input type="text" name="nama_hidangan" class="w-full border rounded p-2" placeholder="contoh: Ayam Goreng Lalapan" required>
                </div>

                {{-- Rating dengan bintang --}}
                <div class="mb-4">
                    <label class="block mb-1">Penilaian</label>
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" id="star{{ $i }}" name="penilaian" value="{{ $i }}" class="hidden" required />
                            <label for="star{{ $i }}" class="cursor-pointer text-gray-400 text-6xl" onclick="highlightStars({{ $i }})">&#9733;</label>
                        @endfor
                    </div>
                </div>

                {{-- Upload Foto --}}
                <div class="mb-4">
                    <label class="block mb-1">Foto Makanan (optional)</label>
                    <input type="file" name="foto_makanan" class="w-full border rounded p-2" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" class="mt-2 hidden w-48 h-48 object-cover rounded" />
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Deskripsi Ulasan</label>
                    <textarea name="deskripsi_ulasan" class="w-full border rounded p-2" rows="5" placeholder="Deskripsikan pengalamanmu, rasa, penyajian, dan lain-lain." required></textarea>
                </div>

                {{-- Tag Dinamis --}}
                <div class="mb-4">
                    <label class="block mb-1">Tag</label>
                    <div class="flex">
                        <input type="text" id="tag-input" class="w-full border rounded p-2" placeholder="contoh: Masakan Sunda, Pedas">
                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2" onclick="addTag()">Tambah</button>
                    </div>
                    <div id="tags" class="flex flex-wrap mt-2"></div>
                    <input type="hidden" name="tag" id="tag-hidden">
                </div>

                <div class="flex justify-end">
                    <button type="submit" dusk="kirim" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk bintang, tag, dan preview gambar --}}
    <script>
        function highlightStars(starCount) {
            for (let i = 1; i <= 5; i++) {
                const label = document.querySelector('label[for="star' + i + '"]');
                if (i <= starCount) {
                    label.classList.add('text-yellow-400');
                    label.classList.remove('text-gray-400');
                } else {
                    label.classList.remove('text-yellow-400');
                    label.classList.add('text-gray-400');
                }
            }
        }

        let tagList = [];

        function addTag() {
            const input = document.getElementById('tag-input');
            const tagsContainer = document.getElementById('tags');
            const hiddenInput = document.getElementById('tag-hidden');

            if (input.value.trim() !== '') {
                const tagText = input.value.trim();
                if (!tagList.includes(tagText)) {
                    tagList.push(tagText);

                    const tag = document.createElement('span');
                    tag.classList.add('bg-green-100', 'text-green-800', 'px-2', 'py-1', 'rounded-full', 'mr-2', 'mt-2', 'cursor-pointer', 'transition', 'duration-200', 'hover:bg-red-100');
                    tag.textContent = tagText;
                    tag.onclick = function() {
                        this.remove();
                        tagList = tagList.filter(t => t !== tagText);
                        hiddenInput.value = tagList.join(',');
                    }

                    tagsContainer.appendChild(tag);
                    hiddenInput.value = tagList.join(',');
                    input.value = '';
                } else {
                    alert('Tag sudah ada!');
                }
            }
        }

        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('preview');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>

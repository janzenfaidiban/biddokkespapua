<!-- fotoKetuaKlasis -->
<div class="mb-3">
<label for="fotoKetuaKlasis">Foto Ketua Klasis</label>
    <div class="border rounded-sm {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}">
        <img id="preview-fotoKetuaKlasis" 
            src="{{ isset($data->user) && $data->user->fotoKetuaKlasis ? asset('storage/' . $data->user->fotoKetuaKlasis) : asset('assets/images/gambar-placeholder.jpg') }}" 
            class="w-50">
    </div>
    @if(Request::segment(3) != 'create' && Request::segment(4) == 'edit' && !empty($data->user->fotoKetuaKlasis))
    <a href="#" class="text-danger my-1 d-block" data-toggle="modal" data-target="#deleteFotoKetuaKlasisModal">
        Hapus Foto
    </a>
    @endif
    <!-- Spinner Loading -->
    <div id="loading-spinner-fotoKetuaKlasis" class="mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
@if(Request::segment(4) != 'detail')
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Unggah</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="fotoKetuaKlasis" name="fotoKetuaKlasis" accept="image/*" aria-describedby="inputGroupFileAddon01" onchange="previewFotoKetuaKlasis(event)">
        <label class="custom-file-label" for="fotoKetuaKlasis">Pilih file foto Ketua Klasis</label>
    </div>
</div>

<div class="d-block mt-1 mb-3">
    <p class="text-muted m-0">
        Mendukung format file *.JPG dan *.PNG. Ukuran yang disarankan 4:3 (1080 x 810 pixels)
    </p>
</div>
@endif

@push('scripts')

    <script>
        function previewFotoKetuaKlasis(event) {
            var input = event.target;
            var reader = new FileReader();
            var spinner = document.getElementById('loading-spinner-fotoKetuaKlasis');
            var imgElement = document.getElementById('preview-fotoKetuaKlasis');

            // Tampilkan spinner & sembunyikan gambar sementara
            spinner.style.display = 'block';
            imgElement.style.display = 'none';

            reader.onload = function(){
                setTimeout(function() {
                    spinner.style.display = 'none';
                    imgElement.src = reader.result;
                    imgElement.style.display = 'block';
                }, 500);
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>

@endpush

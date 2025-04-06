<!-- fileStrukturOrganisasi -->
<div class="">
    <label for="fileStrukturOrganisasi">Struktur Organisasi</label>
    @if(!empty($data->user->fileStrukturOrganisasi))
    <div class="mb-2 py-2 px-2 border rounded-sm {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }} d-flex justify-content-between align-items-center">
        <a href="{{ asset('storage/' . $data->user->fileStrukturOrganisasi) }}" target="_blank" class="text-primary mr-3 font-weight-bold">
            <i class="fa-solid fa-file-arrow-down"></i> Unduh File Struktur Organisasi
        </a>
        @if(Request::segment(4) != 'detail')
        <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteFileStrukturOrganisasiModal">
            {!! $iconTombolHapusPermanen !!}
        </a>
        @endif
    </div>
    @else 
    <input type="text" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }} mb-3" value="File belum diunggah" @if(Request::segment(4) == 'detail') disabled @endif>
    @endif
    
    <!-- Spinner Loading -->
    <div id="loading-spinner" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

@if(Request::segment(4) != 'detail')
<!-- Preview nama file -->
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Unggah</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="fileStrukturOrganisasi" name="fileStrukturOrganisasi" accept=".pdf,.xlsx" aria-describedby="inputGroupFileAddon01" onchange="previewfileStrukturOrganisasi(event)">
        <label class="custom-file-label" for="fileStrukturOrganisasi">Pilih file struktur organisasi</label>
    </div>
</div>

<div class="d-block mt-1 mb-3">
    <p class="text-muted m-0">
        Mendukung format file *.PDF dan *.XLSX
    </p>
    <a href="{!! $linkTemplateStrukturOrganisasi ?? '' !!}" target="_blank"><i class="fe-link mr-1"></i> Lihat/unduh Template Struktur Organisasi di Google Spreadsheets</a>
</div>
@endif

@push('scripts')
<script>
    function previewfileStrukturOrganisasi(event) {
        var input = event.target;
        var fileName = input.files.length > 0 ? input.files[0].name : "";
        var label = input.nextElementSibling;
        var spinner = document.getElementById('loading-spinner');
        
        if (label) {
            label.innerText = fileName ? fileName : "Pilih file struktur organisasi";
            label.classList.add("text-danger");
        }
        
        // Tampilkan spinner selama 1 detik saat file diunggah
        spinner.style.display = 'block';
        setTimeout(() => {
            spinner.style.display = 'none';
        }, 1000);
    }
</script>
@endpush

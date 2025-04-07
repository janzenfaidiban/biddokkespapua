<div class="row">
    <div class="col-lg-6">
        <a href="#" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambahModal">
            {!! $iconTombolTambah !!} Tambah
        </a>

        <a href="{{ $routeSemua }}" class="btn btn-link {{ $isSemuaActive ? 'text-primary' : 'text-dark' }}">
            {!! $iconSemuaData !!} Semua ({{ $totalAll ?? '' }})
        </a>

        <a href="{{ $routeTrash }}" class="btn btn-link {{ $isTrashActive ? 'text-primary' : 'text-dark' }}">
            {!! $iconTempatSampah !!} Tempat Sampah ({{ $totalOnlyTrashed ?? '' }})
        </a>
    </div>

    <div class="col-lg-6">
        <form action="{{ $formAction }}" method="GET">
            <div class="form-group mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Pencarian data..." aria-label="Recipient's username" value="{{ request()->search ?? old('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary waves-effect waves-light" type="submit">{!! $iconPencarian !!} Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

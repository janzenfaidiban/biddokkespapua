<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {!! $siteCopyright ?? '' !!}
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                @if(Auth::user()->hasRole('adminmaster'))
                    <a href="{{ route('adminmaster.faq') }}" class="@if(Request::segment(2) == 'faq') text-primary @endif">{!! $iconHalamanFaq ?? '' !!} FAQ</a>
                    <a href="{{ route('adminmaster.panduan') }}" class="@if(Request::segment(2) == 'panduan') text-primary @endif">{!! $iconHalamanPanduan ?? '' !!} Panduan</a>
                    <a href="{{ route('adminmaster.petaSitus') }}" class="@if(Request::segment(2) == 'peta-situs') text-primary @endif">{!! $iconHalamanPetaSitus ?? '' !!} Peta Situs</a>
                    <a href="{{ route('adminmaster.hakCipta') }}" class="@if(Request::segment(2) == 'hak-cipta') text-primary @endif">{!! $iconHalamanHakCipta ?? '' !!} Hak Cipta</a>
                    <a href="{{ route('adminmaster.syaratKetentuan') }}" class="@if(Request::segment(2) == 'syarat-ketentuan') text-primary @endif">{!! $iconHalamanSyaratKetentuan ?? '' !!} Syarat dan Ketentuan</a>
                @endif

                @if(Auth::user()->hasRole('adminklasis'))
                    <a href="{{ route('adminklasis.faq') }}" class="@if(Request::segment(2) == 'faq') text-primary @endif">{!! $iconHalamanFaq ?? '' !!} FAQ</a>
                    <a href="{{ route('adminklasis.panduan') }}" class="@if(Request::segment(2) == 'panduan') text-primary @endif">{!! $iconHalamanPanduan ?? '' !!} Panduan</a>
                    <a href="{{ route('adminklasis.petaSitus') }}" class="@if(Request::segment(2) == 'peta-situs') text-primary @endif">{!! $iconHalamanPetaSitus ?? '' !!} Peta Situs</a>
                    <a href="{{ route('adminklasis.hakCipta') }}" class="@if(Request::segment(2) == 'hak-cipta') text-primary @endif">{!! $iconHalamanHakCipta ?? '' !!} Hak Cipta</a>
                    <a href="{{ route('adminklasis.syaratKetentuan') }}" class="@if(Request::segment(2) == 'syarat-ketentuan') text-primary @endif">{!! $iconHalamanSyaratKetentuan ?? '' !!} Syarat dan Ketentuan</a>
                @endif

                @if(Auth::user()->hasRole('adminjemaat'))
                    <a href="{{ route('adminjemaat.faq') }}" class="@if(Request::segment(2) == 'faq') text-primary @endif">{!! $iconHalamanFaq ?? '' !!} FAQ</a>
                    <a href="{{ route('adminjemaat.panduan') }}" class="@if(Request::segment(2) == 'panduan') text-primary @endif">{!! $iconHalamanPanduan ?? '' !!} Panduan</a>
                    <a href="{{ route('adminjemaat.petaSitus') }}" class="@if(Request::segment(2) == 'peta-situs') text-primary @endif">{!! $iconHalamanPetaSitus ?? '' !!} Peta Situs</a>
                    <a href="{{ route('adminjemaat.hakCipta') }}" class="@if(Request::segment(2) == 'hak-cipta') text-primary @endif">{!! $iconHalamanHakCipta ?? '' !!} Hak Cipta</a>
                    <a href="{{ route('adminjemaat.syaratKetentuan') }}" class="@if(Request::segment(2) == 'syarat-ketentuan') text-primary @endif">{!! $iconHalamanSyaratKetentuan ?? '' !!} Syarat dan Ketentuan</a>
                @endif

                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    setTimeout(function(){
        $('.alert').slideUp();
    }, 3000);
</script>
<!-- end Footer -->

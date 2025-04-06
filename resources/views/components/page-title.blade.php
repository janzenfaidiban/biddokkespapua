@props(['title', 'description'])
        
<!-- start breadcrumb -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
                    <!-- bagian admin -->
                    @if(Auth::user()->hasRole('admin'))
                
                    @if(Request::segment(1) == 'admin' && Request::segment(2) == '')
                    <li class="breadcrumb-item text-capitalize">
                        Selamat datang, <b class="px-1">{{ Auth::user()->name ?? 'User name' }}!</b> 
                    </li>
                    @endif

                    
                    @if(Request::segment(1) == 'admin' && Request::segment(2) == 'dasbor')
                    <li class="breadcrumb-item text-capitalize">
                        Selamat datang, <b class="px-1">{{ Auth::user()->name ?? 'User name' }}!</b> 
                    </li>
                    @endif


                    @if(Request::segment(2) != 'dasbor' && Request::segment(2) != '')
                    <li class="breadcrumb-item text-capitalize">
                        <a  href="{{ route('admin.dasbor') }}">Dasbor</a> 
                    </li>
                    <li class="breadcrumb-item text-capitalize active">
                        {!! $title !!}
                    </li>
                    @endif

                    @endif

                    <!-- bagian operator -->
                    @if(Auth::user()->hasRole('operator'))
                
                    @if(Request::segment(1) == 'operator' && Request::segment(2) == '')
                    <li class="breadcrumb-item text-capitalize">
                        Selamat datang, <b class="px-1">{{ Auth::user()->name ?? 'User name' }}!</b> 
                    </li>
                    @endif

                    
                    @if(Request::segment(1) == 'operator' && Request::segment(2) == 'dasbor')
                    <li class="breadcrumb-item text-capitalize">
                        Selamat datang, <b class="px-1">{{ Auth::user()->name ?? 'User name' }}!</b> 
                    </li>
                    @endif


                    @if(Request::segment(2) != 'dasbor' && Request::segment(2) != '')
                    <li class="breadcrumb-item text-capitalize">
                        <a  href="{{ route('operator.dasbor') }}">Dasbor</a> 
                    </li>
                    <li class="breadcrumb-item text-capitalize active">
                        {!! $title !!}
                    </li>
                    @endif
                    
                    @endif


                </ol>
            </div>
            <h4 class="page-title text-capitalize">{!! $title !!}</h4>
            <p>{!! $description !!}</p>
        </div>
    </div>
</div>
<!-- end breadcrumb --> 
                <!-- start breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item text-capitalize">
                                        <a  href="{{ route('adminmaster.beranda') }}">Beranda</a> 
                                    </li>
                                    <li class="breadcrumb-item text-capitalize active">
                                        {!! $pageTitle !!}
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title text-capitalize">{!! $pageTitle !!}</h4>
                            
                            <p>{{ $pageDescription }}</p>
                        </div>
                    </div>
                </div>
                <!-- end breadcrumb --> 
                 
                {!! display_bootstrap_alerts() !!}
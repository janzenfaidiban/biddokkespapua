@extends('layouts.app')
@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid"> 

        <x-page-title 
            :title="$pageTitle"
            :description="$pageDescription" 
        />

            <div class="row">
                
                <div class="col-12">

                    <div class="card-box">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos labore nobis blanditiis dolorem laborum qui officia cum voluptates, minus magni itaque porro alias, vel eaque!</p>
                    </div>
                </div>
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->

    <x-footer />

</div>

@stop

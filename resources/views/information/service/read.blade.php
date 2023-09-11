@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<div role="main" class="main">
    <div class="container pt-5">
        <?php if(!empty($read)) { ?>
        <div class="row py-4 mb-2">
            <div class="col-md-7 order-2">
                <div class="card card-body">
                    <div class="overflow-hidden">
                        <h2 class="text-color-dark font-weight-bold text-12 mb-2 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300"><?php echo $read->title; ?></h2>
                    </div>
                    <p class="lead appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700"><?php echo $read->information; ?></p>
                    <div class="pb-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
                        <h4 class="card-title mb-1 text-4 font-weight-bold">
                            <a href="<?php echo url( $read->link); ?>">
                            <?php echo Session::get('flag') == 'uk'? 'Open Link ' : 'Buka Tautan'; ?>
                            </a>
                        </h4>
                    </div>
                    <hr class="solid my-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="900">
                    <div class="row align-items-center appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1000">
                        <div class="post-block mt-5 post-share">
                            <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Share this post' : 'Bagikan tautan ini'; ?> </h4>
                            <div id="socialShare"></div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
                <div class="card card-body">
                    <img src="<?php echo $read->path; ?>" class="img-fluid mb-2" alt="<?php echo $read->title; ?>" />
                </div>
            </div>
            <?php } ?> 
        </div>
    </div>

    @endsection
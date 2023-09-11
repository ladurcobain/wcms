@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="section section-elements m-0 section-no-border bg-bottom-slash position-relative z-index-1">
	<div class="container text-center mt-4">
        <div class="row">
            <div class="col text-center">
                <div class="overflow-hidden mb-2">
                    <h2 class="font-weight-normal text-7 mb-0 appear-animation" data-appear-animation="maskUp">
                        <strong class="font-weight-extra-bold">Sitemap Website</strong>
                    </h2>
                    <br />
                </div>
            </div>
        </div>
        <br />
        <div class="row justify-content-center">
            <?php if(count($list) > 0) { ?>
                <?php foreach ($list as $row) { ?>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div
                            class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
                            <div class="featured-box featured-box-no-borders featured-box-box-shadow">
                                <a href="<?php echo url($row->menu_url); ?>" class="text-decoration-none">
                                    <span class="box-content px-1 py-4 text-center d-block">
                                        <span class="text-primary text-8 position-relative top-3 mt-3"><i
                                                class="fas <?php echo $row->menu_icon; ?>"></i></span>
                                        <span class="elements-list-shadow-icon text-default"><i class="fas <?php echo $row->menu_icon; ?>"></i></span>
                                        <span
                                            class="font-weight-bold text-uppercase text-1 d-block text-dark pt-2"><?php echo Session::get('flag') == 'uk'? $row->menu_title_en : $row->menu_title_in; ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
            <div class="row">
                <div class="col text-center">
                    <div class="overflow-hidden mb-1">
                        <p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">
                            <i class="fas fa-exclamation-triangle fa-fw text-warning text-5 va-middle"></i>
                            <span class="va-middle">Data tidak ditemukan.</span>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <br />
        <div class="post-block mt-5 post-share">
            <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Share this post' : 'Bagikan tautan ini'; ?> </h4>
            <div id="socialShare"></div>
        </div>
    </div>
</section>    

@endsection
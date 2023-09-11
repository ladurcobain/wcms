@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="">
	<div class="container mt-4">
        <?php if($results->total() > 0) { ?>              
            <div class="row">
                <div class="blog-posts">
                    <div class="row">
                        <?php foreach ($results as $row) { ?>
                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5 card card-body">
                                <div class="post-image">
                                    <a href="<?php echo url('information/service/'. $row->id.'/read'); ?>">
                                        <img src="<?php echo $row->path; ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="<?php echo $row->title; ?>" />
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-4 line-height-6 mt-3 mb-2">
                                        <a href="<?php echo url('information/service/'. $row->id.'/read'); ?>">
                                            <?php echo $row->title; ?>
                                        </a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="d-block mt-2"><a target="blank" href="<?php echo $row->link; ?>" class="btn btn-xs btn-light text-1 text-uppercase"><?php echo Session::get('flag') == 'uk'? 'Open Link ' : 'Buka Tautan'; ?></a></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="container py-4"></div>
                    <?php if(!empty($results)) { ?>
                        <h2 style="color: #05ac69;" class="pagination font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2 float-start">Total Data : {{ $results->total() }}</h2>
                        <div class="pagination float-end">{{ $results->onEachSide(1)->links() }}</div>
                    <?php } ?>
                    </div>
                </div>
            </div>
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
</section>

@endsection
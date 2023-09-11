@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="">
	<div class="container mt-4">
        <?php if($results->total() > 0) { ?>              
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">
                        <?php foreach ($results as $row) { ?>
                        <div class="col-12 col-sm-6 col-lg-3 mb-4">
                            <div class="portfolio-item card card-body">
                                <a href="<?php echo url('information/structural/'. $row->id.'/read'); ?>">
                                    <span class="thumb-info thumb-info-lighten thumb-info-no-borders border-radius-0">
                                        <span class="thumb-info-wrapper border-radius-0">
                                            <img src="<?php echo $row->path; ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="<?php echo $row->name; ?>" class="img-fluid border-radius-0" />
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner"><?php echo substr($row->name, 0, 15); ?></span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-link"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
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
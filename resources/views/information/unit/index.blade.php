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
                        <article class="post post-medium card card-body">
                            <div class="col-lg-12">
                                <div class="post-content">
                                    <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
                                        <a href="<?php echo url('information/unit/'. $row->id.'/read'); ?>"><?php echo $row->title; ?></a>
                                    </h2>
                                    <p class="mb-0">
                                        <?php echo Status::str_ellipsis(Session::get('flag') == 'uk'? $row->text_en : $row->text_in, 500); ?>
                                    </p>
                                </div>
                                <span class="d-block d-sm-inline-block float-sm-end mt-3 mt-sm-0">
                                    <a href="<?php echo url('information/unit/'. $row->id.'/read'); ?>" class="btn btn-xs btn-light text-1 text-uppercase">
                                        <?php echo Session::get('flag') == 'uk'? 'Read more' : 'Selengkapnya'; ?>
                                    </a>
                                </span>
                            </div>
                        </article>
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
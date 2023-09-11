@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="section section-default border-0 m-0">
    <div class="container py-4">
        <div class="row pb-4">
            <div class="col">
                <form action="<?php echo url('contents/filter'); ?>" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="slug" value="{{ $slug }}" />
                    <div class="input-group input-group-lg">
                        <input class="form-control h-auto" placeholder="Masukkan kata kunci pencarian ..."
                                    name="q" value="{{ $q }}" autocomplete="off" type="text" />
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>								
            </div>
        </div>
    </div>
</section>

<section class="">
	<div class="container mt-4">
        <?php if($results->total() > 0) { ?>     
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-posts">
                    <ul class="simple-post-list m-0">
                        <?php foreach ($results as $row) { ?>
                        <li>
                            <div class="post-info card card-body box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                                <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
                                    <?php if((strpos($row->menu_url, 'information') !== false) || (strpos($row->menu_url, 'conference') !== false)) { ?>
                                        <a href="<?php echo url($slug .'/'. $row->menu_url .'/'. $row->id.'/read'); ?>"><?php echo $row->menu_name; ?></a>
                                    <?php } else{ ?>
                                        <a href="<?php echo url($slug .'/'. $row->menu_url); ?>"><?php echo $row->menu_name; ?></a>
                                    <?php } ?>
                                </h2>
                                <p class="mb-0">
                                    <?php echo Status::str_ellipsis(Session::get('flag') == 'uk'? $row->text_en : $row->text_in, 500); ?>
                                </p>
                                <div class="post-meta">
                                    <span class="text-dark text-uppercase font-weight-semibold"><?php echo $row->satker; ?></span> | <?php echo $row->date .' '. $row->time; ?>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <br /><br />
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
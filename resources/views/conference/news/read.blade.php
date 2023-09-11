@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')
@include('layouts.text2speak')

<section class="">
    <?php if(!empty($read)) { ?>
    <textarea style="display: none;" id="text"><?php echo Session::get('flag') == 'uk'? strip_tags($read->text_en) : strip_tags($read->text_in); ?></textarea>
	<div class="container mt-4">
        <?php if(!empty($other)) {?>
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-posts single-post mb-3 card card-body">
                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ms-0">
                            <center>
                                <img src="<?php echo $read->path; ?>"
                                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="<?php echo $read->title; ?>" />
                            </center>
                        </div>
                        <div class="post-content ms-0">
                            <h3 style="color: #05ac69;" class="font-weight-semi-bold text-5"><?php echo $read->title; ?></h3>
                            <div class="post-meta mb-2 p-0">
                                <span><i class="far fa-calendar-alt"></i> <?php echo $read->date; ?> </span>
                                <span><i class="far fa-folder"></i> <a><?php echo $read->category; ?></a> </span>
                                <span><i class="far fa-eye"></i> <a><?php echo number_format($read->view); ?></a> </span>
                            </div>
                            <p class="lead mb-0"><?php echo Session::get('flag') == 'uk'? $read->text_en : $read->text_in; ?></p>
                            <div class="post-block mt-5 post-share">
                                <div class="row mb-3">
                                    <div class="col-lg-5">
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Share this post' : 'Bagikan tautan ini'; ?></h4>
                                        <div id="socialShare"></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Listening' : 'Mendengarkan'; ?></h4>
                                        <button type="button" id="btn-play" onclick="speak();" class="btn btn-primary"><i class="fas fa-play"></i>  <?php echo Session::get('flag') == 'uk'? 'Play' : 'Putar'; ?></button>
                                        <button type="button" id="btn-stop" onclick="stops();" class="d-none btn btn-danger"><i class="fas fa-stop"></i>  <?php echo Session::get('flag') == 'uk'? 'Stop' : 'Berhenti'; ?></button>
                                    </div>
                                    <div class="col-lg-4">
                                        <?php if(($read->link_youtube != "") && ($read->link_instagram != "")) { ?>
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Links on social media' : 'Tautan dimedia sosial'; ?></h4>
                                        <div>
                                            <ul class="social-icons social-icons-medium">
                                                <?php if($read->link_youtube != "") { ?>
                                                <li>
                                                    <a href="<?php echo $read->link_youtube; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="<?php echo $read->link_youtube; ?>">
                                                        <i class="text-danger fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <?php if($read->link_instagram != "") { ?>
                                                <li>
                                                    <a href="<?php echo $read->link_instagram; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="<?php echo $read->link_instagram; ?>">
                                                        <i class="text-info fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-4">
                <?php if(!empty($headline)) {?>
                <h3 class="font-weight-bold text-3 mb-0 pb-2"><?php echo Session::get('flag') == 'uk'? 'Headlines' : 'Berita Utama'; ?></h3>
                <div class="pb-1 card card-body">
                    <div class="mb-2 pb-1">
                        <?php foreach ($headline as $rHeadline) { ?>
                        <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <div class="post-image mb-2">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                            <a href="<?php echo url('conference/news/'. $rHeadline->id.'/read'); ?>">
                                                <img src="<?php echo $rHeadline->path; ?>" class="img-fluid border-radius-0" alt="<?php echo $rHeadline->title; ?>" width="50" height="50" />
                                            </a>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-sm-8">
                                    <div class="post-info">
                                        <h4 class="d-block pb-1 line-height-2 text-3 text-dark font-weight-semibold mb-0">
                                            <a href="<?php echo url('conference/news/'. $rHeadline->id.'/read'); ?>" class="text-decoration-none text-color-dark text-color-hover-primary"><?php echo Status::str_ellipsis($rHeadline->title, 100); ?></a>
                                        </h4>
                                        <div class="post-meta">
                                            <?php echo $rHeadline->date; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
                <br />
                <?php } ?>
                <h3 class="font-weight-bold text-3 mb-0 pb-2"><?php echo Session::get('flag') == 'uk'? 'Other News' : 'Berita Lainnya'; ?></h3>
                <div class="pb-1 card card-body">
                    <div class="mb-2 pb-1">
                        <?php foreach ($other as $rOther) { ?>
                        <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row align-items-center pb-2">
                                <div class="col-sm-4">
                                    <div class="post-image mb-2">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                            <a href="<?php echo url('conference/news/'. $rOther->id.'/read'); ?>">
                                                <img src="<?php echo $rOther->path; ?>" class="img-fluid border-radius-0" alt="<?php echo $rOther->title; ?>" width="50" height="50" />
                                            </a>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-sm-8">
                                    <div class="post-info">
                                        <h4 class="d-block pb-1 line-height-2 text-3 text-dark font-weight-semibold mb-0">
                                            <a href="<?php echo url('conference/news/'. $rOther->id.'/read'); ?>" class="text-decoration-none text-color-dark text-color-hover-primary"><?php echo Status::str_ellipsis($rOther->title, 100); ?></a>
                                        </h4>
                                        <div class="post-meta">
                                            <?php echo $rOther->date; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-posts single-post card card-body">
                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ms-0">
                            <center>
                                <img src="<?php echo $read->path; ?>"
                                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="<?php echo $read->title; ?>" />
                            </center>
                        </div>
                        <div class="post-content ms-0">
                            <h3 style="color: #05ac69;" class="font-weight-semi-bold text-5"><?php echo $read->title; ?></h3>
                            <div class="post-meta mb-2 p-0">
                                <span><i class="far fa-calendar-alt"></i> <?php echo $read->date; ?> </span>
                                <span><i class="far fa-folder"></i> <a><?php echo $read->category; ?></a> </span>
                                <span><i class="far fa-eye"></i> <a><?php echo number_format($read->view); ?></a> </span>
                            </div>
                            <p class="lead mb-0"><?php echo Session::get('flag') == 'uk'? $read->text_en : $read->text_in; ?></p>
                            <div class="post-block mt-5 post-share">
                                <div class="row mb-3">
                                    <div class="col-lg-5">
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Share this post' : 'Bagikan tautan ini'; ?></h4>
                                        <div id="socialShare"></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Listening' : 'Mendengarkan'; ?></h4>
                                        <button type="button" id="btn-play" onclick="speak();" class="btn btn-primary"><i class="fas fa-play"></i>  <?php echo Session::get('flag') == 'uk'? 'Play' : 'Putar'; ?></button>
                                        <button type="button" id="btn-stop" onclick="stops();" class="d-none btn btn-danger"><i class="fas fa-stop"></i>  <?php echo Session::get('flag') == 'uk'? 'Stop' : 'Berhenti'; ?></button>
                                    </div>
                                    <div class="col-lg-4">
                                        <?php if(($read->link_youtube != "") && ($read->link_instagram != "")) { ?>
                                        <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Links on social media' : 'Tautan dimedia sosial'; ?></h4>
                                        <div>
                                            <ul class="social-icons social-icons-medium">
                                                <?php if($read->link_youtube != "") { ?>
                                                <li>
                                                    <a href="<?php echo $read->link_youtube; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="<?php echo $read->link_youtube; ?>">
                                                        <i class="text-danger fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <?php if($read->link_instagram != "") { ?>
                                                <li>
                                                    <a href="<?php echo $read->link_instagram; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="<?php echo $read->link_instagram; ?>">
                                                        <i class="text-info fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</section>    

@endsection
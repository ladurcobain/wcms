@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')

<?php if($banner != []) { ?>
<div class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-horizontal-center show-dots-hover dots-light nav-style-1 nav-inside nav-inside-plus nav-dark nav-lg nav-font-size-lg show-nav-hover mb-0"
    data-plugin-options="{'autoplayTimeout': 6000}" data-dynamic-height="['700px','700px','700px','550px','500px']"
    style="height: 700px;">
    <div class="owl-stage-outer">
        <div class="owl-stage">
            <?php foreach($banner as $row) : ?>
            <div class="owl-item position-relative overlay overlay-show overlay-op-3"
                data-dynamic-height="['700px','700px','700px','550px','500px']"
                style="background-image: url(<?php echo $row->path; ?>); background-size: cover; background-position: center;">
                <div class="container position-relative z-index-3 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-7 text-center">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                <h1 class="text-color-light font-weight-extra-bold text-12-5 line-height-3 mb-2 appear-animation"
                                    data-appear-animation="blurIn" data-appear-animation-delay="500"
                                    data-plugin-options="{'minWindowWidth': 0}">
                                    <?php echo Session::get('flag') == 'uk'? $row->title_en : $row->title_in; ?>
                                </h1>
                                <p class="text-4-5 text-color-light font-weight-light opacity-2 text-center mb-5"
                                    data-plugin-animated-letters
                                    data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 30}">
                                    <?php echo Session::get('flag') == 'uk'? $row->subtitle_en : $row->subtitle_in; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if(count($banner) == 1) { ?>
                <?php foreach($banner as $row) : ?>
                <div class="owl-item position-relative overlay overlay-show overlay-op-7"
                    data-dynamic-height="['700px','700px','700px','550px','500px']"
                    style="background-image: url(<?php echo $row->path; ?>); background-size: cover; background-position: center;">
                    <div class="container position-relative z-index-3 h-100">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-lg-7 text-center">
                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                    <h1 class="text-color-light font-weight-extra-bold text-12-5 line-height-3 mb-2 appear-animation"
                                        data-appear-animation="blurIn" data-appear-animation-delay="500"
                                        data-plugin-options="{'minWindowWidth': 0}">
                                        <?php echo Session::get('flag') == 'uk'? $row->title_en : $row->title_in; ?>
                                    </h1>
                                    <p class="text-4-5 text-color-light font-weight-light opacity-7 text-center mb-5"
                                        data-plugin-animated-letters
                                        data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 30}">
                                        <?php echo Session::get('flag') == 'uk'? $row->subtitle_en : $row->subtitle_in; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>
    <div class="owl-dots mb-5">
        <?php 
            $i=0;
            foreach($banner as $row) : 
                $i=$i+1;
        ?>
        <button role="button" class="owl-dot <?php echo (($i==1)?'active':''); ?>"><span></span></button>
        <?php endforeach; ?>
    </div>
</div>
<?php } ?>

<?php if(count($berita) > 0) { ?>
<section class="section section-height-1 bg-color-grey-scale-1 m-0 border-0">
    <div class="row pt-4 mt-3">
        <div class="col">
            <h2 style="color: #777;" class="font-weight-normal text-center text-6 mb-8 appear-animation" data-appear-animation="fadeInUpShorter">
                <?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Important</strong> News' : '<strong class="font-weight-extra-bold">Berita</strong> Utama'; ?>
            </h2>
        </div>
    </div>    
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-8">
                <p style="font-weight: bold;color: #05ac69;" class="lead pe-lg-5 me-lg-5"><?php echo $berita[0]['title']; ?></p>
                <div class="post-meta">
                    <span>
                        <i class="far fa-calendar-alt text-primary"></i>
                        <span style="color: #05ac69"> <?php echo Carbon\Carbon::createFromFormat('Y-m-d', $berita[0]['date'])->format('d-m-Y'); ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-folder text-primary"></i> 
                        <span style="color: #05ac69"><?php echo $berita[0]['category']; ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-eye text-primary"></i> 
                        <span style="color: #05ac69"><?php echo number_format($berita[0]['view']); ?> <?php echo Session::get('flag') == 'uk' ? 'views' : 'dilihat'; ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-user text-primary"></i> 
                        <span style="color: #05ac69"><?php echo $berita[0]['satker']; ?></span>
                    </span>
                </div>
                <p><?php echo Session::get('flag') == 'uk' ? Status::str_ellipsis($berita[0]['text_en'], 350) : Status::str_ellipsis($berita[0]['text_in'], 350); ?></p>
                <a style="background-color: #05ac69;" href="<?php echo url('conference/news/'. $berita[0]['id'].'/read'); ?>" class="btn btn-dark font-weight-semibold btn-px-4 btn-py-2 text-2"><?php echo Session::get('flag') == 'uk'? 'More' : 'Selengkapnya'; ?></a>
            </div>
            <div class="col-sm-4 col-md-6 col-lg-4 mt-sm-3" style="top: 1.7rem;">
                <div class="card border-width-3 border-radius-0" style="margin: 5px;padding: 10px;">    
                    <img src="<?php echo $berita[0]['path']; ?>" class="img-fluid position-relative appear-animation mb-2" data-appear-animation="expandIn" data-appear-animation-delay="600" alt="<?php echo $berita[0]['title']; ?>" />
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-8">
                <p style="font-weight: bold;color: #05ac69;" class="lead pe-lg-5 me-lg-5"><?php echo $berita[1]['title']; ?></p>
                <div class="post-meta">
                    <span>
                        <i class="far fa-calendar-alt text-primary"></i>
                        <span style="color: #05ac69"> <?php echo Carbon\Carbon::createFromFormat('Y-m-d', $berita[1]['date'])->format('d-m-Y'); ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-folder text-primary"></i> 
                        <span style="color: #05ac69"><?php echo $berita[1]['category']; ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-eye text-primary"></i> 
                        <span style="color: #05ac69"><?php echo number_format($berita[1]['view']); ?> <?php echo Session::get('flag') == 'uk' ? 'views' : 'dilihat'; ?></span>
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <i class="far fa-user text-primary"></i> 
                        <span style="color: #05ac69"><?php echo $berita[1]['satker']; ?></span>
                    </span>
                </div>
                <p><?php echo Session::get('flag') == 'uk' ? Status::str_ellipsis($berita[1]['text_en'], 350) : Status::str_ellipsis($berita[1]['text_in'], 350); ?></p>
                <a style="background-color: #05ac69;" href="<?php echo url('conference/news/'. $berita[1]['id'].'/read'); ?>" class="btn btn-dark font-weight-semibold btn-px-4 btn-py-2 text-2"><?php echo Session::get('flag') == 'uk'? 'More' : 'Selengkapnya'; ?></a>
            </div>
            <div class="col-sm-4 col-md-6 col-lg-4 mt-sm-3" style="top: 1.7rem;">
                <div class="card border-width-3 border-radius-0" style="margin: 5px;padding: 10px;">    
                    <img src="<?php echo $berita[1]['path']; ?>" class="img-fluid position-relative appear-animation mb-2" data-appear-animation="expandIn" data-appear-animation-delay="600" alt="<?php echo $berita[1]['title']; ?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row recent-posts pt-3 mt-4 pb-5 mb-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
            <?php for($i=2; $i<count($berita); $i++) { ?>
            <div class="col-md-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card border-width-3 border-radius-0 border-color-hover-dark" style="margin: 5px;padding: 5px;">
                    <article>
                        <div class="row">
                            <div class="col">
                                <a href="<?php echo url('conference/news/'. $berita[$i]['id'].'/read'); ?>"
                                    class="text-decoration-none">
                                    <img src="<?php echo $berita[$i]['path']; ?>" class="img-fluid hover-effect-2 mb-3"
                                        alt="<?php echo $berita[$i]['titile']; ?>" />
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto pe-0">
                                <div class="date">
                                    <span
                                        class="day text-color-dark font-weight-extra-bold"><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $berita[$i]['date'])->format('d'); ?></span>
                                    <span
                                        class="month text-1"><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $berita[$i]['date'])->format('M'); ?></span>
                                </div>
                            </div>
                            <div class="col ps-1">
                                <h4 class="line-height-3 text-3">
                                    <a href="<?php echo url('conference/news/'. $berita[$i]['id'].'/read'); ?>"
                                        class="text-dark">
                                        <?php echo $berita[$i]['titile']; ?>
                                    </a>
                                </h4>
                                <p style="font-size:12px;" class="line-height-3 pe-4 mb-1"><span><i class="far fa-user"></i>
                                        <?php echo $berita[$i]['satker']; ?></p>
                                <p style="font-size:12px;" class="line-height-3 pe-4 mb-1"><span><i class="far fa-eye"></i>
                                        <?php echo $berita[$i]['view']; ?> Dilihat</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<div class="container">
    <div class="row py-5 my-5">
        <div class="col-lg-8 mt-5 mt-lg-0">
            <?php if($unit != []) { ?>
            <h2 style="color: #777;" class="font-weight-bold text-7 mt-2 mb-3"><?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Organizational structure</strong> Structure' : '<strong class="font-weight-extra-bold">Struktur</strong> Organisasi'; ?></h2>
            <div class="card card-body">
                <div class="row">
                <?php foreach($unit as $row) : ?>
                <div class="col-lg-6 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                    <div class="feature-box feature-box-style-2 mb-4">
                        <div class="feature-box-icon">
                            <i class="icon-layers icons"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold mb-2">
                                <a href="<?php echo url('information/unit/'. $row->id.'/read'); ?>">
                                    <?php echo $row->title; ?>
                                </a>
                            </h4>
                            <p class="mb-0">
                                <?php echo Status::str_ellipsis(Session::get('flag') == 'uk'? $row->text_en : $row->text_in, 200); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            </div>
            <?php } else { ?>
            <div class="card card-body">
                <div class="col-lg-12">
                    <h2 style="color: #777;" class="font-weight-bold text-7 mt-2 mb-0"><?php echo Session::get('flag') == 'uk'? 'Contact Us' : 'Kontak Kami'; ?></h2>
                    <p class="mb-4"><?php echo Session::get('flag') == 'uk'? 'If you have questions about Kejaksaan Republik Indonesia, please contact us.' : 'Jika anda memiliki pertanyaan seputar Kejaksaan Republik Indonesia, silahkan menghubungi kami.'; ?></p>
                    
                    @if ($alert = Session::get('alrt'))
                    <div class="alert <?php echo (($alert == "error")?'alert-danger':'alert-success'); ?> alert-dismissible fade show" tutorial="alert">
                        <strong><?php echo (($alert == "error")?'Error':'Success'); ?>!</strong>
                        <?php echo Session::get('msgs'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                    </div>
                    @endif

                    <form id="contactusForm" style="color: black;"  class="contact-form-recaptcha-v3" action="<?php echo url('ajax/set-contactus'); ?>" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="slug" value="{{ $slug }}" />
                        <input type="hidden" name="module" value="home" />
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Name' : 'Nama'; ?>  <span style="color:red;">*</span></label>
                                <input type="text" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your name' : 'Silahan masukkan nama lengkap'; ?>." maxlength="100"
                                    class="form-control text-3 h-auto py-2" id="name" name="name" autocomplete="off" required />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Email' : 'Surel'; ?>  <span style="color:red;">*</span></label>
                                <input type="email" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your email address' : 'Silahan masukkan alamat email'; ?>."
                                    data-msg-email="Please enter a valid email address." maxlength="100"
                                    class="form-control text-3 h-auto py-2" id="email" name="email" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Subject' : 'Subyek'; ?>  <span style="color:red;">*</span></label>
                                <input type="text" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter the subject' : 'Silahan masukkan subyek pesan'; ?>." maxlength="100"
                                    class="form-control text-3 h-auto py-2" id="subject" name="subject" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Message' : 'Pesan'; ?>  <span style="color:red;">*</span></label>
                                <textarea maxlength="5000" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your message' : 'Silahan masukkan isi pesan'; ?>." rows="5"
                                    class="form-control text-3 h-auto py-2" id="message" name="message" style="resize: none;" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <button class="btn btn-default btn-modern" type="reset"><strong>Batal!</strong></button>
                                <button data-loading-text="Loading..." class="btn btn-primary btn-modern" id="contactusButton" type="submit"><strong>Kirim!</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter">
            <?php if($infografis != []) { ?>
            <div class="row">
                <div class="col">
                    <h4 style="color: #777;" class="font-weight-bold mb-2">
                        <?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Assessment</strong> Poll' : '<strong class="font-weight-extra-bold">Info</strong> Infografis'; ?>
                    </h4>
                    <div class="owl-carousel owl-theme dots-inside float-start me-4 mb-2 mt-4" 
                        data-plugin-options="{'items': 1, 'margin': 10, 'animateOut': 'fadeOut'}">
                        <?php foreach($infografis as $row) : ?>
                        <div class="card card-body">
                            <a target="_blank" href="<?php echo $row->link; ?>">
                                <img class="img-fluid rounded" src="<?php echo $row->path; ?>"
                                    alt="<?php echo $row->name; ?>" />
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr>
            <?php } ?>

            <h4 style="color: #777;" class="font-weight-bold mb-2">
                <?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Assessment</strong> Poll' : '<strong class="font-weight-extra-bold">Indeks</strong> Kepuasan'; ?>
            </h4>
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-sm alert-success d-none" id="ratingSuccess" role="alert">
                                <span id="ratingSuccessMessage"><span>
                            </div>
                            <div class="alert alert-sm alert-danger d-none" id="ratingError" role="alert">
                                <span id="ratingErrorMessage"><span>
                            </div>
                            <form id="ratingForm" class="contact-form form-with-icons">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="slug" value="{{ $slug }}" />
                                <div class="form-group col">
                                    <div class="d-block">
                                        <input type="text" class="rating-invisible" value="5" title="" name="value"
                                            data-plugin-star-rating
                                            data-plugin-options="{'showCaption': true, 'color': 'dark', 'size':'sm'}">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="position-relative">
                                        <i
                                            class="icons icon-note text-color-primary text-3 position-absolute left-15 top-15"></i>
                                        <textarea maxlength="5000" rows="3" class="form-control text-3 h-auto py-2"
                                        id="ratingDescription" name="description" placeholder="Pendapat (opsional)"
                                            style="resize: none;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <button class="btn btn-default btn-modern"
                                        type="reset"><strong>Batal!</strong></button>
                                    <button data-loading-text="Loading..." class="btn btn-primary btn-modern"
                                        id="ratingButton" type="button" onClick="submitRating();"><strong>Kirim!</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(($info->profile->satker_videolink != "") || ($info->profile->satker_videopath != "")) { ?>
<section class="section section-custom-map appear-animation lazyload" data-appear-animation="fadeInUpShorter" style="opacity:0.5;background-color: transparent; background-position: center 0; background-repeat: no-repeat;">
    <section class="section section-default section-footer">
        <div class="container">
            <div class="row py-5 my-5">
                <div class="col text-center">
                    <div class="call-to-action-content mb-5 appear-animation" data-appear-animation="fadeInUpShorter">
                        <h2 class="font-weight-bold text-primary mb-2"><?php echo $info->profile->satker_videotitle; ?></h2>
                        <p class="font-weight-light text-5 text-primary opacity-7 mb-0"><?php echo $info->profile->satker_videosubtitle; ?></p>
                    </div>
                    <div class="call-to-action-btn appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                        <div class="box-content">
                            <a class="text-decoration-none lightbox" href="<?php echo (($info->profile->satker_videotype == 1)?$info->profile->satker_videolink:$info->profile->satker_videopath); ?>" data-plugin-options="{'type':'iframe'}">
                                <i class="fas fa-play featured-icon featured-icon-style-2 featured-icon-hover-effect-1 pulseAnim pulseAnimAnimated animation-infinite bg-primary right-4 top-0 m-0"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php } ?>

{{-- <hr> --}}

<?php if($service != []) { ?>
<section class="section section-height-3 bg-color-grey-scale-1 border-0 m-0 appear-animation" data-appear-animation="fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center appear-animation" data-appear-animation="fadeInUpShorter">
                <h2 style="color: #777;" class="font-weight-normal text-6 pb-2 mb-4">
                    <?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Public</strong> Service' : '<strong class="font-weight-extra-bold">Layanan</strong> Publik'; ?>
                </h2>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme mb-0"
                    data-plugin-options="{'responsive': {'0': {'items': 1}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false, 'nav': true }">
                    <?php foreach($service as $row) : ?>
                    <div class="card card-body" style="margin:10px;">
                        <a target="_blank" href="<?php echo $row->link; ?>">
                            <img class="img-fluid opacity-6" src="<?php echo $row->path; ?>"
                                alt="<?php echo $row->title; ?>" />
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

{{-- <hr> --}}

<?php if(($info->profile->satker_facebook != "") || ($info->profile->satker_instagram != "") || ($info->profile->satker_twitter != ""))  { ?>
<section class="section section-height-3 section-text-light bg-color-primary border-0 m-0 appear-animation"
    data-appear-animation="fadeIn">
    <div class="container">
        <div class="row">
            <div class="col appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                <div class="container z-1">
                    <h1 class="text-center">
                        <?php echo Session::get('flag') == 'uk'? 'Find us on' : 'Temukan kami di'; ?> 
                        <b class="text-black"><?php echo Session::get('flag') == 'uk'? 'social media' : 'media sosial'; ?></b>
                    </h1>
                    <div class="row mt-3">
                        <?php if($info->profile->satker_facebook != "") { ?>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card card-body">
                            <h4 class="heading-block my-4">
                                <span class="text-black"><i class='fab fa-facebook-f'></i> &nbsp; <a href="<?php echo $info->profile->satker_facebook; ?>" target="_blank" style="color: #00AC69;"><b>Facebook</b></span> Kejaksaan</a>
                            </h4>
                            <embed
                                src="https://www.facebook.com/plugins/page.php?href=<?php echo $info->profile->satker_facebook; ?>&tabs=timeline&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId"
                                width="100%" height="378" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></embed>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($info->profile->satker_instagram != "") { ?>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card card-body">
                                <h4 class="heading-block my-4">
                                    <span class="text-black"><i class='fab fa-instagram'></i> &nbsp; <a href="<?php echo $info->profile->satker_instagram; ?>" target="_blank" style="color: #00AC69;"><b>Instagram</b></span> Kejaksaan</a>
                                </h4>
                                <embed src="<?php echo $info->profile->satker_instagram; ?>/embed" width="100%" height="380"
                                    style="border:none;overflow:hidden" scrolling="no"
                                    frameborder="0" allowfullscreen="true" allowtransparency="true"></embed>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($info->profile->satker_twitter != "") { ?>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card card-body">
                                <h4 class="heading-block my-4">
                                    <span class="text-black"><i class='fab fa-twitter'></i> &nbsp; <a href="<?php echo $info->profile->satker_twitter; ?>" target="_blank" style="color: #00AC69;"><b>Twitter</b></span> Kejaksaan</a>
                                </h4>
                                <div id="overflowTest" style="overflow-y: auto;max-height: 381px;">
                                    <a class="twitter-timeline" href="<?php echo $info->profile->satker_twitter; ?>">Tweets by
                                        KejaksaanRI</a>
                                    <script async src="https://platform.twitter.com/widgets.js"></script>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

@endsection

@extends('layouts.master')

@section('slug')
    {{ $slug }}
@endsection
@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('layouts.breadcrumb')

    <section class="">
        <div class="container mt-4">
            <?php if($results->total() > 0) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-posts recent-posts">
                        <?php foreach ($results as $row) { ?>
                        <article class="post post-medium border-0 pb-0 mb-5">
                            <div class="row mb-3 card card-body">
                                <div class="col-lg-12">
                                    <div class="post-content bg-color-light">
                                        <h2 class="font-weight-bold text-4 line-height-3 mt-0 mb-2">
                                            <a href="<?php echo url('conference/article/' . $row->id . '/read'); ?>"><?php echo $row->title; ?></a>
                                        </h2>
                                        <div class="post-meta m-0 p-0">
                                            <span><i class="far fa-calendar-alt text-primary"></i><span
                                                    style="color: #05ac69"> <?php echo $row->date; ?></span> </span>
                                            <span><i class="far fa-folder text-primary"></i> <a
                                                    style="color: #05ac69"><?php echo $row->category; ?></a>
                                            </span>
                                            <span><i class="far fa-eye text-primary"></i> <a
                                                    style="color: #05ac69"><?php echo number_format($row->view); ?></a>
                                                <?php echo Session::get('flag') == 'uk' ? 'views' : 'dilihat'; ?></span>
                                        </div>
                                        <p class="mb-0">
                                            <?php echo Status::str_ellipsis(Session::get('flag') == 'uk' ? $row->text_en : $row->text_in, 460); ?>
                                        </p>
                                        <div class="post-meta m-0 p-0">
                                            <span class="d-block mt-2">
                                                <a href="<?php echo url('conference/article/' . $row->id . '/read'); ?>"
                                                    class="btn btn-xs btn-light text-1 text-uppercase">
                                                    <?php echo Session::get('flag') == 'uk' ? 'Read more' : 'Selengkapnya'; ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                        <div class="container py-4"></div>
                        <?php if(!empty($results)) { ?>
                        <h2 style="color: #05ac69;"
                            class="pagination font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2 float-start">Total
                            Data : {{ $results->total() }}</h2>
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

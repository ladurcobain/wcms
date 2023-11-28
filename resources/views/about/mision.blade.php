@extends('layouts.master')

@section('slug')
    {{ $slug }}
@endsection
@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('layouts.breadcrumb')

    <section class="section section-elements m-0 section-no-border bg-bottom-slash position-relative z-index-1">
        <div class="container mt-4 card card-body">
            <?php if(count($list) > 0) { ?>
            <div class="row">
                <?php foreach ($list as $row) { ?>
                <div class="col-lg-12 text-justify">
                    <div class="overflow-hidden mb-1">
                        <p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">
                            <?php echo Session::get('flag') == 'uk' ? $row->text_en : $row->text_in; ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } else { ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="overflow-hidden mb-1">
                        <p class="lead mb-0 appear-animation" data-appear-animation="maskUp"
                            data-appear-animation-delay="200">
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

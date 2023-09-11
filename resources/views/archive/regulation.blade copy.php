@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="">
    <div class="container">
        <div class="featured-boxes py-3 mt-2 mb-4">
            <div class="row">
                <?php if($results->total() > 0) { ?>
                <div class="row">
                    <?php foreach ($results as $row) { ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="featured-box featured-box-primary featured-box-effect-1">
                                <div class="box-content">
                                    <i class="icon-featured far fa-file-alt"></i>
                                    <h3 class="text-color-dark font-weight-bold text-3 mb-2 mt-3"><?php echo $row->title; ?></h3>
                                    <a href="javascript:void(0);" OnClick="link_new_tab('{{ $row->path }}');" class="btn btn-primary mb-2"><?php echo Session::get('flag') == 'uk'? 'Download File' : 'Unduh Berkas'; ?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="container py-4"></div>
                    <?php if(!empty($results)) { ?>
                        <h2 style="color: #05ac69;" class="pagination font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2 float-start">Total Data : {{ $results->total() }}</h2>
                        <div class="pagination float-end">{{ $results->onEachSide(1)->links() }}</div>
                    <?php } ?>     
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
        </div>
    </div>  
</section>

@endsection

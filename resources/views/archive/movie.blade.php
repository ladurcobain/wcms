@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="">
	<div class="container py-4">
        <?php if($results->total() > 0) { ?>
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">
                        <?php foreach ($results as $row) { ?>
                            <div class="col-lg-6 mb-2 mb-lg-4">
                                <div class="card p-2">
                                    <div class="card-body p-2 my-2 isotope-item document ">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <embed width="100%" height="280"
                                                    src="{{ $row->link }}">
                                                </embed>
                                            </div>
                                            <div class="mg-description">
                                                <small class="float-end text-muted">{{ $row->description }}</small>
                                            </div>
                                        </div>
                                        <h5 class="mg-title font-weight-semibold">{{ $row->title, 35 }}</h5>
                                    </div>
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


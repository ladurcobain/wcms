@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<div role="main" class="main">
    <div class="container pt-5">
        <?php if(!empty($read)) { ?>
        <div class="row py-4 mb-2">
            <div class="col-md-7 order-2">
                <div class="overflow-hidden">
                    <h2 class="text-color-dark font-weight-bold text-12 mb-2 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300"><?php echo $read->name; ?></h2>
                </div>
                <p class="lead appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700"><?php echo $read->information; ?></p>
            </div>
            <div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
                <img src="<?php echo $read->path; ?>" class="img-fluid mb-2" alt="">
            </div>
            <?php } ?> 
        </div>
    </div>

    @endsection
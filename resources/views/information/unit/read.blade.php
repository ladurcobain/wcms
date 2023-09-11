@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="section section-elements m-0 section-no-border bg-bottom-slash position-relative z-index-1">
	<div class="container mt-4">
        <?php if(!empty($read)) { ?>
        <div class="row card card-body">
            <div class="col-lg-12">
                <div class="overflow-hidden mb-1">
                    <h2 style="color: #05ac69;" class="font-weight-semi-bold"><?php echo $read->title; ?></h2>
                    <p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">
                        <?php echo Session::get('flag') == 'uk'? $read->text_en : $read->text_in; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?> 
    </div>
</section>    

@endsection
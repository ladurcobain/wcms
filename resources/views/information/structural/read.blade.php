@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<?php if(!empty($read)) { ?>
<div class="container pt-5">
    <div class="row py-4 mb-2">
        <div class="col-md-8 order-2">
            <div class="card card-body">
                <h2 class="text-color-dark font-weight-normal text-5 mb-2"><?php echo $read->name; ?></h2>
                <ul class="list list-icons list-primary list-borders text-2">
                    <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">NIP : </strong> <?php echo $read->nip; ?></li>
                    <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">Jabatan : </strong> <?php echo $read->title; ?></li>
                </ul>
                <p class="lead appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700"><?php echo $read->information; ?></p>
            </div>
        </div>
        <div class="col-md-4 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
            <div class="card card-body">    
                <img src="<?php echo $read->path; ?>" class="img-fluid mb-2" class="img-fluid mb-2" alt="<?php echo $read->name; ?>" />
            </div>
        </div>
    </div>
</div>
<?php } ?> 

@endsection
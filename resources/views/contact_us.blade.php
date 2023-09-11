@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<div class="container py-5 my-5">
    <div class="row card card-body transition-3ms">
        <div class="col-lg-12">
            <h2 class="font-weight-bold text-7 mt-2 mb-0"><?php echo Session::get('flag') == 'uk'? 'Contact Us' : 'Kontak Kami'; ?></h2>
            <p class="mb-4"><?php echo Session::get('flag') == 'uk'? 'If you have questions about Kejaksaan Republik Indonesia, please contact us.' : 'Jika anda memiliki pertanyaan seputar Kejaksaan Republik Indonesia, silahkan menghubungi kami.'; ?></p>
            
            @if ($alert = Session::get('alrt'))
            <div class="alert <?php echo (($alert == "error")?'alert-danger':'alert-success'); ?> alert-dismissible fade show" tutorial="alert">
                <strong><?php echo (($alert == "error")?'Error':'Success'); ?>!</strong>
                <?php echo Session::get('msgs'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
            </div>
            @endif

            <form style="color: black;" id="contactusForm" class="contact-form-recaptcha-v3" action="<?php echo url('ajax/set-contactus'); ?>" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="slug" value="{{ $slug }}" />
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Name' : 'Nama'; ?> <span class="text-danger">*</span></label>
                        <input type="text" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your name' : 'Silahan masukkan nama lengkap'; ?>." maxlength="100"
                            class="form-control text-3 h-auto py-2" id="name" name="name" autocomplete="off" required />
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Email' : 'Email'; ?> <span class="text-danger">*</span></label>
                        <input type="email" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your email address' : 'Silahan masukkan alamat email'; ?>."
                            data-msg-email="Please enter a valid email address." maxlength="100"
                            class="form-control text-3 h-auto py-2" id="email" name="email" autocomplete="off" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Subject' : 'Subjek'; ?> <span class="text-danger">*</span></label>
                        <input type="text" value="" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter the subject' : 'Silahan masukkan subyek pesan'; ?>." maxlength="100"
                            class="form-control text-3 h-auto py-2" id="subject" name="subject" autocomplete="off" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label mb-1 text-2"><?php echo Session::get('flag') == 'uk'? 'Message' : 'Pesan'; ?> <span class="text-danger">*</span></label>
                        <textarea maxlength="5000" data-msg-required="<?php echo Session::get('flag') == 'uk'? 'Please enter your message' : 'Silahan masukkan isi pesan'; ?>." rows="5"
                            class="form-control text-3 h-auto py-2" id="message" name="message" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <button class="btn btn-default btn-modern" type="reset"><strong>Batal!</strong></button>
                        <button data-loading-text="Loading ..." class="btn btn-primary btn-modern" id="contactusButton" type="submit"><strong>Kirim!</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    $map = $info->profile->satker_map;
    if($map != "") {
?>
<div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="100%" height="500" id="gmap_canvas" src="<?php echo $map; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>
<?php } ?>

@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<body data-plugin-page-transition>

    <div class="body coming-soon">

        <div role="main" class="main" style="min-height: calc(100vh - 393px);">
            <div class="container">
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="logo">
                            <a>
                                <img height="150" src="{{ URL::asset('assets/img/kejaksaan-logo.jpg') }}" alt="Kejaksaan Agung RI" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <hr class="solid my-5">
                    </div>
                </div>
                <div class="row" >
                    <div class="col text-center">
                        <div class="overflow-hidden mb-2">
                            <h2 class="font-weight-normal text-7 mb-0 appear-animation" data-appear-animation="maskUp">
                                <strong class="font-weight-extra-bold">Satuan Kerja</strong>
                            </h2>
                        </div>
                        <div class="overflow-hidden mb-1">
                            <p class="lead mb-0 appear-animation" data-appear-animation="maskUp"
                                data-appear-animation-delay="200">Link Url Website Satuan Kerja Kejaksaan
                            </p>
                        </div>
                    </div>
                </div>
                <br />
                @if ($alert = Session::get('alrt'))
                <div class="row col-lg-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Error!</strong> <?php echo Session::get('msgs'); ?>
                    </div>
                </div>
                @endif
                <br />
                <div class="row card card-body table-responsive">
					<table id="tableDt" class="table table-responsive-lg table-hover table-bordered table-striped table-sm mb-0" data-plugin-options='{"searchPlaceholder": "Pencarian ..."}' style="min-height: 235px;">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">
                                    #
                                </th>
                                <th width="30%">
                                    Satuan Kerja
                                </th>
                                <th>
                                    Link Url
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($list) > 0) { ?>
                                <?php 
                                    $i=0;
                                    foreach ($list as $row) { 
                                        $i = $i+1;
                                ?>
                                <tr>
                                    <td class="text-center" valign="middle">
                                        <?php echo $i; ?>
                                    </td>
                                    <td valign="middle">
                                        <?php echo $row->satker_name; ?>
                                    </td>
                                    <td valign="middle">
                                        <a href="<?php echo $row->satker_url; ?>"><?php echo $row->satker_url; ?></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center" valign="middle">
                                        <p class="description">
                                            <i class="fas fa-exclamation-triangle fa-fw text-warning text-5 va-middle"></i>
                                            <span class="va-middle">Data tidak ditemukan.</span>
                                        </p>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="post-block mt-5 post-share">
                    <h4 class="mb-3"><?php echo Session::get('flag') == 'uk'? 'Share this post' : 'Bagikan tautan ini'; ?> </h4>
                    <div id="socialShare"></div>
                </div>
            </div>
        </div>

        <footer id="footer">
            <div class="footer-copyright footer-copyright-style-2">
                <div class="container py-2">
                    <div class="row py-4">
                        <div
                            class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-lg-0">
                            <p>© Copyright 2023. All Rights Reserved.</p>
                        </div>
                        <div
                            class="col-md-8 d-flex align-items-center justify-content-center justify-content-md-end mb-4 mb-lg-0">
                            <p><i class="far fa-envelope text-color-primary top-1 p-relative"></i><a
                                    href="mailto:kejaksaan@agung.com" class="opacity-7 ps-1">kejaksaan@agung.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @include('layouts.scripts')

</body>

</html>
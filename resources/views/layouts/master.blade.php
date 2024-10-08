<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<script>
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      img.src = img.dataset.src;
    });
  } else {
    // Dynamically import the LazySizes library
    const script = document.createElement('script');
    script.src =
      'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.2/lazysizes.min.js';
    document.body.appendChild(script);
  }
</script>

<script>
    function setFlag(val) {
        if (val == "uk") {
            document.getElementById("flag-uk").classList.remove("d-none");
            document.getElementById("flag-id").classList.remove("d-block");

            document.getElementById("flag-uk").classList.add("d-block");
            document.getElementById("flag-id").classList.add("d-none");
        } else {
            document.getElementById("flag-uk").classList.remove("d-block");
            document.getElementById("flag-id").classList.remove("d-none");

            document.getElementById("flag-uk").classList.add("d-none");
            document.getElementById("flag-id").classList.add("d-block");
        }

        var uri = base_url + "ajax/set-flag/" + val;
        $.ajax({
            type: "get",
            dataType: "html",
            url: uri,
            timeout: 500,
            beforeSend: function() {
                //
            }
        }).done(function(data) {
            location.reload();
        }).fail(function(jqXHR, textStatus) {
            if (textStatus === 'timeout') {
                //
            }
        });
    }

    function submitRating() {
        var uri = base_url + "ajax/set-rating";
        var form = $('#ratingForm');

        $.ajax({
            url: uri,
            data: form.serialize(),
            type: "POST",
            dataType: "JSON",
            beforeSend: function() {
                $('#ratingDescription').val('');
            }
        }).done(function(data) {
            if (data.status == "success") {
                document.getElementById("ratingSuccess").classList.remove("d-none");
                document.getElementById("ratingSuccess").classList.add("d-block");

                document.getElementById("ratingError").classList.remove("d-block");
                document.getElementById("ratingError").classList.add("d-none");

                var messagenya = "<?php echo Session::get('flag') == 'uk' ? 'Thank you for your rating' : 'Terima kasih atas penilaian Anda'; ?>";
                $('#ratingSuccessMessage').html('<strong>' + messagenya + '</strong>');
            } else {
                document.getElementById("ratingSuccess").classList.remove("d-block");
                document.getElementById("ratingSuccess").classList.add("d-none");

                document.getElementById("ratingError").classList.remove("d-none");
                document.getElementById("ratingError").classList.add("d-block");

                $('#ratingErrorMessage').html('<strong>' + data.message + '</strong>');
            }
        }).fail(function(jqXHR, textStatus) {
            if (textStatus === 'timeout') {
                //
            }
        });
    }
</script>

<body data-plugin-page-transition style="background-color: black;color: white;" data-plugin-page-transition>

<!--    
<body data-plugin-page-transition style="background-color: black;color: white;" class="loading-overlay-showing" data-plugin-page-transition
    data-loading-overlay data-plugin-options="{'hideDelay': 0, 'effect': 'percentageProgress1'}">
-->
    <?php echo Status::loadingContent($overlay); ?>
    <div class="body">
        <?php if ($pattern) {
            $repeat = $is_cover == 1 ? 'background-position: center;background-repeat:no-repeat' : 'background-repeat:repeat';
            $bg_pattern = 'style="margin: 0;background-image: url(' . $pattern . ');' . $repeat . ';"';
        } else {
            $bg_pattern = 'style="background:#FFF;"';
        } ?>

        <?php if($is_cover == 1) { ?>
        <header id="header" class="header-transparent"
            data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 300, 'stickyChangeLogo': true, 'stickyHeaderContainerHeight': 175}">
            <?php } else { ?>
            <header id="header"
                data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 10, 'stickySetTop': '-60px', 'stickyChangeLogo': true}">
                <?php } ?>
                <div class="header-body" <?php echo $bg_pattern; ?>>
                    <div class="header-container container">
                        <div class="header-row">
                            <div class="header-column">
                                <div class="header-row">
                                    <div class="header-logo">
                                        <a>
                                            <img alt="Kejaksaan Republik Indonesia" height="120"
                                                data-sticky-height="80" data-sticky-top="50"
                                                src="{{ URL::asset('assets/img/webphada.png') }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="header-column justify-content-end">
                                <div class="header-row pt-3">
                                    <nav class="header-nav-top">
                                        <ul class="nav nav-pills">
                                            <?php $session_flag = Session::get('flag'); ?>
                                            <!--
                                                <li class="nav-item nav-item-left-border">
                                                <a href="javascript:void(0);"
                                                    OnCLick="link_new_tab('{{ Curl::frontUrl() }}');">CMS</a>
                                            </li>
                                            -->
                                            <?php if($session_flag != "") { ?>
                                            <li id="flag-id"
                                                class="nav-item dropdown <?php echo $session_flag == 'id' ? ' d-block ' : ' d-none ;'; ?> nav-item-left-border nav-item-left-border-md-show">
                                                <a class="nav-link" href="javascript:void(0)" role="button"
                                                    id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <img src="{{ URL::asset('assets/img/blank.gif') }}"
                                                        class="flag flag-id" alt="Bahasa" /> Bahasa
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownLanguage">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onClick="setFlag('uk');"><img
                                                            src="{{ URL::asset('assets/img/blank.gif') }}"
                                                            class="flag flag-gb uk" alt="English" /> English</a>
                                                </div>
                                            </li>
                                            <li id="flag-uk"
                                                class="nav-item dropdown <?php echo $session_flag == 'uk' ? ' d-block ' : ' d-none ;'; ?> nav-item-left-border nav-item-left-border-md-show">
                                                <a class="nav-link" href="javascript:void(0)" role="button"
                                                    id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <img src="{{ URL::asset('assets/img/blank.gif') }}"
                                                        class="flag flag-gb uk" alt="English" /> English
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownLanguage">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onClick="setFlag('id');"><img
                                                            src="{{ URL::asset('assets/img/blank.gif') }}"
                                                            class="flag flag-id" alt="Bahasa" /> Bahasa</a>
                                                </div>
                                            </li>
                                            <?php } else { ?>
                                            <li id="flag-id" style="display:block;"
                                                class="nav-item dropdown d-block nav-item-left-border nav-item-left-border-md-show">
                                                <a class="nav-link" href="javascript:void(0)" role="button"
                                                    id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <img src="{{ URL::asset('assets/img/blank.gif') }}"
                                                        class="flag flag-id" alt="Bahasa" /> Bahasa
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownLanguage">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onClick="setFlag('uk');"><img
                                                            src="{{ URL::asset('assets/img/blank.gif') }}"
                                                            class="flag flag-gb uk" alt="English" /> English</a>
                                                </div>
                                            </li>
                                            <li id="flag-uk" style="display:block;"
                                                class="nav-item dropdown d-none nav-item-left-border nav-item-left-border-md-show">
                                                <a class="nav-link" href="javascript:void(0)" role="button"
                                                    id="dropdownLanguage" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{ URL::asset('assets/img/blank.gif') }}"
                                                        class="flag flag-gb uk" alt="English" /> English
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownLanguage">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onClick="setFlag('id');"><img
                                                            src="{{ URL::asset('assets/img/blank.gif') }}"
                                                            class="flag flag-id" alt="Bahasa" /> Bahasa</a>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-row">
                                    <div class="header-nav pt-1">
                                        <div
                                            class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                            @include('layouts.navigation')
                                        </div>
                                        <div class="header-nav-features">
                                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                                <a href="javascript:void(0);"
                                                    class="header-nav-features-toggle text-decoration-none"
                                                    data-focus="headerSearch"><i
                                                        class="fas fa-search header-nav-top-icon"></i>
                                                </a>
                                                <div class="header-nav-features-dropdown"
                                                    id="headerTopSearchDropdown">
                                                    <form role="search"action="<?php echo url('contents/filter'); ?>" method="POST">
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="slug"
                                                            value="{{ $slug }}" />
                                                        <div class="simple-search input-group">
                                                            <input class="form-control text-1" id="headerSearch"
                                                                placeholder="Masukkan kata kunci pencarian ..."
                                                                name="q" value="" autocomplete="off"
                                                                type="search" />
                                                            <button class="btn" type="submit">
                                                                <i class="fas fa-search header-nav-top-icon"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse"
                                            data-bs-target=".header-nav-main nav">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <?php if ($background) {
                $bg_background = 'style="background-image: url(' . $background . ');background-position: center;background-repeat: repeat;"';
            } else {
                $bg_background = '';
            } ?>
            <div role="main" class="main" <?php echo $bg_background; ?>>
                <?php
                if ($is_cover == 1) {
                    $section = '<section style="height: 300px !important;box-sizing: border-box;background-image: url(' . $pattern . ');background-repeat: no-repeat;background-position: center;height: 100vh;"></section>';
                } else {
                    $section = '';
                }
                ?>
                <?php echo $section; ?>
                @yield('content')
            </div>

            @include('layouts.footer')
    </div>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel"><?php echo Session::get('flag') == 'uk'? '<strong class="font-weight-extra-bold">Assessment</strong> Poll' : '<strong class="font-weight-extra-bold">Indeks</strong> Kepuasan'; ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-sm alert-success d-none" id="ratingSuccess" role="alert">
                                    <span id="ratingSuccessMessage"><span>
                                </div>
                                <div class="alert alert-sm alert-danger d-none" id="ratingError" role="alert">
                                    <span id="ratingErrorMessage"><span>
                                </div>
                                <form id="ratingForm" class="contact-form form-with-icons" action="{{ url('ajax/process-rating') }}" method="post" novalidate>
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
                                            <img src="{{ URL::to('/') }}/ajax/refresh-captcha" class="img-fluid position-relative" />
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <div class="position-relative">
                                            <i class="icons icon-puzzle text-color-primary text-3 position-absolute left-15 top-15"></i>
                                            <input type="text" name="captcha" maxlength="5" class="form-control text-3 h-auto py-2" autocomplete="off" placeholder ="Masukkan kode Captcha" required OnKeyUp="checkCaptcha(this.value);" />
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
                                            id="ratingButton" type="submit"><strong>Kirim!</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.scripts')
    <script>
        function darkMode() {
            var element = document.querySelector('[role="main"]');
            element.classList.add("dark-mode");
        }
    </script>
    <!--<script src="https://code.responsivevoice.org/responsivevoice.js?key=1gvJbppd"></script>-->
</body>

</html>

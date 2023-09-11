<section class="page-header page-header-classic page-header-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1 data-title-border>{{ (($subtitle != "")? $subtitle : $title); }}</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end">
                    <li><a href="<?php echo url($slug .'/home'); ?>">Beranda</a></li>
                    @if ($title != "")
                        <li><span>{{ $title }}</span></li>
                    @endif
                    @if ($subtitle != "")
                        <li><span>{{ $subtitle }}</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
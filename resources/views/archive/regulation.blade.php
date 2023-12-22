@extends('layouts.master')

@section('slug') {{ $slug }} @endsection
@section('title') {{ $title }} @endsection

@section('content')
@include('layouts.breadcrumb')

<section class="">
    <div class="container">
        <div class="featured-boxes py-3 mt-2 mb-4">
            <div class="row table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="20%">Nomor</th>
                            <th>Judul</th>
                            <th width="10%" align="center"><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($results->total() > 0) { ?>
                        <?php foreach ($results as $row) { ?>
                        <tr>
                            <td>{{ $row->noPeraturan }}</td>
                            <td>{{ $row->judul }}</td>
                            <td align="center">    
                                <button type="button" OnClick="link_new_tab('<?php echo $row->urlDownload;  ?>');" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Unduh</button>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                            <tr><td align="center" colspan="3">Data tidak ditemukan</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if($results->total() > 0) { ?>
                    <tfoot>    
                        <tr>
                            <td>Total <b>{{ $results->total() }}</b> Data</td>
                            <td colspan="2"><span style="margin-top: 15px;float:right;">{{ $results->onEachSide(1)->links() }}</span></td>
                        </tr>
                    </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>  
</section>

@endsection

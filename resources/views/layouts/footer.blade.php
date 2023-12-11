<?php 
    if(!empty($info)) { 
        $profile = $info->profile;
?>
<script>
    function submitNewsletter() {
        var uri = base_url + "ajax/set-newsletter";
        var form = $('#newsletterForm');
        
        $.ajax({
            url: uri,
            data: form.serialize(),
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
                $('#newsletterEmail').val('');
            }
        }).done(function(data) {
            if(data.status) {
                document.getElementById("newsletterSuccess").classList.remove("d-none");
                document.getElementById("newsletterSuccess").classList.add("d-block");

                document.getElementById("newsletterError").classList.remove("d-block");
                document.getElementById("newsletterError").classList.add("d-none");
                
                var messagenya = "<?php echo Session::get('flag') == 'uk'? 'Thank you for subscribing' : 'Terima kasih Anda telah berlangganan'; ?>";
                $('#newsletterSuccessMessage').html('<strong>'+ messagenya +'</strong>');
            }
            else {
                document.getElementById("newsletterSuccess").classList.remove("d-block");
                document.getElementById("newsletterSuccess").classList.add("d-none");

                document.getElementById("newsletterError").classList.remove("d-none");
                document.getElementById("newsletterError").classList.add("d-block");
                
                $('#newsletterErrorMessage').html('<strong>'+ data.message +'</strong>');
            }
        }).fail(function(jqXHR, textStatus){
            if(textStatus === 'timeout') {     
                //
            }		
        });
    }
</script>

<footer id="footer">
    <div class="container">
        <div class="footer-ribbon">
            <span><?php echo $profile->satker_name; ?></span>
        </div>
        <div class="row py-5 my-4">
            <div class="col-md-6 mb-4 mb-lg-0">
                <div class="row">
                    <div class="col-md-7">
                        <h5 class="text-3 mb-3"><?php echo Session::get('flag') == 'uk'? 'CONTACT WITH US' : 'HUBUNGI KAMI'; ?></h5>
                        <ul class="list list-icons list-icons-lg">
                            <li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i><p class="m-0"><?php echo $profile->satker_address; ?></p></li>
                            <li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i><p class="m-0"><a href="tel:><?php echo $profile->satker_phone; ?>"><?php echo $profile->satker_phone; ?></a></p></li>
                            <li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="mailto:><?php echo $profile->satker_email; ?>"><?php echo $profile->satker_email; ?></a></p></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-3 mb-3"><?php echo Session::get('flag') == 'uk'? 'USEFUL LINK' : 'TAUTAN TERKAIT'; ?></h5>
                        <ul class="list list-icons list-icons-sm">
                            <?php 
                                $related = $info->related;
                                foreach($related as $row) : 
                            ?>
                            <li><i class="fas fa-angle-right"></i><a href="<?php echo $row->url; ?>" class="link-hover-style-1 ms-1"> <?php echo $row->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>    
            </div>
            <div class="col-md-6 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-7">
                        <h5 class="text-3 mb-3"><?php echo Session::get('flag') == 'uk'? 'SUBSCRIBE' : 'BERLANGGANAN'; ?></h5>
                        <p class="text-4 mb-1"><?php echo Session::get('flag') == 'uk'? 'Register your email address to get news from us.' : 'Daftarkan alamat surel Anda untuk berlangganan berita dari kami.'; ?></p>

                        <div class="alert alert-sm alert-success d-none" id="newsletterSuccess" role="alert">
						    <span id="newsletterSuccessMessage"><span>
                        </div>
                        <div class="alert alert-sm alert-danger d-none" id="newsletterError" role="alert">
						    <span id="newsletterErrorMessage"><span>
                        </div>
                        
                        <form id="newsletterForm" class="mw-100">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="slug" value="{{ $slug }}" />
                            <div class="input-group input-group-rounded">
                                <input class="form-control form-control-sm bg-light px-4 text-3" placeholder="Alamat Surel ..." name="newsletterEmail" id="newsletterEmail" type="email" autocomplete="off" required />
                                <button class="btn btn-primary text-color-light text-2 py-3 px-4" id="newsletterButton" type="button" onClick="submitNewsletter();"><strong>Kirim!</strong></button>
                            </div>
                        </form>
                        <ul class="social-icons mt-4 mb-3">
                            <?php 
                                $medsos = $info->medsos;
                                foreach($medsos as $row) : 
                            ?>
                            <li class="social-icons-<?php echo strtolower($row->name); ?>"><a href="<?php echo $row->url; ?>" target="_blank" title="<?php echo $row->name; ?>"><?php echo Status::medsosType($row->name); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>    
                    <div class="col-md-4">
                        <h5 class="text-3 mb-3"><?php echo Session::get('flag') == 'uk'? 'COUNTER VISITOR' : 'STATISTIK KUNJUNGAN'; ?></h5>
                        <div>
                            <table height="10" width="100%">
                                <?php 
                                    $visitor = $info->visitor;
                                    foreach($visitor as $row) : 
                                ?>
                                <tr>
                                    <td style="height:10px !important;" width="55%" valign="top"><span class="text-3"><?php echo $row->title; ?><sapi_windows_cp_get></td>
                                    <td valign="top" align="right"><span class="text-4"><b><?php echo number_format($row->count); ?></b></span></td>
                                </tr>   
                                <?php endforeach; ?> 
                                
                                <?php $rating = $info->rating; ?>
                                <tr><td style="height:40px !important;" colspan="2" valign="bottom" align="left">
                                    <ul class="list-inline custom-list-icons-1 text-color-light mt-2">
										<li class="list-inline-item">
											<span style="
                                                width: 32px;
                                                height: 32px;
                                                border-radius: 2px;
                                                margin-right: 3px;
                                                display: inline-block;
                                                text-align: center;
                                                font-weight: bold;
                                                line-height: 32px;
                                                background-color: #FFF !important;
                                                color: #212529 !important;
                                            ">
												<?php echo $rating->average; ?>
											</span>
                                            <span class="text-4"> <?php echo Session::get('flag') == 'uk'? 'from' : 'dari'; ?> </span>
											<strong class="font-weight-semibold negative-ls-05"> <?php echo $rating->num; ?> </strong>
                                            <span class="text-4"> <?php echo Session::get('flag') == 'uk'? 'polling' : 'penilaian'; ?> </span>
										</li>
                                    </ul>    
                                </td></tr>
                            </table>
                        </div>  
                    </div> 
                </div>  
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright-style-2">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col d-flex align-items-center justify-content-center">
                    <p style="font-weight: bold;font-size: 14px;">&copy; Hak Cipta 2023 - V.<?php echo $profile->satker_version; ?>. Kejaksaan Republik Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php if($profile->satker_whatsapp != "") { ?>
<style>
#hello img{
    position: fixed;
    right:0;
    bottom:50px;
    /* margin:0;
    padding:0; */
    width:120px;
    z-index: 999;
}
</style>

<div id="hello">
<a href="https://api.whatsapp.com/send?phone=<?php echo $profile->satker_whatsapp; ?>&text=<?php echo ($profile->satker_opening == ""?"Mohon Bantuannya":$profile->satker_opening); ?>" target="_blank">
    <img src="{{ URL::asset('assets/img/kontak.png') }}" alt="Hubungi Kami" />
</a>
</div>
<?php } ?>
<?php } ?>
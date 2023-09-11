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
                <section class="http-error py-0">
					<div class="row justify-content-center py-3">
						<div class="col-6 text-center">
							<div class="http-error-main">
								<h2 class="mb-0">401!</h2>
                                <br />
								<span class="text-6 font-weight-bold text-color-dark">Tidak Mendapat Respon</span>
							</div>
                            <br /><br /><br />
							<a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary btn-rounded btn-xl font-weight-semibold text-2 px-4 py-3 mt-1 mb-4"><i class="fas fa-angle-left pe-3"></i>Kembali</a>
						</div>
					</div>
				</section>
            </div>
        </div>

        <footer id="footer">
            <div class="footer-copyright footer-copyright-style-2">
                <div class="container py-2">
                    <div class="row py-4">
                        <div
                            class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-lg-0">
                            <p>&copy; Hak Cipta 2023. Kejaksaan Republik Indonesia.</p>
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
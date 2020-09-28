<footer id="footer" class="mt-0">
    <div class="container my-4">
        <div class="row py-5">
            <div class="col-md-5 col-lg-3 mb-5 mb-lg-0">
                <h5 class="text-6 text-transform-none font-weight-semibold text-color-light mb-4">Contact Details</h5>
                <p class="text-4 mb-1">Membangun Komunikasi, Koordinasi dan Konsultasi <br>
                    Email : - <br>
                    Telp : - <br>
                    Fax : -</p> <br>
            </div>
            <div class="col-md-7 col-lg-5 mb-5 mb-lg-0">
                <h5 class="text-6 text-transform-none font-weight-semibold text-color-light mb-4">Berita</h5>
                <div class="row">
                    <div class="col-6">
                        <p class="mb-1"><a href="elements-call-to-action.html" class="text-4 link-hover-style-1">Semua Berita</a></p>
                        <p class="mb-1"><a href="elements-pricing-tables.html" class="text-4 link-hover-style-1">Semua Iklan</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-6 text-transform-none font-weight-semibold text-color-light mb-4">E-mail</h5>
                <p class="text-4 mb-1">Get all the latest information</p>
                <p class="text-4">Sign up for newsletter today.</p>
                <div class="alert alert-success d-none" id="newsletterSuccess">
                    <strong>Success!</strong> You've been added to our email list.
                </div>
                <div class="alert alert-danger d-none" id="newsletterError"></div>
                <form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST" class="mw-100">
                    <div class="input-group input-group-rounded">
                        <input class="form-control form-control-sm bg-light px-4 text-3" placeholder="Email Address..." name="newsletterEmail" id="newsletterEmail" type="text">
                        <span class="input-group-append">
                            <button class="btn btn-primary text-color-light text-2 py-3 px-4" type="submit"><strong>Kirim</strong></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright-style-2">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col d-flex align-items-center justify-content-center mb-4 mb-lg-0">
                    <p>© Copyright 2019. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- Vendor -->
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery/jquery.min.js"></script>

<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/popper/umd/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/common/common.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/vide/jquery.vide.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/vivus/vivus.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url() ?>assets/frontEnd/js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontEnd/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Theme Custom -->
<script src="<?php echo base_url() ?>assets/frontEnd/js/custom.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Theme Initialization Files -->
<script src="<?php echo base_url() ?>assets/frontEnd/js/theme.init.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker();
    });
</script>
</body>

</html>
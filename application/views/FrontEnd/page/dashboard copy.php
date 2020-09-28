<div role="main" class="main">
    <div class="slider-container rev_slider_wrapper" style="height: 50vh;">
        <div id="revolutionSlider" class="slider rev_slider" style="height:50%" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'sliderLayout': 'fullscreen', 'delay': 9000, 'gridwidth': 1170, 'gridheight': 700, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }}">
            <ul style="height:50%">
                <li data-transition="fade" style="height:50%">
                    <img src="https://cdn-asset.jawapos.com/wp-content/uploads/2020/07/urban-farming-2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" height="50%">
                </li>

                <li data-transition="fade" style="height:50%">
                    <img src="https://cdn-asset.jawapos.com/wp-content/uploads/2020/07/urban-farming-2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" height="50%">
                </li>

            </ul>
        </div>
    </div>

    <div class="container py-4">
        <div class="row pb-1">

            <div class="col-lg-7 mb-4 pb-2">
                <a href="#">
                    <article class="thumb-info thumb-info-no-borders thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
                        <div class="thumb-info-wrapper thumb-info-wrapper-opacity-6">
                            <?php $result = $this->db->query("SELECT *FROM TBL_NEWSPOST ORDER BY NP_ID DESC LIMIT 1")->row() ?>
                            <img src="<?php echo base_url() ?>uploads/<?php echo $result->NP_IMAGELINK; ?>" class="img-fluid" alt="How To Take Better Concert Pictures in 30 Seconds">
                            <div class="thumb-info-title bg-transparent p-4">

                                <div class="thumb-info-inner mt-1">
                                    <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0"><?php echo $result->NP_TITLE ?></h2>
                                </div>
                                <div class="thumb-info-show-more-content">
                                    <?php $subContent = strip_tags($result->NP_CONTENT);
                                    $subContent = substr($subContent, 0, 300); ?>
                                    <p class="mb-0 text-1 line-height-9 mb-1 mt-2 text-light opacity-5"><?php echo $subContent ?>...</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            <div class="col-lg-5">
                <?php $result = $this->db->query("SELECT *FROM TBL_NEWSPOST ORDER BY NP_ID DESC LIMIT 3 OFFSET 0  ")->result_array();
                foreach ($result as $resultQuery) :
                ?>


                    <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                        <div class="row align-items-center pb-1">
                            <div class="col-sm-5">
                                <a href="blog-post.html">
                                    <img src="<?php echo base_url() ?>uploads/<?php echo $resultQuery['NP_IMAGELINK'] ?>" class="img-fluid border-radius-0" alt="<?php echo $resultQuery['NP_TITLE'] ?>">
                                </a>
                            </div>
                            <div class="col-sm-7 pl-sm-1">
                                <div class="thumb-info-caption-text">
                                    <h2 class="d-block line-height-2 text-4 text-dark font-weight-bold mt-1 mb-0">
                                        <a href="blog-post.html" class="text-decoration-none text-color-dark"><?php echo $resultQuery['NP_TITLE'] ?></a>
                                    </h2>
                                    <p style="font-size:12px;color:grey">Post Date : <?php echo $resultQuery['NP_POSTDATE']; ?></p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row pb-1 pt-2">

            <div class="col-md-9">

                <div class="heading heading-border heading-middle-border">
                    <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-light py-2 bg-secondary">Gadgets</strong></h3>
                </div>

                <div class="row pb-1">

                    <div class="col-lg-6 mb-4 pb-1">
                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-67.jpg" class="img-fluid border-radius-0" alt="Why should I buy a smartwatch?">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Why should I buy a smartwatch?</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-6">

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-47.jpg" class="img-fluid border-radius-0" alt="Gadgets That Make Your Smartphone Even Smarter">
                                    </a>
                                </div>
                                <div class="col-sm-8 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Gadgets That Make Your Smartphone Even Smarter</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-68.jpg" class="img-fluid border-radius-0" alt="The best augmented reality smartglasses">
                                    </a>
                                </div>
                                <div class="col-sm-7 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">The best augmented reality smartglasses</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-67.jpg" class="img-fluid border-radius-0" alt="Why should I buy a smartwatch?">
                                    </a>
                                </div>
                                <div class="col-sm-7 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Why should I buy a smartwatch?</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="heading heading-border heading-middle-border">
                    <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-light py-2 bg-tertiary">Lifestyle</strong></h3>
                </div>

                <div class="row pb-1">

                    <div class="col-lg-6 mb-4 pb-1">
                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-49.jpg" class="img-fluid border-radius-0" alt="The Best Way to Ride a Motorcycle">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">The Best Way to Ride a Motorcycle</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-6">

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-50.jpg" class="img-fluid border-radius-0" alt="5 Fun Things to Do at the Beach">
                                    </a>
                                </div>
                                <div class="col-sm-7 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">5 Fun Things to Do at the Beach</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-51.jpg" class="img-fluid border-radius-0" alt="Amazingly Fresh Fruit And Herb Drinks For Summer">
                                    </a>
                                </div>
                                <div class="col-sm-7 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Amazingly Fresh Fruit And Herb Drinks For Summer</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-52.jpg" class="img-fluid border-radius-0" alt="The 20 Best Appetizers with 5 Ingredients">
                                    </a>
                                </div>
                                <div class="col-sm-7 pl-sm-0">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">The 20 Best Appetizers with 5 Ingredients</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>


            </div>

            <div class="col-md-3">

                <h3 class="font-weight-bold text-3 pt-1">Featured Posts</h3>

                <div class="pb-2">

                    <div class="mb-4 pb-2">
                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-65.jpg" class="img-fluid border-radius-0" alt="Main Reasons To Stop Texting And Driving">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Main Reasons To Stop Texting And Driving</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="mb-4 pb-2">
                        <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/default/blog-66.jpg" class="img-fluid border-radius-0" alt="Tips to Help You Quickly Prepare your Lunch">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Tips to Help You Quickly Prepare your Lunch</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="section section-secondary border-0 py-0 m-0 appear-animation" data-appear-animation="fadeIn">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between pb-5 pb-lg-0">
                <div class="col-lg-5 order-2 order-lg-1 pt-4 pt-lg-0 pb-5 pb-lg-0 mt-5 mt-lg-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                    <h2 class="font-weight-bold text-color-light text-7 mb-2">Who We Are</h2>
                    <p class="lead font-weight-light text-color-light text-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit massa enim. Nullam id varius nunc.</p>
                    <p class="font-weight-light text-color-light text-2 mb-4 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc. Vivamus bibendun magna ex, et faucibus lacus venenatis eget</p>
                    <a href="#" class="btn btn-dark-scale-2 btn-px-5 btn-py-2 text-2">LEARN MORE</a>
                </div>
                <div class="col-9 offset-lg-1 col-lg-5 order-1 order-lg-2 scale-2">
                    <img class="img-fluid box-shadow-3 my-2 border-radius" src="<?php echo base_url() ?>assets/frontEnd/img/gallery/gallery-1.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="section section-height-4 bg-color-grey-scale-1 border-0 m-0 pb-5">
        <div class="container">
            <div class="row justify-content-center my-4">
                <div class="col appear-animation" data-appear-animation="fadeInUpShorter">
                    <div class="owl-carousel owl-theme nav-bottom rounded-nav" data-plugin-options="{'items': 1, 'loop': true, 'autoHeight': true}">
                        <div>
                            <div class="col">
                                <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                    <div class="testimonial-author">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/clients/client-1.jpg" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <blockquote>
                                        <p class="text-color-dark text-5 line-height-5">Your time is limited, so don’t waste it living someone else’s life. Don’t be trapped by dogma - which is living with the results of other people’s thinking. Don’t let the noise of others’ opinions drown out your own inner voice.</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <p class="opacity-10"><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col">
                                <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                    <div class="testimonial-author">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/clients/client-1.jpg" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <blockquote>
                                        <p class="text-color-dark text-5 line-height-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce ante tellus, convallis non consectetur sed, pharetra nec ex.</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <p class="opacity-10"><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col">
                                <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                    <div class="testimonial-author">
                                        <img src="<?php echo base_url() ?>assets/frontEnd/img/clients/client-1.jpg" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <blockquote>
                                        <p class="text-color-dark text-5 line-height-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <p class="opacity-10"><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row py-5 my-5">
            <div class="col">

                <div class="owl-carousel owl-theme mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 5}, '992': {'items': 7}, '1200': {'items': 7}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-1.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-2.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-3.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-5.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-6.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="<?php echo base_url() ?>assets/frontEnd/img/logos/logo-2.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
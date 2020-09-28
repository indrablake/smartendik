<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/animate/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/simple-line-icons/css/simple-line-icons.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/owl.carousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/owl.carousel/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/magnific-popup/magnific-popup.min.css">
<div role="main" class="main">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-9">
                <div class="owl-carousel owl-theme nav-inside" data-plugin-options="{'items': 1, 'autoplay': true, 'autoplayTimeout': 4000, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                    <div>
                        <div class=" border-0 p-0 d-block">
                            <div <?php $fileImage = base_url('uploads/Berita/ca966be60d61efe28c9aa9306137aeb1.jpg') ?> style=" background-image: url('<?php echo $fileImage; ?>');height:320px;background-size: cover;  width: 100%;" alt="">
                                <div style="position: absolute;bottom:20px;left:20px">
                                    <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0">
                                        Pokjawas PAI Jawa Tengah, Mengawali Sosialisasi Aplikasi Simpinter</h2>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="border-0 p-0 d-block">
                            <div <?php $fileImage = base_url('uploads/Berita/421449aa6a5c2c408b41cfcc522d2d9b.jpg') ?> style=" background-image: url('<?php echo $fileImage; ?>');height:320px;background-size: cover;  width: 100%;" alt="">
                                <div style="position: absolute;bottom:20px;left:20px">
                                    <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0">
                                        Rakor Pokjawas PAI, Mantapkan Pengawalan Mutu Era Pandemi Covid 19</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                    <div class="row">
                        <div class="col" style="text-align: center;">
                            <img src="http://pokjawaspai.org/media_library/images/913f3e39372954e3623e6568a8822b05.jpg" style="width:100%;" class="border-radius-0" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="thumb-info-caption-text">
                                <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                    Pokjawas PAI Nasional
                                </h4>
                                <div class="d-inline-block text-default text-1 mt-2 float-none">
                                    Kecepatan dan kemudahan akses informasi dalam era digital suatu kenyataan yang berdampak pada perubahan pola hidup manusia saat ini termasuk…
                                </div>
                                <a href="<?php echo base_url() ?>Welcome/detailProfile" class="btn btn-success btn-sm">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="row pb-1 pt-2">
                <div class="col-md-9">
                    <div class="heading heading-border heading-middle-border">
                        <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-dark py-2 bg-tertiary">Berita Terbaru</strong></h3>
                    </div>
                    <div class="row pb-1">
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php $queryRowBerita1 = $this->db->query("SELECT *from dat_berita ORDER BY berita_kd DESC LIMIT 1")->row(); ?>
                            <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                <div class="row">
                                    <div class="col">
                                        <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRowBerita1->berita_kd ?>">
                                            <img src="<?php echo base_url() ?>uploads/berita/<?php echo $queryRowBerita1->berita_gambar ?>" class="img-fluid border-radius-0" alt="<?php echo $queryRowBerita1->berita_judul; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRowBerita1->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($queryRowBerita1->berita_tgl_kirim)); ?></a>
                                            </div>
                                            <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-1">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRowBerita1->berita_kd ?>" class="text-decoration-none text-color-dark"><?php echo $queryRowBerita1->berita_judul; ?></a>
                                            </h4>
                                            <?php
                                            $num_char = 150;
                                            $cut_text = substr($queryRowBerita1->berita_isi, 0, $num_char);
                                            if ($queryRowBerita1->berita_isi{
                                                $num_char - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                                $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                                $cut_text = substr($queryRowBerita1->berita_isi, 0, $new_pos);
                                            }
                                            ?>
                                            <?php echo $cut_text . '...'; ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-lg-6">
                            <?php $queryResult = $this->db->query("SELECT *FROM dat_berita   ORDER BY berita_kd DESC LIMIT 4 OFFSET 1")->result_array() ?>
                            <?php foreach ($queryResult as $result) : ?>
                                <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                    <div class="row align-items-center pb-1">
                                        <div class="col-sm-4">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>">
                                                <img src="<?php echo base_url() ?>uploads/berita/<?php echo $result['berita_gambar']; ?>" class="img-fluid border-radius-0" alt="<?php echo $result['berita_judul']; ?>">
                                            </a>
                                        </div>
                                        <div class="col-sm-8 pl-sm-0">
                                            <div class="thumb-info-caption-text">
                                                <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>" class="text-decoration-none text-color-dark"><?php echo $result['berita_judul']; ?></a>
                                                </h4>
                                                <div class="d-inline-block text-default text-1 float-none">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($result['berita_tgl_kirim'])); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="heading heading-border heading-middle-border">
                        <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-dark py-2 bg-tertiary">Berita Terpopuler</strong></h3>
                    </div>

                    <div class="row pb-1">
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php $queryRow = $this->db->query("SELECT *FROM dat_berita   ORDER BY berita_kd DESC LIMIT 1 OFFSET 5")->row(); ?>
                            <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                <div class="row">
                                    <div class="col">
                                        <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                            <img src="<?php echo base_url() ?>uploads/berita/<?php echo $queryRow->berita_gambar ?>" class="img-fluid border-radius-0" alt="<?php echo $queryRow->berita_judul; ?>">

                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($queryRow->berita_tgl_kirim)); ?></a>
                                            </div>
                                            <?php
                                            $num_char = 150;
                                            $cut_text = substr($queryRow->berita_isi, 0, $num_char);
                                            if ($queryRow->berita_isi{
                                                $num_char - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                                $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                                $cut_text = substr($queryRow->berita_isi, 0, $new_pos);
                                            }
                                            ?>
                                            <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-dark"><?php echo $queryRow->berita_judul; ?></a>
                                            </h4>
                                            <p class="mb-0"><?php echo $cut_text; ?></p>

                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php $queryResult = $this->db->query("SELECT *FROM dat_berita   ORDER BY berita_kd DESC LIMIT 4 OFFSET 6")->result_array() ?>
                            <?php foreach ($queryResult as $result) : ?>
                                <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                    <div class="row align-items-center pb-1">
                                        <div class="col-sm-4">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>">
                                                <img src="<?php echo base_url() ?>uploads/berita/<?php echo $result['berita_gambar']; ?>" class="img-fluid border-radius-0" alt="<?php echo $result['berita_judul']; ?>">
                                            </a>
                                        </div>
                                        <div class="col-sm-8 pl-sm-0">
                                            <div class="thumb-info-caption-text">
                                                <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>" class="text-decoration-none text-color-dark"><?php echo $result['berita_judul']; ?></a>
                                                </h4>
                                                <div class="d-inline-block text-default text-1 float-none">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($result['berita_tgl_kirim'])); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="heading heading-border heading-middle-border">
                        <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-dark py-2 bg-quaternary">Berita Terkini</strong></h3>
                    </div>

                    <div class="row pb-1">
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php $queryRow = $this->db->query("SELECT *FROM dat_berita   ORDER BY berita_kd DESC LIMIT 1 OFFSET 9")->row(); ?>
                            <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                <div class="row">
                                    <div class="col">
                                        <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                            <img src="<?php echo base_url() ?>uploads/berita/<?php echo $queryRow->berita_gambar ?>" class="img-fluid border-radius-0" alt="<?php echo $queryRow->berita_judul; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($queryRow->berita_tgl_kirim)); ?></a>
                                            </div>
                                            <?php
                                            $num_char2 = 150;
                                            $cut_text = substr($queryRow->berita_isi, 0, $num_char2);
                                            if ($queryRow->berita_isi{
                                                $num_char2 - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                                $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                                $cut_text = substr($queryRow->berita_isi, 0, $new_pos);
                                            }
                                            ?>
                                            <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-dark"><?php echo $queryRow->berita_judul; ?></a>
                                            </h4>
                                            <p class="mb-0"><?php echo $cut_text; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php $queryResult = $this->db->query("SELECT *FROM dat_berita   ORDER BY berita_kd DESC LIMIT 4 OFFSET 10")->result_array() ?>
                            <?php foreach ($queryResult as $result) : ?>
                                <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                    <div class="row align-items-center pb-1">
                                        <div class="col-sm-4">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>">
                                                <img src="<?php echo base_url() ?>uploads/berita/<?php echo $result['berita_gambar']; ?>" class="img-fluid border-radius-0" alt="<?php echo $result['berita_judul']; ?>">
                                            </a>
                                        </div>
                                        <div class="col-sm-8 pl-sm-0">
                                            <div class="thumb-info-caption-text">
                                                <div class="d-inline-block text-default text-1 float-none">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($result['berita_tgl_kirim'])); ?></a>
                                                </div>
                                                <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $result['berita_kd']; ?>" class="text-decoration-none text-color-dark"><?php echo $result['berita_judul']; ?></a>
                                                </h4>

                                            </div>
                                        </div>
                                    </div>

                                </article>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">

                    <h3 class="font-weight-bold text-3 pt-1">Iklan Terbaru</h3>

                    <div class="pb-2">
                        <?php $queryIklan = $this->db->query("SELECT *FROM dat_iklan where iklan_status='1' ORDER BY iklan_kd DESC LIMIT 4 ")->result_array() ?>
                        <?php foreach ($queryIklan as $iklan) : ?>
                            <div class="mb-4 pb-2">
                                <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                    <div class="row">
                                        <div class="col" style="text-align: center;">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                                <?php
                                                $kdIklan = $iklan['iklan_kd'];
                                                $queryImage = $this->db->query("SELECT *FROM dat_iklan_gambar where iklan_kd='$kdIklan' LIMIT 1")->row() ?>
                                                <img src="<?php echo base_url() ?>uploads/imageIklan/<?php echo trim($queryImage->iklan_gambar_link); ?>" style="width:100px;" class="border-radius-0" alt="<?php echo $iklan['iklan_judul']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="thumb-info-caption-text">
                                                <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($iklan['iklan_tgl_kirim'])); ?></a>
                                                </div>
                                                <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="text-decoration-none text-color-dark"><?php echo $iklan['iklan_judul']; ?></a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            </div>
                        <?php endforeach; ?>

                    </div>


                </div>
            </div>
            <!-- <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar">
                    <form action="page-search-results.html" method="get">
                        <div class="input-group mb-3 pb-1">
                            <input class="form-control text-1" placeholder="Search..." name="s" id="s" type="text">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
                            </span>
                        </div>
                    </form>

                    <div class="tabs tabs-dark mb-4 pb-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Berita</a></li>
                            <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Iklan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="popularPosts">
                                <ul class="simple-post-list">

                                    <?php $result = $this->db->query("SELECT *FROM dat_berita ORDER BY berita_kd DESC LIMIT 3 OFFSET 0 ")->result_array();
                                    foreach ($result as $resultQuery) :
                                    ?>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                    <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                                        <img src="<?php echo base_url() ?>uploads/Berita/<?php echo $resultQuery['berita_gambar'] ?>" width="50" height="50" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>"><?php echo $resultQuery['berita_judul'] ?></a>
                                                <div class="post-meta">
                                                    Nov 10, 2018
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="tab-pane" id="recentPosts">
                                <ul class="simple-post-list">
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                                    <img src="<?php echo base_url() ?>assets/frontEnd/img/blog/square/blog-24.jpg" width="50" height="50" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">Vitae Nibh Un Odiosters</a>
                                            <div class="post-meta">
                                                Nov 10, 2018
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                                    <img src="img/blog/square/blog-42.jpg" width="50" height="50" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">Odiosters Nullam Vitae</a>
                                            <div class="post-meta">
                                                Nov 10, 2018
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">
                                                    <img src="img/blog/square/blog-11.jpg" width="50" height="50" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>">Nullam Vitae Nibh Un Odiosters</a>
                                            <div class="post-meta">
                                                Nov 10, 2018
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h5 class="font-weight-bold pt-4">About Us</h5>
                    <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p>
                </aside>
            </div>
            <div class="col-lg-6">
                <div class="blog-posts">
                    <?php $result = $this->db->query("SELECT *FROM dat_berita ORDER BY berita_kd DESC LIMIT 3 OFFSET 0 ")->result_array();
                    foreach ($result as $resultQuery) :
                    ?>
                        <article class="post post-large">
                            <div class="post-image">
                                <a href="bl og-post.html">
                                    <img src="<?php echo base_url() ?>uploads/Berita/<?php echo $resultQuery['berita_gambar'] ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                </a>
                            </div>

                            <div class="post-date">
                                <span class="day">10</span>
                                <span class="month">Jan</span>
                            </div>

                            <div class="post-content">

                                <h2 class="font-weight-semibold text-6 line-height-3 mb-3"><a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>"><?php echo $resultQuery['berita_judul'] ?></a></h2>

                                <p class="mb-0 text-1 line-height-9 mb-1 mt-2 "><?php echo $resultQuery['berita_isi'] ?></p>

                                <div class="post-meta">
                                    <span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
                                    <span><i class="far fa-folder"></i> <a href="#">Lifestyle</a>, <a href="#">Design</a> </span>
                                    <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
                                    <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                                </div>

                            </div>
                        </article>
                    <?php endforeach; ?>


                    <ul class="pagination float-right">
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                    </ul>

                </div>
            </div>
            <div class="col-lg-3">
                <aside class="sidebar pb-4">
                    <h5 class="font-weight-bold">Iklan Terbaru</h5>
                    <div id="tweet" class="twitter mb-4" data-plugin-tweets data-plugin-options="{'username': 'oklerthemes', 'count': 2}">
                        <p>Please wait...</p>
                    </div>
                    <?php $result = $this->db->query("SELECT *FROM dat_berita ORDER BY berita_kd DESC LIMIT 3 OFFSET 0 ")->result_array();
                    foreach ($result as $resultQuery) :
                    ?>
                        <article class="post post-large">
                            <div class="post-image">
                                <a href="bl og-post.html">
                                    <img src="<?php echo base_url() ?>uploads/Berita/<?php echo $resultQuery['berita_gambar'] ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                </a>
                            </div>


                            <div class="post-content" style="margin-left: -4em;">

                                <h4 class="line-height-3 mb-1"><a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>"><?php echo $resultQuery['berita_judul'] ?></a></h4>
                                <p class="mb-0 line-height-9 mb-1 "><?php echo substr($resultQuery['berita_isi'], 0, 100); ?></p>

                                <div class="post-meta">
                                    <span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
                                    <span><i class="far fa-folder"></i> <a href="#">Lifestyle</a>, <a href="#">Design</a> </span>
                                    <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
                                    <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $queryRow->berita_kd; ?>" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                                </div>

                            </div>
                        </article>
                    <?php endforeach; ?>
                </aside>
            </div>
        </div> -->

        </div>

    </div>
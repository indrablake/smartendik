<div class="container py-4">
    <div class="row">
        <div class="col-md-9">
            <div class="blog-posts single-post">
                <article class="post post-large blog-single-post border-0 m-0 p-0">
                    <div class="post-image ml-0">
                        <a>
                            <img src="<?php echo base_url() ?>uploads/berita/<?php echo $result->berita_gambar ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                        </a>
                    </div>

                    <div class="post-content ml-0">
                        <h2 class="font-weight-bold"><a><?php echo $result->berita_judul; ?></a></h2>
                        <div class="post-meta">
                            <span><i class="far fa-user"></i> By <a href="#">Admin</a> </span>
                            <span><i class=""></i> <a href="#"><?php echo date('M d,Y', strtotime($result->berita_tgl_kirim)); ?></a></span>
                        </div>
                        <p><?php echo $result->berita_isi; ?></p>

                        <div class="post-block mt-5 post-share">

                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style ">
                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                <a class="addthis_button_tweet"></a>
                                <a class="addthis_button_pinterest_pinit"></a>
                                <a class="addthis_counter addthis_pill_style"></a>
                            </div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                            <!-- AddThis Button END -->
                        </div>


                    </div>
                </article>
            </div>
        </div>
        <div class="col-md-3">
            <p>Berita Lainnya</p>
            <?php $queryBerita = $this->db->query("SELECT *FROM dat_berita ORDER BY berita_kd DESC LIMIT 2")->result_array() ?>
            <?php foreach ($queryBerita as $berita) : ?>
                <div class="mb-4 pb-2">
                    <article class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $berita['berita_kd']; ?>">
                                    <img src="<?php echo base_url() ?>uploads/berita/<?php echo trim($berita['berita_gambar']); ?>" class="border-radius-0" alt="<?php echo $berita['berita_judul']; ?>">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="thumb-info-caption-text">
                                    <div class="d-inline-block text-default text-1 mt-2 float-none">
                                        <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $berita['berita_kd']; ?>" class="text-decoration-none text-color-default"><?php echo date('M d, Y', strtotime($berita['berita_tgl_kirim'])); ?></a>
                                    </div>
                                    <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                        <a href="<?php echo base_url() ?>Welcome/detailBerita?id=<?php echo $berita['berita_kd']; ?>" class="text-decoration-none text-color-dark"><?php echo $berita['berita_judul']; ?></a>
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
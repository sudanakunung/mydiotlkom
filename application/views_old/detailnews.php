<?php include 'header.php'; ?>
	<section style="padding-top: 6rem;padding-bottom: 1rem;background:#9699a0;font-family: 'Open Sans', sans-serif;" >
		<div class="container section-new">
			<div class="row top-carafie">
				<div class="col-md-12 col-12" style="margin-bottom: 1rem;">
					<h1 class="post-heading"><?php echo $berita['judul'];?></h1>
					<hr>
					<span class="author-detail"><?php echo ucfirst($berita['author'])." || ".date_format(date_create($berita['created_at']), 'j M Y H:m'); ?></span>
				</div>
				<div class="col-12 no-padding">
					<img src="<?php echo base_url('plugins/kcfinder/upload/images/'.$berita['thumbnail']);?>" alt="<?php echo $berita['judul'];?>" style="width: 100%; height: auto;border-radius:4px;">
				</div>
				<div class="col-12">
					<br/>
					<?php echo $berita['artikel'];?>
				</div>
			</div>
		</div>
	</section>
	<?php include 'footer.php'; ?>
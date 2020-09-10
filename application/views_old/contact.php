<?php include 'header.php'; ?>
	<section style="padding-top: 7rem; padding-bottom: 7rem;">
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="margin-bottom: 3rem">
					<div class="m--page--title">
						<div class="m--page--title__line">
							<div class="m--page--title__line__block"></div></div>
							<h1 class="d-table-cell text-center h4"><?php echo strtoupper($this->lang->line('Contact Us'));?></h1>
						<div class="m--page--title__line">
							<div class="m--page--title__line__block"></div></div>
					</div>
				</div>
				<div class="col-md-12  no-padding" style="font-size: 18px;">
					<div class="col-md-8 offset-md-2 col-12" style="margin-bottom: 20px;">
						<b><?php echo $this->lang->line('Please use the form below to contact us regarding application-specific issues or general questions.'); ?></b>
					</div>
					
					<div class="col-md-8 offset-md-2 col-12">
						<?php if ($this->session->flashdata('pesan') != null): ?>
						<p><?php echo $this->session->flashdata('pesan') ?></p>
						<?php endif ?>
						<?php echo form_open('/submit-contact');?>
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="">Subject</label>
							<input type="text" name="subject" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="">Message</label>
							<textarea name="message" id="" cols="30" rows="10" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-lg btn-primary" value="Send e-mail">
						</div>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include 'footer.php'; ?>
</body>
</html>
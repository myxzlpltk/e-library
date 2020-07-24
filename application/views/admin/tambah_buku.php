<?= doctype('html5'); ?>
<html>
<head>
	<title>Tambah Buku</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/select2/css/select2.min.css') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 2)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
			<?= validation_errors() ?>
			<?= form_open_multipart() ?>
			<div class="row">
				<div class="col-sm-4" id="left-side">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><span class="fa fa-file-image-o"></span> Gambar Buku</h3>
						</div>
						<div class="box-body">
							<input type="file" name="file" class="btn-block" id="berkas" accept="image/*">
							<div class="preview">
							</div>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><span class="fa fa-file-pdf-o"></span> Berkas Buku</h3>
						</div>
						<div class="box-body">
							<input type="file" name="pdf" class="btn-block" accept=".pdf">
							<div class="preview">
							</div>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><span class="fa fa-file-o"></span> Lampiran</h3>
							<div class="box-tools">
								<a href="#"><i class="fa fa-file-image-o" data-toggle="tooltip" title="gambar"></i></a>
								<a href="#"><i class="fa fa-file-video-o" data-toggle="tooltip" title="video"></i></a>
								<a href="#"><i class="fa fa-file-pdf-o" data-toggle="tooltip" title="pdf"></i></a>
								<a href="#"><i class="fa fa-file-word-o" data-toggle="tooltip" title="word"></i></a>
								<a href="#"><i class="fa fa-file-excel-o" data-toggle="tooltip" title="excel"></i></a>
								<a href="#"><i class="fa fa-file-powerpoint-o" data-toggle="tooltip" title="powerpoint"></i></a>
							</div>
						</div>
						<div class="box-body">
							<input type="file" name="lampiran[]" class="btn-block" multiple="multiple" accept=".jpg,.png,.gif,.pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.mp4,.mkv">
						</div>
					</div>
				</div>
				<div class="col-sm-8" id="right-side">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><span class="fa fa-info"></span> Informasi Buku</h3>
							<div class="box-tools">
								<button type="submit" name="submit" class="btn btn-success btn-sm"><span class="fa fa-save"></span> Simpan Data</button>
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Nama Buku</label>
								<input type="text" name="nama_buku" class="form-control" placeholder="Nama buku yang di entri" value="<?= set_value('nama_buku') ?>" maxlength="100">
							</div>
							<div class="form-group">
								<label>Deskripsi Buku</label>
								<textarea name="deskripsi_buku" class="form-control" rows="7" placeholder="Deskripsi data buku yang di entri" draggable="draggable-y"><?= set_value('deskripsi_buku') ?></textarea>
							</div>
							<div class="form-group">
								<label>Kategori Buku</label>
								<select name="kategori[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Kategori" data-language="id" style="width: 100%;">
									<?php foreach ($kategori as $v) { ?>
									<option value="<?= $v->id_kategori ?>" <?= set_select('kategori[]', $v->id_kategori) ?> ><?= $v->nama_kategori ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?= form_close() ?>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/select2/js/select2.min.js') ?>
<?= script('assets/plugins/select2/js/i18n/id.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('select.select2').select2();
	})
</script>
</body>
</html>
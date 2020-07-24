<?= doctype('html5'); ?>
<html>
<head>
	<title>Edit Buku</title>
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
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="fa fa-info"></span> Informasi Buku</h3>
				</div>
				<div class="box-body">
					<?= form_open() ?>
						<input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
						<div class="form-group">
							<label>Nama Buku</label>
							<input type="text" name="nama_buku" class="form-control" placeholder="Nama buku yang di entri" value="<?= $buku['nama_buku'] ?>" maxlength="100">
						</div>
						<div class="form-group">
							<label>Deskripsi Buku</label>
							<textarea name="deskripsi_buku" class="form-control" rows="7" placeholder="Deskripsi data buku yang di entri" draggable="draggable-y"><?= $buku['deskripsi_buku'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Kategori Buku</label>
							<select name="kategori[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Kategori" data-language="id" style="width: 100%;">
								<?php foreach ($kategori as $v) { ?>
									<option value="<?= $v->id_kategori ?>" <?php foreach ($buku['kategori'] as $val) { if($v->nama_kategori==$val->kategori){echo 'selected';} } ?> ><?= $v->nama_kategori ?></option>
								<?php } ?>
							</select>
						</div>
						<button type="submit" name="submit" class="btn btn-success pull-right"><span class="fa fa-save"></span> Simpan Data</button>
					<?= form_close() ?>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/select2/js/select2.min.js') ?>
<?= script('assets/plugins/select2/js/i18n/id.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('select.select2').select2();
	})
</script>
</body>
</html>
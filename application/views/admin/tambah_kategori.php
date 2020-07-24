<?= doctype('html5'); ?>
<html>
<head>
	<title>Tambah Kategori</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 4)) ?>

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
					<h3 class="box-title">Data Kategori</h3>
				</div>
				<div class="box-body">
					<?= form_open() ?>
						<div class="form-group">
							<label>Nama Kategori</label>
							<input type="text" name="nama_kategori" class="form-control" placeholder="contoh: Novel, Majalah" value="<?= set_value('nama_kategori') ?>">
						</div>
						<input type="submit" name="submit" class="btn btn-primary pull-right" value="Tambahkan Data">
					<?= form_close() ?>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
</body>
</html>
<?= doctype('html5'); ?>
<html>
<head>
	<title>Laporan</title>
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
	<?php $this->load->view('admin/side', array('menu' => 5)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?php flash() ?>
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-orange">
						<div class="inner">
							<i class="fa fa-clock-o fa-4x"></i>
							<h4>Log</h4>
						</div>
						<div class="icon">
							<i class="fa fa-clock-o"></i>
						</div>
						<a href="<?= base_url('admin/laporan/log') ?>" class="small-box-footer" data-toggle="tooltip" title="Catatan log aplikasi">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-purple">
						<div class="inner">
							<i class="fa fa-qrcode fa-4x"></i>
							<h4>Kode Verifikasi</h4>
						</div>
						<div class="icon">
							<i class="fa fa-qrcode"></i>
						</div>
						<a href="<?= base_url('admin/laporan/kode') ?>" class="small-box-footer" data-toggle="tooltip" title="Kode Verifikasi User">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-blue">
						<div class="inner">
							<i class="fa fa-search fa-4x"></i>
							<h4>Pencarian</h4>
						</div>
						<div class="icon">
							<i class="fa fa-search"></i>
						</div>
						<a href="<?= base_url('admin/laporan/pencarian') ?>" class="small-box-footer" data-toggle="tooltip" title="Riwayat Pencarian">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-green">
						<div class="inner">
							<i class="fa fa-bar-chart fa-4x"></i>
							<h4>Statistik</h4>
						</div>
						<div class="icon">
							<i class="fa fa-bar-chart"></i>
						</div>
						<a href="<?= base_url('admin/laporan/statistik') ?>" class="small-box-footer" data-toggle="tooltip" title="Laporan Statistik">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<h3>Alat Pengembang</h3>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-red">
						<div class="inner">
							<i class="fa fa-hdd-o fa-4x"></i>
							<h4>Ruang Unggahan</h4>
						</div>
						<div class="icon">
							<i class="fa fa-hdd-o"></i>
						</div>
						<a href="<?= base_url('admin/laporan/ruang_unggahan') ?>" class="small-box-footer" data-toggle="tooltip" title="Status dan Informasi">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="small-box bg-maroon">
						<div class="inner">
							<i class="fa fa-bug fa-4x"></i>
							<h4>Error &amp; Bug</h4>
						</div>
						<div class="icon">
							<i class="fa fa-bug"></i>
						</div>
						<a href="<?= base_url('admin/laporan/error') ?>" class="small-box-footer" data-toggle="tooltip" title="Daftar Error dan Bug">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
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
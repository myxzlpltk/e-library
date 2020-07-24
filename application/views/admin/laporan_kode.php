<?= doctype('html5'); ?>
<html>
<head>
	<title>Rekap Kode Verifikasi</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/plugins/datatables/css/dataTables.bootstrap.min.css') ?>
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
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>

			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= $kode[0] ?></h3>
							<p>Kode belum diverifikasi</p>
						</div>
						<div class="icon">
							<i class="fa fa-question"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-maroon">
						<div class="inner">
							<h3><?= $kode[1] ?></h3>
							<p>Kode diverifikasi</p>
						</div>
						<div class="icon">
							<i class="fa fa-check"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-olive">
						<div class="inner">
							<h3><?= $kode[2] ?></h3>
							<p>Kode dibatalkan klien</p>
						</div>
						<div class="icon">
							<i class="fa fa-user"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3><?= $kode[3] ?></h3>
							<p>Kode dibatalkan sistem</p>
						</div>
						<div class="icon">
							<i class="fa fa-server"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Kode Verifikasi</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable serverSide" data-ajax="<?= base_url('admin/laporan/get_kode') ?>">
						<thead>
							<tr>
								<th>ID</th>
								<th>Kode</th>
								<th>Batas Waktu</th>
								<th>Tipe</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>
<?= script('assets/plugins/datatables/js/dataTables.bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
</body>
</html>
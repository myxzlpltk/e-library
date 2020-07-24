<?= doctype('html5'); ?>
<html>
<head>
	<title>Data Buku</title>
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
	<?php $this->load->view('admin/side', array('menu' => 2)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?php flash() ?>
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Daftar Buku</h3>
					<div class="box-tools pull-right">
						<div class="btn-group">
							<a href="<?= base_url('admin/buku/tambah') ?>" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Tambah Buku</a>
							<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= base_url('admin/buku/impor') ?>"><span class="fa fa-upload"></span> Import Buku</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable serverSide" data-ajax="<?= base_url('admin/buku/get_data') ?>">
						<thead>
							<tr>
								<th>ID</th>
								<th>Gambar</th>
								<th>Judul</th>
								<th>Deskripsi</th>
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
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
</body>
</html>
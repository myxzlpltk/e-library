<?= doctype('html5'); ?>
<html>
<head>
	<title>Informasi Buku</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/datatables/css/dataTables.bootstrap.min.css') ?>
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

			<div class="row">
				<div class="col-md-3">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Buku</h3>
							<div class="box-tools">
								<div class="btn-group">
									<a href="<?= base_url('buku/lihat/'.$id) ?>" class="btn btn-primary btn-sm" target="_blank"><span class="fa fa-eye"></span> Pratinjau</a>
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right" role="menu">
										<li><a href="#" data-toggle="modal" data-target="#perbaruiGambar"><span class="fa fa-file-image-o"></span> Perbarui Gambar</a></li>
										<li><a href="#" data-toggle="modal" data-target="#perbaruiFile"><span class="fa fa-file-pdf-o"></span> Perbarui File</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="box-body">
							<img src="<?= cover($buku['file_buku']) ?>" class="img-responsive img-thumbnail center-block" data-toggle="modal" data-target="#coverBuku">
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li><a href="#">Diunduh <span class="pull-right badge bg-blue"><?= array_sum(array_column($unduh, 'jumlah')) ?> Kali</span></a></li>
								<li><a href="#">Ukuran <span class="pull-right badge bg-aqua"><?= byte_format($file['size']) ?></span></a></li>
							</ul>
						</div>
					</div>

					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><?= count($buku['lampiran']) ?> Lampiran</h3>
							<div class="box-tools">
								<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahLampiran"><span class="fa fa-plus"></span> Tambah</a>
							</div>
						</div>
						<div class="box-footer no-padding">
							<?php if(count($buku['lampiran'])>0){ ?>
							<p></p>
							<p class="text-center"><em>Klik untuk menghapus</em></p>
							<?php } ?>
							<ul class="nav nav-stacked">
								<?php foreach ($buku['lampiran'] as $value) { ?>
								<?php if(file_exists(lampiranpath($buku['id_buku'],$value->file_lampiran))){ ?>
									<?php $lpr_info = get_file_info(lampiranpath($buku['id_buku'],$value->file_lampiran)) ?>
									<li class="lampiran" data-file="<?= $value->file_lampiran ?>" data-id="<?= $value->id_lampiran ?>" style="word-break: break-all;"><a href="#"><?= $value->file_lampiran ?> <span class="badge bg-aqua"><?= byte_format($lpr_info['size']) ?></span></a></li>
								<?php } ?>
								<?php } ?>
								<?php if(count($buku['lampiran']) == 0){ ?>
								<li><a href="#">Tidak ada lampiran</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Informasi Buku</h3>
							<div class="box-tools pull-right">
								<div class="btn-group">
									<a href="<?= base_url('buku/baca/'.$id) ?>" class="btn btn-primary btn-sm" target="_blank"><span class="fa fa-eye"></span> Baca</a>
									<a href="<?= base_url('admin/buku/unduh/'.$buku['id_buku']) ?>" class="btn btn-success btn-sm"><span class="fa fa-download"></span> Unduh</a>
									<a href="<?= base_url('admin/buku/edit/'.$buku['id_buku']) ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit"></span> Edit</a>
									<button class="btn btn-danger btn-sm hapusBuku" data-buku="<?= $buku['id_buku'] ?>"><span class="fa fa-trash"></span> Hapus</button>
								</div>
							</div>
						</div>
						<div class="box-body">
							<dl class="dl-horizontal">
								<dt>Judul</dt>
								<dd><?= $buku['nama_buku'] ?></dd>
								<dt>Deskripsi</dt>
								<dd><?= $buku['deskripsi_buku'] ?></dd>
								<dt>Kategori</dt>
								<dd>
									<?php foreach ($buku['kategori'] as $val) { ?>
									<a href="<?= base_url('admin/kategori/lihat/'.$val->id) ?>" class="label label-primary"><i class="fa fa-tag"></i> <?= $val->kategori ?></a>
									<?php } ?>
								</dd>
								<dt>Tanggal Unggah</dt>
								<dd><?= fix_date($buku['tanggal_unggah'], true) ?></dd>
								<dt>File Gambar</dt>
								<dd><?= $buku['file_buku'] ?></dd>
								<dt>File PDF</dt>
								<dd><?= $buku['file_pdf'] ?></dd>
							</dl>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Pengunduh Buku</h3>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered dataTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Jumlah Unduh</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($unduh as $no => $key) { ?>
									<tr>
										<td><?= $no+1 ?></td>
										<td><?= $key['nama_user'] ?></td>
										<td><?= $key['username'] ?></td>
										<td><?= $key['jumlah'] ?> Kali</td>
										<td>
											<a href="<?= base_url('admin/user/lihat/'.$key['id_user']) ?>" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> Lihat</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Pembaca Buku</h3>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered dataTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Jumlah Baca</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($baca as $no => $key) { ?>
									<tr>
										<td><?= $no+1 ?></td>
										<td><?= $key['nama_user'] ?></td>
										<td><?= $key['username'] ?></td>
										<td><?= $key['jumlah'] ?> Kali</td>
										<td>
											<a href="<?= base_url('admin/user/lihat/'.$key['id_user']) ?>" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> Lihat</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>

	<div class="modal fade" id="perbaruiGambar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<?= form_open_multipart('admin/buku/edit_sampul/'.$buku['id_buku']) ?>
				<div class="modal-header bg-blue">
					<h5 class="modal-title text-center">Perbarui Gambar</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="preview"></div>
						<input type="file" name="file" class="form-control" accept="image/*" id="berkas">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Perbarui Gambar</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="coverBuku" tabindex="-1" role="dialog">
		<div class="container">
			<button type="button" class="close" data-dismiss="modal"><h3 style="color: white;font-size: 36px;">&times;</h3></button>
			<br><br>
			<img src="<?= cover($buku['file_buku']) ?>" class="img-responsive center-block">
		</div>
	</div>

	<div class="modal fade" id="perbaruiFile" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<?= form_open_multipart('admin/buku/edit_berkas/'.$buku['id_buku']) ?>
				<div class="modal-header bg-blue">
					<h5 class="modal-title text-center">Perbarui File</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="preview"></div>
						<input type="file" name="pdf" class="form-control" accept=".pdf" id="berkas">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Perbarui File</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="tambahLampiran" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<?= form_open_multipart('admin/buku/tambah_lampiran/'.$buku['id_buku']) ?>
				<div class="modal-header bg-blue">
					<h5 class="modal-title text-center">Tambah Lampiran</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="file" name="lampiran[]" class="form-control" multiple="multiple" id="berkas" accept=".jpg,.png,.gif,.pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.mp4,.mkv">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Tambah Lampiran</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>
<?= script('assets/plugins/datatables/js/dataTables.bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function(){

		$('li.lampiran').click(function(event) {
			swal({
				title: "Apakah anda yakin?",
				text: "Berkas "+$(this).data('file')+" akan dihapus dan tidak dapat dikembalikan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete) {
					location.assign('<?= base_url('admin/buku/hapus_lampiran/') ?>'+$(this).data('id'));
				}
			});
		});

		$('.hapusBuku').click(function(event){
			swal({
				title: "Apakah anda yakin?",
				text: "Buku akan dihapus dan tidak dapat dikembalikan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: '<?= base_url('admin/buku/hapus/'.$buku['id_buku']) ?>',
						dataType: 'json',
						success: function(result,status,xhr){
							swal('Buku berhasil dihapus!', {
								icon: "success",
							})
							.then(function(){
								location.assign('<?= base_url('admin/buku/') ?>');
							});
						},
						error: function(xhr,status,error){
							swal('Buku gagal dihapus! Silahkan coba lagi nanti.', {
								icon: "error",
							});
						}
					});
				}
			});
		})
	});

</script>
</body>
</html>
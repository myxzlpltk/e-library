<?= doctype('html5'); ?>
<html>
<head>
	<title>Informasi Kategori</title>
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
	<?php $this->load->view('admin/side', array('menu' => 4)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?php flash() ?>
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Buku Kategori <?= $kategori->nama_kategori ?></h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-warning btn-sm" id="editKategori"><span class="fa fa-edit"></span> Edit</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable serverSide" data-ajax="<?= base_url('admin/kategori/get_data/'.$kategori->id_kategori) ?>">
						<thead>
							<tr>
								<th>ID</th>
								<th>Judul</th>
								<th>Deskripsi</th>
								<th>Waktu</th>
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
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/plugins/moment/moment.min.js') ?>
<?= script('assets/plugins/moment/id.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>
<?= script('assets/plugins/datatables/js/dataTables.bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#editKategori').click(function(){
			swal("Nama Kategori", {
				content: 'input',
				buttons: true,
				dangerMode: true
			})
			.then((value) => {
				if(value!=null){
					if(value==''){
						swal('Kamu harus mengisi kolom');
					}
					else{
						$.ajax({
							url: '<?= base_url('admin/kategori/edit/'.$kategori->id_kategori) ?>',
							data: {
								nama_kategori: value
							},
							method: 'post',
							dataType: 'json',
							success: function(result,status,xhr){
								location.reload(true);
							},
							error: function(xhr,status,error){
								swal('Password gagal diperbaharui! Silahkan coba lagi nanti.', {
									icon: "error",
								});
							}
						});
					}
				}
			});
		});
	});
</script>
</body>
</html>
<?= doctype('html5'); ?>
<html>
<head>
	<title>Konfigurasi Slider</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/bootstrap/css/bootstrap-grid.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/plugins/sortable/css/jquery-ui.min.css') ?>
	<?= link_tag('assets/plugins/sortable/css/jquery-ui.theme.min.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 10)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
			<div class="callout callout-info">
				<p>Seret kotak untuk mengubah urutan slider</p>
			</div>
			<div class="row" id="sortable">
				<?php foreach ($slider as $key => $value) { ?>
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6" style="margin-bottom: 10px;" data-id="<?= $value->id_slider ?>">
					<div class="box box-primary" style="margin-bottom: 0;height: 100%;">
						<div class="box-header with-border" style="cursor: move;">
							<h5 class="box-title"><span class="fa fa-arrows"></span></h5>
							<div class="box-tools pull-right">
								<a href="#" class="btn btn-danger btn-sm deleteSlider" data-id="<?= $value->id_slider ?>"><span class="fa fa-trash"></span></a>
							</div>
						</div>
						<div class="box-body droptarget">
							<?php if($value->tipe_slider=='image'){ ?>
							<img src="<?= base_url('home/slider/'.$value->file_slider) ?>" class="img-responsive dragtarget" id="<?= $value->id_slider ?>">
							<?php }else{ ?>
							<p class="text-center"><b>Video</b></p>
							<a href="<?= $value->file_slider ?>" class="text-center btn-link" style="word-break: break-all;" target="_blank">
								<p><span class="fa fa-video-camera fa-4x"></span></p>
								<p><?= $value->file_slider ?></p>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tambahSlider"><span class="fa fa-plus"></span> Tambah Slider</button>
			<button type="button" id="saveSlider" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>

	<div class="modal fade" id="tambahSlider" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<?= form_open_multipart('admin/konfigurasi/tambah_slider/') ?>
				<div class="modal-header bg-blue">
					<h5 class="modal-title text-center">Tambah Slider</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="tipe_slider" value="image">
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a data-toggle="tab" href="#image">Gambar</a></li>
						<li><a data-toggle="tab" href="#video">Video</a></li>
					</ul>

					<div class="tab-content">
						<div id="image" class="tab-pane fade in active">
							<br>
							<div class="form-group">
								<div class="preview"></div>
								<input type="file" name="file" class="form-control" accept="image/*" id="berkas">
							</div>
						</div>
						<div id="video" class="tab-pane fade">
							<br>
							<div class="form-group">
								<input type="text" name="url" class="form-control" placeholder="URL youtube">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Tambah Slider</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/sortable/js/jquery-ui.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script>
	$(document).ready(function(){
		// $('#tambahSlider').modal('show');
		$('.nav-tabs a').on('shown.bs.tab', function(event){
			var x = $(event.target).text();
			if(x=='Gambar'){
				$('input[name="url"]').val(null);
				$('input[name="tipe_slider"]').val('image');
				$('.preview').html(null);
			}
			else if(x=='Video'){
				$('input[name="file"]').val(null);
				$('input[name="tipe_slider"]').val('video');
			}
			else{

			}
		});

		$( "#sortable" ).sortable({
			placeholder : 'sort-highlight',
			connectWith : '.connectedSortable',
			handle : '.box-header',
			forcePlaceholderSize : true,
			zIndex : 999999,
			cursor: 'move',
		});
		$('#saveSlider').click(function(){
			var data = [];
			$('#sortable').children().each(function(index){
				data[index] = {
					id_slider: $(this).data('id'),
					urutan_slider: index+1
				}
			});
			$.ajax({
				url: '<?= base_url('admin/konfigurasi/update_slider') ?>',
				dataType: 'json',
				data: {
					data: data
				},
				method: 'post',
				success: function(result,xhr,status){
					swal('Berhasil!',{
						icon: 'success'
					});
				},
				error: function(xhr,status,error){
					swal('Gagal!',{
						icon: 'error'
					});
				}
			})
		})

		$('.deleteSlider').click(function(){
			var slider = $(this);
			swal({
				title: "Apakah anda yakin?",
				text: "Slider akan dihapus dan tidak dapat dikembalikan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: '<?= base_url('admin/konfigurasi/hapus_slider/') ?>'+$(this).data('id'),
						dataType: 'json',
						success: function(result,status,xhr){
							$(slider).parents('.col-6').remove();
							swal('Slider berhasil dihapus!', {
								icon: "success",
							})
						},
						error: function(xhr,status,error){
							swal('Slider gagal dihapus! Silahkan coba lagi nanti.', {
								icon: "error",
							});
						}
					});
				}
			});
		})
	})
</script>
</body>
</html>
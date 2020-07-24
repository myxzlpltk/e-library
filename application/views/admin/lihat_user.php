<?= doctype('html5'); ?>
<html>
<head>
	<title>Informasi User</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
    <?= link_tag('assets/plugins/pace/themes/white/pace-theme-flash.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 3)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?php flash() ?>
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Informasi User</h3>
							<div class="box-tools pull-right">
								<a href="#" class="btn btn-warning btn-sm" id="gantiPassword" data-user="<?= $user->id_user ?>"><span class="fa fa-lock"></span> Ganti Password</a>
								<a href="#" class="btn btn-danger btn-sm" id="hapusUser" data-user="<?= $user->id_user ?>"><span class="fa fa-trash"></span> Hapus</a>
							</div>
						</div>
						<div class="box-body">
							<dl class="dl-horizontal">
								<dt>Nama Lengkap</dt>
								<dd><?= $user->nama_user ?></dd>
								<dt>Username</dt>
								<dd><?= $user->username ?></dd>
								<dt>Email</dt>
								<dd><?= $user->email ?></dd>
								<dt>Status Verifikasi</dt>
								<dd><?= $user->verifikasi_email==1?'Terverifikasi':'Belum Diverifikasi'; ?></dd>
								<dt>Tanggal Gabung</dt>
								<dd><span class="moment" data-time="<?= $user->tanggal_gabung ?>"></span></dd>
							</dl>
						</div>
					</div>

					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Log</h3>
						</div>
						<div class="box-body">
							<ul class="timeline timeline-inverse"></ul>
							<button class="btn btn-default center-block" id="loadMore"><span class="fa fa-refresh"></span> Load More</button>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Buku Sering Di Unduh</h3>
						</div>
						<div class="box-body no-padding">
							<ul class="nav nav-stacked">
								<?php foreach ($unduh as $no => $key){ ?>
								<li><a href="<?= base_url('admin'.$key['btn']) ?>"><?= $key['nama_buku'] ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">Buku Sering Di Baca</h3>
						</div>
						<div class="box-body no-padding">
							<ul class="nav nav-stacked">
								<?php foreach ($baca as $no => $key){ ?>
								<li><a href="<?= base_url('admin'.$key['btn']) ?>"><?= $key['nama_buku'] ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/pace/js/pace.min.js') ?>
<?= script('assets/plugins/moment/moment.min.js') ?>
<?= script('assets/plugins/moment/id.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); }); 
	$(document).ready(function(){
		$('#hapusUser').click(function(event){
			swal({
				title: "Apakah anda yakin?",
				text: "Data user akan dihapus dan tidak dapat dikembalikan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: '<?= base_url('admin/user/hapus/') ?>'+$(this).data('user'),
						dataType: 'json',
						success: function(result,status,xhr){
							swal('Data user berhasil dihapus!', {
								icon: "success",
							})
							.then(function(){
								location.assign('<?= base_url('admin/user') ?>');
							});
						},
						error: function(xhr,status,error){
							swal('Data user gagal dihapus! Silahkan coba lagi nanti.', {
								icon: "error",
							});
						}
					});
				}
			});
		});
		$('#gantiPassword').click(function(){
			swal("Password Baru", {
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
							url: '<?= base_url('admin/user/ganti/') ?>'+$(this).data('user'),
							data: {
								password: value
							},
							method: 'post',
							dataType: 'json',
							success: function(result,status,xhr){
								swal('Password berhasil diperbaharui!', {
									icon: "success",
								})
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

		loadMore();

        $(window).scroll(function(){
            if($(window).scrollTop() == $(document).height() - $(window).height()){
                loadMore();
            }
        })

        var timer;
    	var statusAjax = false;
        $('#loadMore').click(loadMore);

        function loadMore(){
        	if(!statusAjax){
	        	$.ajax({
	        		url: '<?php echo base_url('admin/user/get_user_log') ?>',
	        		type: 'post',
	        		dataType: 'json',
	        		data: {
	        			last: $('.timeline > li:not(.time-label)').last().attr('id'),
	                    id_user: <?= $user->id_user ?>,
	        		},
	        		beforeSend: function(){
	        			statusAjax = true;
            			$('#loadMore > span').addClass('fa-spin');
	        		},
	        		success: function(result,status,xhr){
	                    resultPage(result);
	                },
	                complete: function(xhr,status,error){
	        			statusAjax = false;
	                	$('#loadMore > span').removeClass('fa-spin');
	                }
	        	});
	        }
        }

        function resultPage(result){
            var html;
            $.each(result, function(){
                html = '';
                if ($('.time-label > span').last().html() != moment(this.waktu).format("DD MMM YYYY")) {
                    html += '<li class="time-label"><span class="bg-black">'+moment(this.waktu).format("DD MMM YYYY")+'</span></li>';
                }
                html += '<li id="'+this.id_log+'">';
                html += icon(this.aksi);
                html += '<div class="timeline-item">';
                html += '<span class="time" data-time="'+this.waktu+'" data-toggle="tooltip" title="'+moment(this.waktu).format('dddd, DD MMMM YYYY HH:mm:ss')+' WIB"><i class="fa fa-clock-o"></i> '+moment(this.waktu).fromNow()+'</span>';
                html += '<span class="time" data-toggle="tooltip" title="Tipe Akses" style="cursor: pointer;"><span class="badge bg-olive">'+this.rule+'</span></span>';
                html += '<h3 class="timeline-header">';
                html += '<a href="<?php echo base_url('admin/user/lihat/') ?>'+this.id_user+'">'+this.nama_user+'</a> ';
                html += this.judul+'</h3>';
                if(this.keterangan != '') {
                    html += '<div class="timeline-body">';
                    html += '<p>'+this.keterangan+'</p>';
                    if(this.btn != '') {
                        html += '<a href="<?php echo base_url('admin') ?>'+this.btn+'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Lihat</a>';
                    }
                html += '</div>';
                }
                html += '</div>'
                html += '</li>';
                $('.timeline').append(html);
            });

            setInterval(function(){
                $('[data-time]').each(function(){
                    $(this).html('<i class="fa fa-clock-o"></i> '+moment($(this).data('time')).fromNow());
                })
            }, 120000);

            $('[data-toggle="tooltip"]').tooltip();
        }

        function icon(str){
            if(str == 'login'){
                return '<i class="fa fa-sign-in bg-aqua"></i>';
            }
            else if(str == 'logout'){
                return '<i class="fa fa-sign-out bg-maroon"></i>';
            }
            else if(str == 'unduh'){
                return '<i class="fa fa-download bg-green"></i>';
            }
            else if(str == 'kategori'){
                return '<i class="fa fa-tags bg-orange"></i>';
            }
            else if(str == 'buku'){
                return '<i class="fa fa-book bg-blue"></i>';
            }
            else if(str == 'baca'){
                return '<i class="fa fa-eye bg-red"></i>';
            }
            else{
                return '<i class="fa fa-remove-o bg-gray"></i>';
            }
        }
	})
</script>
</body>
</html>
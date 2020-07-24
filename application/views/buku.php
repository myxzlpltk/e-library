<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Daftar Buku</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap/css/bootstrap-grid.min.css') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
    <?= link_tag('assets/plugins/pace/themes/white/pace-theme-flash.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body>

	<?php $this->load->view('header', array('menu'=>3)) ?>

	<main class="blue lighten-5">
		<div class="section bg-white">
			<div class="row">
				<div class="col-12">
					<?php card_flash() ?>
				</div>
				<div class="col-md-3">
					<ul class="collapsible">
						<li id="filter-box" class="white">
							<div class="collapsible-header waves-effect">
								<i class="material-icons left">filter_list</i>
								<span>Filter</span>
								<i class="material-icons right expand-icon">expand_less</i>
							</div>
							<div class="collapsible-body">
								<?= form_open('',array('method'=>'get')) ?>
									<div class="input-field">
										<i class="material-icons prefix">search</i>
										<input id="filterJudul" type="text" class="autocomplete" name="judul" value="<?= $this->input->get('judul') ?>" autocomplete="off" data-autocomplete="<?= base_url('buku/autocomplete/') ?>">
										<label for="filterJudul">Ketik Pencarian</label>
									</div>
									<?php foreach ($_kategori as $v) { ?>
									<p>
										<label>
											<input type="checkbox" class="filled-in" name="kategori[]" value="<?= $v->nama_kategori ?>"  <?php if(is_array($this->input->get('kategori'))){foreach($this->input->get('kategori') as $k){if(strtolower($k)==strtolower($v->nama_kategori)){echo 'checked="checked"';}}} ?> />
											<span><?= $v->nama_kategori ?></span>
										</label>
									</p>
									<?php } ?>
									<button class="btn blue waves-effect waves-light" type="submit">Cari</button>
								<?= form_close() ?>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-9">

					<div class="row" id="list-book">
						<div class="col-12">
							<h5>Daftar Buku <span class="blue white-text badge">Terbaru</span></h5>
						</div>
					</div>
					<div class="center">
						<button type="button" class="btn blue waves-effect waves-light" id="loadMore"><span class="fa fa-refresh"></span> Muat Lagi</button>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php $this->load->view('footer') ?>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
	<?= script('assets/plugins/pace/js/pace.min.js') ?>
	<?= script('assets/main.js') ?>
	<script type="text/javascript">
    	$(document).ajaxStart(function() { Pace.restart(); }); 
		$(document).ready(function(){
			var judul = <?= json_encode($this->input->get('judul')) ?>;
			var kategori = <?= json_encode($this->input->get('kategori')) ?>;
			var status = false;

			if($(window).width()>=768){
				$('#filter-box').addClass('active');
				$('.collapsible').collapsible();
			}

			loadMore(true);

			$('#loadMore').click(loadMore);
			$(window).scroll(function(){
	            if($(window).scrollTop() == $(document).height() - $(window).height()){
	                loadMore();
	            }
	        })

			function loadMore(bool){
				if(!status){
					$.ajax({
						url : '<?= base_url('buku/get_data') ?>',
						dataType: 'json',
						data: {
							judul: judul,
							kategori: kategori,
							last_id: $('#list-book').children().last().data('last')
						},
						type: 'post',
						beforeSend: function(){
							status = true;
						},
						success: function(result,status,xhr){
							if(result.buku.length==0){
								$('#loadMore').prop('disabled', true);
								if(bool==true){
									$('#list-book').append('<div class="col-12"><?= callout('danger', 'Tidak ada buku yang dapat ditampilkan') ?></div>')
									$('#loadMore').prop('disabled', true);
								}
							}
							else{
								listparse(result);
							}
						},
						error: function(xhr,status,error){
							swal({
								title: "Gagal mendapatkan buku",
								icon: "error",
							})
						},
						complete: function(){
							status = false;
						}
					})
				}
			}

			function listparse(data){
				$('#list-book').children().data('last', null);
				$.each(data.buku, function(){
					var html = '';
					html += '<div class="col-lg-2 col-md-3 col-sm-4 col-6">'
					html += '<div class="card card-sticky-action hoverable">';
					html += '<div class="card-image waves-effect waves-block waves-light">';
					html += '<img src="'+data.thumb+this.sampul+'" alt="'+this.judul+'" class="responsive-img activator">';
					html += '</div>';
					html += '<div class="card-content">';
					html += '<p class="card-title">'+this.judul+'</p>';
					html += '</div>';
					html += '<div class="card-action">';
					html += '<a href="'+data.lihat_buku+this.id+'" class="btn btn-small blue waves-effect waves-light">LIHAT</a>';
					html += '</div>';

					html += '<div class="card-reveal">';
					html += '<span class="card-title"><i class="material-icons right waves-effect circle">close</i>Info</span>';
					html += '<p>'+this.deskripsi+'</p>';
					html += '</div>';
					html += '</div>';
					html += '</div>';
					$('#list-book').append(html);
				});
				$('#list-book').children().last().data('last', data.last);
			}
		})
	</script>

</body>

</html>

<?php
if(!isset($menu)) {
  $menu = 0;
} 
?>
<ul id="dropdown-kategori" class="dropdown-content">
	<?php foreach ($_kategori as $_k) { ?>
	<li><a href="<?= base_url('buku?kategori[]='.$_k->nama_kategori) ?>"><?= $_k->nama_kategori ?></a></li>
	<?php } ?>
</ul>
<?php if($this->session->userdata('id_user')){ ?>
<ul id="dropdown-pengguna" class="dropdown-content">
	<?php if(!$this->session->userdata('validated')){ ?>
	<li><a href="<?= base_url('verifikasi') ?>" class="dropdown-item"><i class="material-icons left">verified_user</i>Verifikasikan</a></li>
	<?php } ?>
	<li><a href="<?= base_url('profil') ?>" class="dropdown-item"><i class="material-icons left">account_circle</i>Profil</a></li>
	<li><a href="<?= base_url('logout?redirect='.uri_string()) ?>" class="dropdown-item"><i class="material-icons left">exit_to_app</i>Keluar</a></li>
</ul>
<?php }else{ ?>
<ul id="dropdown-pengguna" class="dropdown-content">
	<li><a href="<?= base_url('login?redirect='.uri_string()) ?>" class="dropdown-item"><i class="material-icons left" style="transform: rotate(180deg);">exit_to_app</i>Masuk</a></li>
	<li><a href="<?= base_url('register') ?>" class="dropdown-item"><i class="material-icons left">person_add</i>Daftar</a></li>
</ul>
<?php } ?>
<header class="navbar-fixed">
	<nav>
		<div class="nav-wrapper blue">
			<div class="container">
				<a href="#" class="open-boxsearch right hide-on-med-and-up"><i class="material-icons">search</i></a>
				<a href="#" class="brand-logo">e-Library</a>
				<a href="#" data-target="sidenav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down a-sidebar">
					<li class="<?php if($menu==1){echo'active';} ?>"><a href="<?= base_url() ?>"><i class="material-icons left">home</i>Home</a></li>
					<li class="<?php if($menu==2){echo'active';} ?>"><a href="<?= base_url('panduan') ?>"><i class="material-icons left">explore</i>Panduan</a></li>
					<li><a class="dropdown-trigger" href="#" data-target="dropdown-kategori"><i class="material-icons left">bookmark</i>Kategori</a></li>
					<li class="<?php if($menu==3){echo'active';} ?>"><a href="<?= base_url('buku') ?>"><i class="material-icons left">book</i>Daftar Buku</a></li>
					<li class="<?php if($menu==4){echo'active';} ?> open-boxsearch"><a href="#"><i class="material-icons">search</i> </a></li>
					<li class="<?php if($menu==5){echo'active';} ?>"><a class="dropdown-trigger" href="#" data-target="dropdown-pengguna"><i class="material-icons">person</i> </a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>

<ul class="sidenav a-sidebar" id="sidenav-mobile">
	<li class="section blue lighten-1 waves-effect waves-light w-100">
		<h1 class="gayatri">"GAYATRI"</h1>
	</li>
	<li class="<?php if($menu==1){echo'active';} ?> waves-effect w-100"><a href="<?= base_url() ?>"><i class="material-icons left">home</i>Home</a></li>
	<li class="<?php if($menu==2){echo'active';} ?> waves-effect w-100"><a href="<?= base_url('panduan') ?>"><i class="material-icons left">explore</i>Panduan</a></li>
	<li class="waves-effect w-100"><a class="dropdown-trigger" href="#" data-target="dropdown-kategori-mobile"><i class="material-icons left">bookmark</i>Kategori</a></li>
	<li class="<?php if($menu==3){echo'active';} ?> waves-effect w-100"><a href="<?= base_url('buku') ?>"><i class="material-icons left">book</i>Daftar Buku</a></li>
	<li class="<?php if($menu==4){echo'active';} ?> open-boxsearch waves-effect w-100"><a href="#"><i class="material-icons left">search</i> Cari</a></li>
	<li class="<?php if($menu==5){echo'active';} ?> waves-effect w-100"><a class="dropdown-trigger" href="#" data-target="dropdown-pengguna-mobile"><i class="material-icons">person</i> Akun</a></li>
</ul>

<ul id="dropdown-kategori-mobile" class="dropdown-content">
	<?php foreach ($_kategori as $_k) { ?>
	<li><a href="<?= base_url('buku?kategori[]='.$_k->nama_kategori) ?>"><?= $_k->nama_kategori ?></a></li>
	<?php } ?>
</ul>

<?php if($this->session->userdata('id_user')){ ?>
<ul id="dropdown-pengguna-mobile" class="dropdown-content">
	<?php if(!$this->session->userdata('validated')){ ?>
	<li><a href="<?= base_url('verifikasi') ?>" class="dropdown-item"><i class="material-icons left">verified_user</i>Verifikasikan</a></li>
	<?php } ?>
	<li><a href="<?= base_url('profil') ?>" class="dropdown-item"><i class="material-icons left">account_circle</i>Profil</a></li>
	<li><a href="<?= base_url('logout?redirect='.uri_string()) ?>" class="dropdown-item"><i class="material-icons left">exit_to_app</i>Keluar</a></li>
</ul>
<?php }else{ ?>
<ul id="dropdown-pengguna-mobile" class="dropdown-content">
	<li><a href="<?= base_url('login?redirect='.uri_string()) ?>" class="dropdown-item"><i class="material-icons left" style="transform: rotate(180deg);">exit_to_app</i>Masuk</a></li>
	<li><a href="<?= base_url('register') ?>" class="dropdown-item"><i class="material-icons left">person_add</i>Daftar</a></li>
</ul>
<?php } ?>

<!-- KOTAK PENCARIAN -->
<div class="white" id="searchBox">
	<div class="container">
		<?= form_open('buku',array('method'=>'get')) ?>
			<div class="clearfix">
				<p class="right-align"><button type="button" class="waves-effect btn-flat white btn-large" id="closeSearchBox">&times;</button></p>
			</div>
			<div class="row">
				<div class="input-field col m6">
					<input id="searchInput" type="text" name="judul" class="autocomplete" autocomplete="off" autocomplete="off" data-autocomplete="<?= base_url('buku/autocomplete/') ?>">
					<label for="searchInput">Judul Buku</label>
				</div>
				<div class="input-field col m6">
					<select name="kategori[]" multiple="multiple">
						<option value="" disabled>Kategori Buku</option>
						<?php foreach ($_kategori as $key => $value) { ?>
						<option value="<?= $value->nama_kategori ?>"><?= $value->nama_kategori ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<button type="submit" class="btn blue right waves-effect waves-light"><i class="material-icons left">search</i>Cari</button>
		<?= form_close() ?>
	</div>
</div>
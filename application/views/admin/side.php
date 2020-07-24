<?php
if(!isset($menu)) {
  $menu = 0;
} 
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <?= form_open('admin', array('class'=>'sidebar-form','method'=>'get')) ?>
      <div class="input-group">
        <input name="q" class="form-control" placeholder="Cari..." type="text" value="<?= $this->input->get('q') ?>" autocomplete="off">
        <span class="input-group-btn">
          <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    <?= form_close() ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="<?php if($menu == 1){echo 'active';} ?>"><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="<?php if($menu == 2){echo 'active';} ?>"><a href="<?php echo base_url('admin/buku') ?>"><i class="fa fa-book"></i> <span>Data Buku</span></a></li>
      <li class="<?php if($menu == 3){echo 'active';} ?>"><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-users"></i> <span>Data User</span></a></li>
      <li class="<?php if($menu == 4){echo 'active';} ?>"><a href="<?php echo base_url('admin/kategori') ?>"><i class="fa fa-tags"></i> <span>Data Kategori</span></a></li>
      <li class="<?php if($menu == 5){echo 'active';} ?>"><a href="<?php echo base_url('admin/laporan') ?>"><i class="fa fa-line-chart"></i> <span>Laporan</span></a></li>
      <li class="<?php if($menu == 10){echo 'active';} ?>"><a href="<?php echo base_url('admin/konfigurasi') ?>"><i class="fa fa-cogs"></i> <span>Konfigurasi</span></a></li>
    </ul>
  </section>
</aside>
<header class="main-header">
    <a href="<?= base_url() ?>" class="logo">
        <span class="logo-mini"><span class="fa fa-book"></span></span>
        <span class="logo-lg"><span class="fa fa-book"></span> Library</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $this->session->userdata('nama_user') ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <h4 class="img-circle" alt="User Image"><span class="fa fa-user fa-4x fa-inverse"></span></h4>
                            <p>
                                <?php echo $this->session->userdata('nama_user') ?>
                                <small><?php echo $this->session->userdata('rule') ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url('admin/user/lihat/'.$this->session->userdata('id_user')) ?>" class="btn btn-warning btn-flat"><span class="fa fa-user"></span> Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('logout') ?>" class="btn btn-danger btn-flat"><span class="fa fa-sign-out"></span> Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
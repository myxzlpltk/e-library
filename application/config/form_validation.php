<?php 

$config = array(
    'verifikasi' => array(
        array(
            'field' => 'kode',
            'label' => 'kode verifikasi',
            'rules' => 'required'
        ),
        array(
            'field' => 'g-recaptcha-response',
            'label' => 'reCAPTCHA',
            'rules' => 'required'
        )
    ),
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required'
        )
    ),
    'register' => array(
        array(
            'field' => 'nama_user',
            'label' => 'nama lengkap',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email|is_unique[user.email]'
        ),
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required|alpha_dash|min_length[4]|is_unique[user.username]'
        ),
        array(
            'field' => 'password',
            'label' => 'kata sandi',
            'rules' => 'required|alpha_numeric|min_length[6]'
        ),
        array(
            'field' => 'type_password',
            'label' => 'ketik ulang kata sandi',
            'rules' => 'required|matches[password]'
        ),
        array(
            'field' => 'g-recaptcha-response',
            'label' => 'reCAPTCHA',
            'rules' => 'required'
        )
    ),
    'edit_profil' => array(
        array(
            'field' => 'nama_user',
            'label' => 'nama lengkap',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email|min_length[4]|callback_email_edit'
        ),
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required|alpha_dash|callback_username_edit'
        )
    ),
    'ganti_password' => array(
        array(
            'field' => 'password_lama',
            'label' => 'password lama',
            'rules' => 'required|alpha_numeric|callback_old_password'
        ),
        array(
            'field' => 'password',
            'label' => 'password baru',
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'type_password',
            'label' => 'verifikasi password',
            'rules' => 'required|matches[password]'
        )
    ),
	'tambah_buku' => array(
		array(
			'field' => 'nama_buku',
			'label' => 'nama buku',
			'rules' => 'required|max_length[100]|is_unique[buku.nama_buku]'
		),
        array(
            'field' => 'deskripsi_buku',
            'label' => 'deskripsi buku',
            'rules' => 'required'
        ),
        array(
            'field' => 'kategori[]',
            'label' => 'kategori buku',
            'rules' => 'required'
        )
    ),
    'tambah_kategori' => array(
    	array(
    		'field' => 'nama_kategori',
    		'label' => 'nama kategori',
    		'rules' => 'required|is_unique[kategori.nama_kategori]'
    	)
    ),
    'edit_buku' => array(
        array(
            'field' => 'nama_buku',
            'label' => 'nama buku',
            'rules' => 'required|max_length[100]|callback_edit_buku'
        ),
        array(
            'field' => 'deskripsi_buku',
            'label' => 'deskripsi buku',
            'rules' => 'required'
        ),
        array(
            'field' => 'kategori[]',
            'label' => 'kategori buku',
            'rules' => 'required'
        )
    ),
    'reset_password' => array(
        array(
            'field' => 'password',
            'label' => 'password baru',
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'type_password',
            'label' => 'verifikasi password',
            'rules' => 'required|matches[password]'
        )
    ),
);

$config['error_prefix'] = '<div class="alert alert-danger"><b>';
$config['error_suffix'] = '<span class="close" data-dismiss="alert">&times;</span></b></div>';
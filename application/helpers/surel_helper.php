<?php 

function get_mail($to=null, $code=null, $verif=null, $type=null){
	if($type=='register'){
		$mail = '<div style="max-width: 440px;width: 100%;margin: 0 auto; display: block;">';
		$mail .= '<div>';
		$mail .= '<h2 style="text-align: center;font-family: sans-serif;">Verifikasi Pendaftaran</h2>';
		$mail .= '<p style="text-align: center;margin-bottom: 30px;font-family: sans-serif;">Terima kasih telah mendaftar di E-Library BAPPEDA Tulungagung.Berikut ini adalah kode verifikasi anda.</p>';
		$mail .= '</div>';
		$mail .= '<div>';
		$mail .= '<h1 style="font-family: sans-serif;text-align: center;"><pre style="border: 2px solid #004B8D;display: inline;padding: 10px;color: #004B8D;letter-spacing: 4px;border-radius: 4px;">'.$code.'</pre></h1>';
		$mail .= '<p style="font-family: sans-serif;text-align: center;"><b>ATAU</b></p>';
		$mail .= '<br>';
		$mail .= '<p style="text-align: center;"><a href="'.base_url('verifikasi/lihat/'.$verif).'" style="border: none;text-decoration: none;color: #fff;background-color: #004B8D;padding: 16px;font-family: sans-serif;">Klik Disini Untuk Verifikasi</a>';
		$mail .= '</div>';
		$mail .= '<div>';
		$mail .= '<br>';
		$mail .= '<p style="text-align: center;font-family: sans-serif;">Jika anda tidak pernah mendaftar. Mohon abaikan surel ini.</p>';
		$mail .= '</div>';
		$mail .= '</div>';

		return $mail;
	}
	elseif ($type=='forgot') {
		$mail = '<div style="max-width: 440px;width: 100%;margin: 0 auto; display: block;">';
		$mail .= '<div>';
		$mail .= '<h2 style="text-align: center;font-family: sans-serif;">Lupa Password</h2>';
		$mail .= '<p style="text-align: center;margin-bottom: 30px;font-family: sans-serif;">Anda memberitahu kami bahwa anda kesulitan saat proses login sehingga meminta password baru. Berikut ini adalah kode verifikasi anda.</p>';
		$mail .= '</div>';
		$mail .= '<div>';
		$mail .= '<h1 style="font-family: sans-serif;text-align: center;"><pre style="border: 2px solid #004B8D;display: inline;padding: 10px;color: #004B8D;letter-spacing: 4px;border-radius: 4px;">'.$code.'</pre></h1>';
		$mail .= '<p style="font-family: sans-serif;text-align: center;"><b>ATAU</b></p>';
		$mail .= '<br>';
		$mail .= '<p style="text-align: center;"><a href="'.base_url('verifikasi/lihat/'.$verif).'" style="border: none;text-decoration: none;color: #fff;background-color: #004B8D;padding: 16px;font-family: sans-serif;">Klik Disini Untuk Verifikasi</a>';
		$mail .= '</div>';
		$mail .= '<div>';
		$mail .= '<br>';
		$mail .= '<p style="text-align: center;font-family: sans-serif;">Jika anda tidak pernah melapor lupa password. Mohon abaikan surel ini.</p>';
		$mail .= '</div>';
		$mail .= '</div>';

		return $mail;
	}
}

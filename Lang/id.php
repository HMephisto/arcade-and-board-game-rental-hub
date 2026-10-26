<?php
return [
    // App & Nav
    'app_name'           => 'Pusat Rental Arcade & Board Game',
    'nav_dashboard'      => 'Katalog Game',
    'nav_add'            => 'Tambah Game',
    'nav_logout'         => 'Keluar',
    'logged_in_as'       => 'Masuk sebagai',

    // Auth
    'login_title'        => 'Masuk ke Sistem',
    'username'           => 'Nama Pengguna',
    'password'           => 'Kata Sandi',
    'btn_login'          => 'Masuk',
    'err_login_failed'   => 'Nama pengguna atau kata sandi tidak valid.',
    'msg_logged_out'     => 'Anda berhasil keluar.',

    // Dashboard / Table
    'dashboard_title'    => 'Daftar Unit Game',
    'btn_add_new'        => '+ Tambah Game Baru',
    'btn_edit'           => 'Ubah',
    'btn_delete'         => 'Hapus',
    'col_title'          => 'Judul Game',
    'col_category'       => 'Kategori',
    'col_players'        => 'Jumlah Pemain',
    'col_rate'           => 'Tarif / Jam',
    'col_condition'      => 'Kondisi',
    'col_status'         => 'Status',
    'col_actions'        => 'Aksi',
    'no_data'            => 'Belum ada data game yang terdaftar.',
    'confirm_delete'     => 'Apakah Anda yakin ingin menghapus data ini?',

    // Forms
    'form_add_title'     => 'Tambah Unit Game Baru',
    'form_edit_title'    => 'Ubah Data Game',
    'lbl_title'          => 'Judul Game',
    'lbl_category'       => 'Kategori',
    'lbl_min_players'    => 'Pemain Minimum',
    'lbl_max_players'    => 'Pemain Maksimum',
    'lbl_hourly_rate'    => 'Tarif Sewa per Jam (Rp)',
    'lbl_condition'      => 'Kondisi Fisik',
    'lbl_status'         => 'Status Ketersediaan',
    'btn_save'           => 'Simpan Data',
    'btn_update'         => 'Perbarui Data',
    'btn_cancel'         => 'Batal',

    // Category / Enum Values
    'cat_board_game'     => 'Board Game',
    'cat_arcade'         => 'Arcade Cabinet',
    'cat_console'        => 'Console',
    'cond_mint'          => 'Sangat Baik (Mint)',
    'cond_good'          => 'Bagus (Good)',
    'cond_fair'          => 'Cukup (Fair)',
    'cond_repair'        => 'Perlu Perbaikan',
    'status_available'   => 'Tersedia',
    'status_rented'      => 'Sedang Disewa',
    'status_maintenance' => 'Dalam Perawatan',

    // Validation Errors
    'err_validation_header' => 'Harap perbaiki kesalahan berikut:',
    'err_title_req'      => 'Judul game wajib diisi.',
    'err_cat_inv'        => 'Pilihan kategori tidak valid.',
    'err_min_players'    => 'Pemain minimum harus minimal 1.',
    'err_max_players'    => 'Pemain maksimum tidak boleh lebih kecil dari pemain minimum.',
    'err_rate_inv'       => 'Tarif per jam harus berupa angka positif.',
    'err_cond_inv'       => 'Pilihan kondisi fisik tidak valid.',
    'err_status_inv'     => 'Pilihan status ketersediaan tidak valid.',

    // Notifications
    'msg_created'        => 'Data game berhasil ditambahkan.',
    'msg_updated'        => 'Data game berhasil diperbarui.',
    'msg_deleted'        => 'Data game berhasil dihapus.',
];
<?php
return [
    // App & Nav
    'app_name'           => 'Arcade & Board Game Rental Hub',
    'nav_dashboard'      => 'Game Catalog',
    'nav_add'            => 'Add Game',
    'nav_logout'         => 'Logout',
    'logged_in_as'       => 'Logged in as',

    // Auth
    'login_title'        => 'System Login',
    'username'           => 'Username',
    'password'           => 'Password',
    'btn_login'          => 'Sign In',
    'err_login_failed'   => 'Invalid username or password.',
    'msg_logged_out'     => 'You have been logged out successfully.',

    // Dashboard / Table
    'dashboard_title'    => 'Game Inventory Units',
    'btn_add_new'        => '+ Add New Game',
    'btn_edit'           => 'Edit',
    'btn_delete'         => 'Delete',
    'col_title'          => 'Game Title',
    'col_category'       => 'Category',
    'col_players'        => 'Players',
    'col_rate'           => 'Rate / Hour',
    'col_condition'      => 'Condition',
    'col_status'         => 'Status',
    'col_actions'        => 'Actions',
    'no_data'            => 'No games found in the database.',
    'confirm_delete'     => 'Are you sure you want to delete this game record?',

    // Forms
    'form_add_title'     => 'Add New Game Unit',
    'form_edit_title'    => 'Edit Game Details',
    'lbl_title'          => 'Game Title',
    'lbl_category'       => 'Category',
    'lbl_min_players'    => 'Minimum Players',
    'lbl_max_players'    => 'Maximum Players',
    'lbl_hourly_rate'    => 'Hourly Rate (IDR)',
    'lbl_condition'      => 'Physical Condition',
    'lbl_status'         => 'Availability Status',
    'btn_save'           => 'Save Record',
    'btn_update'         => 'Update Record',
    'btn_cancel'         => 'Cancel',

    // Category / Enum Values
    'cat_board_game'     => 'Board Game',
    'cat_arcade'         => 'Arcade Cabinet',
    'cat_console'        => 'Console',
    'cond_mint'          => 'Mint',
    'cond_good'          => 'Good',
    'cond_fair'          => 'Fair',
    'cond_repair'        => 'Needs Repair',
    'status_available'   => 'Available',
    'status_rented'      => 'Rented',
    'status_maintenance' => 'Maintenance',

    // Validation Errors
    'err_validation_header' => 'Please correct the following errors:',
    'err_title_req'      => 'Game title is required.',
    'err_cat_inv'        => 'Selected category is invalid.',
    'err_min_players'    => 'Minimum players must be at least 1.',
    'err_max_players'    => 'Maximum players cannot be less than minimum players.',
    'err_rate_inv'       => 'Hourly rate must be a positive number.',
    'err_cond_inv'       => 'Selected condition is invalid.',
    'err_status_inv'     => 'Selected status is invalid.',

    // Notifications
    'msg_created'        => 'Game record created successfully.',
    'msg_updated'        => 'Game record updated successfully.',
    'msg_deleted'        => 'Game record deleted successfully.',
];
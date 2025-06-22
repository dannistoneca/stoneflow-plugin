<?php
// Add settings page to admin menu
function stoneflow_add_settings_page() {
    add_submenu_page(
        'stoneflow-dashboard',
        'StoneFlow Settings',
        'Settings',
        'manage_options',
        'stoneflow-settings',
        'stoneflow_render_settings_page'
    );
}
add_action('admin_menu', 'stoneflow_add_settings_page');

// Render settings page
function stoneflow_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>StoneFlow Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('stoneflow_settings_group');
            do_settings_sections('stoneflow-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function stoneflow_register_settings() {
    register_setting('stoneflow_settings_group', 'stoneflow_admin_email');

    add_settings_section(
        'stoneflow_main_settings',
        'Main Settings',
        null,
        'stoneflow-settings'
    );

    add_settings_field(
        'stoneflow_admin_email',
        'Admin Notification Email',
        'stoneflow_admin_email_field',
        'stoneflow-settings',
        'stoneflow_main_settings'
    );
}
add_action('admin_init', 'stoneflow_register_settings');

// Email field
function stoneflow_admin_email_field() {
    $email = get_option('stoneflow_admin_email', get_bloginfo('admin_email'));
    echo '<input type="email" name="stoneflow_admin_email" value="' . esc_attr($email) . '" class="regular-text">';
}


if ( ! function_exists( 'stoneflow_admin_dashboard' ) ) {
    function stoneflow_admin_dashboard() {
        echo '<div class="wrap"><h1>Welcome to StoneFlow Admin</h1><p>This is your main control panel.</p></div>';
    }
}

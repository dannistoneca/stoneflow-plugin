<?php
defined('ABSPATH') || exit;

$paypal_email = get_option('stoneflow_paypal_email', '');
$etransfer_email = get_option('stoneflow_etransfer_email', '');
$default_tax = get_option('stoneflow_default_tax', '15');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('stoneflow_save_settings')) {
    update_option('stoneflow_paypal_email', sanitize_email($_POST['paypal_email']));
    update_option('stoneflow_etransfer_email', sanitize_email($_POST['etransfer_email']));
    update_option('stoneflow_default_tax', floatval($_POST['default_tax']));
    echo '<div class="updated"><p>Settings saved.</p></div>';
}
?>

<div class="wrap">
    <h1>⚙️ StoneFlow Settings</h1>
    <form method="post">
        <?php wp_nonce_field('stoneflow_save_settings'); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="paypal_email">PayPal Email</label></th>
                <td><input name="paypal_email" type="email" id="paypal_email" value="<?php echo esc_attr($paypal_email); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="etransfer_email">E-Transfer Email</label></th>
                <td><input name="etransfer_email" type="email" id="etransfer_email" value="<?php echo esc_attr($etransfer_email); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="default_tax">Default Tax Rate (%)</label></th>
                <td><input name="default_tax" type="number" step="0.1" id="default_tax" value="<?php echo esc_attr($default_tax); ?>" class="small-text"></td>
            </tr>
        </table>
        <?php submit_button('Save Settings'); ?>
    </form>
</div>

<div class="wrap">
  <h1>StoneFlow Settings</h1>
  <form method="post" action="options.php">
    <?php settings_fields('stoneflow_settings_group'); ?>
    <?php do_settings_sections('stoneflow_settings_group'); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row">PayPal Email</th>
        <td><input type="email" name="stoneflow_paypal_email" value="<?php echo esc_attr(get_option('stoneflow_paypal_email')); ?>" class="regular-text" /></td>
      </tr>

      <tr valign="top">
        <th scope="row">eTransfer Email</th>
        <td><input type="email" name="stoneflow_etransfer_email" value="<?php echo esc_attr(get_option('stoneflow_etransfer_email')); ?>" class="regular-text" /></td>
      </tr>

      <tr valign="top">
        <th scope="row">Default Tax Rate (%)</th>
        <td><input type="number" name="stoneflow_tax_rate" value="<?php echo esc_attr(get_option('stoneflow_tax_rate', 15)); ?>" class="small-text" step="0.01" min="0" /></td>
      </tr>
    </table>

    <?php submit_button(); ?>
  </form>
</div>

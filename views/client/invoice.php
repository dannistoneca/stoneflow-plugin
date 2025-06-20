<?php
defined('ABSPATH') || exit;

?>
<div class="stoneflow-client-panel">
    <h2>Your Invoices</h2>
    <p>Here you can view your invoice history and download copies for your records.</p>
    <table class="stoneflow-table">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $client_id = get_current_user_id();
            $invoices = stoneflow_get_client_invoices($client_id);

            if ($invoices && is_array($invoices)) :
                foreach ($invoices as $invoice) :
            ?>
                <tr>
                    <td>#<?php echo esc_html($invoice['id']); ?></td>
                    <td><?php echo esc_html(date('Y-m-d', strtotime($invoice['date']))); ?></td>
                    <td>$<?php echo esc_html(number_format($invoice['amount'], 2)); ?></td>
                    <td><?php echo esc_html(ucfirst($invoice['status'])); ?></td>
                    <td>
                        <a href="<?php echo esc_url($invoice['file_url']); ?>" target="_blank" class="button">Download</a>
                    </td>
                </tr>
            <?php
                endforeach;
            else :
                echo '<tr><td colspan="5">No invoices found.</td></tr>';
            endif;
            ?>
        </tbody>
    </table>
</div>

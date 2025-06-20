<?php
// includes/pages/stoneflow-client-intake.php

function stoneflow_render_client_intake_form($client_id) {
    $intake_data = stoneflow_get_client_intake_data($client_id);
    ?>
    <div class="stoneflow-intake-form">
        <h2>Client Intake Form</h2>
        <form method="post">
            <?php wp_nonce_field('stoneflow_intake_save', 'stoneflow_intake_nonce'); ?>
            <input type="hidden" name="client_id" value="<?php echo esc_attr($client_id); ?>">

            <label for="business_name">Business Name</label>
            <input type="text" name="business_name" id="business_name" value="<?php echo esc_attr($intake_data['business_name'] ?? ''); ?>">

            <label for="goals">Business Goals</label>
            <textarea name="goals" id="goals"><?php echo esc_textarea($intake_data['goals'] ?? ''); ?></textarea>

            <label for="challenges">Current Challenges</label>
            <textarea name="challenges" id="challenges"><?php echo esc_textarea($intake_data['challenges'] ?? ''); ?></textarea>

            <input type="submit" name="save_intake" value="Save Intake Info">
        </form>
    </div>
    <?php
}

function stoneflow_handle_client_intake_form_submission() {
    if (!isset($_POST['stoneflow_intake_nonce']) || !wp_verify_nonce($_POST['stoneflow_intake_nonce'], 'stoneflow_intake_save')) {
        return;
    }

    if (!current_user_can('manage_options')) return;

    $client_id = intval($_POST['client_id']);
    $business_name = sanitize_text_field($_POST['business_name']);
    $goals = sanitize_textarea_field($_POST['goals']);
    $challenges = sanitize_textarea_field($_POST['challenges']);

    $intake_data = [
        'business_name' => $business_name,
        'goals' => $goals,
        'challenges' => $challenges,
    ];

    stoneflow_save_client_intake_data($client_id, $intake_data);

    add_action('admin_notices', function () {
        echo '<div class="notice notice-success is-dismissible"><p>Client intake data saved successfully.</p></div>';
    });
}

add_action('admin_init', 'stoneflow_handle_client_intake_form_submission');

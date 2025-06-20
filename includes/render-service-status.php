<?php
// Renders a service status badge
function stoneflow_render_status_badge($status) {
    $colors = [
        'queued' => '#f39c12',
        'in process' => '#3498db',
        'completed' => '#2ecc71',
        'on hold' => '#e67e22',
        'cancelled' => '#e74c3c'
    ];

    $color = $colors[$status] ?? '#7f8c8d';
    return '<span style="background-color:' . esc_attr($color) . '; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;">' . esc_html(ucwords($status)) . '</span>';
}

<div class="stoneflow-client-profile">
    <h2>👤 Your Profile</h2>

    <table class="widefat striped">
        <tbody>
            <tr>
                <th>Name</th>
                <td><?php echo esc_html($client->display_name); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo esc_html($client->user_email); ?></td>
            </tr>
            <tr>
                <th>Registration Date</th>
                <td><?php echo esc_html($client->user_registered); ?></td>
            </tr>
        </tbody>
    </table>

    <h3>📝 Discovery Info</h3>
    <div class="stoneflow-discovery-info">
        <?php echo !empty($client->discovery_info) ? wpautop(esc_html($client->discovery_info)) : '<p>No discovery info found.</p>'; ?>
    </div>
</div>

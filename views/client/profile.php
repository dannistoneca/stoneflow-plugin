<div class="wrap">
    <h1>👤 My Profile</h1>

    <table class="form-table">
        <tr>
            <th>Name</th>
            <td><?= esc_html($user->display_name) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= esc_html($user->user_email) ?></td>
        </tr>
        <tr>
            <th>Registered</th>
            <td><?= esc_html($user->user_registered) ?></td>
        </tr>
    </table>

    <h2>📝 Your Discovery Info</h2>
    <p>
        <?php if ($discovery_info) : ?>
            <?= nl2br(esc_html($discovery_info)) ?>
        <?php else : ?>
            No discovery session info found.
        <?php endif; ?>
    </p>
</div>

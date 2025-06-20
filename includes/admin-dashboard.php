<?php
// Admin Dashboard Page
function stoneflow_admin_dashboard() {
    ?>
    <div class="wrap">
        <h1>Welcome to StoneFlow Admin</h1>
        <p>This is your main control panel.</p>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
            <!-- Clients Box -->
            <div class="postbox" style="flex: 1; min-width: 250px;">
                <h2 style="padding: 10px;">👤 Clients</h2>
                <div class="inside" style="padding: 0 10px 10px;">
                    <p>Manage client profiles, view details, and send messages.</p>
                    <a href="<?php echo admin_url('admin.php?page=stoneflow-client-manager'); ?>" class="button button-primary">Go to Client Manager</a>
                </div>
            </div>

            <!-- Services Box -->
            <div class="postbox" style="flex: 1; min-width: 250px;">
                <h2 style="padding: 10px;">📦 Services</h2>
                <div class="inside" style="padding: 0 10px 10px;">
                    <p>Track service requests, update statuses, and manage priorities.</p>
                    <a href="<?php echo admin_url('admin.php?page=stoneflow-service-queue'); ?>" class="button button-primary">Go to Service Queue</a>
                </div>
            </div>

            <!-- AI Assistant Box -->
            <div class="postbox" style="flex: 1; min-width: 250px;">
                <h2 style="padding: 10px;">🤖 S.T.O.N.E. Assistant</h2>
                <div class="inside" style="padding: 0 10px 10px;">
                    <p>Use our AI assistant to automate onboarding, SEO writing, or get suggestions.</p>
                    <a href="<?php echo admin_url('admin.php?page=stoneflow-ai-assistant'); ?>" class="button button-primary">Access S.T.O.N.E.</a>
                </div>
            </div>
        </div>

        <div style="margin-top: 40px;">
            <h2>Quick Actions</h2>
            <ul>
                <li><a href="<?php echo admin_url('admin.php?page=stoneflow-client-manager'); ?>">➕ Add a New Client</a></li>
                <li><a href="<?php echo admin_url('admin.php?page=stoneflow-service-queue'); ?>">📝 Check Pending Services</a></li>
                <li><a href="<?php echo admin_url('admin.php?page=stoneflow-ai-assistant'); ?>">💡 Ask S.T.O.N.E. for Help</a></li>
            </ul>
        </div>
    </div>
    <?php
}

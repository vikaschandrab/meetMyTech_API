@extends('admin.layout')

@section('title', 'Admin Settings')
@section('page-title', 'System Settings')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-cog me-2"></i>General Settings</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="site_name" value="MeetMyTech">
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control" id="site_description" rows="3">Professional networking platform for tech professionals</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="admin_email" value="admin@meetmytech.com">
                    </div>

                    <div class="mb-3">
                        <label for="maintenance_mode" class="form-label">Maintenance Mode</label>
                        <select class="form-control" id="maintenance_mode">
                            <option value="0">Disabled</option>
                            <option value="1">Enabled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Settings
                    </button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-envelope me-2"></i>Email Settings</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="mail_driver" class="form-label">Mail Driver</label>
                        <select class="form-control" id="mail_driver">
                            <option value="smtp">SMTP</option>
                            <option value="sendmail">Sendmail</option>
                            <option value="mailgun">Mailgun</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mail_host" class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" id="mail_host" value="smtp.zoho.com">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mail_port" class="form-label">SMTP Port</label>
                                <input type="number" class="form-control" id="mail_port" value="587">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mail_encryption" class="form-label">Encryption</label>
                                <select class="form-control" id="mail_encryption">
                                    <option value="tls">TLS</option>
                                    <option value="ssl">SSL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mail_username" class="form-label">SMTP Username</label>
                        <input type="text" class="form-control" id="mail_username" value="admin@meetmytech.com">
                    </div>

                    <div class="mb-3">
                        <label for="mail_password" class="form-label">SMTP Password</label>
                        <input type="password" class="form-control" id="mail_password" placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Email Settings
                    </button>
                    <button type="button" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-paper-plane me-1"></i>Test Email
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-info-circle me-2"></i>System Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Laravel Version:</strong>
                    <span class="text-muted">{{ app()->version() }}</span>
                </div>
                <div class="mb-3">
                    <strong>PHP Version:</strong>
                    <span class="text-muted">{{ PHP_VERSION }}</span>
                </div>
                <div class="mb-3">
                    <strong>Environment:</strong>
                    <span class="badge bg-{{ app()->environment() === 'production' ? 'success' : 'warning' }}">
                        {{ ucfirst(app()->environment()) }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Debug Mode:</strong>
                    <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                        {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Timezone:</strong>
                    <span class="text-muted">{{ config('app.timezone') }}</span>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-database me-2"></i>Database Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Connection:</strong>
                    <span class="text-muted">{{ config('database.default') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Database:</strong>
                    <span class="text-muted">{{ config('database.connections.mysql.database') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Host:</strong>
                    <span class="text-muted">{{ config('database.connections.mysql.host') }}</span>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-tools me-2"></i>System Actions</h6>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-warning btn-sm mb-2 w-100">
                    <i class="fas fa-broom me-1"></i>Clear Cache
                </button>
                <button type="button" class="btn btn-outline-info btn-sm mb-2 w-100">
                    <i class="fas fa-sync me-1"></i>Clear Config Cache
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm mb-2 w-100">
                    <i class="fas fa-route me-1"></i>Clear Route Cache
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-eye me-1"></i>Clear View Cache
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add functionality for system action buttons
    const buttons = document.querySelectorAll('[data-action]');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            // Implement cache clearing actions
            console.log('Action:', action);
        });
    });
});
</script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Capybara CRM') ?> - Capybara CRM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-width: 250px; }
        body { background-color: #f8f9fa; }
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        #sidebar .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 0.65rem 1.25rem;
            border-radius: 0.375rem;
            margin: 0.1rem 0.75rem;
            transition: all 0.2s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.15);
        }
        #sidebar .nav-link i { width: 1.25rem; }
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #topnav { background: #fff; border-bottom: 1px solid #dee2e6; }
        .page-content { padding: 1.5rem; flex: 1; }
        @media (max-width: 767.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
            #sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            #sidebar-overlay.show { display: block; }
        }
        .kanban-column { min-width: 220px; }
        .badge-status-new { background-color: #0d6efd; }
        .badge-status-contacted { background-color: #6f42c1; }
        .badge-status-qualified { background-color: #198754; }
        .badge-status-lost { background-color: #dc3545; }
        .badge-status-in_progress { background-color: #fd7e14; }
        .badge-status-negotiation { background-color: #ffc107; color: #000; }
        .badge-status-won { background-color: #198754; }
        .badge-status-active { background-color: #198754; }
        .badge-status-inactive { background-color: #6c757d; }
    </style>
</head>
<body>

<!-- Sidebar overlay for mobile -->
<div id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <a href="/dashboard" class="text-decoration-none">
            <span class="fs-4 fw-bold text-white"><i class="bi bi-circle-fill text-primary me-2"></i>Capybara CRM</span>
        </a>
    </div>
    <ul class="nav flex-column mt-2 pb-4">
        <li class="nav-item">
            <a class="nav-link <?= (uri_string() === 'dashboard') ? 'active' : '' ?>" href="/dashboard">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'contacts') === 0) ? 'active' : '' ?>" href="/contacts">
                <i class="bi bi-person-lines-fill me-2"></i> Contacts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'leads') === 0) ? 'active' : '' ?>" href="/leads">
                <i class="bi bi-funnel me-2"></i> Leads
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'opportunities') === 0) ? 'active' : '' ?>" href="/opportunities">
                <i class="bi bi-trophy me-2"></i> Opportunities
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'activities') === 0) ? 'active' : '' ?>" href="/activities">
                <i class="bi bi-calendar-check me-2"></i> Activities
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'tags') === 0) ? 'active' : '' ?>" href="/tags">
                <i class="bi bi-tags me-2"></i> Tags
            </a>
        </li>
    </ul>
</nav>

<!-- Main content -->
<div id="main-content">
    <!-- Top navbar -->
    <nav id="topnav" class="navbar px-3 py-2">
        <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-list fs-5"></i>
        </button>
        <span class="navbar-brand d-none d-md-block fw-semibold text-secondary ms-2"><?= esc($title ?? '') ?></span>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="text-muted small d-none d-sm-inline"><i class="bi bi-person-circle me-1"></i><?= esc(session()->get('user_name') ?? '') ?></span>
            <span class="badge bg-secondary text-uppercase small d-none d-sm-inline"><?= esc(session()->get('user_role') ?? '') ?></span>
            <a href="/logout" class="btn btn-sm btn-outline-danger"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
        </div>
    </nav>

    <!-- Flash messages -->
    <div class="px-3 pt-3">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i><?= esc(session()->getFlashdata('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Page content -->
    <div class="page-content">
        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('sidebar-overlay').classList.toggle('show');
}
</script>
</body>
</html>

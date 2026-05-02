<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? lang('Crm.page_title_suffix')) ?> - <?= lang('Crm.page_title_suffix') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/coaty.css') ?>">
</head>
<body>

<!-- Sidebar overlay for mobile -->
<div id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar bg-coaty-light">
    <div class="sidebar-header">
        <div class="brand-title"><?= lang('Crm.app_name') ?: 'Capybara CRM' ?></div>
        <div class="brand-subtitle"><?= lang('Crm.app_subtitle') ?: 'Customer Relationship Manager' ?></div>
    </div>
    <ul class="nav flex-column mt-2 pb-4">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (uri_string() === 'dashboard') ? 'active' : '' ?>" href="/dashboard">
                <i class="bi bi-speedometer2"></i><span><span><?= lang('Crm.nav_dashboard') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'contacts') === 0) ? 'active' : '' ?>" href="/contacts">
                <i class="bi bi-person-lines-fill"></i><span><span><?= lang('Crm.nav_contacts') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'leads') === 0) ? 'active' : '' ?>" href="/leads">
                <i class="bi bi-funnel"></i><span><span><?= lang('Crm.nav_leads') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'opportunities') === 0) ? 'active' : '' ?>" href="/opportunities">
                <i class="bi bi-trophy"></i><span><span><?= lang('Crm.nav_opportunities') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'activities') === 0) ? 'active' : '' ?>" href="/activities">
                <i class="bi bi-calendar-check"></i><span><span><?= lang('Crm.nav_activities') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'tags') === 0) ? 'active' : '' ?>" href="/tags">
                <i class="bi bi-tags"></i><span><span><?= lang('Crm.nav_tags') ?></span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (strpos(uri_string(), 'tickets') === 0) ? 'active' : '' ?>" href="/tickets">
                <i class="bi bi-ticket-perforated"></i><span><span><?= lang('Crm.nav_tickets') ?></span></span>
            </a>
        </li>
        <?php if (session()->get('user_role') === 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center <?= (uri_string() === 'setup') ? 'active' : '' ?>" href="/setup">
                <i class="bi bi-gear-fill"></i><span><span><?= lang('Crm.setup') ?></span></span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<!-- Top navbar -->
<nav id="topnav" class="navbar navbar-dark bg-coaty-dark px-3 py-2">
    <button class="btn btn-sm btn-outline-light d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list fs-5"></i>
    </button>
    <span class="navbar-brand d-none d-md-block fw-semibold text-white ms-2"><?= esc($title ?? '') ?></span>
    <div class="ms-auto d-flex align-items-center gap-2">
        <a href="/profile" class="btn btn-sm btn-outline-light d-none d-sm-inline">
            <i class="bi bi-person-circle me-1"></i><?= esc(session()->get('user_name') ?? '') ?>
        </a>
        <span class="badge bg-secondary text-uppercase small d-none d-sm-inline"><?= esc(session()->get('user_role') ?? '') ?></span>
        <a href="/logout" class="btn btn-sm btn-outline-light"><i class="bi bi-box-arrow-right me-1"></i><?= lang('Crm.logout') ?></a>
    </div>
</nav>

<!-- Main content -->
<div id="main-content">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('sidebar-overlay').classList.toggle('show');
}
</script>
</body>
</html>

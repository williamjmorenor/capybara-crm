<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-funnel me-2 text-warning"></i>Leads</h5>
    <a href="/leads/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Lead</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/leads" class="row g-2">
            <div class="col-sm-6 col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search by name or email…">
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <select class="form-select form-select-sm" name="status">
                    <option value="">All statuses</option>
                    <?php foreach (['new', 'contacted', 'qualified', 'lost'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($statusFilter ?? '') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button>
                <?php if ($search || $statusFilter): ?>
                    <a href="/leads" class="btn btn-outline-danger btn-sm">Clear</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($leads)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-funnel fs-1 d-block mb-2"></i>No leads found.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Est. Value</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><a href="/leads/<?= $lead['id'] ?>" class="text-decoration-none fw-semibold"><?= esc($lead['name']) ?></a></td>
                            <td class="text-muted"><?= esc($lead['email'] ?? '—') ?></td>
                            <td><span class="badge bg-light text-dark text-capitalize"><?= esc($lead['source']) ?></span></td>
                            <td><span class="badge badge-status-<?= $lead['status'] ?>"><?= ucfirst($lead['status']) ?></span></td>
                            <td><?= $lead['estimated_value'] > 0 ? '$' . number_format($lead['estimated_value'], 2) : '—' ?></td>
                            <td class="text-end">
                                <a href="/leads/<?= $lead['id'] ?>" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="/leads/<?= $lead['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/leads/<?= $lead['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this lead?')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

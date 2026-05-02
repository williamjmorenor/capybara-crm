<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-funnel me-2 text-warning"></i><?= lang('Crm.leads') ?></h5>
    <a href="/leads/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i><?= lang('Crm.new_lead') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/leads" class="row g-2">
            <div class="col-sm-6 col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>" placeholder="<?= lang('Crm.search_leads') ?>">
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <select class="form-select form-select-sm" name="status">
                    <option value=""><?= lang('Crm.all_statuses') ?></option>
                    <?php foreach (['new', 'contacted', 'qualified', 'lost'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($statusFilter ?? '') === $s ? 'selected' : '' ?>><?= lang('Crm.status_' . $s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm" type="submit"><?= lang('Crm.filter') ?></button>
                <?php if ($search || $statusFilter): ?>
                    <a href="/leads" class="btn btn-outline-danger btn-sm"><?= lang('Crm.clear') ?></a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($leads)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-funnel fs-1 d-block mb-2"></i><?= lang('Crm.no_leads') ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><?= lang('Crm.name') ?></th>
                            <th><?= lang('Crm.email') ?></th>
                            <th><?= lang('Crm.source') ?></th>
                            <th><?= lang('Crm.status') ?></th>
                            <th><?= lang('Crm.est_value') ?></th>
                            <th class="text-end"><?= lang('Crm.actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><a href="/leads/<?= $lead['id'] ?>" class="text-decoration-none fw-semibold"><?= esc($lead['name']) ?></a></td>
                            <td class="text-muted"><?= esc($lead['email'] ?? '—') ?></td>
                            <td><span class="badge bg-light text-dark"><?= lang('Crm.source_' . $lead['source']) ?></span></td>
                            <td><span class="badge badge-status-<?= $lead['status'] ?>"><?= lang('Crm.status_' . $lead['status']) ?></span></td>
                            <td><?= $lead['estimated_value'] > 0 ? '$' . number_format($lead['estimated_value'], 2) : '—' ?></td>
                            <td class="text-end">
                                <a href="/leads/<?= $lead['id'] ?>" class="btn btn-sm btn-outline-info" title="<?= lang('Crm.view_all') ?>"><i class="bi bi-eye"></i></a>
                                <a href="/leads/<?= $lead['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="<?= lang('Crm.edit') ?>"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/leads/<?= $lead['id'] ?>/delete" class="d-inline" onsubmit="return confirm('<?= lang('Crm.delete_lead_confirm') ?>')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" title="<?= lang('Crm.delete') ?>"><i class="bi bi-trash"></i></button>
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

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i><?= esc($contact['name']) ?></h5>
    <div class="d-flex gap-2">
        <a href="/contacts/<?= $contact['id'] ?>/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i><?= lang('Crm.edit') ?></a>
        <a href="/contacts" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3"><?= lang('Crm.contact_details') ?></h6>
                <dl class="row mb-0">
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.name') ?></dt>
                    <dd class="col-sm-8"><?= esc($contact['name']) ?></dd>
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.email') ?></dt>
                    <dd class="col-sm-8"><?= $contact['email'] ? '<a href="mailto:' . esc($contact['email']) . '">' . esc($contact['email']) . '</a>' : '—' ?></dd>
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.phone') ?></dt>
                    <dd class="col-sm-8"><?= esc($contact['phone'] ?? '—') ?></dd>
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.company') ?></dt>
                    <dd class="col-sm-8"><?= esc($contact['company'] ?? '—') ?></dd>
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.status') ?></dt>
                    <dd class="col-sm-8"><span class="badge badge-status-<?= $contact['status'] ?>"><?= lang('Crm.status_' . $contact['status']) ?></span></dd>
                    <dt class="col-sm-4 text-muted"><?= lang('Crm.created') ?></dt>
                    <dd class="col-sm-8 small text-muted"><?= esc($contact['created_at'] ?? '—') ?></dd>
                </dl>
            </div>
        </div>

        <?php if ($contact['notes']): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-2"><?= lang('Crm.notes') ?></h6>
                <p class="mb-0"><?= nl2br(esc($contact['notes'])) ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0"><i class="bi bi-calendar-check me-2 text-info"></i><?= lang('Crm.activities') ?></h6>
                <a href="/activities/create?related_type=contact&related_id=<?= $contact['id'] ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-plus-lg me-1"></i><?= lang('Crm.add_activity') ?>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($activities)): ?>
                    <div class="text-center text-muted py-4"><?= lang('Crm.no_activities') ?></div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($activities as $activity): ?>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-secondary text-uppercase"><?= esc($activity['type']) ?></span>
                                <small class="text-muted"><?= esc($activity['date']) ?></small>
                            </div>
                            <p class="mb-0 mt-1 small"><?= esc($activity['description']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

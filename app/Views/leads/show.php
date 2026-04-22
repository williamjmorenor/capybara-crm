<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-funnel me-2 text-warning"></i><?= esc($lead['name']) ?></h5>
    <div class="d-flex gap-2">
        <a href="/leads/<?= $lead['id'] ?>/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i><?= lang('Crm.edit') ?></a>
        <a href="/leads" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3"><?= lang('Crm.lead_details') ?></h6>
                <dl class="row mb-0">
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.name') ?></dt>
                    <dd class="col-sm-7"><?= esc($lead['name']) ?></dd>
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.email') ?></dt>
                    <dd class="col-sm-7"><?= $lead['email'] ? '<a href="mailto:' . esc($lead['email']) . '">' . esc($lead['email']) . '</a>' : '—' ?></dd>
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.source') ?></dt>
                    <dd class="col-sm-7"><span class="badge bg-light text-dark"><?= lang('Crm.source_' . $lead['source']) ?></span></dd>
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.status') ?></dt>
                    <dd class="col-sm-7"><span class="badge badge-status-<?= $lead['status'] ?>"><?= lang('Crm.status_' . $lead['status']) ?></span></dd>
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.est_value') ?></dt>
                    <dd class="col-sm-7"><?= $lead['estimated_value'] > 0 ? '$' . number_format($lead['estimated_value'], 2) : '—' ?></dd>
                    <dt class="col-sm-5 text-muted"><?= lang('Crm.created') ?></dt>
                    <dd class="col-sm-7 small text-muted"><?= esc($lead['created_at'] ?? '—') ?></dd>
                </dl>
            </div>
        </div>

        <?php if ($lead['notes']): ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-2"><?= lang('Crm.notes') ?></h6>
                <p class="mb-0"><?= nl2br(esc($lead['notes'])) ?></p>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($lead['status'] !== 'lost'): ?>
        <div class="card border-0 shadow-sm border-success">
            <div class="card-body text-center">
                <i class="bi bi-person-check fs-2 text-success d-block mb-2"></i>
                <p class="mb-3 text-muted small"><?= lang('Crm.convert_pipeline_hint') ?></p>
                <form method="post" action="/leads/<?= $lead['id'] ?>/convert" onsubmit="return confirm('<?= lang('Crm.convert_lead_confirm') ?>')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-arrow-right-circle me-1"></i><?= lang('Crm.convert_to_contact') ?>
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0"><i class="bi bi-calendar-check me-2 text-info"></i><?= lang('Crm.activities') ?></h6>
                <a href="/activities/create?related_type=lead&related_id=<?= $lead['id'] ?>" class="btn btn-sm btn-outline-primary">
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

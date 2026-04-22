<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-trophy me-2 text-success"></i><?= esc($opportunity['title']) ?></h5>
    <div class="d-flex gap-2">
        <a href="/opportunities/<?= $opportunity['id'] ?>/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i><?= lang('Crm.edit') ?></a>
        <a href="/opportunities" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <h6 class="fw-semibold text-muted text-uppercase small mb-3"><?= lang('Crm.opportunity_details') ?></h6>
        <dl class="row">
            <dt class="col-sm-4 text-muted"><?= lang('Crm.title') ?></dt>
            <dd class="col-sm-8"><?= esc($opportunity['title']) ?></dd>

            <dt class="col-sm-4 text-muted"><?= lang('Crm.status') ?></dt>
            <dd class="col-sm-8">
                <span class="badge badge-status-<?= $opportunity['status'] ?>"><?= lang('Crm.status_' . $opportunity['status']) ?></span>
            </dd>

            <dt class="col-sm-4 text-muted"><?= lang('Crm.amount_label') ?></dt>
            <dd class="col-sm-8 fw-semibold text-success"><?= $opportunity['amount'] > 0 ? '$' . number_format($opportunity['amount'], 2) : '—' ?></dd>

            <dt class="col-sm-4 text-muted"><?= lang('Crm.close_date') ?></dt>
            <dd class="col-sm-8"><?= esc($opportunity['close_date'] ?? '—') ?></dd>

            <dt class="col-sm-4 text-muted"><?= lang('Crm.contact') ?></dt>
            <dd class="col-sm-8">
                <?php if ($contact): ?>
                    <a href="/contacts/<?= $contact['id'] ?>"><?= esc($contact['name']) ?></a>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif; ?>
            </dd>

            <dt class="col-sm-4 text-muted"><?= lang('Crm.created') ?></dt>
            <dd class="col-sm-8 small text-muted"><?= esc($opportunity['created_at'] ?? '—') ?></dd>
        </dl>

        <?php if ($opportunity['notes']): ?>
            <hr>
            <h6 class="fw-semibold text-muted text-uppercase small mb-2"><?= lang('Crm.notes') ?></h6>
            <p class="mb-0"><?= nl2br(esc($opportunity['notes'])) ?></p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

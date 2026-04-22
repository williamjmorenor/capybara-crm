<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-trophy me-2 text-success"></i><?= esc($opportunity['title']) ?></h5>
    <div class="d-flex gap-2">
        <a href="/opportunities/<?= $opportunity['id'] ?>/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i>Edit</a>
        <a href="/opportunities" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <h6 class="fw-semibold text-muted text-uppercase small mb-3">Opportunity Details</h6>
        <dl class="row">
            <dt class="col-sm-4 text-muted">Title</dt>
            <dd class="col-sm-8"><?= esc($opportunity['title']) ?></dd>

            <dt class="col-sm-4 text-muted">Status</dt>
            <dd class="col-sm-8">
                <span class="badge badge-status-<?= $opportunity['status'] ?>"><?= ucwords(str_replace('_', ' ', $opportunity['status'])) ?></span>
            </dd>

            <dt class="col-sm-4 text-muted">Amount</dt>
            <dd class="col-sm-8 fw-semibold text-success"><?= $opportunity['amount'] > 0 ? '$' . number_format($opportunity['amount'], 2) : '—' ?></dd>

            <dt class="col-sm-4 text-muted">Close Date</dt>
            <dd class="col-sm-8"><?= esc($opportunity['close_date'] ?? '—') ?></dd>

            <dt class="col-sm-4 text-muted">Contact</dt>
            <dd class="col-sm-8">
                <?php if ($contact): ?>
                    <a href="/contacts/<?= $contact['id'] ?>"><?= esc($contact['name']) ?></a>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif; ?>
            </dd>

            <dt class="col-sm-4 text-muted">Created</dt>
            <dd class="col-sm-8 small text-muted"><?= esc($opportunity['created_at'] ?? '—') ?></dd>
        </dl>

        <?php if ($opportunity['notes']): ?>
            <hr>
            <h6 class="fw-semibold text-muted text-uppercase small mb-2">Notes</h6>
            <p class="mb-0"><?= nl2br(esc($opportunity['notes'])) ?></p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

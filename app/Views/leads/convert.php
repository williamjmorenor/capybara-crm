<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-arrow-right-circle me-2 text-success"></i>Convert Lead to Contact</h5>
    <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:520px">
    <div class="card-body text-center py-5">
        <i class="bi bi-person-check fs-1 text-success d-block mb-3"></i>
        <h5>Convert <strong><?= esc($lead['name']) ?></strong>?</h5>
        <p class="text-muted">This will create a new contact from the lead data and archive the lead.</p>

        <form method="post" action="/leads/<?= $lead['id'] ?>/convert">
            <?= csrf_field() ?>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg me-1"></i>Yes, Convert
                </button>
                <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

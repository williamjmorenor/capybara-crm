<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-arrow-right-circle me-2 text-success"></i><?= lang('Crm.convert_lead_title') ?></h5>
    <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm" style="max-width:520px">
    <div class="card-body text-center py-5">
        <i class="bi bi-person-check fs-1 text-success d-block mb-3"></i>
        <h5><?= lang('Crm.convert_lead_title') ?> <strong><?= esc($lead['name']) ?></strong>?</h5>
        <p class="text-muted"><?= lang('Crm.convert_lead_body') ?></p>

        <form method="post" action="/leads/<?= $lead['id'] ?>/convert">
            <?= csrf_field() ?>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg me-1"></i><?= lang('Crm.yes_convert') ?>
                </button>
                <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary"><?= lang('Crm.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

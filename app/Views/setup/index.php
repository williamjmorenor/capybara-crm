<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-gear-fill me-2 text-success"></i><?= lang('Crm.setup') ?></h5>
    <a href="/dashboard" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="fw-semibold mb-3"><?= lang('Crm.user_global_settings') ?></h6>
        <p class="text-muted mb-4"><?= lang('Crm.setup_description') ?></p>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 bg-light p-3">
                    <h6 class="fw-semibold"><?= lang('Crm.default_user_role') ?></h6>
                    <p class="mb-0 text-muted"><?= lang('Crm.default_user_role_description') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 bg-light p-3">
                    <h6 class="fw-semibold"><?= lang('Crm.require_password_reset') ?></h6>
                    <p class="mb-0 text-muted"><?= lang('Crm.require_password_reset_description') ?></p>
                </div>
            </div>
        </div>

        <div class="alert alert-info mt-4">
            <?= lang('Crm.setup_admin_only_note') ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

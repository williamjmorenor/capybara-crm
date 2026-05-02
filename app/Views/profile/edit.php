<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-person-circle me-2 text-success"></i><?= lang('Crm.profile') ?></h5>
    <a href="/dashboard" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm" style="max-width:680px">
    <div class="card-body">
        <form method="post" action="/profile" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold"><?= lang('Crm.name') ?> <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="<?= esc(old('name', $user['name'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold"><?= lang('Crm.email_address') ?> <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="<?= esc(old('email', $user['email'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold"><?= lang('Crm.password') ?></label>
                <input type="password" id="password" name="password" class="form-control" placeholder="<?= lang('Crm.password') ?>">
                <div class="form-text"><?= lang('Crm.profile_password_hint') ?></div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i><?= lang('Crm.save_changes') ?></button>
                <a href="/dashboard" class="btn btn-outline-secondary"><?= lang('Crm.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

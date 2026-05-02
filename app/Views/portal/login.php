<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-sm-5">
        <div class="login-header">
            <h2><?= lang('Crm.client_portal') ?></h2>
            <p class="login-subtitle"><?= lang('Crm.portal_subtitle') ?></p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="/portal/login" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label"><?= lang('Crm.email_address') ?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                           value="<?= esc(old('email')) ?>" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label"><?= lang('Crm.password') ?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                           placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i><?= lang('Crm.sign_in') ?>
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

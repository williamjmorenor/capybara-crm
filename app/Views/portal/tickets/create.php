<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-ticket-perforated me-2 text-primary"></i><?= lang('Crm.new_ticket') ?></h5>
    <a href="/portal/tickets" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="/portal/tickets/create">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.title') ?> <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="<?= esc(old('title')) ?>" required maxlength="200">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.ticket_type') ?> <span class="text-danger">*</span></label>
                <select name="type" class="form-select" required>
                    <?php foreach (['support', 'warranty', 'incident', 'commercial'] as $t): ?>
                        <option value="<?= $t ?>" <?= old('type') === $t ? 'selected' : '' ?>>
                            <?= lang('Crm.ticket_type_' . $t) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold"><?= lang('Crm.description') ?></label>
                <textarea name="description" class="form-control" rows="5"><?= esc(old('description')) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i><?= lang('Crm.create_ticket') ?>
                </button>
                <a href="/portal/tickets" class="btn btn-outline-secondary"><?= lang('Crm.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

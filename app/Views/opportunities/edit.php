<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-pencil me-2 text-success"></i><?= lang('Crm.edit_opportunity') ?></h5>
    <a href="/opportunities/<?= $opportunity['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/opportunities/<?= $opportunity['id'] ?>/edit" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.title') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="<?= esc(old('title', $opportunity['title'])) ?>" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.status') ?> <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <?php foreach (['new', 'in_progress', 'negotiation', 'won', 'lost'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('status', $opportunity['status']) === $s ? 'selected' : '' ?>><?= lang('Crm.status_' . $s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.amount') ?></label>
                    <input type="number" class="form-control" name="amount" value="<?= esc(old('amount', $opportunity['amount'])) ?>" min="0" step="0.01">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.contact') ?></label>
                    <select class="form-select" name="contact_id">
                        <option value=""><?= lang('Crm.none_option') ?></option>
                        <?php foreach ($contacts as $contact): ?>
                            <option value="<?= $contact['id'] ?>" <?= old('contact_id', $opportunity['contact_id']) == $contact['id'] ? 'selected' : '' ?>><?= esc($contact['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.close_date') ?></label>
                    <input type="date" class="form-control" name="close_date" value="<?= esc(old('close_date', $opportunity['close_date'])) ?>">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold"><?= lang('Crm.notes') ?></label>
                <textarea class="form-control" name="notes" rows="3"><?= esc(old('notes', $opportunity['notes'])) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i><?= lang('Crm.save_changes') ?></button>
                <a href="/opportunities/<?= $opportunity['id'] ?>" class="btn btn-outline-secondary"><?= lang('Crm.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

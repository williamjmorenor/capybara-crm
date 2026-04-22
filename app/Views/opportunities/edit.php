<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-pencil me-2 text-success"></i>Edit Opportunity</h5>
    <a href="/opportunities/<?= $opportunity['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/opportunities/<?= $opportunity['id'] ?>/edit" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="<?= esc(old('title', $opportunity['title'])) ?>" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <?php foreach (['new', 'in_progress', 'negotiation', 'won', 'lost'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('status', $opportunity['status']) === $s ? 'selected' : '' ?>><?= ucwords(str_replace('_', ' ', $s)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Amount ($)</label>
                    <input type="number" class="form-control" name="amount" value="<?= esc(old('amount', $opportunity['amount'])) ?>" min="0" step="0.01">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Contact</label>
                    <select class="form-select" name="contact_id">
                        <option value="">— None —</option>
                        <?php foreach ($contacts as $contact): ?>
                            <option value="<?= $contact['id'] ?>" <?= old('contact_id', $opportunity['contact_id']) == $contact['id'] ? 'selected' : '' ?>><?= esc($contact['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Close Date</label>
                    <input type="date" class="form-control" name="close_date" value="<?= esc(old('close_date', $opportunity['close_date'])) ?>">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Notes</label>
                <textarea class="form-control" name="notes" rows="3"><?= esc(old('notes', $opportunity['notes'])) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Changes</button>
                <a href="/opportunities/<?= $opportunity['id'] ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

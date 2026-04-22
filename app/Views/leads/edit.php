<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-pencil me-2 text-warning"></i>Edit Lead</h5>
    <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/leads/<?= $lead['id'] ?>/edit" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= esc(old('name', $lead['name'])) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" value="<?= esc(old('email', $lead['email'])) ?>">
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Source <span class="text-danger">*</span></label>
                    <select class="form-select" name="source" required>
                        <?php foreach (['web', 'referral', 'manual', 'other'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('source', $lead['source']) === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <?php foreach (['new', 'contacted', 'qualified', 'lost'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('status', $lead['status']) === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Estimated Value ($)</label>
                    <input type="number" class="form-control" name="estimated_value" value="<?= esc(old('estimated_value', $lead['estimated_value'])) ?>" min="0" step="0.01">
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Assigned To</label>
                    <select class="form-select" name="assigned_to">
                        <option value="">Unassigned</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= old('assigned_to', $lead['assigned_to']) == $user['id'] ? 'selected' : '' ?>><?= esc($user['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Notes</label>
                <textarea class="form-control" name="notes" rows="3"><?= esc(old('notes', $lead['notes'])) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Changes</button>
                <a href="/leads/<?= $lead['id'] ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

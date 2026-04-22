<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-calendar-plus me-2 text-info"></i>New Activity</h5>
    <a href="/activities" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/activities/create" novalidate>
            <?= csrf_field() ?>

            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="type" required>
                        <?php foreach (['call', 'email', 'meeting', 'note'] as $t): ?>
                            <option value="<?= $t ?>" <?= old('type', $type ?? '') === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="date"
                           value="<?= esc(old('date', $default_date ?? '')) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required><?= esc(old('description')) ?></textarea>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Related To</label>
                    <select class="form-select" name="related_type">
                        <option value="">— None —</option>
                        <?php foreach (['lead', 'contact', 'opportunity'] as $rt): ?>
                            <option value="<?= $rt ?>" <?= old('related_type', $related_type ?? '') === $rt ? 'selected' : '' ?>><?= ucfirst($rt) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Related ID</label>
                    <input type="number" class="form-control" name="related_id"
                           value="<?= esc(old('related_id', $related_id ?? '')) ?>" min="1" placeholder="e.g. 1">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Create Activity</button>
                <a href="/activities" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

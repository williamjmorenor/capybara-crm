<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-pencil me-2 text-primary"></i>Edit Contact</h5>
    <a href="/contacts/<?= $contact['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/contacts/<?= $contact['id'] ?>/edit" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= esc(old('name', $contact['name'])) ?>" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= esc(old('email', $contact['email'])) ?>">
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?= esc(old('phone', $contact['phone'])) ?>">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Company</label>
                    <input type="text" class="form-control" name="company" value="<?= esc(old('company', $contact['company'])) ?>">
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="active" <?= old('status', $contact['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= old('status', $contact['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Notes</label>
                <textarea class="form-control" name="notes" rows="3"><?= esc(old('notes', $contact['notes'])) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Changes</button>
                <a href="/contacts/<?= $contact['id'] ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

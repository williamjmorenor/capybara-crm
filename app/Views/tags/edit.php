<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-pencil me-2 text-secondary"></i>Edit Tag</h5>
    <a href="/tags" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-sm" style="max-width:480px">
    <div class="card-body">
        <form method="post" action="/tags/<?= $tag['id'] ?>/edit" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?= esc(old('name', $tag['name'])) ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Color</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="color" class="form-control form-control-color" name="color"
                           value="<?= esc(old('color', $tag['color'])) ?>" style="width:60px">
                    <span class="text-muted small">Pick a color for the tag badge</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Changes</button>
                <a href="/tags" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

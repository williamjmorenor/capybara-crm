<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-tags me-2 text-secondary"></i>Tags</h5>
    <a href="/tags/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Tag</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($tags)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-tags fs-1 d-block mb-2"></i>No tags yet.
                <a href="/tags/create" class="d-block mt-2">Create the first tag</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Preview</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td>
                                <span class="badge" style="background-color:<?= esc($tag['color']) ?>;font-size:0.85rem">
                                    <?= esc($tag['name']) ?>
                                </span>
                            </td>
                            <td><?= esc($tag['name']) ?></td>
                            <td><code><?= esc($tag['color']) ?></code></td>
                            <td class="text-end">
                                <a href="/tags/<?= $tag['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/tags/<?= $tag['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this tag?')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

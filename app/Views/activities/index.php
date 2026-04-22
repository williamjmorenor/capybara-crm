<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-calendar-check me-2 text-info"></i>Activities</h5>
    <a href="/activities/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Activity</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/activities" class="row g-2">
            <div class="col-sm-4">
                <select class="form-select form-select-sm" name="type">
                    <option value="">All types</option>
                    <?php foreach (['call', 'email', 'meeting', 'note'] as $t): ?>
                        <option value="<?= $t ?>" <?= ($typeFilter ?? '') === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button>
                <?php if ($typeFilter): ?>
                    <a href="/activities" class="btn btn-outline-danger btn-sm">Clear</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($activities)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>No activities found.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Related</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td><span class="badge bg-secondary text-uppercase"><?= esc($activity['type']) ?></span></td>
                            <td><?= esc(mb_strimwidth($activity['description'], 0, 80, '…')) ?></td>
                            <td class="text-muted small"><?= esc($activity['date']) ?></td>
                            <td>
                                <?php if ($activity['related_type'] && $activity['related_id']): ?>
                                    <span class="badge bg-light text-dark text-capitalize"><?= esc($activity['related_type']) ?> #<?= $activity['related_id'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="/activities/<?= $activity['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/activities/<?= $activity['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this activity?')">
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

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Contacts</h5>
    <a href="/contacts/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Contact</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/contacts" class="row g-2">
            <div class="col-sm-8 col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search by name, email or company…">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <?php if ($search): ?>
                        <a href="/contacts" class="btn btn-outline-danger">Clear</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($contacts)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-person-x fs-1 d-block mb-2"></i>No contacts found.
                <a href="/contacts/create" class="d-block mt-2">Create the first contact</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><a href="/contacts/<?= $contact['id'] ?>" class="text-decoration-none fw-semibold"><?= esc($contact['name']) ?></a></td>
                            <td class="text-muted"><?= esc($contact['email'] ?? '—') ?></td>
                            <td><?= esc($contact['company'] ?? '—') ?></td>
                            <td><?= esc($contact['phone'] ?? '—') ?></td>
                            <td>
                                <span class="badge badge-status-<?= $contact['status'] ?>">
                                    <?= ucfirst($contact['status']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/contacts/<?= $contact['id'] ?>" class="btn btn-outline-info btn-sm" title="View"><i class="bi bi-eye"></i></a>
                                <a href="/contacts/<?= $contact['id'] ?>/edit" class="btn btn-outline-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/contacts/<?= $contact['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this contact?')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-xs btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
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

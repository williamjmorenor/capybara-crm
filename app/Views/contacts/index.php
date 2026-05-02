<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i><?= lang('Crm.contacts') ?></h5>
    <a href="/contacts/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i><?= lang('Crm.new_contact') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/contacts" class="row g-2">
            <div class="col-sm-8 col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>" placeholder="<?= lang('Crm.search_contacts') ?>">
                    <button class="btn btn-outline-secondary" type="submit"><?= lang('Crm.search') ?></button>
                    <?php if ($search): ?>
                        <a href="/contacts" class="btn btn-outline-danger"><?= lang('Crm.clear') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($contacts)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-person-x fs-1 d-block mb-2"></i><?= lang('Crm.no_contacts') ?>
                <a href="/contacts/create" class="d-block mt-2"><?= lang('Crm.create_first_contact') ?></a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><?= lang('Crm.name') ?></th>
                            <th><?= lang('Crm.email') ?></th>
                            <th><?= lang('Crm.company') ?></th>
                            <th><?= lang('Crm.phone') ?></th>
                            <th><?= lang('Crm.status') ?></th>
                            <th class="text-end"><?= lang('Crm.actions') ?></th>
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
                                    <?= lang('Crm.status_' . $contact['status']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/contacts/<?= $contact['id'] ?>" class="btn btn-outline-info btn-sm" title="<?= lang('Crm.view_all') ?>"><i class="bi bi-eye"></i></a>
                                <a href="/contacts/<?= $contact['id'] ?>/edit" class="btn btn-outline-primary btn-sm" title="<?= lang('Crm.edit') ?>"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/contacts/<?= $contact['id'] ?>/delete" class="d-inline" onsubmit="return confirm('<?= lang('Crm.delete_contact_confirm') ?>')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-outline-danger btn-sm" title="<?= lang('Crm.delete') ?>"><i class="bi bi-trash"></i></button>
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

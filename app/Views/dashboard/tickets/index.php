<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-ticket-perforated me-2 text-danger"></i><?= lang('Crm.tickets') ?></h5>
    <a href="/tickets/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i><?= lang('Crm.new_ticket') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3">
        <form method="get" action="/tickets" class="row g-2">
            <div class="col-sm-5 col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>" placeholder="<?= lang('Crm.search') ?>…">
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <select class="form-select form-select-sm" name="status">
                    <option value=""><?= lang('Crm.all_statuses') ?></option>
                    <?php foreach (['new', 'assigned', 'solved', 'closed'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($statusFilter ?? '') === $s ? 'selected' : '' ?>>
                            <?= lang('Crm.status_' . $s) ?: ucfirst($s) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm" type="submit"><?= lang('Crm.filter') ?></button>
                <?php if ($search || $statusFilter): ?>
                    <a href="/tickets" class="btn btn-outline-danger btn-sm"><?= lang('Crm.clear') ?></a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($tickets)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-ticket-perforated fs-1 d-block mb-2"></i><?= lang('Crm.no_tickets') ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><?= lang('Crm.title') ?></th>
                            <th><?= lang('Crm.contact') ?></th>
                            <th><?= lang('Crm.ticket_type') ?></th>
                            <th><?= lang('Crm.priority') ?></th>
                            <th><?= lang('Crm.status') ?></th>
                            <th class="text-end"><?= lang('Crm.actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket):
                            $priorityClass = match($ticket['priority']) {
                                'high'   => 'danger',
                                'medium' => 'warning',
                                'low'    => 'success',
                                default  => 'secondary',
                            };
                            $statusClass = match($ticket['status']) {
                                'new'      => 'primary',
                                'assigned' => 'warning',
                                'solved'   => 'success',
                                'closed'   => 'secondary',
                                default    => 'light',
                            };
                        ?>
                        <tr>
                            <td class="text-muted small">#<?= $ticket['id'] ?></td>
                            <td>
                                <a href="/tickets/<?= $ticket['id'] ?>" class="text-decoration-none fw-semibold"><?= esc($ticket['title']) ?></a>
                                <?php if ($ticket['is_billable']): ?>
                                    <span class="badge bg-success ms-1 small">$</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-muted">
                                <?= isset($clients[$ticket['client_id']]) ? esc($clients[$ticket['client_id']]['name']) : '—' ?>
                            </td>
                            <td><span class="badge bg-light text-dark"><?= lang('Crm.ticket_type_' . $ticket['type']) ?></span></td>
                            <td><span class="badge bg-<?= $priorityClass ?>"><?= lang('Crm.priority_' . $ticket['priority']) ?></span></td>
                            <td><span class="badge bg-<?= $statusClass ?>"><?= lang('Crm.status_' . $ticket['status']) ?: ucfirst($ticket['status']) ?></span></td>
                            <td class="text-end">
                                <a href="/tickets/<?= $ticket['id'] ?>" class="btn btn-sm btn-outline-info" title="<?= lang('Crm.view_all') ?>"><i class="bi bi-eye"></i></a>
                                <a href="/tickets/<?= $ticket['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="<?= lang('Crm.edit') ?>"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/tickets/<?= $ticket['id'] ?>/delete" class="d-inline"
                                      onsubmit="return confirm('<?= lang('Crm.delete_ticket_confirm') ?>')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" title="<?= lang('Crm.delete') ?>"><i class="bi bi-trash"></i></button>
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

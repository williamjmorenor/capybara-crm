<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-ticket-perforated me-2 text-primary"></i><?= lang('Crm.my_tickets') ?></h5>
    <a href="/portal/tickets/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i><?= lang('Crm.new_ticket') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($tickets)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-ticket-perforated fs-1 d-block mb-2"></i>
                <p><?= lang('Crm.no_tickets') ?></p>
                <a href="/portal/tickets/create" class="btn btn-primary btn-sm"><?= lang('Crm.new_ticket') ?></a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><?= lang('Crm.title') ?></th>
                            <th><?= lang('Crm.ticket_type') ?></th>
                            <th><?= lang('Crm.status') ?></th>
                            <th><?= lang('Crm.created') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td class="text-muted small">#<?= $ticket['id'] ?></td>
                            <td>
                                <a href="/portal/tickets/<?= $ticket['id'] ?>" class="text-decoration-none fw-semibold">
                                    <?= esc($ticket['title']) ?>
                                </a>
                            </td>
                            <td><span class="badge bg-light text-dark"><?= lang('Crm.ticket_type_' . $ticket['type']) ?></span></td>
                            <td>
                                <?php
                                $statusClass = match($ticket['status']) {
                                    'new'      => 'primary',
                                    'assigned' => 'warning',
                                    'solved'   => 'success',
                                    'closed'   => 'secondary',
                                    default    => 'light',
                                };
                                ?>
                                <span class="badge bg-<?= $statusClass ?>"><?= lang('Crm.status_' . $ticket['status']) ?: ucfirst($ticket['status']) ?></span>
                            </td>
                            <td class="text-muted small"><?= esc(substr($ticket['created_at'] ?? '', 0, 10)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

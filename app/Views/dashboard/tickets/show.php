<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$statusClass = match($ticket['status']) {
    'new'      => 'primary',
    'assigned' => 'warning',
    'solved'   => 'success',
    'closed'   => 'secondary',
    default    => 'light',
};
$priorityClass = match($ticket['priority']) {
    'high'   => 'danger',
    'medium' => 'warning',
    'low'    => 'success',
    default  => 'secondary',
};
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0">
        <i class="bi bi-ticket-perforated me-2 text-danger"></i>
        <span class="badge bg-<?= $statusClass ?> me-1"><?= lang('Crm.status_' . $ticket['status']) ?: ucfirst($ticket['status']) ?></span>
        <?= esc($ticket['title']) ?>
    </h5>
    <div class="d-flex gap-2">
        <a href="/tickets/<?= $ticket['id'] ?>/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i><?= lang('Crm.edit') ?></a>
        <a href="/tickets" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
    </div>
</div>

<div class="row g-3">
    <!-- Left column: ticket details + actions -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3"><?= lang('Crm.ticket_details') ?></h6>
                <dl class="row mb-0 small">
                    <dt class="col-5 text-muted"><?= lang('Crm.ticket_type') ?></dt>
                    <dd class="col-7"><span class="badge bg-light text-dark"><?= lang('Crm.ticket_type_' . $ticket['type']) ?></span></dd>

                    <dt class="col-5 text-muted"><?= lang('Crm.priority') ?></dt>
                    <dd class="col-7"><span class="badge bg-<?= $priorityClass ?>"><?= lang('Crm.priority_' . $ticket['priority']) ?></span></dd>

                    <dt class="col-5 text-muted"><?= lang('Crm.contact') ?></dt>
                    <dd class="col-7"><?= $client ? esc($client['name']) : '<span class="text-muted">—</span>' ?></dd>

                    <dt class="col-5 text-muted"><?= lang('Crm.assigned_to') ?></dt>
                    <dd class="col-7"><?= $assignee ? esc($assignee['name']) : '<span class="text-muted">' . lang('Crm.unassigned') . '</span>' ?></dd>

                    <dt class="col-5 text-muted"><?= lang('Crm.is_billable') ?></dt>
                    <dd class="col-7">
                        <?php if ($ticket['is_billable']): ?>
                            <span class="badge bg-success">Yes</span>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-5 text-muted"><?= lang('Crm.created') ?></dt>
                    <dd class="col-7 text-muted"><?= esc(substr($ticket['created_at'] ?? '', 0, 10)) ?></dd>

                    <?php if ($ticket['closed_at']): ?>
                    <dt class="col-5 text-muted"><?= lang('Crm.status_closed') ?></dt>
                    <dd class="col-7 text-muted"><?= esc(substr($ticket['closed_at'], 0, 10)) ?></dd>
                    <?php endif; ?>
                </dl>

                <?php if ($ticket['description']): ?>
                    <hr>
                    <p class="mb-0 small"><?= nl2br(esc($ticket['description'])) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Assign form -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-2"><?= lang('Crm.assign_agent') ?></h6>
                <form method="post" action="/tickets/<?= $ticket['id'] ?>/assign">
                    <?= csrf_field() ?>
                    <select name="assigned_to" class="form-select form-select-sm mb-2">
                        <option value=""><?= lang('Crm.unassigned') ?></option>
                        <?php foreach ($agents as $agent): ?>
                            <option value="<?= $agent['id'] ?>" <?= $ticket['assigned_to'] == $agent['id'] ? 'selected' : '' ?>>
                                <?= esc($agent['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-person-check me-1"></i><?= lang('Crm.assign_agent') ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Create opportunity -->
        <?php if ($ticket['is_billable']): ?>
        <div class="card border-0 shadow-sm <?= $existingOpportunity ? 'border-success' : '' ?>">
            <div class="card-body text-center">
                <?php if ($existingOpportunity): ?>
                    <i class="bi bi-trophy-fill fs-3 text-success d-block mb-2"></i>
                    <p class="small mb-2"><?= lang('Crm.opportunity_exists') ?></p>
                    <a href="/opportunities/<?= $existingOpportunity['id'] ?>" class="btn btn-sm btn-outline-success w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i><?= lang('Crm.view_all') ?>
                    </a>
                <?php else: ?>
                    <i class="bi bi-trophy fs-3 text-warning d-block mb-2"></i>
                    <p class="small mb-2"><?= lang('Crm.create_opportunity_from_ticket') ?></p>
                    <form method="post" action="/tickets/<?= $ticket['id'] ?>/opportunity">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-warning w-100">
                            <i class="bi bi-plus-circle me-1"></i><?= lang('Crm.create_opportunity_from_ticket') ?>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Right column: messages -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-semibold mb-0"><i class="bi bi-chat-dots me-2 text-info"></i><?= lang('Crm.messages') ?></h6>
            </div>
            <div class="card-body">
                <?php if (empty($messages)): ?>
                    <p class="text-muted text-center py-3"><?= lang('Crm.no_messages') ?></p>
                <?php else: ?>
                    <div class="d-flex flex-column gap-3 mb-4">
                        <?php foreach ($messages as $msg): ?>
                        <?php $isClient = $msg['author_type'] === 'client'; ?>
                        <div class="d-flex <?= $isClient ? 'justify-content-start' : 'justify-content-end' ?>">
                            <div class="p-3 rounded-3 border <?= $isClient ? 'bg-light' : 'bg-primary-subtle' ?>" style="max-width:85%">
                                <div class="d-flex gap-2 align-items-center mb-1">
                                    <span class="badge <?= $isClient ? 'bg-secondary' : 'bg-primary' ?> small">
                                        <?= $isClient ? lang('Crm.contact') : 'Agent' ?>
                                    </span>
                                    <?php if (isset($authors[$msg['author_id']])): ?>
                                        <span class="small fw-semibold"><?= esc($authors[$msg['author_id']]['name']) ?></span>
                                    <?php endif; ?>
                                    <?php if ($msg['type'] === 'private'): ?>
                                        <span class="badge bg-warning text-dark small"><i class="bi bi-lock"></i> Private</span>
                                    <?php endif; ?>
                                    <span class="text-muted small ms-auto"><?= esc(substr($msg['created_at'] ?? '', 0, 16)) ?></span>
                                </div>
                                <div><?= nl2br(esc($msg['message'])) ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <hr>
                <form method="post" action="/tickets/<?= $ticket['id'] ?>/message">
                    <?= csrf_field() ?>
                    <div class="mb-2">
                        <textarea name="message" class="form-control" rows="3"
                                  placeholder="<?= lang('Crm.reply') ?>…" required></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <select name="msg_type" class="form-select form-select-sm w-auto">
                            <option value="public"><?= lang('Crm.msg_type_public') ?></option>
                            <option value="private"><?= lang('Crm.msg_type_private') ?></option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-send me-1"></i><?= lang('Crm.send') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

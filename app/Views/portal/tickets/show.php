<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>

<?php
$statusClass = match($ticket['status']) {
    'new'      => 'primary',
    'assigned' => 'warning',
    'solved'   => 'success',
    'closed'   => 'secondary',
    default    => 'light',
};
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0">
        <i class="bi bi-ticket-perforated me-2 text-primary"></i>
        <span class="badge bg-<?= $statusClass ?> me-2"><?= lang('Crm.status_' . $ticket['status']) ?: ucfirst($ticket['status']) ?></span>
        <?= esc($ticket['title']) ?>
    </h5>
    <a href="/portal/tickets" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold text-muted text-uppercase small mb-3"><?= lang('Crm.ticket_details') ?></h6>
                <dl class="row mb-0 small">
                    <dt class="col-5 text-muted"><?= lang('Crm.ticket_type') ?></dt>
                    <dd class="col-7"><span class="badge bg-light text-dark"><?= lang('Crm.ticket_type_' . $ticket['type']) ?></span></dd>
                    <dt class="col-5 text-muted"><?= lang('Crm.status') ?></dt>
                    <dd class="col-7"><span class="badge bg-<?= $statusClass ?>"><?= lang('Crm.status_' . $ticket['status']) ?: ucfirst($ticket['status']) ?></span></dd>
                    <dt class="col-5 text-muted"><?= lang('Crm.created') ?></dt>
                    <dd class="col-7 text-muted"><?= esc(substr($ticket['created_at'] ?? '', 0, 10)) ?></dd>
                </dl>
                <?php if ($ticket['description']): ?>
                    <hr>
                    <p class="mb-0 small"><?= nl2br(esc($ticket['description'])) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

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
                        <div class="d-flex <?= $isClient ? 'justify-content-end' : 'justify-content-start' ?>">
                            <div class="p-3 rounded-3 <?= $isClient ? 'bg-primary text-white' : 'bg-light' ?>" style="max-width:80%">
                                <div class="small fw-semibold mb-1 <?= $isClient ? 'text-white-50' : 'text-muted' ?>">
                                    <?php if ($isClient): ?>
                                        <?= esc(session()->get('client_name')) ?>
                                    <?php elseif (isset($authors[$msg['author_id']])): ?>
                                        <?= esc($authors[$msg['author_id']]['name']) ?>
                                    <?php else: ?>
                                        Support
                                    <?php endif; ?>
                                    &nbsp;·&nbsp;<?= esc(substr($msg['created_at'] ?? '', 0, 16)) ?>
                                </div>
                                <div><?= nl2br(esc($msg['message'])) ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (! in_array($ticket['status'], ['solved', 'closed'])): ?>
                <hr>
                <form method="post" action="/portal/tickets/<?= $ticket['id'] ?>/message">
                    <?= csrf_field() ?>
                    <div class="mb-2">
                        <textarea name="message" class="form-control" rows="3"
                                  placeholder="<?= lang('Crm.reply') ?>…" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-send me-1"></i><?= lang('Crm.send') ?>
                    </button>
                </form>
                <?php else: ?>
                <div class="alert alert-secondary mt-3 mb-0 small">
                    <i class="bi bi-lock me-1"></i><?= lang('Crm.ticket_closed_no_reply') ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-trophy me-2 text-success"></i>Opportunities</h5>
    <a href="/opportunities/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Opportunity</a>
</div>

<?php
$statusLabels = [
    'new'         => ['label' => 'New',         'color' => 'primary'],
    'in_progress' => ['label' => 'In Progress',  'color' => 'warning'],
    'negotiation' => ['label' => 'Negotiation',  'color' => 'info'],
    'won'         => ['label' => 'Won',          'color' => 'success'],
    'lost'        => ['label' => 'Lost',         'color' => 'danger'],
];
?>

<div class="overflow-auto">
    <div class="d-flex gap-3 pb-3" style="min-width: max-content;">
        <?php foreach ($statuses as $status): ?>
        <?php $cfg = $statusLabels[$status]; ?>
        <div class="kanban-column" style="width:260px">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-<?= $cfg['color'] ?> bg-opacity-10 border-0 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-<?= $cfg['color'] === 'warning' ? 'dark' : $cfg['color'] ?>"><?= $cfg['label'] ?></span>
                        <span class="badge bg-<?= $cfg['color'] ?>"><?= count($kanban[$status]) ?></span>
                    </div>
                </div>
                <div class="card-body p-2" style="min-height:200px">
                    <?php if (empty($kanban[$status])): ?>
                        <p class="text-center text-muted small py-3">No opportunities</p>
                    <?php else: ?>
                        <?php foreach ($kanban[$status] as $opp): ?>
                        <div class="card border mb-2 shadow-sm">
                            <div class="card-body p-2">
                                <a href="/opportunities/<?= $opp['id'] ?>" class="text-decoration-none fw-semibold small d-block mb-1">
                                    <?= esc($opp['title']) ?>
                                </a>
                                <?php if ($opp['amount'] > 0): ?>
                                    <div class="text-success small fw-semibold"><?= '$' . number_format($opp['amount'], 2) ?></div>
                                <?php endif; ?>
                                <?php if ($opp['close_date']): ?>
                                    <div class="text-muted" style="font-size:0.75rem"><i class="bi bi-calendar3 me-1"></i><?= esc($opp['close_date']) ?></div>
                                <?php endif; ?>
                                <div class="d-flex gap-1 mt-2">
                                    <a href="/opportunities/<?= $opp['id'] ?>/edit" class="btn btn-sm btn-outline-secondary" style="font-size:0.7rem;padding:1px 5px"><i class="bi bi-pencil"></i></a>
                                    <form method="post" action="/opportunities/<?= $opp['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete?')">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-sm btn-outline-danger" style="font-size:0.7rem;padding:1px 5px"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>

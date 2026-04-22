<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Stats row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-primary bg-opacity-10 me-3">
                    <i class="bi bi-person-lines-fill fs-3 text-primary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= $totalContacts ?></div>
                    <div class="text-muted small">Total Contacts</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-warning bg-opacity-10 me-3">
                    <i class="bi bi-funnel fs-3 text-warning"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= array_sum($leadsByStatus) ?></div>
                    <div class="text-muted small">Total Leads</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-success bg-opacity-10 me-3">
                    <i class="bi bi-trophy fs-3 text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= $activeOpportunities ?></div>
                    <div class="text-muted small">Active Opportunities</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 bg-info bg-opacity-10 me-3">
                    <i class="bi bi-calendar-check fs-3 text-info"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= count($recentActivities) ?></div>
                    <div class="text-muted small">Recent Activities</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leads by status -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-semibold mb-0"><i class="bi bi-funnel me-2 text-warning"></i>Leads by Status</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php
                    $statusConfig = [
                        'new'       => ['label' => 'New',       'class' => 'primary'],
                        'contacted' => ['label' => 'Contacted',  'class' => 'secondary'],
                        'qualified' => ['label' => 'Qualified',  'class' => 'success'],
                        'lost'      => ['label' => 'Lost',       'class' => 'danger'],
                    ];
                    foreach ($leadsByStatus as $status => $count):
                        $cfg   = $statusConfig[$status];
                        $total = array_sum($leadsByStatus);
                        $pct   = $total > 0 ? round(($count / $total) * 100) : 0;
                    ?>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded-3 bg-light">
                            <div class="fs-3 fw-bold text-<?= $cfg['class'] ?>"><?= $count ?></div>
                            <div class="text-muted small text-capitalize"><?= $cfg['label'] ?></div>
                            <div class="progress mt-2" style="height:4px">
                                <div class="progress-bar bg-<?= $cfg['class'] ?>" style="width:<?= $pct ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent activities -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="fw-semibold mb-0"><i class="bi bi-calendar-check me-2 text-info"></i>Recent Activities</h6>
        <a href="/activities" class="btn btn-sm btn-outline-secondary">View All</a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recentActivities)): ?>
            <div class="text-center text-muted py-4">
                <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>No recent activities.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Related</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentActivities as $activity): ?>
                        <tr>
                            <td><span class="badge bg-secondary text-uppercase"><?= esc($activity['type']) ?></span></td>
                            <td><?= esc(mb_strimwidth($activity['description'], 0, 60, '…')) ?></td>
                            <td class="text-muted small"><?= esc($activity['date']) ?></td>
                            <td>
                                <?php if ($activity['related_type'] && $activity['related_id']): ?>
                                    <span class="badge bg-light text-dark text-capitalize"><?= esc($activity['related_type']) ?> #<?= $activity['related_id'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
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

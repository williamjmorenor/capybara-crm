<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-ticket-perforated me-2 text-danger"></i><?= lang('Crm.edit_ticket') ?></h5>
    <a href="/tickets/<?= $ticket['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i><?= lang('Crm.back') ?></a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form method="post" action="/tickets/<?= $ticket['id'] ?>/edit">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.title') ?> <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="<?= esc(old('title', $ticket['title'])) ?>" required maxlength="200">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.status') ?> <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <?php foreach (['new', 'assigned', 'solved', 'closed'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('status', $ticket['status']) === $s ? 'selected' : '' ?>>
                                <?= lang('Crm.status_' . $s) ?: ucfirst($s) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.ticket_type') ?> <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <?php foreach (['support', 'warranty', 'incident', 'commercial'] as $t): ?>
                            <option value="<?= $t ?>" <?= old('type', $ticket['type']) === $t ? 'selected' : '' ?>>
                                <?= lang('Crm.ticket_type_' . $t) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.priority') ?></label>
                    <select name="priority" class="form-select">
                        <?php foreach (['low', 'medium', 'high'] as $p): ?>
                            <option value="<?= $p ?>" <?= old('priority', $ticket['priority']) === $p ? 'selected' : '' ?>>
                                <?= lang('Crm.priority_' . $p) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold"><?= lang('Crm.contact') ?></label>
                    <select name="client_id" class="form-select">
                        <option value=""><?= lang('Crm.none_option') ?></option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['id'] ?>" <?= old('client_id', $ticket['client_id']) == $client['id'] ? 'selected' : '' ?>>
                                <?= esc($client['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.assigned_to') ?></label>
                <select name="assigned_to" class="form-select">
                    <option value=""><?= lang('Crm.unassigned') ?></option>
                    <?php foreach ($agents as $agent): ?>
                        <option value="<?= $agent['id'] ?>" <?= old('assigned_to', $ticket['assigned_to']) == $agent['id'] ? 'selected' : '' ?>>
                            <?= esc($agent['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('Crm.description') ?></label>
                <textarea name="description" class="form-control" rows="4"><?= esc(old('description', $ticket['description'])) ?></textarea>
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_billable" id="is_billable" value="1"
                           <?= old('is_billable', $ticket['is_billable']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_billable"><?= lang('Crm.is_billable') ?></label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i><?= lang('Crm.save_changes') ?></button>
                <a href="/tickets/<?= $ticket['id'] ?>" class="btn btn-outline-secondary"><?= lang('Crm.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

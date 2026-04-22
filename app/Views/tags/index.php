<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-tags me-2 text-secondary"></i><?= lang('Crm.tags') ?></h5>
    <a href="/tags/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i><?= lang('Crm.new_tag') ?></a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($tags)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-tags fs-1 d-block mb-2"></i><?= lang('Crm.no_tags') ?>
                <a href="/tags/create" class="d-block mt-2"><?= lang('Crm.create_first_tag') ?></a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><?= lang('Crm.preview') ?></th>
                            <th><?= lang('Crm.name') ?></th>
                            <th><?= lang('Crm.color') ?></th>
                            <th class="text-end"><?= lang('Crm.actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td>
                                <span class="badge" style="background-color:<?= esc($tag['color']) ?>;font-size:0.85rem">
                                    <?= esc($tag['name']) ?>
                                </span>
                            </td>
                            <td><?= esc($tag['name']) ?></td>
                            <td><code><?= esc($tag['color']) ?></code></td>
                            <td class="text-end">
                                <a href="/tags/<?= $tag['id'] ?>/edit" class="btn btn-sm btn-outline-primary" title="<?= lang('Crm.edit') ?>"><i class="bi bi-pencil"></i></a>
                                <form method="post" action="/tags/<?= $tag['id'] ?>/delete" class="d-inline" onsubmit="return confirm('<?= lang('Crm.delete_tag_confirm') ?>')">
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

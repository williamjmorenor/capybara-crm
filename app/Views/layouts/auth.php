<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? lang('Crm.page_title_suffix')) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/coaty.css') ?>">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-branding">
            <div class="branding-content">
                <div class="logo-container">
                    <div class="logo-large">CP</div>
                </div>
                <div>
                    <h1 class="brand-name"><?= lang('Crm.page_title_suffix') ?></h1>
                    <p class="brand-tagline"><?= lang('Crm.sign_in_subtitle') ?></p>
                </div>
            </div>
        </div>
        <div class="login-form-container">
            <div class="login-form-wrapper">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

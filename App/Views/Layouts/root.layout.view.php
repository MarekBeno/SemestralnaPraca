<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */

// aktuálny kontrolér (na zvýraznenie položky v menu)
$current = strtolower($_GET['c'] ?? 'home');
$active = fn(string $controller) => $current === $controller ? ' aria-current="page"' : '';
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= App\Configuration::APP_NAME ?></title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $link->asset('favicons/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $link->asset('favicons/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $link->asset('favicons/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= $link->asset('favicons/site.webmanifest') ?>">
    <link rel="shortcut icon" href="<?= $link->asset('favicons/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="<?= $link->url('home.index') ?>"><span class="logo">LOGO</span><?= App\Configuration::APP_NAME ?></a>
        <input type="checkbox" id="menu-toggle" aria-label="Zobraziť menu">
        <label class="menu-btn" for="menu-toggle">Menu</label>
        <nav class="main-nav" aria-label="Hlavná navigácia">
            <ul>
                <li><a href="<?= $link->url('home.index') ?>"<?= $active('home') ?>>Domov</a></li>
                <li><a href="<?= $link->url('song.index') ?>"<?= $active('song') ?>>Piesne</a></li>
                <li><a href="#">Zoznamy</a></li>
            </ul>
        </nav>
        <div class="auth">
            <?php if ($user->isLoggedIn()) { ?>
                <span class="user"><span class="avatar"><?= e(mb_strtoupper(mb_substr($user->getName(), 0, 2))) ?></span><?= e($user->getName()) ?></span>
                <a class="btn btn-cream" href="<?= $link->url('auth.logout') ?>">Odhlásiť sa</a>
            <?php } else { ?>
                <a class="btn btn-cream" href="<?= $link->url('auth.login') ?>">Prihlásiť sa</a>
                <a class="btn btn-light" href="#">Registrovať sa</a>
            <?php } ?>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <?= $contentHTML ?>
    </div>
</main>
</body>
</html>

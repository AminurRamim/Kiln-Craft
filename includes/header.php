<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($page_title) ? htmlspecialchars($page_title) . ' · ' : '' ?>Kiln &amp; Craft</title>
<meta name="description" content="Kiln & Craft — a community hub for illustrators, photographers, ceramicists, printmakers, weavers, and woodworkers.">
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- CSS-only theme switcher: these radios must sit before everything else
     in the document so :has() on <body> can react to which one is checked. -->
<div class="theme-radios">
  <input type="radio" name="theme" id="theme-clay" checked>
  <input type="radio" name="theme" id="theme-ink">
  <input type="radio" name="theme" id="theme-meadow">
</div>

<a class="skip-link" href="#main-content">Skip to content</a>

<header class="site-header">
  <div class="header-inner">
    <a class="brand" href="index.php">
      <span class="brand-mark" aria-hidden="true">&#10133;</span> Kiln &amp; Craft
    </a>

    <nav class="site-nav" aria-label="Main navigation">
      <a href="index.php"<?= ($active_page ?? '') === 'index' ? ' class="active" aria-current="page"' : '' ?>>Members</a>
      <a href="gallery.php"<?= ($active_page ?? '') === 'gallery' ? ' class="active" aria-current="page"' : '' ?>>Gallery</a>
      <a href="workshops.php"<?= ($active_page ?? '') === 'workshops' ? ' class="active" aria-current="page"' : '' ?>>Workshops</a>
      <a href="commissions.php"<?= ($active_page ?? '') === 'commissions' ? ' class="active" aria-current="page"' : '' ?>>Commission</a>
    </nav>

    <fieldset class="theme-switcher">
      <legend class="visually-hidden">Choose a color theme</legend>
      <label for="theme-clay" class="theme-swatch swatch-clay" title="Clay theme"><span class="visually-hidden">Clay theme</span></label>
      <label for="theme-ink" class="theme-swatch swatch-ink" title="Ink theme"><span class="visually-hidden">Ink theme</span></label>
      <label for="theme-meadow" class="theme-swatch swatch-meadow" title="Meadow theme"><span class="visually-hidden">Meadow theme</span></label>
    </fieldset>
  </div>
</header>

<main class="site-main" id="main-content">

<?php
require 'includes/functions.php';

$members = get_members();
$projects = get_all_projects($members);

$page_title = 'Gallery';
$active_page = 'gallery';
include 'includes/header.php';
?>

<section class="hero hero-compact">
  <p class="eyebrow">Gallery</p>
  <h1>Work from the whole community.</h1>
  <p class="lede">Click any piece to see it larger &mdash; no JavaScript, just the CSS <code>:target</code> selector.</p>
</section>

<div class="masonry-gallery">
  <?php foreach ($projects as $i => $p): $anchor = 'project-' . $i; ?>
    <a href="#<?= $anchor ?>" class="masonry-tile tile-<?= slug($p['discipline']) ?>" id="tile-<?= $anchor ?>">
      <span class="masonry-title"><?= htmlspecialchars($p['title']) ?></span>
      <span class="masonry-artist">by <?= htmlspecialchars($p['member_name']) ?></span>
    </a>
  <?php endforeach; ?>
</div>

<?php foreach ($projects as $i => $p): $anchor = 'project-' . $i; ?>
  <div class="lightbox" id="<?= $anchor ?>">
    <a href="#tile-<?= $anchor ?>" class="lightbox-backdrop" aria-label="Close preview"></a>
    <div class="lightbox-panel tile-<?= slug($p['discipline']) ?>" role="dialog" aria-label="<?= htmlspecialchars($p['title']) ?>">
      <a href="#tile-<?= $anchor ?>" class="lightbox-close" aria-label="Close preview">&times;</a>
      <h2><?= htmlspecialchars($p['title']) ?></h2>
      <p class="discipline-tag"><?= htmlspecialchars($p['discipline']) ?></p>
      <p>by <?= htmlspecialchars($p['member_name']) ?></p>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>

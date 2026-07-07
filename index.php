<?php
require 'includes/functions.php';

$members = get_members();

$activeType = clean($_GET['type'] ?? '');
$disciplines = array_values(array_unique(array_map(fn($m) => $m['discipline'], $members)));
sort($disciplines);

$filtered = ($activeType === '' || strtolower($activeType) === 'all')
    ? $members
    : array_values(array_filter($members, fn($m) => strtolower($m['discipline']) === strtolower($activeType)));

$page_title = 'Members';
$active_page = 'index';
include 'includes/header.php';
?>

<section class="hero">
  <p class="eyebrow">Kiln &amp; Craft</p>
  <h1>Makers, in their own words.</h1>
  <p class="lede">Browse profiles from illustrators, photographers, ceramicists, printmakers, weavers, and woodworkers building things by hand.</p>
</section>

<nav class="filter-bar" aria-label="Filter members by discipline">
  <a href="index.php" class="chip<?= ($activeType === '' || strtolower($activeType) === 'all') ? ' active' : '' ?>">All</a>
  <?php foreach ($disciplines as $d): ?>
    <a href="index.php?type=<?= urlencode($d) ?>" class="chip<?= (strtolower($activeType) === strtolower($d)) ? ' active' : '' ?>"><?= htmlspecialchars($d) ?></a>
  <?php endforeach; ?>
</nav>

<section class="member-grid" aria-label="Member profiles">
  <?php if (empty($filtered)): ?>
    <p class="empty-state">No members match that discipline yet.</p>
  <?php else: ?>
    <?php foreach ($filtered as $m): ?>
      <article class="member-card">
        <a href="member.php?member=<?= (int) $m['id'] ?>">
          <span class="member-avatar avatar-<?= slug($m['discipline']) ?>"><?= htmlspecialchars($m['initials']) ?></span>
          <h2><?= htmlspecialchars($m['name']) ?></h2>
          <p class="discipline-tag"><?= htmlspecialchars($m['discipline']) ?></p>
          <p class="member-bio"><?= htmlspecialchars(truncate($m['bio'], 92)) ?></p>
        </a>
      </article>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>

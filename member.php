<?php
require 'includes/functions.php';

$members = get_members();
$id = (int) ($_GET['member'] ?? 0);
$member = find_member($id, $members);

if ($member === null) {
    header('Location: index.php');
    exit();
}

$page_title = $member['name'];
$active_page = 'index';
include 'includes/header.php';
?>

<article class="profile">
  <a href="index.php" class="back-link">&larr; All members</a>

  <div class="profile-head">
    <span class="member-avatar avatar-large avatar-<?= slug($member['discipline']) ?>"><?= htmlspecialchars($member['initials']) ?></span>
    <div>
      <h1><?= htmlspecialchars($member['name']) ?></h1>
      <p class="discipline-tag"><?= htmlspecialchars($member['discipline']) ?></p>
    </div>
  </div>

  <p class="profile-bio"><?= htmlspecialchars($member['bio']) ?></p>

  <h2 class="section-heading">Projects</h2>
  <div class="profile-projects">
    <?php foreach ($member['projects'] as $p): ?>
      <div class="project-tile tile-<?= slug($member['discipline']) ?>">
        <span class="project-title"><?= htmlspecialchars($p['title']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <a class="cta-button" href="commissions.php?member=<?= (int) $member['id'] ?>">Request a commission from <?= htmlspecialchars($member['name']) ?></a>
</article>

<?php include 'includes/footer.php'; ?>

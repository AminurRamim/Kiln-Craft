<?php
require 'includes/functions.php';

$events = get_events();
usort($events, fn($a, $b) => strcmp($a['date'], $b['date']));

$page_title = 'Workshops';
$active_page = 'workshops';
include 'includes/header.php';
?>

<section class="hero hero-compact">
  <p class="eyebrow">Workshops</p>
  <h1>Upcoming sessions, soonest first.</h1>
  <p class="lede">Sorted automatically with PHP's <code>usort()</code>, so this list never needs to be reordered by hand.</p>
</section>

<ol class="event-list">
  <?php foreach ($events as $e): $ts = strtotime($e['date']); ?>
    <li class="event-row">
      <div class="event-date">
        <span class="event-day"><?= htmlspecialchars(date('d', $ts)) ?></span>
        <span class="event-month"><?= htmlspecialchars(date('M', $ts)) ?></span>
      </div>
      <div class="event-info">
        <h2><?= htmlspecialchars($e['title']) ?></h2>
        <p class="discipline-tag"><?= htmlspecialchars($e['discipline']) ?></p>
        <p><?= htmlspecialchars($e['description']) ?></p>
      </div>
    </li>
  <?php endforeach; ?>
</ol>

<?php include 'includes/footer.php'; ?>

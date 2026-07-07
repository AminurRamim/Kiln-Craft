<?php
session_start();
require 'includes/functions.php';

$inquiry = $_SESSION['inquiry'] ?? null;

if ($inquiry === null) {
    header('Location: commissions.php');
    exit();
}

$page_title = 'Thank you';
$active_page = 'commissions';
include 'includes/header.php';
?>

<section class="hero hero-compact">
  <p class="eyebrow">Thank you</p>
  <h1>Thanks, <?= htmlspecialchars($inquiry['name']) ?>.</h1>
  <p class="lede">Your <?= htmlspecialchars($inquiry['discipline']) ?> inquiry is in. We'll reply to <?= htmlspecialchars($inquiry['email']) ?> soon.</p>
</section>

<div class="inquiry-summary">
  <h2 class="section-heading">What you sent us</h2>
  <p><?= nl2br(htmlspecialchars($inquiry['message'])) ?></p>
</div>

<a class="cta-button" href="index.php">Back to members</a>

<?php include 'includes/footer.php'; ?>

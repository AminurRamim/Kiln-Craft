<?php
session_start();
require 'includes/functions.php';

$members = get_members();
$errors = [];
$values = ['name' => '', 'email' => '', 'discipline' => '', 'message' => ''];

$preselectId = (int) ($_GET['member'] ?? 0);
$preselectMember = find_member($preselectId, $members);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values['name'] = clean($_POST['name'] ?? '');
    $values['email'] = clean($_POST['email'] ?? '');
    $values['discipline'] = clean($_POST['discipline'] ?? '');
    $values['message'] = clean($_POST['message'] ?? '');

    if ($values['name'] === '') {
        $errors[] = 'Please enter your name.';
    }
    if ($values['email'] === '' || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($values['discipline'] === '') {
        $errors[] = 'Please choose a discipline.';
    }
    if ($values['message'] === '' || strlen($values['message']) < 10) {
        $errors[] = 'Tell us a little more about the piece you have in mind (10 characters minimum).';
    }

    if (empty($errors)) {
        $_SESSION['inquiry'] = $values;
        header('Location: thankyou.php');
        exit();
    }
}

$disciplines = array_values(array_unique(array_map(fn($m) => $m['discipline'], $members)));
sort($disciplines);

$page_title = 'Commission';
$active_page = 'commissions';
include 'includes/header.php';
?>

<section class="hero hero-compact">
  <p class="eyebrow">Commissions</p>
  <h1>Start a commission.</h1>
  <p class="lede">Tell us what you're picturing, and we'll match you with the right maker.</p>
</section>

<?php if (!empty($errors)): ?>
  <div class="form-errors" role="alert">
    <ul>
      <?php foreach ($errors as $err): ?>
        <li><?= htmlspecialchars($err) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form class="commission-form" method="post" action="commissions.php" novalidate>
  <label for="name">Name</label>
  <input type="text" id="name" name="name" value="<?= htmlspecialchars($values['name']) ?>" required>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="<?= htmlspecialchars($values['email']) ?>" required>

  <label for="discipline">Discipline</label>
  <select id="discipline" name="discipline" required>
    <option value="">Choose one&hellip;</option>
    <?php foreach ($disciplines as $d): ?>
      <?php
        $isSelected = $values['discipline'] === $d
            || (!$values['discipline'] && $preselectMember && $preselectMember['discipline'] === $d);
      ?>
      <option value="<?= htmlspecialchars($d) ?>"<?= $isSelected ? ' selected' : '' ?>><?= htmlspecialchars($d) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="message">Tell us about the piece</label>
  <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($values['message']) ?></textarea>

  <button type="submit" class="cta-button">Send inquiry</button>
</form>

<?php include 'includes/footer.php'; ?>

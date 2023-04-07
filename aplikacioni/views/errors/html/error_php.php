<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>Ka ndodhur nje GABIM per PHP</h4>

<p>Rendesa: <?php echo $severity; ?></p>
<p>Mesazhi:  <?php echo $message; ?></p>
<p>Emri i Skedarit: <?php echo $filepath; ?></p>
<p>Numri i Rreshtit: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Gjurmimi:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			Skedari: <?php echo $error['file'] ?><br />
			Rreshti: <?php echo $error['line'] ?><br />
			Funksioni: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>
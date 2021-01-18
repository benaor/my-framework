<h1> Hello <?= htmlspecialchars(isset($name) ? $name : "world", ENT_QUOTES); ?> </h1>

<?php
$name = $request->query->get("name", "world");
?>

<h1> Hello <?= htmlspecialchars($name, ENT_QUOTES); ?> </h1>

<?php
$Parsedown = new Parsedown();

echo "Just a test"
echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>

?>

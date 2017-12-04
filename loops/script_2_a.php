<?php

$i = 1;

echo "<tr>";
for ($i;$i<=18;$i++) {
    echo "<td>".$i."</td>";
    if ($i==5) {
        echo "</tr><tr>";
    }
    if ($i==10) {
        echo "</tr><tr>";
    }
    if ($i==15) {
        echo "</tr><tr>";
    }
}
echo "<td></td><td></td></tr>";
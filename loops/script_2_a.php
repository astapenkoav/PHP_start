<?php

$i = 1;
$n = 43;
echo "<tr>";
for ($i;$i<=$n;$i++) {
    echo "<td>".$i."</td>";
    if ($i%5==0) {
        echo "</tr><tr>";
    }
}
echo "</tr>";

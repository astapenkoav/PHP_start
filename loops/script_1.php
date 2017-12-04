<?php

$i = 2;
$n = 13;
while ($i<=$n) {
    echo "<tr>";
    echo "<td>".$i."</td>";
    echo "<td>".($i*$i)."</td>";
    echo "<td>".($i*$i*$i)."</td>";
    echo "</tr>";
    $i++;
}
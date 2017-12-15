<?php
require 'arrays.php';
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Menu</title>
</head>
<body>
<div class="container">
<ul>
    <li><a href="<?=$menu['0']['link_1']?>"><?=$menu['0']['name_1']?></a>
        <ul>
            <li><a href="<?=$menu['0']['inside_1_1']['link_4']?>"><?=$menu['0']['inside_1_1']['name_4']?></a>
                <ul>
                    <li><a href="<?=$menu['0']['inside_1_1']['inside_4_1']['link_9']?>"><?=$menu['0']['inside_1_1']['inside_4_1']['name_9']?></a></li>
                    <li><a href="<?=$menu['0']['inside_1_1']['inside_4_2']['link_10']?>"><?=$menu['0']['inside_1_1']['inside_4_2']['name_10']?></a></li>
                </ul>
            </li>
            <li><a href="<?=$menu['0']['inside_1_2']['link_5']?>"><?=$menu['0']['inside_1_2']['name_5']?></a></li>
        </ul>
    </li>
    <li><a href="<?=$menu['1']['link_2']?>"><?=$menu['1']['name_2']?></a>
        <ul>
            <li><a href="<?=$menu['1']['inside_2_1']['link_6']?>"><?=$menu['1']['inside_2_1']['name_6']?></a></li>
            <li><a href="<?=$menu['1']['inside_2_2']['link_7']?>"><?=$menu['1']['inside_2_2']['name_7']?></a>
                <ul>
                    <li><a href="<?=$menu['1']['inside_2_2']['inside_7_1']['link_11']?>"><?=$menu['1']['inside_2_2']['inside_7_1']['name_11']?></a></li>
                    <li><a href="<?=$menu['1']['inside_2_2']['inside_7_2']['link_12']?>"><?=$menu['1']['inside_2_2']['inside_7_2']['name_12']?></a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="<?=$menu['2']['link_3']?>"><?=$menu['2']['name_3']?></a>
        <ul>
            <li><a href="<?=$menu['2']['inside_3_1']['link_8']?>"><?=$menu['2']['inside_3_1']['name_8']?></a>
                <ul>
                    <li><a href="<?=$menu['2']['inside_3_1']['inside_8_1']['link_13']?>"><?=$menu['2']['inside_3_1']['inside_8_1']['name_13']?></a></li>
                    <li><a href="<?=$menu['2']['inside_3_1']['inside_8_2']['link_14']?>"><?=$menu['2']['inside_3_1']['inside_8_2']['name_14']?></a></li>
                    <li><a href="<?=$menu['2']['inside_3_1']['inside_8_3']['link_15']?>"><?=$menu['2']['inside_3_1']['inside_8_3']['name_15']?></a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</div>
</body>
</html>
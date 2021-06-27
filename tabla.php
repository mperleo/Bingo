<?php
    require 'Bingo_fun.php';
    $cartones=cartones(5);
?>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bingo!</title>
        <link rel="icon" href="files_style/bingo!.png" type="image" />
        <link type="text/css" href="files_style/css/mdb.min.css" rel="stylesheet">
        <link type="text/css" href="files_style/css/cartones.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  

</head>
<body>
    
    <?php
        for($k=0; $k<5; $k++){
            echo '<div class="tabla-div">';
            echo '<table>';
            for($i=0; $i<3; $i++){
                echo '<tr>';
                for($j=0; $j<9; $j++){
                    if($cartones[$k][$i][$j]!=0) echo '<td>'.$cartones[$k][$i][$j].'</td>';
                    else echo '<td class="vacio"> </td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '<div class="texto">Cards made by Bingo!</div>';
            echo '</div>';
        }    

    ?>
</body>


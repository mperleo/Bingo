<?php
    require 'Bingo_fun.php';
    session_start();

    //var_dump($_SESSION);

    if(!isset($_SESSION['bombo'])){
        $bombo=crear_bombo(); // genero el array del sorteo
        $n_elem=count($bombo); // calculo el número de elementos del array
        
        $sorteo= array(); // genero el array de los números sorteados
        $n_elemSort=1; // inicio la variable del tamaño del array de sorteados a 1
    }
    //si los elementos estan en la sesion
    else{
        $bombo=$_SESSION['bombo'];
        $n_elem=$_SESSION['n_elem'];

        if(isset($_SESSION['sorteo'])){
            $sorteo=$_SESSION['sorteo'];
            $n_elemSort=$_SESSION['n_elemSort'];
        }
    }
    if(isset($_GET['bingo'])){
        $mensaje3="¡BINGO!";
        $_SESSION['bingo']=true;
    }
    else if(isset($_GET['numero'])){
        //genero un número aleatorio entre 0 y 89
        $n= rand(1,$n_elem);
        $retorno=tirada( $n, $bombo, $sorteo, $n_elemSort, $n_elem);

        $mensaje=$retorno['mensaje'];
        if(strcmp($mensaje, "No hay más bolas")===0){
            $_SESSION['bingo']=true;
        }
        $bombo=$retorno['bombo'];
        $sorteo=$retorno['sorteo'];
        $n_elemSort=$retorno['n_elemSort'];
        $n_elem=$retorno['n_elem'];

    }
    else if(isset($_GET['nuevo'])){
        session_unset();
        header("Location: index.php");
        die();
    }

    if(isset($_GET['linea'])){
        $mensaje2="¡SE HA CANTADO LINEA!";
        $_SESSION['linea']=true;
    }   

    if(isset($_GET['cartones'])){
        //$cartones=cartones(5);
        header("Location: tabla.php?cartones");
    } 

    $_SESSION['bombo']=$bombo;
    $_SESSION['n_elem']=$n_elem;
    $_SESSION['sorteo']=$sorteo;
    $_SESSION['n_elemSort']=$n_elemSort;
?>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bingo!</title>
        <link rel="icon" href="files_style/bingo!.png" type="image" />
        <link type="text/css" href="files_style/css/mdb.min.css" rel="stylesheet">
        <link type="text/css" href="files_style/css/bingo.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
        <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
        <script src="resources/files_style/js/mdb.min.js" language="javascript" type="text/javascript"></script>
</head>
<body>
    <header>
        <div class="border-h1 d-flex justify-content-center align-items-center">
            <h1 class="PressStart display-2">Bingo!</h1>
        </div>
    </header>
    
    <div class="container">
        <?php if( !isset($_SESSION['bingo']) ) {?>
            <div class="d-flex justify-content-center align-items-center ">
                <a class=" btn btn-primary btn-rounded btn-lg margin-buttons-sm" href="index.php?numero">Nuevo número</a> 
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <a class=" btn btn-warning btn-rounded btn-lg margin-buttons-sm" href="index.php?bingo">Bingo</a> 
                <a class=" btn btn-secondary btn-rounded btn-lg margin-buttons-sm" href="index.php?linea">Linea</a>
            </div> 
        <?php } else {?>
            <div class="d-flex justify-content-center align-items-center ">
                <button type="button" class=" btn btn-primary btn-rounded btn-lg margin-buttons-sm" disabled>Nuevo número</button> 
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="button" class=" btn btn-warning btn-rounded btn-lg margin-buttons-sm" disabled>Bingo</button> 
                <button type="button" class=" btn btn-secondary btn-rounded btn-lg margin-buttons-sm" disabled>Linea</button>
            </div>
        <?php }?>
        <div class="d-flex justify-content-center align-items-center">
            <a class="btn btn-danger btn-rounded btn-lg margin-buttons-sm" href="index.php?nuevo">Nuevo juego</a> 
        </div> 
        <div class="d-flex justify-content-center align-items-center">
            <a class="btn btn-success btn-rounded btn-lg margin-buttons-sm" href="index.php?cartones" target="_blank">Generar cartones (WIP)</a> 
        </div> 

        <?php
            if(isset($mensaje)){
                echo '<hr>';
                echo '<p class="Fugaz display-6 text-center">La última bola que ha salido es: </p>';
                
                if(is_int($mensaje)){
                    echo '<div class="d-flex justify-content-center align-items-center ">';
                        echo '<div class="justify-content-center align-items-center">';
                            echo '<p class="bola">'.$mensaje.'</p>';
                        echo '</div>';
                    echo '</div>';
                }
                else{
                    echo '<p class="alert alert-danger Fugaz">'.$mensaje.'</p>';
                }
                    
                
            }
        ?>
        <?php
            if(isset($mensaje2) || ( isset($_SESSION['linea']) && $_SESSION['linea']== TRUE)){
                echo '<hr>';
                echo '<p class="alert alert-info Fugaz">¡SE HA CANTADO LINEA!</p>';
            }
        ?>
        <?php
            if(isset($mensaje3)){
                echo '<hr>';
                echo '<p class="alert alert-success Fugaz">'.$mensaje3.'</p>';
            }
        ?>

        <?php
            if(!empty($sorteo)){
                //sort($sorteo,SORT_NUMERIC);
                echo '<hr>';
                echo "<h3 class='Fugaz'>Han salido los números:</h3>";
                echo '<div class="row text-center">';
                foreach($sorteo as $valor){
                    echo '<div class="col-md-1">';
                        echo '<p class="bola">'.$valor.'</p>';
                    echo '</div>';
                }  
                echo '</div>';
            }
        ?>
    </div>
    
    <footer class="text-center ">
        <div class="border-h1 flex justify-content-center align-items-center">
            <a href="#">Back to top</a>
            <p><a href="../myki/index.php">Miguel Pérez León 2021</a></p>  
        </div> 
    </footer>
</body>    
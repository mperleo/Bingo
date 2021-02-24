<?php 
    /*
    FUNCIÓN QUE GENERA UN ARRAY CON NÚMEROS DEL 1 AL 90
    Retorno:
    -- bombo: array que contiene los números del bingo
    El número de elementos se saca en el index mediante una función
    */
    function crear_bombo(){
        $bombo= array();
        
        //bucle que genera el llena el array pasado por referencia con numueros del 1 al 90 en posiciones de la 1 a la 90 ambos incluidos
        for($i=1; $i<91 ;$i++){
            $bombo[$i]=$i;
        }
        return $bombo; // saco el número de elementos que va ha tener el array al principio, validos para el corteo
    }

    /*
        Función que relaliza la tirada y saca un número del array
        PARÁMETROS:
        -- n: número aleatorio que hace referencia al la posición del array bonbo a sacar
        -- sorteo: array que almacena el valor ganado en el sorteo
        -- bombo: array que contiene los números del bingo
        -- j: número de elementos que se han sorteado
        -- n_elem: número elementos que hay en el bombo
        RETORNO:
        -- retorno: array asociativo con todos los elementos para operar
    */
    function tirada( $n, $bombo, $sorteo, $j, $n_elem){
        $mensaje=NULL;
        //var_dump($n);
        // Si el número de la posición indicada es distinto de 0 y meor de 91 se saca el número
        if($n_elem>0){
            $sorteo[$j]= $bombo[$n]; // meto en el array sorteo, el valor sacado en la tirada
            $j++; // añado 1 al número de bolas sacadas
            $mensaje=$bombo[$n]; // muestro por pantalla el número que ha salido en la tirada
            $n_elem = ($n_elem)-1; // decremento 1 el número de elementos
            $bombo=borrar($bombo, $n, $n_elem); //pongo el valor de esa posición igual a 0 para que ya no vuelva a salir en el sorteo
        }
        // si el número de la posición es 0  y hay elementos en el bombo llamo a la misma función con otro número aleatorio
        else if($n_elem ==0){
            $mensaje="No hay más bolas";
        }

        $retorno['bombo']=$bombo;
        $retorno['sorteo']=$sorteo;
        $retorno['n_elemSort']=$j;
        $retorno['n_elem']=$n_elem;
        $retorno['mensaje']=$mensaje;

        return $retorno;
    }

    /*
        Función que genera los cartones del bingo de forma que:
        Columna:    Números:
        Primera	    Del 1 al 9
        Segunda	    Del 10 al 19
        Tercera	    Del 20 al 29
        Cuarta 	    Del 30 al 39
        Quinta      Del 40 al 49
        Sexta	    Del 50 al 59
        Séptima	    Del 60 al 69
        Octava      Del 70 al 79
        Novena      Del 80 al 90

        PARÁMETROS:
        -- numero: número de cartones a generar
        RETORNO:
        -- cartones generados
    */
    function cartones($numero){
        $arrayNumeros=crear_bombo(); // genero el array del sorteo
        $minCol=[1,10,20,30,40,50,60,70,80];
        $maxCol=[9,19,29,39,49,59,69,79,90];

        for($k=0; $k<$numero; $k++){
            $arrayAux=$arrayNumeros;
            $n_elementos=90;
               
            for($i=0; $i<3; $i++){
                $sinNada=4;
                $conNumero=5;
                for($j=0; $j<9; $j++){
                    $aux=rand(1,100);
                    if( $conNumero==0 || ($aux > 60 && $sinNada != 0) ){
                        $cartones[$k][$i][$j]=0;
                        $sinNada--;
                    }
                    else{
                        do{
                            $aux=rand($minCol[$j],$maxCol[$j]);
                        }while($arrayAux[$aux]==0);
                        $cartones[$k][$i][$j]=$arrayAux[$aux];
                        $arrayAux[$aux]=0;
                        $conNumero--;
                        //sort($cartones[$k][$j],SORT_NUMERIC);
                    } 
                } 
            }
        }   
        return $cartones; 
    }

    /*
        Función que borra un elemento de un array, mandando los elementos siguientes hacia atras
        PARÁMETROS:
        -- array: del que se elimina el elemento
        -- indice: elemento a eliminar
        -- n_elementos: numero de elementos resultantes de quitar el elemendo indicado
        RETORNO:
        -- el array sin el elemento indicado
    */
    function borrar( $array, $indice, $n_elementos){
        for($i=$indice; $i<=$n_elementos; $i++){
            $array[$i]=$array[$i+1];
        }

        return $array;
    }  
?>
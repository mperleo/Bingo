<?php 
    require 'Bingo_fun.php';
    $cartones=cartones(15);

    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;

    function generarPDF($cartones){
        require_once 'dompdf/autoload.inc.php';

        $content = '<html>';
        $content .= '<head>';
            $content .= 
            '<style> 
                body{
                    font-family: Arial, Helvetica, sans-serif;
                    margin: 0px;
                    padding: 0px;
                } 

                table, th, td{
                    border: 2px solid rgb(13, 173, 83);
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 35px;
                    font-weight: bolder;
                    color: rgb(5, 131, 59);
                }
                
                td{
                    width: 55px;
                    height: 55px;
                }
                
                .tabla-div{
                    padding: 15px;
                    border: 2px solid  rgb(13, 173, 83);
                    width: 535px;
                    margin: 20px;
                }
                
                .texto{
                    margin-top: 6px;
                    color: rgb(5, 131, 59);
                    font-size: 15px;
                }
                
                .vacio{
                    background-color: rgba(7, 223, 101, 0.87);
                }

                .espacio{
                    height: 110px;
                }
            </style>';

        $content .= '</head>';
        $content .= '<body>';

        for($k=0; $k<15; $k++){
            $content .= '<div class="tabla-div">';
                $content .= '<table>';
                    for($i=0; $i<3; $i++){
                        $content .= '<tr>';
                        for($j=0; $j<9; $j++){
                            if($cartones[$k][$i][$j]!=0) $content .= '<td>'.$cartones[$k][$i][$j].'</td>';
                            else $content .= '<td class="vacio"> </td>';
                        }
                        $content .= '</tr>';
                    }
                $content .= '</table>';
                $content .= '<div class="texto">Cards made by Bingo!</div>';
            $content .= '</div>';

            if(($k+1) % 3 == 0){
                $content .= '<div class="espacio"></div>';
            }
        }
        $content .= '</body>';
        $content .= '</html>';    
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->render(); // Generar el PDF desde contenido HTML
        $pdf = $dompdf->output(); // Obtener el PDF generado
        $dompdf->stream(); // Enviar el PDF generado al navegador

    }

    generarPDF($cartones);

?>
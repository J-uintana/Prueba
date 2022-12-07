<?php

$BDMSSA = mysqli_connect("localhost", "root", "","bdmultiserviciossa");

if(!$BDMSSA)
        {
            echo "No se ha podido conectar con el servidor" . mysql_error();
        }

 ?>

<?php

   //Recogemos el archivo enviado por el formulario

   
   $archivo = $_FILES['archivo']['name'];
   
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];

      if (file_exists('../Archivos/'.$archivo)) {
            echo '2';
      } else {
          //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
         if (!((strpos($tipo, "pdf") ) && ($tamano < 2000000))) {
            echo '1';
         }
         else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, '../Archivos/'.$archivo)) {
               //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
               chmod('../Archivos/'.$archivo, 0777);
               //Mostramos el mensaje de que se ha subido co éxito
               echo '../Archivos/'.$archivo;
            }
            else {
               //Si no se ha podido subir la imagen, mostramos un mensaje de error
               echo '3';
            }
         }
      }

     
   }

?>
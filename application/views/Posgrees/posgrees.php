<?php 
if ($this->session->userdata('nombre')==null) {
redirect (base_url().'index.php/welcome/logout');
}
include 'plantilla/header.php';
 ?>
<?php
$servidorBD = "127.0.0.1";
$usuario = "postgres";
$clave = "Karlosomar";
$BD = "Estetica";
$enlace = 0;

$enlace = pg_connect("host=".$servidorBD." port= 5432"." dbname=".$BD." user=".$usuario." password=".$clave) 
or die("Existio un error al intentar conectarse al servidor de base de datos");

$resultado = pg_exec($enlace, "SELECT * FROM cliente ORDER BY idcliente ASC; ")
or die("No se pudo realizar la consulta");

//echo "Numero de filas encontradas: ".pg_num_rows($resultado)."<br><br>";

//while( $registro=pg_fetch_Array($resultado) )
//{
//echo "Nombre: ".$registro['nombre']."<br>";
//}
//echo "Fin de la consulta!!!!!";
?>

 <div id="content-wrapper">
    <div class="container-fluid">
		          <h1>Hola Posgrees</h1>
	<div class="container-fluid">
		<a href="">Clientes</a><br>
		<a href="">Productos</a><br>
		<a href="">Empleados</a><br>
		<a href="">Nomina</a><br>
	</div>
		  <table class="table table-striped" style="text-align: center" >
		  <thead>
		    <tr>
		      <th scope="col">Nombre</th>      
		      <th scope="col">Primer Apelido</th>
		      <th scope="col">Segundo Apellido</th>
		      <th scope="col">Direccion</th>
		      <th scope="col">Correo</th>
		      <th scope="col">Telefono</th>
		      <th scope="col">Codigo Postal</th>
		      <th scope="col">Sexo</th>

		    </tr>
		  </thead>
		  <tbody>
		     <?php
		     $registro=pg_fetch_Array($resultado);  
		        while($registro){
		          ?>
		        <tr>
		        	<?php
		        	if(comprobar_nombre($registro['nombre'])=="correcto"){ ?>
					<td id="correcto"><?php echo $registro['nombre']?></td>
		        	<?php }else{ ?>
		        	<td id="mal"><?php echo $registro['nombre']?></td>
		        <?php } ?>
		        <?php
		        	if(comprobar_nombre($registro['primerapellido'])=="correcto"){ ?>
					<td id="correcto"><?php echo $registro['primerapellido']?></td>
		        	<?php }else{ ?>
		        	<td id="mal"><?php echo $registro['primerapellido']?></td>
		        <?php } ?>
				 <?php
		        	if(comprobar_nombre($registro['segundoapellido'])=="correcto"){ ?>
					<td id="correcto"><?php echo $registro['segundoapellido']?></td>
		        	<?php }else{ ?>
		        	<td id="mal"><?php echo $registro['segundoapellido']?></td>
		        <?php } ?>
				<?php
		        	if(comprobar_direccion($registro['direccion'])=="correcto"){ ?>
					<td id="correcto"><?php echo $registro['direccion']?></td>
		        	<?php }else{ ?>
		        	<td id="mal"><?php echo $registro['direccion']?></td>
		        <?php } ?>		        
		        </tr>
		       <?php  } ?>
		  </tbody>
		</table> 
      </div>
        </footer>
    </div>
 <?php 
include 'plantilla/footer.php';
 ?>
         <?php
        function comprobar_nombre($nombre_usuario){ 
			   if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i", $nombre_usuario)) { 
			      //echo "correcto"; 
			      return true; 
			   } else { 
			       //echo "incorrecto"; 
			      return false; 
			   } 
			}

		function comprobar_direccion($nombre_usuario){ 
			   if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ # 0-9 ]+$/i", $nombre_usuario)) { 
			      //echo "correcto"; 
			      return true; 
			   } else { 
			       //echo "incorrecto"; 
			      return false; 
			   } 
			}
        ?>
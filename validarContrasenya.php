<?php


try{
   $con = new PDO('mysql:host=localhost;dbname=bd', "root");
}catch(PDOException $e){
   echo "<div class='error'>".$e->getMessage()."</div>";
   die();
 }
echo $cadena = password_hash("t00r", PASSWORD_BCRYPT );
$sql="SELECT * FROM users;";
$res=$con->query($sql);

foreach($res->fetchAll() as $fila)
{
echo "<br>---";
echo $hash=$fila['hash'];
}

$password="t00r";
$estado=password_verify ( $password , $hash );

if($estado==true)
{
echo " cierto";
}
else
{
echo "falso";

}

<?php 
session_start(); 
include "../../model/conexion.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {
    $stmt = $conexion->prepare("SELECT id_usuario, email, password, id_rol, id_empleado FROM usuarios WHERE email='$uname' AND password='$pass' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    
    if ($stmt->rowCount() === 1) {
        foreach($resultado as $fila){
            if ($fila['email'] === $uname && $fila['password'] === $pass) {
                $_SESSION['email'] = $fila['email'];
                $_SESSION['id_rol'] = $fila['id_rol'];
                $_SESSION['id_usuario'] = $fila['id_usuario'];
                $_SESSION['id_empleado'] = $fila['id_empleado'];
                if ($fila['id_rol'] == '2') {
                    header("Location: view/costeo/index.php");
                    exit();
                } else if ($fila['id_rol'] == '4') {
                    header("Location: view/usuarios/index.php");
                    exit();
                } else {
                    header("Location: view/planilla/index.php");
                    exit();
                }
            }else{
                header("Location: index.php?error=Usuario o contraseña incorrectos.");
                exit();
            }
        }
    }else{
        header("Location: index.php?error=Usuario o contraseña incorrectos.");
        exit();
    }
}else{
    echo "No se ha asignado un empleado a este usuario.";
}
?>
<?php
    require_once("../master/footer.php")
?>
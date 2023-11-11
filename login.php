<?php 
session_start(); 
include "model/conexion.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=El campo de correo electrónico es requerido.");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=El campo contraseña es requerido.");
        exit();
    }else{
        $stmt = $conexion->prepare("SELECT id_usuario, email, password, id_rol, id_empleado, (select nombres from empleados emp where emp.id_empleado = usr.id_empleado) nombres FROM usuarios usr WHERE email='$uname' AND password='$pass' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        
        if ($stmt->rowCount() === 1) {
            foreach($resultado as $fila){
                if ($fila['email'] === $uname && $fila['password'] === $pass) {
                    $_SESSION['email'] = $fila['email'];
                    $_SESSION['id_rol'] = $fila['id_rol'];
                    $_SESSION['id_usuario'] = $fila['id_usuario'];
                    $_SESSION['id_empleado'] = $fila['id_empleado'];

                    if (isset($fila['nombres'])) {
                        $_SESSION['nombres'] = $fila['nombres'];
                    }

                    if ($fila['id_rol'] == '2') {
                        header("Location: view/costeo/index.php");
                        exit();
                    } else if ($fila['id_rol'] == '4') {
                        header("Location: view/usuarios/index.php");
                        exit();
                    } else {
                        header("Location: view/home/index.php");
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
    }
}else{
    header("Location: index.php");
    exit();
}
<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="post">

        <img src="./view/assets/header.jpg" style="height: 40px;" />
        <h3 style="text-align: center;">Sistema de Recursos Humanos de Creativa Consultores, S.A.</h3>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Correo electrónico:</label>

        <input type="text" name="uname" placeholder="Ingrese su correo electrónico..."><br>

        <label>Contraseña:</label>

        <input type="password" name="password" placeholder="Ingrese su contraseña..."><br> 

        <button type="submit">Iniciar Sesión</button>

     </form>

</body>

</html>
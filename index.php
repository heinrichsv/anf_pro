<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="post">

        <img src="./view/assets/_logo.jpeg" style="height: 125px; display: block; margin: 0 auto;" />
        <h3 style="text-align: center;">Sistema de Gestión de Planilla de PC Service & Solutions, S.A. de C.V</h3>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Correo electrónico:</label>

        <input type="text" name="uname" placeholder="Ingrese su correo electrónico..." required><br>

        <label>Contraseña:</label>

        <input type="password" name="password" placeholder="Ingrese su contraseña..." required><br> 

        <button type="submit" style="background-color: #00c3ff; border-color: #00c3ff;">Iniciar Sesión</button>

     </form>

</body>

</html>
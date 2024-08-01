<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="index.php" method="post">
        <label for="usuario">Usuário</label>
        <input type="text" id="usuario" name="usuario"><br>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha"><br>
        <p style="color: red"><?php echo isset($_GET['w']) ? $_GET['w'] : ''?></p>
        <input type="submit">
    </form>
</body>
</html>
<?php
include __DIR__ . '/app/templates/header.php';

$error = null;
$params = [];
$authtoken = generateAuthToken();

if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
    if ($_POST['password'] != $_POST['confirm_password']) {
        $error = 'пароли не совпали';
    } else {
        $params[] = trim($_POST['email']);
        $params[] = md5(trim($_POST['password']));
        $params[] = $authtoken;
    }
}

if (!empty($params)) {
    $sql = "INSERT INTO `users`(`email`, `password`, `authtoken`) VALUES (?,?,?)";
    $query = $pdo->prepare($sql);
    $query->execute($params);
}

if (isset($_POST['success']) && !empty($params)) {
    header('location: login.php');
}
?>

<!-- content -->


<div class="register">
    <div>
        <?php print_r($error); ?>
    </div>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" required>
        <label for="confirm_password">Подтвердите пароль</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <button type="submit" name="success">Зарегистрироваться</button>
    </form>
    <p>Вы уже зарегистрированы? <a href="login.php">Войти</a></p>
</div>


<!-- content -->

<?php
include __DIR__ . '/app/templates/footer.php';
?>
<?php
include __DIR__ . '/app/templates/header.php';


$email = null;
$password = null;
$authtoken = null;
$checkPass = null;
$massage = null;


if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = '';
}
$params = [':email' => $email];

$sql = "SELECT * FROM `users` WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute($params);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
} else {
    $password = '';
}

if ($user != []) {
    $checkPass = $user['password'];
}

if (isset($_POST['success'])) {
    if ($password === $checkPass) {
        setcookie('authtoken', $user['authtoken']);
        header('location: index.php');
    } else {
        $massage = 'Невенрный email или пароль';
    }
}

?>

<!-- content -->

<div class="login">
    <p><?= $massage?></p>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">
        <button type="submit" name="success">Войти</button>
    </form>    
</div>

<!-- content -->

<?php
include __DIR__ . '/app/templates/footer.php';
?>
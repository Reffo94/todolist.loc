<?php
include __DIR__ . '/app/templates/header.php';

$title = 'Добавить запись';
$name = null;
$description = null;

if (!empty($_POST['name'])) {
    $name = $_POST['name'];
}

if (!empty($_POST['description'])) {
    $description = $_POST['description'];
}

$userId = getUserIdByAuthToken($_COOKIE['authtoken']);

$params = [':name' => $name, ':description' => $description, ':userid' => $userId];

$sql = 'INSERT INTO `tasks` (`name`, `description`,`userid`) VALUES (:name,:description,:userid)';
$query = $pdo->prepare($sql);

if (isset($_POST['success'])) {
    $query->execute($params);
    header('location: index.php');
}
?>

<!-- content -->

<div class="add">
    <form action="" method="post">
        <label for="name">Название</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Описание</label>
        <textarea name="description" id="description" cols="10" rows="7" required></textarea>
        <button type="submit" name="success">Записать</button>

    </form>
</div>

<!-- content -->

<?php
include __DIR__ . '/app/templates/footer.php';
?>
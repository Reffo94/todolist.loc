<?php
include __DIR__ . '/app/templates/header.php';

$taskId = $_GET['id'];

$sql = "SELECT * FROM `tasks` WHERE id = $taskId";
$query = $pdo->prepare($sql);
$query->execute();
$task = $query->fetch(PDO::FETCH_OBJ);

$id = $_GET['id'];
$name = $_POST['name'] ?? $task->name;
$description = $_POST['description'] ?? $task->description;

$params = [':name' => $name, ':description' => $description, ':id' => $id];

$sql = "UPDATE tasks SET name = :name, description = :description WHERE id = :id";
$query = $pdo->prepare($sql);

if (isset($_POST['success'])) {
    $query->execute($params);
    header('location: index.php');
}
?>

<!-- content -->

<div class="edit">
    <form action="?id=<?= $task->id ?>" method="post">
        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="<?= $task->name; ?>">
        <label for="description">Описание</label>
        <textarea name="description" id="description" cols="10" rows="7"><?= $task->description; ?></textarea>
        <button type="submit" name="success">Изменить</button>

    </form>
</div>

<!-- content -->

<?php
include __DIR__ . '/app/templates/footer.php';
?>
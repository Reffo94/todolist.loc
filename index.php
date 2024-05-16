<?php
include __DIR__ . '/app/templates/header.php';

$userId = '';

if (!empty($_COOKIE['authtoken'])) {
    $userId = getUserIdByAuthToken($_COOKIE['authtoken']);
} else {
    header('location: login.php');
}

$params = [$userId];
$sql = "SELECT * FROM `tasks` WHERE `userid` = ?;";
$query = $pdo->prepare($sql);
$query->execute($params);
$tasks = $query->fetchAll(PDO::FETCH_OBJ);

$hiddenTable = $tasks == [] ? ' hidden' : '';

?>
<!-- content -->

<div class="main_content">
    <a class="addlink" href="add.php">Добавить запись</a>
    <?php if (isAuthorized()) { ?>
        <table <?= $hiddenTable?>>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Дата создания</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($tasks as $task) { ?>
            <tbody>
                <td><?= $task->name ?></td>
                <td class="description"><?= $task->description ?></td>
                <td><?= $task->createdat ?></td>
                <td><a href="edit.php?id=<?= $task->id ?>" title="Редактировать"><img src="/app/img/edit.svg" alt="edit" width="30px"></a></td>
                <td><a href="delete.php?id=<?= $task->id ?>" title="Удалить"><img src="/app/img/delete.svg" alt="edit" width="24px"></a></td>
    
            </tbody>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>Войлите в систему или зарегистрируйтесь</p>
    <?php } ?>
</div>

<!-- content -->

<?php
include __DIR__ . '/app/templates/footer.php';
?>


<?php
require_once '../vendor/autoload.php';
$userRepository = new \App\Repositories\UserRepository();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userRepository->get($id);

    if (!empty($user)) {
        echo '<form name="delete" method="post" action="delete.php">
        <input type="hidden" name="id" value="'. $user['id'] .'">
         Вы действитьельно хотете удалить пользоватиеля: '.
                $user['first_name'] .' '. $user['last_name'] .' ?
         <input type="submit" value="Удалить">
         <a href="show.php">Назад</a>
        </form>';
    } else {
        echo 'Вы пытаетесь удалить не существующего пользователя! 
            <a href="show.php">Вернутся назад.</a>';
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $userRepository->delete($id);

    header("Location: ../user/show.php");
}

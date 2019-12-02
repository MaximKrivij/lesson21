<?php
require_once '../vendor/autoload.php';

$userRepository = new \App\Repositories\UserRepository();
$phoneRepository = new \App\Repositories\PhoneRepository();

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])) {
    $user['first_name'] = $_POST['first_name'];
    $user['last_name'] = $_POST['last_name'];
    $user['email'] = $_POST['email'];

    $phoneId = $phoneRepository->create($_POST['phone']);
    $userRepository->create($user, $phoneId);
    header("Location: ../user/show.php");
}

echo '<form name="create" method="post" action="create.php">
    <input type="text" name="first_name" value="" placeholder="Fist Name">
    <br>
    <input type="text" name="last_name" value="" placeholder="Last Name">
    <br>
    <input type="text" name="email" value="" placeholder="Email">
    <br>
    <input type="text" name="phone" value="" placeholder="Phone">
    <br>
    <input type="submit" value="Save">
    </form>';
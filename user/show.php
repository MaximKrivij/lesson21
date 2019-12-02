<?php
require_once '../vendor/autoload.php';

$userRepository = new \App\Repositories\UserRepository();
$phoneRepository = new \App\Repositories\PhoneRepository();
$users =  $userRepository->getListWithPhone();

echo '<a href="create.php">Create user</a>';
echo '<table border="1">';
echo '<tr>';
echo '<th>Fist Name</th>';
echo '<th>Last Name</th>';
echo '<th>Email</th>';
echo '<th>Phone</th>';
echo '<th>Action</th>';
echo '</tr>';

foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user['first_name'] . '</td>';
    echo '<td>' . $user['last_name'] . '</td>';
    echo '<td>' . $user['email'] . '</td>';
    echo '<td>' . $user['phone'] . '</td>';
    echo '<td>';
    echo '<a href="update.php?id='. $user['id'] .'">Update</a> ';
    echo '<a href="delete.php?id='. $user['id'] .'">Delete</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';


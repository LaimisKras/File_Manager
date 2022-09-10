<?php
session_start();

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login-manager.php");
    exit;
}

print('<h3 class="logoutText";">Congratulation! You have logged into password protected page.
<button class="btn-logout">
<a class="btn-log" href="logout-manager.php">Click here</a></button> to Logout.</h3>');
print('<br>');
print('<h1 style="color:black; text-align:center;">File Manager</h1>');



// folder and files list
$path = isset($_GET["path"]) ? './' . $_GET["path"] : './';
$files_and_dirs = scandir($path);
print('<table><th>Type</th><th>Name</th><th>Actions</th>');
foreach ($files_and_dirs as $fnd) {
    if ($fnd != ".." and $fnd != ".") {
        print('<tr>');
        print('<td>' . (is_dir($path . $fnd) ? "Directory" : "File") . '</td>');
        print('<td>' . (is_dir($path . $fnd)
                ? '<a href="' . (isset($_GET['path'])
                ? $_SERVER['REQUEST_URI'] . $fnd . '/'
                : $_SERVER['REQUEST_URI'] . '?path=' . $fnd . '/') . '">' . $fnd . '</a>'
                :  $fnd)
            . '</td>');
        print('<td>' . (is_dir($path . $fnd)
        )
            . '</form></td>');
        print('</tr>');
    }
}
print('</table>');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include 'css/style-manager.css'; ?>
    </style>
    <title>File Manager</title>
</head>

<body>
    
</body>

</html>
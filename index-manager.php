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


// creating a new folder
$path=isset($_GET["path"]) ? './' . $_GET["path"] : './';
    if (isset($_POST['createfolder'])) {
        $foldername = ($_POST['createfolder']);
    if (!file_exists($path . $foldername)) {
        mkdir($path . "/" . $foldername);
        print('<p class="warning">Folder was created!</p>');
        header('refresh: 2');
    } else if ($foldername) {
        print('<p class="warning">Such folder already exists!</p>');
        header('refresh: 2');
    } else {
        print('<p class="warning">Failed to create folder! Please write folder name!</p>');
        header('refresh: 2');
    }
}
print(' 
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="createField">
            <input type="text" name="createfolder" class="createInput" />
            <input type="submit" name="submit" value="Create folder" class="createButton" />
        </div>
    </form>
');


// upload file logic
if (isset($_FILES['image'])) {
    $errors = "";
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $exploded = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($exploded));
    $extensions = ["jpeg", "jpg", "png"];
    if (in_array($file_ext, $extensions) === false) {
        $errors = '<p class="warningUpl">File format is not allowed, please choose a JPEG or PNG file!</p>';
        header('refresh:2');
    }
    if ($file_size > 2097152) {
        $errors = '<p class="warningUpl">File size must be smaller than 2 MB!</p>';
        header('refresh: 2');
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $path . $file_name);
        echo '<p class="warningUpl">Success!Image uploaded</p>';
        header('refresh: 2');
    } else {
        print_r($errors);
    }
}
print('
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="uploadField">
            <input type="file" name="image" class="uploadInput" />
            <input type="submit" value="Upload image" class="createButton" />
        </div>
    </form>
');


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
            ? ''
            : ($fnd === 'index-manager.php' || $fnd === 'login-manager.php' || $fnd === 'logout-manager.php' || $fnd === 'Readme.md' || $fnd === 'login-manager.css' || $fnd === 'style-manager.css'
                ?'<form style="display: inline-block" action="" method="post">
                <div class="button">
                    <input type="hidden" name="download" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
                    <input class="downloadBtn" type="submit" value="Download">
                    </div>
                </form>
                <form style="display: inline-block" action="" method="post">
                    <div class="button">
                        <input type="hidden" name="delete" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
                        <input class="deleteBtn" type="submit" value="Delete">
                    </div>
                </form>'
                :'<form style="display: inline-block" action="" method="post">
                <div class="button">
                   <input type="hidden" name="download" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
                   <input class="downloadBtn" type="submit" value="Download">
                   </div>
                </form>
                <form style="display: inline-block" action="" method="post">
                    <div class="button">
                        <input type="hidden" name="delete" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
                        <input class="deleteBtn" type="submit" value="Delete">
                    </div>
                </form>'
            )
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
    <nav style="display: inline-block;">
        <button class="btn-back">
            <a href="<?php $q_string = explode('/', rtrim($_SERVER['QUERY_STRING'], '/'));
                        array_pop($q_string);
                        count($q_string) == 0
                            ? print('?path=/')
                            : print('?' . implode('/', $q_string) . '/');
                    ?>" class="backBtn">Go Back!</a>
        </button>
    </nav>
</body>
</html>
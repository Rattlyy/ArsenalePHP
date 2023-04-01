<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>

<body>
    <details>
        <summary>PHP Version</summary>

        PHP ver:
        <?= phpversion(); ?>
    </details>
    <details>
        <summary>PHP Info</summary>
        <?= phpinfo(); ?>
    </details>

    <details>
        <summary>DB MySQLi test</summary>
        <?php
        $link = mysqli_connect("mariadb", "root", getenv('MYSQL_ROOT_PASSWORD'), null, 3306);

        if (mysqli_connect_errno()) {
            printf("MySQLi connection failed: %s", mysqli_connect_error());
        } else {
            printf("MySQLi Server %s", mysqli_get_server_info($link));
        }

        mysqli_close($link);
        ?>
    </details>


    <details>
        <summary>PDO connection test</summary>
        <?php
        try {
            $database = 'mysql:host=mariadb:3306';
            $pdo = new PDO($database, 'root', getenv('MYSQL_ROOT_PASSWORD'));
            echo "PDO Connection worked";
        } catch (PDOException $e) {
            echo "Error: Unable to connect to MySQL. Error:\n $e";
        }

        $pdo = null;
        ?>
    </details>
</body>

</html>
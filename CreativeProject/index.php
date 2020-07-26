<head>
    <title>Interactive Media Arts Gallery</title>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<body style="margin: 120px auto; width: 15%" ;>
    <div>
        <h3>LOGIN FORM</h3>
        <form action="login.php" method="POST">
            <p>
                username:<input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            </p>
            <div class=" red-text"><?php echo $errs['username']; ?></div>
            <p>
                password:<input type=" password" name="password">
            </p>
            <input style="float: right;" type="submit" name="submit" value="submit">
    </div>
    </form>
</body>
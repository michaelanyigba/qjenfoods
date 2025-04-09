<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <form action="password_reset_code.php" method="post">
    <div class="form-group mb-3 w-50">
        <label for="">Email Address</label>
        <input type="text" name="email" placeholder="Enter email" class="form-control">
    </div>
    <div class="form-group mb-3">
        <button type="submit" name="password_reset_link">Send password link</button>
    </div>
    </form>
    
</body>
</html>
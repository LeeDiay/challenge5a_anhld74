<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
      rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
      crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Link bootstrap icon ở trên -->
    <link rel="stylesheet" href="../source/css/main.css">
    <title>Vux's Web</title>
</head>
<body>
    <!-- Responsive Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
        <div class="container">
            <a href="./page_user.php" class="navbar-brand">VCS School</a>
            <button 
              class="navbar-toggler" 
              type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-dark" href="./info.php" role="button">Account information</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="./upload.php" role="button">File upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="./announcement.php" role="button">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <form class="text-start" method='POST'>
                            <button type="submit" name="logout" class="btn btn-primary">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
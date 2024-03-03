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
    <title>VCS School</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
        <div class="container">
            <a href="page_admin.php" class="navbar-brand">VCS School</a>
            <button 
              class="navbar-toggler" 
              type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                        <a class="btn btn-dark" href="../admin/info.php" role="button">My account</a>
                    </li> -->
                    <li class="nav-item">
                        <div class="dropdown">
                            <button 
                            class="btn btn-dark dropdown-toggle" 
                            type="button" id="profile" 
                            data-bs-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                My account
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                                <a href="info.php" class="dropdown-item">Show info</a>
                                <a href="update_passwd.php" class="dropdown-item">Change password</a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button 
                            class="btn btn-dark dropdown-toggle" 
                            type="button" id="account-management" 
                            data-bs-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                Account manage
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="account-management">
                                <a href="show-user.php" class="dropdown-item">Show account</a>
                                <a href="create-user.php" class="dropdown-item">Create account</a>
                                <a href="delete-user.php" class="dropdown-item">Delete account</a>
                                <a href="update-user.php" class="dropdown-item">Update account</a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="../admin/file_management.php" role="button">File manage</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button 
                            class="btn btn-dark dropdown-toggle" 
                            type="button" id="assignment-management" 
                            data-bs-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                 Assignment manage
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="assignment-management">
                                <a href="show_assignment.php" class="dropdown-item"> Show assignment</a>
                                <a href="add_assignment.php" class="dropdown-item">Add assignment</a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button 
                            class="btn btn-dark dropdown-toggle" 
                            type="button" id="announce-management" 
                            data-bs-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                 Announcement manage
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="account-management">
                                <a href="announcement.php" class="dropdown-item"> Show announcement</a>
                                <a href="add_announcement.php" class="dropdown-item">Add announcement</a>
                            </ul>
                        </div>
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
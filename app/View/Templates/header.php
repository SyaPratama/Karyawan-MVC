<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $model["title"] ?></title>
    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?= $BASEURL ?>/assets/favicon.svg" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?= $BASEURL ?>/css/bootstrap.css">
    <!-- MY CSS -->
    <link rel="stylesheet" href="<?= $BASEURL ?>/css/style.css">
    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    if (isset($_SESSION["error"])) : ?>
        <div class="container text-center <?= isset($_SESSION["LOGGED"]) ? "my-fixed" : "fixed-top" ?> py-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION["error"] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION["error"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["success"])) : ?>
        <div class="container text-center <?= isset($_SESSION["LOGGED"]) ? "my-fixed" : "fixed-top" ?> py-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION["success"] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION["success"]); ?>
    <?php endif; ?>

    <div class="container-md-12 d-flex">

        <?php if (isset($_SESSION["LOGGED"])) : ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar" style="width: 280px;">

                <div class="burger-menu">
                    <i id="close" class="bi bi-x"></i>
                    <i id="open" class="bi bi-list"></i>
                </div>

                <a href="<?= $BASEURL ?>/" class="d-flex align-items-center gap-2 mb-3 mb-md-0 me-md-auto link-dark text-decoration-none" id="logo-sidebar">
                    <svg id="logo-84" width="30" height="28" viewBox="0 0 40 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd" d="M9.98578 4.11462L0 14C1.99734 15.9773 4.27899 17.6437 6.76664 18.9474C7.45424 20.753 8.53203 22.4463 10 23.8995C15.5229 29.3668 24.4772 29.3668 30 23.8995C31.468 22.4463 32.5458 20.753 33.2334 18.9473C35.721 17.6437 38.0027 15.9773 40 14L30.0223 4.12266C30.0149 4.11527 30.0075 4.10788 30 4.1005C24.4772 -1.36683 15.5229 -1.36683 10 4.1005C9.99527 4.10521 9.99052 4.10991 9.98578 4.11462ZM29.0445 20.7309C26.1345 21.7031 23.0797 22.201 20 22.201C16.9203 22.201 13.8656 21.7031 10.9556 20.7309C11.2709 21.145 11.619 21.5424 12 21.9196C16.4183 26.2935 23.5817 26.2935 28 21.9196C28.381 21.5424 28.7292 21.145 29.0445 20.7309ZM12.2051 5.8824C12.9554 6.37311 13.7532 6.79302 14.588 7.13536C16.3038 7.83892 18.1428 8.20104 20 8.20104C21.8572 8.20104 23.6962 7.83892 25.412 7.13536C26.2468 6.79302 27.0446 6.3731 27.795 5.88238C23.4318 1.77253 16.5682 1.77254 12.2051 5.8824Z" fill="#3B4158"></path>
                    </svg>
                    <span class="fs-4"><strong>Dashboard</strong></span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= $BASEURL ?>/" class="nav-link <?= !isset($_SERVER["PATH_INFO"]) ? "active" : "" ?> link-dark">
                            <i class="bi bi-house-door-fill"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/penilaian" class="nav-link link-dark <?= isset($_SERVER["PATH_INFO"]) && $_SERVER["PATH_INFO"] === "/penilaian" ? "active" : "" ?>">
                            <i class="bi bi-clipboard2-pulse-fill"></i>
                            Penilaian
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $BASEURL ?>/assets/unknown.jpg" alt="" width="25" height="25" class="rounded-circle me-2">
                        <strong><?= $user[0]["username"] ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li>
                            <form action="/signOut" method="POST" class="dropdown-item">
                                <input type="hidden" value="logout" name="logout">
                                <button type="submit" class="badge btn-logout">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
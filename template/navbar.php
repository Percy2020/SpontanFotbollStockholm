<?php session_start();?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PostsBase</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/phpDev/index.php">Hem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/phpDev/message/messagesList.php">Gruppen</a>
                </li>
                <?php if(isset($_SESSION['userid'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/phpDev/login/logout.php"">logga ut</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/phpDev/login/loginUser.php"">login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
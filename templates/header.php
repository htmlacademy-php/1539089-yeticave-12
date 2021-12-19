<header class="main-header">

    <div class="main-header__container container">
        <h1 class="visually-hidden">YetiCave</h1>

        <a class="main-header__logo" href="index.php">
            <!-- можно сделать условие, чтобы сравнивать url и на главной ссылку не добавлять -->
            <img src="../img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
        </a>
        <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru" autocomplete="off">

            <input type="search" name="search" placeholder="Поиск лота">
            <input class="main-header__search-btn" type="submit" name="find" value="Найти">

        </form>
        <?php  if (isset($_SESSION) && !empty($_SESSION)) : ?>
        <a class="main-header__add-lot button"
        href="add.php">Добавить лот</a>
        <?php else : ?>
        <a class="main-header__add-lot button" href="templates/403.php">Добавить лот</a>
        <?php endif; ?>


        <nav class="user-menu">

            <?php if (isset($_SESSION) && !empty($_SESSION)) : ?>
                <div class="user-menu__logged">
                    <p><?php echo (htmlspecialchars($_SESSION['user_name'])); ?></p>
                    <a class="user-menu__bets" href="pages/my-bets.html">Мои ставки</a>
                    <a class="user-menu__logout" href="logout.php">Выход</a>
                </div>
                </p>
            <?php else : ?>
                <ul class="user-menu__list">
                    <li class="user-menu__item">
                        <a href="signUpScenario.php">Регистрация</a> <!-- в задании сказано, если юзер залогинен то редиректить его на 403, но она же и так не будет оражаться?-->
                    </li>
                    <li class="user-menu__item">
                        <a href="loginScript.php">Вход</a>
                    </li>
                </ul>
            <?php endif; ?>
        </nav>
    </div>

</header>

    <section class="top" name="menu">
        <a href="http://localhost:8070/home" class="logo">
            <p>
                Cramata
            </p>
        </a>
        <nav class="menu__unknown">
            <a href="about">
                About
            </a>
            <?php if (array_key_exists('authorizedUser', $_SESSION)): ?>
                <a href="user/cabinet" class="login">
                    <?php echo $_SESSION['authorizedUser']?>
                </a>
                <a href="logout">
                    Logout
                </a>
            <?php else: ?>
                <a href="user/login">
                    Log/Sign in
                </a>
            <?php endif; ?>
        </nav>
    </section>
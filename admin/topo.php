    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                <img src="../public/assets/images/user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="../public/assets/images/!logged-user.jpg">
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com"><span class="name">
                    <?php echo $_SESSION["nome_administrador"] ?></span>
                <span class="role"><?php echo $GLOBALS['titulo']; ?> | Administrativo</span>
            </div>
            <i class="fa custom-caret"></i>
        </a>
        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
                <li>
                    <a role="menuitem" tabindex="-1" href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
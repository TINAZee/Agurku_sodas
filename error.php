<?php if (isset($_SESSION['err'])): ?>
    <?php if(1 == $_SESSION['err']): ?>
    <h3 style="color:red;">Neigiamas agurkas</h3>
    <?php endif ?>
    <?php if(2 == $_SESSION['err']): ?>
    <h3 style="color:red;">Per daug sodinate, pone</h3>
    <?php endif ?>
    <?php unset($_SESSION['err']) ?>
<?php endif ?>
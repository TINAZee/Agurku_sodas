<?php if (isset($_SESSION['err'])): ?>
    <?php if(1 == $_SESSION['err']): ?>
    <h3 style="color:red;">Neigiamas agurkas</h3>
    <?php endif ?>
    <?php if(2 == $_SESSION['err']): ?>
    <h3 style="color:red;">Per daug sodinate, limitas - 4 agurkų</h3>
    <?php endif ?>
    <?php if(3 == $_SESSION['err']): ?>
    <h3 style="color:red;">Per daug skinate</h3>
    <?php endif ?>
    <?php if(4 == $_SESSION['err']): ?>
    <h3 style="color:red;">Reikia įrašyti skaičių</h3>
    <?php endif ?>
    <?php if(5 == $_SESSION['err']): ?>
    <h3 style="color:red;">Negalima nuskinti tik dalies agurko</h3>
    <?php endif ?>
    <?php unset($_SESSION['err']) ?>
<?php endif ?>
<!DOCTYPE html>
<html lang="it">
    <?php 
        require "../db/bootstrap.php";
    ?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home_style.css" >
    <link rel="stylesheet" href="../css/nav_div_style.css" >
    

    <title>AlmAware - Home</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
    <main>

        <div class="mobile-only-div">
            <router-link v-if="backLink!=''" :to="'/home'"><arrowBackIcon></arrowBackIcon></router-link>
            <p>Hi <?php echo $_SESSION["name"];?> !</p>
        </div>

        <?php $sdg_array = $dbh->getAllSdg();?>
        
        <div  class="sdg_container">
            <?php foreach($sdg_array as $sdg): ?>
                <div class="sdg_card" style="background-image:url('<?php echo $sdg['img_background']; ?>'); border: solid 2px <?php echo colorSdg($sdg['idgoalsdg']); ?>">
                    <a href="kiosk.php?idgoalsdg=<?php echo $sdg['idgoalsdg']; ?>">    
                        <img src=<?php echo $sdg['img_sdgicons']; ?> alt=<?php echo $sdg['title']; ?> />
                    </a>
                </div>
            <?php endforeach; ?> 
        </div>

        <nav>
            <a href="../php/home.php"><img src="../images/medias/components/icons/home.svg" class="icon"/></a>
            <!--mobile version -->
            <a href="../php/profile.php" class="mobile-only" ><img src="../images/medias/user.svg" class="icon"/></a>
            <a href="../php/badges.php" class="mobile-only" ><img src="../images/medias/components/icons/badge-check.svg" class="icon"/></a>
            <!--desktop version -->
            <a href="../php/greenhouse.php" class="desktop-only"><img src="../images/medias/components/icons/greenhouse.svg" class="icon"/></a>
        </nav>

    </main>
</body>
</html>

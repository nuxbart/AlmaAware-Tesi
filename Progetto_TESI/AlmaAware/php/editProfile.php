<!DOCTYPE html>
<html lang="it">
    <?php require_once "../db/bootstrap.php"; ?>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/profile_style.css" >
        <link rel="stylesheet" href="../css/nav_div_style.css" >
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="../js/editProfile.js"></script>
        
        <title>AlmAware - Edit Profile</title>
        <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
    </head>
    <body>
        <!-- Nel caso dovessi aggiungere il bottone di logout -->
        <!-- <header >
            <div class="row ">
                <h1 class="col-10 font-monospace fw-bold text-center pt-2 pb-2">See&Go</h1>
                <?php if($templateParams["profile"]["Username"]==$_SESSION["Username"]): ?>
                <button id="btn_logout" class="btn text-white font-monospace float-end col-1">Logout</button>
                <?php endif; ?>
            </div>
        </header> -->

    <main>
        <div class="mobile-only-div">
            <a href="../php/home.php"><img src="../images/medias/components/icons/arrow-back.svg" class="icon"/></a>
            <p>Hi <?php echo $_SESSION["name"];?> !</p>
        </div>

        <div class="title">
            <img class="img" src=<?php echo $_SESSION["img_profile"]; ?>>
            <h1 class="center">Edit profile</h1>
            <form method="post" enctype="multipart/form-data">
            <input type="file" id="img_profile" name="img_profile" accept=".jpg,.png,.jpeg" placeholder="Choose photo"/>
                <input class="input" id="name" placeholder=<?php echo $_SESSION["name"];?> type="text" />
                <input class="input" id="email" placeholder=<?php echo $_SESSION["email"];?> type="mail" />
                <select class="select" id="campus" :options ="options">
                <option value="" disabled selected hidden><?php echo $_SESSION["campus"];?></option>
                    <option value="Bologna" >Bologna</option>
                    <option value="Cesena" >Cesena</option>
                    <option value="Forlì" >Forlì</option>
                    <option value="Ravenna" >Ravenna</option>
                    <option value="Rimini" >Rimini</option>
                </select>
                <input class="input" id="password" placeholder=<?php echo $_SESSION["password"];?> type="password"/>

            </form>
        </div>

        <div class="btn-container">
            <button onclick=saveChanges() name="btnSave" class="btn-grey" type="btn-grey" value="Save"> Save Changes</button>
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
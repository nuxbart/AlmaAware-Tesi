<!DOCTYPE html>
<html lang="it">
    <?php 
        require "../db/bootstrap.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../css/sdg_style.css" >
    <link rel="stylesheet" href="../css/nav_div_style.css" >

    <title>AlmAware - Sdg <?php echo $_GET['idSdg']; ?></title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
    <?php $currentSDG = $dbh->getSdg($_GET['idSdg']);?>
    <main>
        <div class="bubble-container"></div>
        <div class="mobile-only-div">
        <a href="../php/badges.php"><img src="../images/medias/components/icons/arrow-back.svg" class="icon"/></a>
            <p>Hi <?php echo $_SESSION["name"];?> !</p>
        </div>
        <h1>What we can do ?</h1>
        <?php $actions = $dbh->getActionsSdg($currentSDG[0]['idgoalsdg']);?>
        <?php foreach($actions as $action): ?>
            <ul>
                <li style="border-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>">
                    <?php echo $action["description"]; ?>
                </li>
            </ul>
        <?php endforeach; ?> 

        <?php $badges=$dbh->getSdgBadges($currentSDG[0]['idgoalsdg']); ?>
        <div class="actions_containter">
            <?php $index = 0; ?>
            <?php foreach($badges as $badge): ?>
                <div class="action-item">
                    <button class="show-modal" data-action-id="<?php echo $index; ?>" 
                    style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
                    background-image: url(<?php echo $badge["badge_icon"]; ?>);"></button>
                    
                    <p><?php echo $badge["subtitle"]; ?></p>

                    <!-- POP-UP -->
                    <div id="action-details-<?php echo $index; ?>" style="display:none;">
                        <div class="modal-body">
                            <p style="font-size: 24px; font-weight: bold;"><?php echo $badge['type']; ?></p>
                            <?php $idUser=$dbh->getIdUser($_SESSION["email"]); 
                            $badgeSDGUserCurr=$dbh->getBadgeSDGUser($idUser[0]["idUser"], $badge["badgeName"]);?>
                            <?php if($badge['type']=="Counter"):?>
                                <button id="btn-counter" class="btn-counter" onclick="increase(<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>, <?php echo $badgeSDGUserCurr[0]['type'];?>, this)" 
                                        style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>; border-radius: 25px; width: 100px; height: auto;">
                                    <p id="counter-txt" class="counter-txt"><?php echo $badgeSDGUserCurr[0]['type']; ?><p>
                                </button>
                            <?php elseif($badge['type']=="Input"): ?>
                                <label class="label" for="inputSDG"><?php echo $badge["subtitle"]; ?></label>
                                <input type="text" id="inputSDG" name="inputSDG" class="inputSDG" placeholder="Input"/>
                            <?php elseif($badge['type']=="Checkbox"): ?>
                                <div>
                                    <input class="checkbox" type="checkbox" value="" id="checkbox"/>
                                    <label class="checkbox-label" for="checkbox"> <?php echo $badge["subtitle"]; ?> </label>
                                </div>  
                            <?php elseif($badge['type']=="Quiz"): ?>
                                <p>Quiz!</p>
                            <?php elseif($badge['type']=="QR-Code"): ?>
                                <p>QR-Code!</p>
                            <?php elseif($badge['type']=="Timer"): ?>
                                <p>Timer!</p>
                            <?php elseif($badge['type']=="Link"): ?>
                                <p>Link!</p>
                            <?php endif; ?>
                            <div class="btn-container">
                                <button id="btn-unibo-outline" class="btn-unibo-outline" style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;">Validate</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php $index++; ?>
            <?php endforeach; ?> 
            <div class="popup-container" id="popup" >
                <span id="close-popup" style="cursor:pointer; float:right;"><img src="../images/medias/components/icons/cross.svg" style="height:2.5vh; z-index:100;"/></span>
                <div id="popup-content"></div>
            </div>
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

<style lang="css" scoped>
    li::before {
    background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
    }
</style>
    
<script src="../js/sdg.js"></script>
</body>
</html>
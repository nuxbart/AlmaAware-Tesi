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
            <?php foreach($badges as $badge): ?>
                <div class="action-item">
                    <button id="show-modal" onclick="showPopUp(<?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>, <?php echo $badge['type']; ?>)"
                    style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
                    background-image: url(<?php echo $badge["badge_icon"]; ?>);"></button>
                    <p><?php echo $badge["subtitle"]; ?></p>
                </div>
                <div id="popupContainer"></div>
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

<style lang="css" scoped>
    li::before {
    background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function closeAll() {
      document.getElementById('popup').style.display = 'none';
    };
    function showPopUp(color, type) {
        const badgesContainer = document.getElementById('popupContainer');
        const badgePopUp = document.createElement('div');
        badgePopUp.classList.add('popup');
        badgePopUp.id = 'popup';

        badgePopUp.innerHTML = `<img src="../images/medias/components/icons/cross.svg" class="modal-default-button" onclick="closeAll()" style="height:2.5vh; z-index:100,"/>
                                <div class="modal-body">
                                <p style="font-size: 24px; font-weight: bold;">${type}</p>
                                <div class="btn-container">
                                    <button id="btn-unibo-outline" class="btn-unibo-outline" style="background-color: ${color};">Validate</button>
                                </div>
                                </div>`;
        badgesContainer.appendChild(badgePopUp);
        document.getElementById('popup').style.display = 'flex';
    }
</script>
</body>
</html>
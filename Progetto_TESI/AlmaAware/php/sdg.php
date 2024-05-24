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
                <?php $idUser=$dbh->getIdUser($_SESSION["email"]); 
                    $badgeSDGUserCurr=$dbh->getBadgeSDGUser($idUser[0]["idUser"], $badge["badgeName"]);?>

                    <button class="show-modal" data-action-id="<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" data-input-id="<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>"
                    style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
                    background-image: url(<?php echo $badge["badge_icon"]; ?>);"></button>
                    
                    <p><?php echo $badge["subtitle"]; ?></p>

                    <!-- POP-UP -->
                    <div id="action-details-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" style="display:none;">
                        <div class="modal-body">
                            <p style="font-size: 24px; font-weight: bold;"><?php echo $badge['badgeName']; ?></p>
                            
                            <?php if($badge['type']=="Counter"):?>
                                <button id="btn-counter" class="btn-counter" onclick="increase(<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>, <?php echo $badgeSDGUserCurr[0]['type'];?>, this)" 
                                        style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>; border-radius: 25px; width: 100px; height: auto;">
                                    <p id="counter-txt" class="counter-txt"><?php echo $badgeSDGUserCurr[0]['type']; ?><p>
                                </button>
                            <?php elseif($badge['type']=="Input"): ?>
                                <label class="label" for="inputSDG"><?php echo $badge["subtitle"]; ?></label>
                                <input type="text" id="inputSDG" name="inputSDG" class="inputSDG" placeholder="<?php if ($badgeSDGUserCurr[0]['type']!=null): echo $badgeSDGUserCurr[0]['type']; else: echo "Input"; endif;?>"/>
                            <?php elseif($badge['type']=="Checkbox"): ?>
                                <div>
                                    <input class="checkbox" type="checkbox" value="" id="checkbox" <?php if ($badgeSDGUserCurr[0]['type']==1): echo "checked"; endif;?>/>
                                    <label class="checkbox-label" for="checkbox"> <?php echo $badge["subtitle"]; ?> </label>
                                </div>  
                            <?php elseif($badge['type']=="Quiz1" || $badge['type']=="Quiz2"): ?>
                                <?php if ($badge['type'] == "Quiz1"): ?>
                                    <div class="quiz-question" id="question-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">
                                        <p>Domanda: Quale percentuale di ricercatori nel campo della scienza e la tecnologia sono donne?</p>
                                        <div class="quiz-options">
                                            <input type="radio" id="option1-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="50">
                                            <label for="option1-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">50%</label><br>
                                            <input type="radio" id="option2-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="30">
                                            <label for="option2-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">30%</label><br>
                                            <input type="radio" id="option3-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="70">
                                            <label for="option3-1-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">70%</label><br>
                                        </div>
                                    </div>
                                <?php elseif ($badge['type'] == "Quiz2"): ?>
                                    <div class="quiz-question" id="question-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">
                                        <p>Domanda: Quale di queste è una fonte di energia rinnovabile?</p>
                                        <div class="quiz-options">
                                            <input type="radio" id="option1-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="Olio">
                                            <label for="option1-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">Olio</label><br>
                                            <input type="radio" id="option2-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="Gas">
                                            <label for="option2-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">Gas</label><br>
                                            <input type="radio" id="option3-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" name="quiz-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>" value="Luce solare">
                                            <label for="option3-2-<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>">Luce solare</label><br>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php elseif($badge['type']=="QR-Code"): ?>
                                <p>QR-Code!</p>
                                <!-- TROVARE FOTO QR-Code -->
                            <?php elseif($badge['type']=="Timer"): ?>
                                <p><?php echo $badge["subtitle"]; ?></p>
                                <div><p id="timer" class="timer">10:00</p></div>
                                <button id="timer-btn" class="timer-btn" onclick="startTimer(<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>, <?php echo $badgeSDGUserCurr[0]['type'];?>)">Start Timer</button>
                                <div>Docce brevi fatte:<p id="timer-counter" class="timer-counter"><?php echo $badgeSDGUserCurr[0]['type']; ?></p></div>
                            <?php elseif($badge['type']=="Link"): ?>
                                <p><?php echo $badge["subtitle"]; ?></p>
                                <a href="../php/greenhouse.php">Clicca qui</a>
                            <?php endif; ?>
                            <div class="btn-container">
                                <?php if($badgeSDGUserCurr[0]['validated']==0): ?>
                                    <button id="btn-unibo-outline" class="btn-unibo-outline" 
                                    onclick="<?php if($badge['type']=="Quiz1" || $badge['type']=="Quiz2"):?>  
                                                    submitQuiz(<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>, '<?php echo $badge['type']; ?>', '<?php echo $badge['badgeName']; ?>')
                                            <?php else:?> 
                                                validate(<?php echo $badgeSDGUserCurr[0]['idbadge']; ?>, <?php echo isset($badgeSDGUserCurr[0]['type']) ? $badgeSDGUserCurr[0]['type'] : 0;?>, '<?php echo $badge['badgeName']; ?>' )
                                            <?php endif;?>"
                                            style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;">Validate</button>
                                <?php else: ?>
                                    <button id="btn-unibo-outline" class="btn-unibo-outline" style="background-color: grey;">Validated</button>
                                <?php endif; ?>
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
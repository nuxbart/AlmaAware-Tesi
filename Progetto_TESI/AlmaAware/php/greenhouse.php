<!DOCTYPE html>
<html lang="it">
<?php require "../db/bootstrap.php";?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/greenhouse_style.css" >
        <link rel="stylesheet" href="../css/nav_div_style.css" >
        <!--<link rel="stylesheet" href="../css/flower_style.css" >-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function setPotColor(color, id) {
                var svgDoc = $('#pot-'+id).contents();
                svgDoc.find('#pot-svg path').attr('fill', color);

                var svgDocP = $('#potP-'+id).contents();
                svgDocP.find('#pot-svg path').attr('fill', color);
            }
            
        </script>
        <title>AlmAware - GreenHouse</title>
        <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
    </head>
    <body>
        <main>
            <div class="greenhouse">
                <div class="shelf-container">
                    <?php $listFlowers=$dbh->getAllFlowers();?>
                    <?php $numRows = ceil(count($listFlowers) / 3); 
                    for ($row = 0; $row < $numRows; $row++): ?>
                        <div class="shelf">
                            <?php for ($col = 0; $col < 3; $col++): ?>
                                <?php $index = $row * 3 + $col;?>
                                <?php if ($index < count($listFlowers)): ?>
                                    <div class="flower">
                                    <?php $flower = $listFlowers[$index]; 
                                        if($flower["typeFlower1"]):?>
                                            <img id="flower1" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 3.2%; padding-left: -8%;" src="../images/medias/flower1.png"/>
                                        <?php endif; ?>
                                        <?php if($flower["typeFlower2"]):?>
                                            <img id="flower2" class="visible" style="width: 2%; height: auto; position: fixed;  margin-bottom: 3.2%; margin-left: 2.5%;" src="../images/medias/flower2.png"/>
                                        <?php endif; ?>
                                        <?php if($flower["typeFlower3"]):?>
                                            <img id="flower3" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 6%; margin-left: 1.5%;" src="../images/medias/flower3.png"/>
                                        <?php endif; ?>
                                        <img src="../images/medias/plante.svg" />
                                        <object class="svgClass" id="pot-<?php echo $flower['idMyFlower']; ?>" type="image/svg+xml" data="../images/medias/pot.svg" onload="setPotColor('<?php echo $flower['colorPot']; ?>', '<?php echo $flower['idMyFlower']; ?>')"></object>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="podium">
                    <?php 
                        //First flower
                        $idUserFirstPodium=$dbh->getFirstPodiumFlowerIdUser();
                        $idMyFlowerFirst=$dbh->getIdFlowerFromIdUser($idUserFirstPodium[0]["idUser"]);
                        $firstFlower=$dbh->getUserFlower($idMyFlowerFirst[0]["idMyFlower"]);
                        
                        //Second flower
                        $idUserSecondPodium=$dbh->getSecondPodiumFlowerIdUser();
                        $idMyFlowerSecond=$dbh->getIdFlowerFromIdUser($idUserSecondPodium[0]["idUser"]);
                        $secondFlower=$dbh->getUserFlower($idMyFlowerSecond[0]["idMyFlower"]);

                        //Third flower
                        $idUserThirdPodium=$dbh->getThirdPodiumFlowerIdUser();
                        $idMyFlowerThird=$dbh->getIdFlowerFromIdUser($idUserThirdPodium[0]["idUser"]);
                        $thirdFlower=$dbh->getUserFlower($idMyFlowerThird[0]["idMyFlower"]);
                        ?>
                    <div id="second-item">
                        <?php if ($secondFlower!=null): ?>
                            <div class="flowerPodium">
                            <?php if($secondFlower[0]["typeFlower1"]):?>
                                    <img id="flower1" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 3.2%; padding-left: -8%;" src="../images/medias/flower1.png"/>
                                <?php endif; ?>
                                <?php if($secondFlower[0]["typeFlower2"]):?>
                                    <img id="flower2" class="visible" style="width: 2%; height: auto; position: fixed;  margin-bottom: 3.2%; margin-left: 2.5%;" src="../images/medias/flower2.png"/>
                                <?php endif; ?>
                                <?php if($secondFlower[0]["typeFlower3"]):?>
                                    <img id="flower3" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 6%; margin-left: 1.5%;" src="../images/medias/flower3.png"/>
                                <?php endif; ?>
                                <img src="../images/medias/plante.svg" />
                                <object class="svgClass" id="potP-<?php echo $secondFlower[0]['idMyFlower']; ?>" type="image/svg+xml" data="../images/medias/pot.svg"  onload="setPotColor('<?php echo $secondFlower[0]['colorPot']; ?>', '<?php echo $secondFlower[0]['idMyFlower']; ?>')"></object>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div id="first-item">
                        <?php if ($firstFlower!=null): ?>
                            <div class="flowerPodium">
                                <?php if($firstFlower[0]["typeFlower1"]):?>
                                    <img id="flower1" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 3.2%; padding-left: -8%;" src="../images/medias/flower1.png"/>
                                <?php endif; ?>
                                <?php if($firstFlower[0]["typeFlower2"]):?>
                                    <img id="flower2" class="visible" style="width: 2%; height: auto; position: fixed;  margin-bottom: 3.2%; margin-left: 2.5%;" src="../images/medias/flower2.png"/>
                                <?php endif; ?>
                                <?php if($firstFlower[0]["typeFlower3"]):?>
                                    <img id="flower3" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 6%; margin-left: 1.5%;" src="../images/medias/flower3.png"/>
                                <?php endif; ?>
                                <img src="../images/medias/plante.svg" />
                                <object class="svgClass" id="potP-<?php echo $firstFlower[0]['idMyFlower']; ?>" type="image/svg+xml" data="../images/medias/pot.svg" onload="setPotColor('<?php echo $firstFlower[0]['colorPot']; ?>', '<?php echo $firstFlower[0]['idMyFlower']; ?>')"></object>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div id="third-item"  >
                        <?php if ($thirdFlower!=null): ?>
                            <div class="flowerPodium">
                            <?php if($thirdFlower[0]["typeFlower1"]):?>
                                    <img id="flower1" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 3.2%; padding-left: -8%;" src="../images/medias/flower1.png"/>
                                <?php endif; ?>
                                <?php if($thirdFlower[0]["typeFlower2"]):?>
                                    <img id="flower2" class="visible" style="width: 2%; height: auto; position: fixed;  margin-bottom: 3.2%; margin-left: 2.5%;" src="../images/medias/flower2.png"/>
                                <?php endif; ?>
                                <?php if($thirdFlower[0]["typeFlower3"]):?>
                                    <img id="flower3" class="visible" style="width: 2%; height: auto; position: fixed; margin-bottom: 6%; margin-left: 1.5%;" src="../images/medias/flower3.png"/>
                                <?php endif; ?>
                                <img src="../images/medias/plante.svg" />
                                <object class="svgClass" id="potP-<?php echo $thirdFlower[0]['idMyFlower']; ?>" type="image/svg+xml" data="../images/medias/pot.svg" onload="setPotColor('<?php echo $thirdFlower[0]['colorPot']; ?>', '<?php echo $thirdFlower[0]['idMyFlower']; ?>')"></object>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- button for add his flower-->
            <button class="mascot" id="show-modal"></button>
            <!-- add pop up to upload flower -->
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


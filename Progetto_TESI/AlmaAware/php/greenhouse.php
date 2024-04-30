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
        <link rel="stylesheet" href="../css/flower_style.css" >

        <title>AlmAware - GreenHouse</title>
        <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
    </head>
    <body>
        <main>
            <div class="greenhouse">
                <div class="shelf-container">
                    <?php $listFlowers=$dbh->getAllFlowers();?>
                    <!--<div v-for="row in 3" class="shelf">
                        <Flower v-if="row == 1" v-for="element in listRow1"  ></Flower>
                        <Flower v-if="row == 2" v-for="element in listRow2"></Flower>
                        <Flower v-if="row == 3" v-for="element in listRow3"></Flower> count(array_column(, "idMyFlower")
                    </div>-->
                    <?php $numRows = ceil(count($listFlowers) / 3); 
                    for ($row = 0; $row < $numRows; $row++): ?>
                        <div class="shelf">
                            <?php for ($col = 0; $col < 3; $col++): ?>
                                <?php $index = $row * 3 + $col;?>
                                <?php if ($index < count($listFlowers)): ?>
                                    <div class="flower">
                                    <?php $flower = $listFlowers[$index]; 
                                        if($flower["typeFlower1"]):?>
                                            <img id="flower1" class="visible" style="width: 40px; height: 40px; position: absolute; top: 0%; left: -8%;" src="../images/medias/flower1.png"/>
                                        <?php endif; ?>
                                        <?php if($flower["typeFlower2"]):?>
                                            <img id="flower2" class="visible" style="width: 40px; height: 40px; position: absolute; top: 0; left: 50%;" src="../images/medias/flower2.png"/>
                                        <?php endif; ?>
                                        <?php if($flower["typeFlower3"]):?>
                                            <img id="flower3" class="visible" style="width: 40px; height: 40px; position: absolute; top: -32%; left: 28%;" src="../images/medias/flower3.png"/>
                                        <?php endif; ?>
                                    <img src="../images/medias/plante.svg" />
                                    <object class="svgClass" type="image/svg+xml" data="../images/medias/pot.svg"></object>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="podium">
                    <div id="second-item"><Flower></Flower></div>
                    <div id="first-item"><Flower></Flower></div>
                    <div id="third-item"  ><Flower></Flower></div>
                </div>
            </div>

           <!-- DA METTERE I FIORI --> 

            <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <modal
            :show="showModal"
            @close="showModal = false"
            type="greenhouse"
            color = "var(--unibo)"
            text = "Flower"
            >
            </modal>
            </Teleport>


            <!-- button for add his flower-->
            <button class="mascot" id="show-modal"></button>

            <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <modal
            :show="showModal"
            @close="showModal = false"
            type="greenhouse"
            >
            </modal>
            </Teleport>
            <nav>
                <a href="../php/home.php"><img src="../images/medias/components/icons/home.svg" class="icon"/></a>
                <!--mobile version -->
                <a href="../php/profile.php" class="mobile-only" ><img src="../images/medias/user.svg" class="icon"/></a>
                <a href="../php/badges.php" class="mobile-only" ><img src="../images/medias/components/icons/badge-check.svg" class="icon"/></a>
                <!--desktop version -->
                <a href="../php/greenhouse.php" class="desktop-only"><img src="../images/medias/components/icons/greenhouse.svg" class="icon"/></a>
            </nav>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.pot').each(function(index) {
                    <?php $flower = $listFlowers[$index]; ?>
                    <?php if ($flower['colorPot']): ?>
                        var svgDoc = $(this).contents();
                        //document.querySelector(".svgClass").getSVGDocument().getElementById("pot-svg").setAttribute("fill", selectedColor);
                        svgDoc.find('path').attr('fill', '<?php echo $flower['colorPot']; ?>');
                    <?php endif; ?>
                });
            });
        </script>
    </body>
</html>


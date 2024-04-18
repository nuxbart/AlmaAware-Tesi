<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/greenhouse_style.css" >
        <link rel="stylesheet" href="../css/nav_div_style.css" >

        <title>AlmAware - GreenHouse</title>
        <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
    </head>
    <body>
        <main>
            <div class="greenhouse">
                <div class="shelf-container">
                    <div v-for="row in 3" class="shelf">
                        <Flower v-if="row == 1" v-for="element in listRow1"  ></Flower>
                        <Flower v-if="row == 2" v-for="element in listRow2"></Flower>
                        <Flower v-if="row == 3" v-for="element in listRow3"></Flower>
                    </div>
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
    </body>
</html>


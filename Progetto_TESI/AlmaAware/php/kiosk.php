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
    <link rel="stylesheet" href="../css/kiosk_style.css" >

    <title>AlmAware - Sdg <?php echo $_GET['idgoalsdg']; ?></title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
    <?php $currentSDG = $dbh->getSdg($_GET['idgoalsdg']);?>
    <main>
      <div class="test"></div>
      <div class="sdg-container">
        <div class="sdg-item" style="background-image: url(<?php echo $currentSDG[0]['img_background']; ?>);"></div>
        <h1><?php echo $currentSDG[0]['idgoalsdg']; ?> - <?php echo $currentSDG[0]['title']; ?></h1>
        <p class="kiosk-desc">
            <span style=" color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>"><?php echo $currentSDG[0]['subtitle']; ?></span>
            <?php echo $currentSDG[0]['description']; ?>
        </p>
        
        <div class="keyNumber_container">
            <?php for ($i = 1; $i <= 3; $i++):
                    $info = 'info'.$i; ?>
                <div class="sdgNumber" style="background-color:  <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>">
                    <p><?php echo $currentSDG[0][$info]?></p>
                </div>
            <?php endfor;?>
        </div>    
      </div>
      <div class="actions sdgLineVertical">
          <div>
            <h2>Cosa fa UNIBO?</h2>
            <p>
            Scopri cosa fa UNIBO dal 2016. Se vuoi vedere di più sul
            numero, tocca la carta.
            </p>
            <!-- MANCA SOLO QUESTO -->
            <div class="keyCard_container">
              <button class="info" id="show-modal" style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>">
                  <h2 class="numberCardCourse numberCard"><?php echo $currentSDG[0]['coursesUnibo']; ?></h2>
                  <p class="titleCard">corsi</p>
              </button>
              <button class="info" id="show-modal" style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>; margin-left: 10px;">
                  <h2 class="numberCardPubl numberCard"><?php echo $currentSDG[0]['publications']; ?></h2>
                  <p class="titleCard">pubblicazioni(Unibo)</p>
              </button>
              <button class="info" id="show-modal" style="background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>; margin-top: 5px;">
                  <h2 class="numberCardProj numberCard"><?php echo $currentSDG[0]['projects']; ?></h2>
                  <p class="titleCard">progetti</p>
              </button>
            </div>
          </div>
          <div>
            <h2>Cosa puoi fare tu?</h2>
            <?php $actions = $dbh->getActionsSdg($currentSDG[0]['idgoalsdg']);?>
            <?php foreach($actions as $action): ?>
                <ul>
                    <li style="border-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>">
                        <?php echo $action["description"]; ?>
                    </li>
                </ul>
            <?php endforeach; ?> 
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!--<script src="../js/?.js"></script> -->
</body>

<style lang="css">
.keyCard_container {
  display: flex;
  flex-wrap: wrap;
  width: 350px;
  justify-content: center;
  align-content: space-between;
  padding: 0;
}
.info::before {
  content: "";
  background-image: url(../images/medias/pictos/info.svg);
  background-repeat: no-repeat;
  background-size: contain;
  height: 20px;
  width: 20px;
  display: block;
  position: relative;
  top: 2%;
  right: 2%;
  box-sizing: border-box;
}

.numberCard {
  font-family: 'Viga', sans-serif;
  font-size: 20px;
  text-align: center;
  margin: 0;
  position: relative;
}
.numberCardProj::before{ 
  content: "";
  height: 5vh;
  width: 140px;
  display: block;
  box-sizing: border-box;
  margin-bottom: 1%;
  background-image: url(../images/medias/pictos/project.svg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;}

.numberCardPubl::before{
  content: "";
  height: 5vh;
  width: 140px;
  display: block;
  box-sizing: border-box;
  margin-bottom: 1%;
  background-image: url(../images/medias/pictos/publication.svg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}
.numberCardCourse::before {
  content: "";
  height: 5vh;
  width: 140px;
  display: block;
  box-sizing: border-box;
  margin-bottom: 1%;
  background-image: url(../images/medias/pictos/course.svg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}

.titleCard {
  font-size: 16px;
  text-align: center;
  padding: 0;
  margin: 0 0 10px 0;
}

    li {
    border-width: 0 0 1.5px 0;
    border-style: solid;
    padding-bottom: 2px;
    margin-bottom: 5%;
    width : 60vw;
  }
  
  ul {
    list-style: none;
    padding-left : 2%;
  }
  
li::before {
    content: "";
    background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
    display: inline-block;
    width: 1.5em;
    height : 1.2em;
    margin-left: -1.6em;
    margin-bottom : -0.2em;

        /*** COLOR BUBBLE *****/
    -webkit-mask-image: url(../images/medias/bubble/list_bubble.svg);
    mask-image: url(../images/medias/bubble/list_bubble.svg);
    -webkit-mask-size: 85%;
    mask-size: 85%;
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-position: center;
    mask-position: center;
}
    .keyNumber_container {
  display: flex;
  flex-wrap: no wrap;
  width: auto;
  justify-content: center;
  padding: 0;
}
    .sdgNumber {
  height : calc(90vw / 3);
  width : calc(90vw / 3);
  color: white;
  margin: 1%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  box-sizing: border-box;
}
.sdgNumber p{
    margin :0;
    font-family: 'Inter',sans-serif ;
}
    main::after {
    background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>;
    }
.test {
    width: 100vw;
    height: 35vh;
    display: block;
    position: absolute;
    box-sizing: border-box;
    top: 0;
    left: -30vw;
    z-index: -10000;
    /*** COLOR BUBBLE *****/
    background-color: <?php echo colorSdg($currentSDG[0]['idgoalsdg']); ?>; /* adapt with the sdg*/
  
    -webkit-mask-image: url(../images/medias/bubble/kiosk_bubble_top.svg);
    mask-image: url(../images/medias/bubble/kiosk_bubble_top.svg);
    -webkit-mask-size: contain;
    mask-size: contain;
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-position: center;
    mask-position: center;
    /*** LINE BUBBLE *****/
    background-image: url(../images/medias/bubble/kiosk_bubble_top_line.svg);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
  }

  .sdg-item::before {
    content: "";
    background-image: url(<?php echo $currentSDG[0]['img_sdgicons']; ?>);
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    display: block;
    width: 25vh;
    height: 100%;
    position: absolute;
    top: 0;
    left: 5%;
  }

  /* PER IL MENU' */
.icon{
  width :4vh;
  height : 4vh;
  fill : black;
  }
/* AGGIUNTA PER IL "nav" */
  nav{
  background-color: #F0EDE8;
  display:flex;
  justify-content: space-evenly;
  align-items: center;
  
  /* SDG_line implement in style.css*/
  border-top : 5px solid;
  border-image-source:url(../images/medias/SGD_line.svg);
  border-image-slice:5;
  border-image-repeat: stretch;
  /* box-shadow : X Y blur Spreat Color */
  box-shadow: 0px -4px 10px 0px rgba(0, 0, 0, 0.15);

  /*position : sticky;*/
  position : fixed;
  bottom : 0;
  left : 0;
  width:100%;
  height:8vh;
}
@media (min-width: 769px) {
.mobile-only {
    display: none;
}

}
@media (min-width: 1250px) {
    .keyNumber_container{
    width:75%;
    height : auto;
    margin : 0 auto 5% auto;
    justify-content: space-between;
    align-content: space-between;
    padding:0;
  }
    .sdgNumber{
    width: 25vh;
    height: 25vh;
    margin: 0;
    padding : 1%;
  }
  .sdgNumber p {
    font-size: 25px;
    margin-bottom: 5%;
  }
  /* AGGIUNTA PER IL "nav" */
  nav{
      flex-direction: column;
      justify-content: flex-start;
      align-items: middle;
      align-content: center;
      padding-top : 2%;
      box-sizing: border-box;
      height:100%;
      width:5vw;
      position : fixed;
      box-sizing: border-box;
      top:0;
      border-right : 15px solid;
      border-top:none;

      border-image-source:url(../images/medias/SGD_lineVertical.svg);
      border-image-slice:5;
      border-image-repeat: stretch;
  }

.icon{
  margin-bottom : 50%;
  height: 125%;
}

li {
      font-size: auto;
      text-align: left;
      box-sizing: border-box;
    }
ul {
    box-sizing: border-box;
    max-width: 80%;
    margin: 0 auto;
}

.keyCard_container{
    width:90%;
    height : 35vh;
    margin : 2% auto 10% auto;
    align-content: center;
  }
 
}

@media (max-width: 768px) {
.desktop-only {
    display: none;
}
main::after {display: none;}
}
/*FINE AGGIUNTA PER IL MENU'*/
</style>
</html>

<!DOCTYPE html>
<html lang="it">
<?php require "../db/bootstrap.php";?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/flower_style.css" >
    <link rel="stylesheet" href="../css/nav_div_style.css" >

    <title>AlmAware - My Flower</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
<main>
    <div class="mobile-only-div">
      <a href="../php/home.php"><img src="../images/medias/components/icons/arrow-back.svg" class="icon"/></a>
      <p>Hi <?php echo $_SESSION["name"];?> !</p>
    </div>
    <h1>My flower</h1>
    <FlowerItem></FlowerItem>
    <div class="form-flower sdgLine">
        <form>
          <div class="form-item">
            <label class="label" for="name"> Name </label>
            <input class="input" type="text" placeholder="flower name" id="name"/>
          </div>
          <div class=" form-item">
            <label>Flower pot color</label>
            <?php $sdg_array = $dbh->getAllSdg();?>
            <div class="color">
              <div class="radio">
              <?php foreach($sdg_array as $sdg): ?>
                <input class="colorItem" type="radio" name="color" value="<?php echo $sdg['idgoalsdg']; ?>" id="<?php echo $sdg['idgoalsdg']; ?>" @click="chekedColor(id)"/>
                <label> 
                  <span style="background-color:<?php echo colorSdg($sdg['idgoalsdg']); ?>" ></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class = "form-item">
            <label for="type ">Flower type</label>
            <div class="type">
              <div class="radio" v-for="plant in 5">
                <input  class="typeItem" type="radio" name="type" value="plant" id="plant+'plante'" @click="chekedPlant(plant)"/>
                <label for="plant+'plante'"><span style="background-color: #FFF" ></span></label>
              </div>
            </div>
          </div>

          <div class="btnContainer">
            <button name="validate" class="btn-outline" type="btn-outline" >Validate</button>
          </div>
        </form>
    </div>
    <script src="../js/flower.js"></script>
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
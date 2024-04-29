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
    <div class="flower">
      <img id="flower1" class="hidden" style="width: 40px; height: 40px; position: absolute; top: 0%; left: -8%;" src="../images/medias/flower1.png"/>
      <img id="flower2" class="hidden" style="width: 40px; height: 40px; position: absolute; top: 0; left: 50%;" src="../images/medias/flower2.png"/>
      <img id="flower3" class="hidden" style="width: 40px; height: 40px; position: absolute; top: -32%; left: 28%;" src="../images/medias/flower3.png"/>
      <img src="../images/medias/plante.svg" />
      <object class="svgClass" type="image/svg+xml" data="../images/medias/pot.svg"></object>
    </div>
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
                <label class="labelColor"> 
                  <span style="background-color:<?php echo colorSdg($sdg['idgoalsdg']); ?>" ></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class = "form-item">
            <label for="type ">Flower type</label>
            <div class="type">
              <div class="radio">
                <input  class="typeItem" type="radio" name="type" value="plant" id="plant'" @click="chekedPlant(plant)"/>
                <label class="labelFlower1"><span><img style="width: 50px; height: 50px;" src="../images/medias/flower1.png"/></span></label>
                <label class="labelFlower2"><span><img style="width: 50px; height: 50px;" src="../images/medias/flower2.png"/></span></label>
                <label class="labelFlower3"><span><img style="width: 50px; height: 50px;" src="../images/medias/flower3.png"/></span></label>
              </div>
            </div>
          </div>

          <div class="btnContainer">
            <button name="validate" class="btn-outline" type="btn-outline" >Validate</button>
          </div>
        </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/flower.js"></script>
</body>
</html>
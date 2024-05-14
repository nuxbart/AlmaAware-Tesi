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
    <?php $idMyFlower=$dbh->getIDFlower($_SESSION["email"]); //var_dump($idMyFlower[0]["idMyFlower"]);
          $myFlower=$dbh->getUserFlower($idMyFlower[0]["idMyFlower"]);?>
    <div class="flower">
      <?php if(!$myFlower[0]['typeFlower1']):?>
        <img id="flower1" class="hidden" style="width: 40px; height: 40px; position: absolute; top: 0%; left: -8%;" src="../images/medias/flower1.png"/>
      <?php else:?>
        <img id="flower1" class="visible" style="width: 40px; height: 40px; position: absolute; top: 0%; left: -8%;" src="../images/medias/flower1.png"/>
      <?php endif;?>

      <?php if(!$myFlower[0]['typeFlower2']):?>
        <img id="flower2" class="hidden" style="width: 40px; height: 40px; position: absolute; top: 0; left: 50%;" src="../images/medias/flower2.png"/>
      <?php else:?>
        <img id="flower2" class="visible" style="width: 40px; height: 40px; position: absolute; top: 0; left: 50%;" src="../images/medias/flower2.png"/>
      <?php endif;?>

      <?php if(!$myFlower[0]['typeFlower3']):?>
        <img id="flower3" class="hidden" style="width: 40px; height: 40px; position: absolute; top: -32%; left: 28%;" src="../images/medias/flower3.png"/>
      <?php else:?>
        <img id="flower3" class="visible" style="width: 40px; height: 40px; position: absolute; top: -32%; left: 28%;" src="../images/medias/flower3.png"/>
      <?php endif;?>

      <img src="../images/medias/plante.svg" />
      <object class="svgClass" type="image/svg+xml" data="../images/medias/pot.svg"></object>
    </div>
    <div class="form-flower sdgLine">
        <form method="POST">
          <div class="form-item">
            <label class="label" for="name"> Name </label>
            <input class="input" type="text" placeholder=<?php if($myFlower[0]['nameFlower']!=null){ echo $myFlower[0]['nameFlower'];}else{echo "flower name";}?>
             id="name" name="name"/>
          </div>
          <div class=" form-item">
            <label>Flower pot color</label>
            <?php $sdg_array = $dbh->getAllSdg(); 
                  $userSessionID=$dbh->getIdUser($_SESSION["email"]);
                  $badgesValidated = $dbh->getAllBadgeValidNot(1, $userSessionID[0]['idUser']);
                  $num = count(array_column($badgesValidated, 'idSdg'));
                  ?>
            <div class="color">
              <div class="radio">
              <?php foreach($sdg_array as $sdg): ?>
                <?php $clic = in_array($sdg['idgoalsdg'], array_column($badgesValidated, 'idSdg')); ?>
                <input class="colorItem" type="radio" name="color" 
                      value="<?php echo colorSdg($sdg['idgoalsdg']); ?>" id="<?php echo $sdg['idgoalsdg']; ?>" 
                      <?php echo $clic ? '' : 'disabled'; ?>/>
                <label class="labelColor"> 
                  <span style="background-color:<?php echo colorSdg($sdg['idgoalsdg']); ?>"></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class = "form-item">
            <label for="type ">Flower type</label>
            <div class="type">
              <div class="radio">
                <input  class="typeItem" type="radio" name="type" value="flower1" id="plant'" <?php echo $num>=3 ? '' : 'disabled'; ?>/>
                <label class="labelFlower1"><span><img style="width: 50px; height: 50px;" src="../images/medias/flower1.png"/></span></label>
                <input  class="typeItem" type="radio" name="type" value="flower2" id="plant'" <?php echo $num>=7 ? '' : 'disabled'; ?>/>
                <label class="labelFlower2"><span><img style="width: 50px; height: 50px;" src="../images/medias/flower2.png"/></span></label>
                <input  class="typeItem" type="radio" name="type" value="flower3" id="plant'" <?php echo $num>=16 ? '' : 'disabled'; ?> />
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
<script>
  window.onload =  function() {
    <?php if ($myFlower[0]['colorPot'] != null): ?>
      document.querySelector(".svgClass").getSVGDocument().getElementById("pot-svg").setAttribute("fill", "<?php echo $myFlower[0]['colorPot']; ?>");
    <?php endif; ?>
  }
</script>
</body>
</html>
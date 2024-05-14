<!DOCTYPE html>
<html lang="it">
<?php 
        require "../db/bootstrap.php";
    ?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- BADGES VALIDI: 1
         BADGES NON VALIDI: 0 -->

    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bedges_style.css" >
    <link rel="stylesheet" href="../css/nav_div_style.css" >

    <title>AlmAware - Badges</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
  <main>
    <div class="mobile-only-div">
      <a href="../php/profile.php"><img src="../images/medias/components/icons/arrow-back.svg" class="icon"/></a>
      <p>Hi <?php echo $_SESSION["name"];?> !</p>
    </div>
    <h1>Badges</h1>
    <?php $userSessionID=$dbh->getIdUser($_SESSION["email"]); ?>
    <div class="filter">
      <button class="filter-item" onclick="getValidated(<?php echo $userSessionID[0]['idUser']; ?>)" id="validated"> Validated</button>
      <button class="filter-item" onclick="getUnvalidated(<?php echo $userSessionID[0]['idUser']; ?>)" id="unvalidated"> Unvalidated</button>
      <select class="filter-item" onchange="changeSdg(this.value, <?php echo $userSessionID[0]['idUser']; ?>)">
        <?php for ($i = 0; $i <= 17; $i++): ?>
          <?php if($i==0): ?>
            <option value="<?php echo $i; ?>">all sdg</option>
          <?php else: ?>
            <option value="<?php echo $i; ?>">sdg <?php echo $i; ?></option>
          <?php endif; ?>
        <?php endfor; ?>
      </select>
    </div>
    <div id="badges-container" class="badges-container">
      <!-- Badges & POP-UP -->
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
  
  <script>
    window.onload = function() {
      changeSdg(0,<?php echo $userSessionID[0]['idUser']; ?>);
    }
  </script>
  <script src="../js/badges.js"></script>
</body>

<style lang="css" scoped>
  .badge {
    width: calc(95vw / 4);
    text-align: center;
    box-sizing: border-box;
    margin-bottom: 3%;
  }

  img{
    width : 95%;
    height : 95%;
  }
 
  .badge h2 {
    font-size: 'Inter',sans-serif ;
    margin: 0;
    font-weight: 100;
    width: 90%;
  }

  .btn-background {
    color : white;
    border: none;
  }
</style>
</html>
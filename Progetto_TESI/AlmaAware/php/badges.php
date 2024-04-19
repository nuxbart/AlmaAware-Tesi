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
    <link rel="stylesheet" href="../css/bedges_style.css" >
    <link rel="stylesheet" href="../css/nav_div_style.css" >

    <title>AlmAware - Badges</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
  <main>
    <div class="mobile-only-div">
      <a href="../php/home.php"><img src="../images/medias/components/icons/arrow-back.svg" class="icon"/></a>
      <p>Hi <?php echo $_SESSION["name"];?> !</p>
    </div>
    <h1>Badges</h1>
    <?php $userSessionID=$dbh->getIdUser($_SESSION["email"]);
          $badges=$dbh->getAllBadgeSdgOfUser($userSessionID); 
          $badgesChosen=$badges;
          $valid=1; $unvalid=0; ?>
    <div class="filter">
      <button class="filter-item" onclick=<?php $badgesChosen=$dbh->getAllBadgeValidNot($valid, $userSessionID); ?> id="validated"> Validated</button>
      <button class="filter-item" onclick=<?php $badgesChosen=$dbh->getAllBadgeValidNot($unvalid, $userSessionID); ?> id="unvalidated"> Unvalidated</button>
      <select class="filter-item" onchange=<?php $badgesChosen=$dbh->getAllBadgeOneSdg($i, $userSessionID); ?>>
        <option value="all">all sdg</option>
        <?php for ($i = 1; $i <= 17; $i++): ?>
          <option value="sdg">sdg <?php echo $i; ?></option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="badges-container">
      <?php foreach ($badgesChosen as $badge): ?>
      <div id="show-modal" class="badge">
        <?php $curr=$dbh->getBadgeSdg($badge['nameBadge']); ?>
        <img src="<?php echo $curr['img_valid']; ?>" alt="name" />
      </div>
      <Badge v-for="badge in listBadges" :name="badge.Badge" :sdg="badge.SDG" :subtitle="badge.Subtitle" :description="badge.Description" :state="badge.State"  :image="badge.Image" >
      </Badge>
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
</style>
</html>
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
    <div class="filter">
      <button class="filter-item" @click="filterByState(validated)" id="validated"> Validated</button>
      <button class="filter-item" @click="filterByState(unvalidated)" id="unvalidated"> Unvalidated</button>
      <select class="filter-item" @change="filterBySdg($event)">
        <option value="all">all sdg</option>
        <option v-for="sdg in 17" :value="sdg">sdg {{ sdg }}</option>
      </select>
    </div>
    <BadgesList :listBadges="list"></BadgesList>
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
</html>
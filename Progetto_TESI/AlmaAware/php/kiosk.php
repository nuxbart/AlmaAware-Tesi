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
            <Menu></Menu>
            <div class="sdg-container">
                <div class="sdg-item" style="background-image: background_url">
                </div>
                <h1><?php echo $currentSDG[0]['idgoalsdg']; ?> - <?php echo $currentSDG[0]['title']; ?></h1>
                <p class="kiosk-desc">
                    <span :style="{ color: color }"><?php echo $currentSDG[0]['subtitle']; ?></span>
                    <?php echo $currentSDG[0]['description']; ?>
                </p>
                <SdgKeyNumberGroup :id="id.toString()"></SdgKeyNumberGroup>
                </div>
                <div class="actions sdgLineVertical">
                <div>
                    <h2>Cosa fa UNIBO?</h2>
                    <p>
                    Scopri cosa fa UNIBO dal 2016. Se vuoi vedere di più sul
                    numero, tocca la carta.
                    </p>
                    <KeyCardsGroup :id="id.toString()"></KeyCardsGroup>
                </div>
                <div>
                    <h2>Cosa puoi fare tu?</h2>
                    <ActionList :id="id.toString()"></ActionList>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!--<script src="../js/?.js"></script> -->
</body>
</html>

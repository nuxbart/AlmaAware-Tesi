<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/flower_style.css" >
    

    <title>AlmAware - My Flower</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
<main>
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
            <div class="color">
              <div class="radio" v-for="id in 17">
              <input class="colorItem" type="radio" name="color" :value="id" :id="id" @click="chekedColor(id)"/>
              <label :for=id> 
                <span :style="{'background-color':'var(--sdg'+id+')'}" ></span>
                {{ getColorName(id) }}
              </label>
            </div>
            </div>
            </div>
          <div class = "form-item">
            <label for="type ">Flower type</label>
            <div class="type">
              <div class="radio" v-for="plant in 5">
                <input  class="typeItem" type="radio" name="type" :value="plant" :id="plant+'plante'" @click="chekedPlant(plant)"/>
                <label :for="plant+'plante'"><span :style="{'background-color':'#FFF'}" ></span></label>
              </div>
            </div>
          </div>

          <button name="validate" class="btn-outline" type="btn-outline" >Validate</button>
        </form>
    </div>
    <script src="../js/flower.js"></script>
</body>
</html>
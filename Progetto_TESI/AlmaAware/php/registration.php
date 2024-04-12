<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/registration_style.css" >
    

    <title>AlmAware - Sign up</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../js/registration.js"></script>
</head>
<body>
<main>
    <div class="container">
      <h1>Create account</h1>
        <form action="#" method="form" name="Registrati">
            <input class="input" id="name" placeholder="Name" type="text"/>
            <input class="input" id="email" placeholder="Email" type="mail"/>
            <select class="input" id="campus" :options ="options" placeholder="Select your campus" required>
            <option value="" disabled selected hidden>Select your campus</option>
                <option value="Bologna">Bologna</option>
                <option value="Cesena">Cesena</option>
                <option value="Forlì">Forlì</option>
                <option value="Ravenna">Ravenna</option>
                <option value="Rimini">Rimini</option>
            </select>
            <input class="input" id="password" placeholder="Password" type="password"/>
            <input class="input" id="confirmpswd" placeholder="Confirm password" type="password"/>
            <div id="msgPassword"></div>
            <div class="checkbox-container">
                <input type="checkbox" id="policies" value="policies" required />
                <label for="policies"> <a href="#" class="link">I accept all the policies and therms</a></label>
            </div>
        </form>
        
                        
        <button onclick="checkPassword()" name="btnRegistrati" class="btn-unibo" type="btn-unibo" value="Register"> Registrati</button>
        <div class="link-container">
            <p class="link">Always an account?</p> <p class="sign-link"><a class="sign-link" href="login.php"> Sign in</a></p>
        </div>
    </div>
  </main>
</body>
</html>
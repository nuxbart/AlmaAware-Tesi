<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login_style.css" >
    

    <title>AlmAware - Login</title>
    <link rel="shortcut icon" href="../images/medias/Mascotte.svg">
</head>
<body>
    <main>
       
        <h1 class="font-monospace fw-bold text-center">Welcome Back</h1>
        
            <form method="POST" action="#" class="center" >
                <!-- Email input -->
                <label class="label" for="email"></label>
                <input type="mail" id="email" name="email" 
                    value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" 
                    class="col form-control input" placeholder="Email"/>
                
                            

                <!-- Password input -->
                <label class="label" for="password"></label>
                <input type="password" id="password" name="password"
                value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"
                class="col form-control input" placeholder="Password"/>
                

                <!-- Checkbox -->
                <div>
                <input class="form-check-input" type="checkbox" value="" id="showPass" placeholder="Show Pass" />
                <label class="sign-link" for="showPass"> Show Password </label>
                </div>        
            </form>

            <!-- Submit button -->
            <div class=" text-center row">
                <button id="btn_submit" class="btn-unibo">Login</button>
            </div>
                            

            <!-- Register link -->
            <div class="link-container">
                <p class="link">Don't have an account?</p><p class="sign-link"><a class="sign-link" href="registration.php">Sign up</a></p>
            </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>


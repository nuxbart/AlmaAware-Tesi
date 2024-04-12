function checkPassword() {
    let pass = document.getElementById("password").value;
    let confirmPass = document.getElementById("confirmpswd").value;
    let msg = document.getElementById("msgPassword");

    if (pass.length > 6) {
        if (pass == confirmPass) {
            msg.textContent = "Password Matched";
            msg.style.backgroundColor = "#1dcd59";

            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let campus = document.getElementById("campus").value;
            let password = document.getElementById("password").value;
            let confirmpswd= document.getElementById("confirmpswd").value;

            //funzione che controlla che ogni elemento inserito nella pagina non sia vuoto
            checkInput(name, email, campus, password, confirmpswd);
        }
        else {
            msg.textContent = "Passwords doesn't match";
            msg.style.backgroundColor = "#ff4d4d";
        }
    }
    else {
        alert("The password must be at least long 7 characters");
        msg.textContent = "";
        msg.style.backgroundColor = "white";
    }
}

function checkInput(name, email, campus, password, confirmpswd) {

    if ((name != 0) && (email != 0) && (campus != 0) && (password != 0) && (confirmpswd != 0)) {
        
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('campus', campus);
        formData.append('password', password);
        formData.append('confirmpswd', confirmpswd);
        axios.post('../php/api-pages/api-registration.php', formData)
        .then(response => {
            console.log(response.data);
            console.log(response.data.success);
            if(response.data && response.data.success) {
                alert("Registration successful!");
                window.location.pathname = './almaAware/Progetto_TESI/AlmaAware/php/login.php';
            }else{
                alert("Registration failed! " + response.data.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);
            alert("Si è verificato un errore durante la registrazione.");
        });
    }
    else {
        alert("Failed! You didn't write all the fields");
    }
}
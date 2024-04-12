
const btn_check = document.getElementById('showPass').onclick = function() {
    if ( !this.checked ) {
        document.getElementById('password').type = "password";
    } else {
        document.getElementById('password').type = "text";
    }
};

const btn_submit = document.getElementById("btn_submit");
   btn_submit.addEventListener("click", function (event) {
	event.preventDefault();
	const email = document.querySelector("#email").value;
	const password = document.querySelector("#password").value;
	login(email, password);
});

function login(email, password) {
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
    axios.post('../php/api-pages/api-login.php', formData).then(response => {
        console.log(response.data);
		if(response.data) {
			window.location.pathname = './almaAware/Progetto_TESI/AlmaAware/php/profile.php';
		}else{
            alert("Password e/o Username sbagliati!");
            window.location.reload();
             
        }
    });
}
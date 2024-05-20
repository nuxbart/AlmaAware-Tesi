// Funzione per aprire la finestra modale
document.getElementById('show-modal').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'flex';
});

// Funzione per chiudere la finestra modale
document.getElementById('btn-unibo-outline').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});

// Funzione join alla serra UniBo
document.getElementById('btn-unibo').addEventListener('click', function() {
    const email = document.getElementById("email").value;
    const formData = new FormData();
    formData.append('email', email);

    axios.post('../php/api-pages/api-greenhouse.php', formData)
        .then(response => {
            console.log(response.data);
            if(response.data) {
                alert("Joined successfully!");
                window.location.reload();
            }else{
                alert("Joined failed! " + response.data.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);
            alert("Si è verificato un errore!");
        });
});
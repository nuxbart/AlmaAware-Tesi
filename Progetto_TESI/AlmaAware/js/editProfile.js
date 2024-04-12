// Funzione per salvare le modifiche
function saveChanges() {
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const campus = document.getElementById('campus').value;
    const password = document.getElementById('password').value;
    const img_profile = document.getElementById('img_profile').files[0]; // Recupera il file immagine

    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('campus', campus);
    formData.append('password', password);
    formData.append('img_profile', img_profile);
    
    console.log(img_profile);
    axios.post('../php/api-pages/api-editProfile.php', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function (response) {
        
        console.log(response.data);
        if (response.data.name || response.data.email || response.data.campus || response.data.password || response.data.img_profile) {
            alert('Changes saved successfully!');
            window.location.pathname = './almaAware/Progetto_TESI/AlmaAware/php/profile.php';
        } else {
            alert('No changes made.');
            
        }
    })
    .catch(function (error) {
        
        console.error(error);
        alert('An error occurred while saving changes.');
    });
}
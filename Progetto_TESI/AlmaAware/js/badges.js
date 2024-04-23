
function changeSdg(i, userSessionID) {
    fetch('../php/api-pages/api_change_sdg.php?i=' + i + '&userSessionID=' + userSessionID)
    .then(response => response.json())
    .then(data => {
        
        console.log(data); 
        displayBadges(data);
    })
    .catch(error => console.error('Errore:', error));
  }

  function getValidated(userSessionID) {
    fetch('../php/api-pages/api_get_validated.php?userSessionID=' + userSessionID)
      .then(response => response.json())
      .then(data => {
        
        console.log(data); 
        displayBadges(data);
      })
      .catch(error => console.error('Errore:', error));
  }

  function getUnvalidated(userSessionID) {
    fetch('../php/api-pages/api_get_unvalidated.php?userSessionID=' + userSessionID )
      .then(response => response.json())
      .then(data => {
        console.log(data);
        displayBadges(data);
      })
      .catch(error => console.error('Errore:', error));
  }

  function displayBadges(data) {
    // Seleziona l'elemento HTML in cui visualizzare i badge
    const badgesContainer = document.getElementById('badges-container');
    
    // Cancella il contenuto dell'elemento per evitare sovrapposizioni
    badgesContainer.innerHTML = '';
  
    // Itera sui dati dei badge e crea gli elementi HTML corrispondenti
    data.forEach(badge => {
      const badgeElement = document.createElement('div');
      badgeElement.classList.add('badge');
      badgeElement.id='show-modal';
      console.log(badge);
      badgeElement.innerHTML = `<img src="${badge.image}" alt="${badge.nameBadge}" />`;
  
      // Aggiungi il badge all'elemento del contenitore
      badgesContainer.appendChild(badgeElement);
    });
  }
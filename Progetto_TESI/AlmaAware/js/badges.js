
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
      badgeElement.innerHTML = `<img src="${badge.image}" alt="${badge.nameBadge}" onclick="getPopUP(${badge.idSdg}, '${badge.nameBadge}' )"/>`;
  
     // Aggiungi il badge all'elemento del contenitore
     badgesContainer.appendChild(badgeElement);
      
    });
  }

   // Funzione per aprire la finestra modale
   function getPopUP(idSdg, nameBadge) {
    fetch('../php/api-pages/api-getBadgeColor.php?idSdg=' + idSdg + '&nameBadge=' + nameBadge)
        .then(response => response.json())
        .then(data => {
            const badgesContainer = document.getElementById('badges-container');
            const badgeColor = data.color;
            
            const badgePopUp = document.createElement('div');
            badgePopUp.classList.add('popup');
            badgePopUp.id = 'popup';
            const badge = data.badgeSdg;
            badgePopUp.innerHTML = `<img src="../images/medias/components/icons/cross.svg" class="modal-default-button" onclick="closeAll()" style="height:2.5vh; z-index:100,"/>
                                  <div class="modal-header"">
                                        <h2>${nameBadge}</h2>
                                        <h3>${badge[0]["subtitle"]}</h3>
                                        <a href="sdg.php?idSdg=${idSdg}"><button id="btn-background" class="btn-background" style="background-color: ${badgeColor};" >Complete</button></a>
                                        <style>
                                          .modal-header::before {
                                            background-color: ${badgeColor};
                                            background-image: url(../images/medias/bubble/popUp_bubble_line.svg),
                                            url("${badge[0]["badge_icon"]}");
                                          }
                                          .modal-default-button {
                                            float: right;
                                          }                                          
                                          </style>
                                      </div>
                                </div>`;

            // Aggiungi il badge all'elemento del contenitore
            badgesContainer.appendChild(badgePopUp);

            document.getElementById('popup').style.display = 'flex';
        })
        .catch(error => console.error('Error:', error));
    
  };

// Funzione per chiudere la finestra modale
  function closeAll() {
      document.getElementById('popup').style.display = 'none';
      window.location.reload();
  };
  
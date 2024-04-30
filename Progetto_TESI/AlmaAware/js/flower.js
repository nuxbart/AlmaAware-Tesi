$('.labelColor').on('click', function() {
  if ($(this).prev('input[name="color"]').is(':disabled')) {
    alert('Corrispondente SDG non è stato completato!');
    return;
  }
  // Rimuoviamo checked degli altri
  $('input[name="color"]').prop('checked', false);
  
  // Seleziona l'opzione corrente
  $(this).prev('input[name="color"]').prop('checked', true);

  var selectedColor = $(this).find('span').css('background-color');

  document.querySelector(".svgClass").getSVGDocument().getElementById("pot-svg").setAttribute("fill", selectedColor);
});

$('.labelFlower1').on('click', function() {
  if ($(this).prev('input[name="type"]').is(':disabled')) {
    alert('Completare almeno 3 SDG!');
    return;
  }
  // Rimuoviamo checked degli altri
 $('input[name="type"]').prop('checked', false);
  
  // Seleziona l'opzione corrente
  $(this).prev('input[name="type"]').prop('checked', true);

  $('#flower1').removeClass('hidden').addClass('visible');
});

$('.labelFlower2').on('click', function() {
  if ($(this).prev('input[name="type"]').is(':disabled')) {
    alert('Completare almeno 7 SDG!');
    return;
  }
  // Rimuoviamo checked degli altri
  $('input[name="type"]').prop('checked', false);
  
  // Seleziona l'opzione corrente
  $(this).prev('input[name="type"]').prop('checked', true);

  $('#flower2').removeClass('hidden').addClass('visible');
});

$('.labelFlower3').on('click', function() {
  if ($(this).prev('input[name="type"]').is(':disabled')) {
    alert('Completare almeno 16 SDG!');
    return;
  }
  // Rimuoviamo checked degli altri
  $('input[name="type"]').prop('checked', false);
  
  // Seleziona l'opzione corrente
  $(this).prev('input[name="type"]').prop('checked', true);

  $('#flower3').removeClass('hidden').addClass('visible');
});


$('.btn-outline').on('click', function(e) {
  e.preventDefault();

  var name = $('#name').val();
  console.log(name);
  var color = $('input[name="color"]:checked').val();
  console.log(color);
  var type = $('input[name="type"]:checked').val();
  console.log(type);

  const formData = new FormData();
  formData.append('name', name);
  formData.append('color', color);
  formData.append('type', type);
  
  axios.post('../php/api-pages/api_update_flower.php', formData)
  .then(function (response) {
      console.log(response.data);
      if(response.data.status == 'success') {
          alert('Dati aggiornati correttamente!');
          window.location.reload();
      } else {
          alert('Errore nell\'aggiornamento dei dati: ' + response.data.message);
          window.location.reload();
      }
  })
  .catch(function (error) {
      console.log(error);
      alert('Si è verificato un errore nella richiesta.');
      window.location.reload();
  });
});

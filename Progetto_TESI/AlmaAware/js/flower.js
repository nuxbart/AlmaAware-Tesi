$('.labelColor').on('click', function() {
  var selectedColor = $(this).find('span').css('background-color');

  document.querySelector(".svgClass").getSVGDocument().getElementById("pot-svg").setAttribute("fill", selectedColor)
});

$('.labelFlower1').on('click', function() {
  $('#flower1').removeClass('hidden').addClass('visible');
});

$('.labelFlower2').on('click', function() {
  $('#flower2').removeClass('hidden').addClass('visible');
});

$('.labelFlower3').on('click', function() {
  $('#flower3').removeClass('hidden').addClass('visible');
});


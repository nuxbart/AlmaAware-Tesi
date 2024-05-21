function increase(badgeId, currentCount, element) {
    const newCount = currentCount + 1;
    $(element).find('.counter-txt').html(newCount);
    $(element).attr('onclick', `increase(${badgeId}, ${newCount}, this)`);
    $.ajax({
        url: '../php/api-pages/api_increase_counter_sdg.php',
        type: 'GET',
        data: {
            badgeId: badgeId,
            currentCount: newCount
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.newCounter) {
                console.log(data);

                $(element).find('.counter-txt').html(data.newCounter);
                $(element).attr('onclick', `increase(${badgeId}, ${data.newCounter}, this)`);
                
            }
        },
        error: function() {
            alert('Errore durante l\'aggiornamento del conteggio');
        }
    });
}
$(document).ready(function(){
    
    $('.show-modal').click(function(){
        var actionId = $(this).data('action-id');
        console.log("Action ID cliccato: " + actionId);
        var actionDetails = $('#action-details-' + actionId).html();
        
        $('#popup-content').html(actionDetails);
        $('#popup').show();
    });

    $('#close-popup').click(function(){
        $('#popup').hide();
        window.location.reload();
    });

    $(window).click(function(event) {
        if ($(event.target).is('#popup')) {
            $('#popup').hide();
            window.location.reload();
        }
    });
});
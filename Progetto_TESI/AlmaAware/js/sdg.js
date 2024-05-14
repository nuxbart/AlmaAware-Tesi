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
    });

    $(window).click(function(event) {
        if ($(event.target).is('#popup')) {
            $('#popup').hide();
        }
    });
});
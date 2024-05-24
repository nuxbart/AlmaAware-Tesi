function submitQuiz(badgeId, type, badgeName) {
    var selectedOption;
    var correctAnswer;
    console.log(type);
    if (type === "Quiz1") {
        selectedOption = $('input[name="quiz-1-' + badgeId + '"]:checked').val();
        console.log(selectedOption);
        correctAnswer = "30";
    } else if (type === "Quiz2") {
        selectedOption = $('input[name="quiz-2-' + badgeId + '"]:checked').val();
        correctAnswer = "Luce solare";
    }

    if (!selectedOption) {
        alert('Per favore, seleziona una risposta.');
        return;
    }

    if (selectedOption === correctAnswer) {
        alert('Risposta corretta!');
        validate(badgeId, 1, badgeName); // Pass 1 as typeCurr to indicate the quiz was passed
    } else {
        alert('Risposta sbagliata. Riprova!');
    }
}

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
function startTimer(badgeId, currentCount) {
    var timerElement = $('#timer-' + badgeId);
    console.log(timerElement);
    var time = 600; // 10 minuti in secondi
    var interval = setInterval(function() {
        var minutes = Math.floor(time / 60);
        var seconds = time % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        timerElement.text(minutes + ":" + seconds);
        time--;

        if (time < 0) {
            clearInterval(interval);
            // Incrementa il contatore quando il timer scade
            increaseCounter(badgeId, currentCount);
        }
    }, 1000);
}

function increaseCounter(badgeId, currentCount) {
    const newCount = currentCount + 1;
    $('.timer-'+ badgeId).html('1:00');
    $('.timer-counter').html(newCount);
    $('.timer-btn').attr('onclick', `startTimer(${badgeId}, ${newCount})`);
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
                if (data.newCounter > 10) {
                    alert('Già fatte 10 docce! Valida il badge!');
                } else {
                    // Ricomincia il timer se non ha raggiunto il conteggio necessario
                    $('.timer-'+ badgeId).html('10:00');
                    $('.timer-counter').html(newCount);
                    $('.timer-btn').attr('onclick', `startTimer(${badgeId}, ${newCount})`);
                }
            }
        },
        error: function() {
            alert('Errore durante l\'aggiornamento del conteggio');
        }
    });
}

function validate(idbadgecurr, typeCurr, badgeName){
    
    var inputValue= $('#inputSDG-' + idbadgecurr).val();
    var checkboxChecked= $('#checkbox-' + idbadgecurr).is(':checked');
    console.log($('#checkbox-' + idbadgecurr));
    console.log(checkboxChecked);
    console.log($(idbadgecurr));

    let data = {
        idbadgecurr: idbadgecurr,
        typeCurr: typeCurr,
        badgeName: badgeName,
        inputValue: inputValue,
        checkboxChecked: checkboxChecked
    };
    
    // QR-Code ??????????????
    $.ajax({
        url: '../php/api-pages/api_validate_badge_sdg.php',
        type: 'GET',
        data: data,
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                console.log(data);
                alert('Badge SDG validato correttamente!');
                window.location.reload();
            }
        },
        error: function() {
            alert('Errore durante la validazione del Badge SDG');
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

        $('#popup-content .inputSDG').each(function() {
            $(this).attr('id', 'inputSDG-' + actionId);
            //console.log($(this).attr('id', 'inputSDG-' + actionId));
        });

        $('#popup-content .checkbox').each(function() {
            $(this).attr('id', 'checkbox-' + actionId);
            console.log($(this).attr('id', 'checkbox-' + actionId));
        });

        $('#popup-content .timer').each(function() {
            $(this).attr('id', 'timer-' + actionId);
            console.log($(this).attr('id', 'timer-' + actionId));
        });
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
document.addEventListener('DOMContentLoaded', function () {

    const choiceButtons = document.querySelectorAll('.choice-btn');
    const nextRoundBtn = document.getElementById('next-round-btn');
    const nextRoundContainer = document.getElementById('next-round-container');
    const resultMessage = document.getElementById('result-message');
    const currentRoundSpan = document.getElementById('current-round');
    const currentScoreSpan = document.getElementById('current-score');
    const gameForm = document.getElementById('game-form');

    let userChoice = null; //per memorizzare la scelta dell'utente

    choiceButtons.forEach(button => {
        button.addEventListener('click', handleUserChoice);
    });

    nextRoundBtn.addEventListener('click', handleNextRound);

    function handleUserChoice(event) {
        userChoice = event.target.dataset.choice;
        const textShown = document.getElementById('text-shown').value;

        choiceButtons.forEach(btn => btn.disabled = true);

        const isCorrect = (userChoice === textShown);
        showResult(isCorrect, textShown);

        nextRoundContainer.style.display = 'block';
    }

    function handleNextRound() {
        resultMessage.style.display = 'none';
        nextRoundContainer.style.display = 'none';

        const datas = new FormData(gameForm);
        datas.append('user_choice', userChoice);

        //chiamata api per salvare la risposta in db e andare al prox round
        fetch('../api/process_round.php', {
            method: 'POST',
            body: datas
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error(data.error);
                    return;
                }

                currentScoreSpan.textContent = data.score;

                if (data.gameFinished) {
                    showFinalResults(data.score);
                } else {
                    updateUIForNextRound(data);
                }
            })
            .catch(error => console.error('Errore:', error));
    }

    function updateUIForNextRound(data) {
        document.getElementById('infographic-image').src = '../' + data.nextInfographic.ImagePath;
        document.getElementById('infographic-text').textContent = data.nextTextToShow;
        document.getElementById('infographic-id').value = data.nextInfographic.InfographicID;
        document.getElementById('text-shown').value = data.nextTextTypeShown;

        document.getElementById('explanation').value = '';
        document.getElementById('consigli').value = '';
        currentRoundSpan.textContent = data.currentRound;

        choiceButtons.forEach(btn => btn.disabled = false);
    }

    function showResult(isCorrect, correctAnswer) {
        resultMessage.style.display = 'block';

        if (isCorrect) {
            resultMessage.className = 'alert alert-success';
            resultMessage.innerHTML = `
                <b>Corretto!</b>
                <br><small>+1 punto</small>
            `;
        } else {
            resultMessage.className = 'alert alert-danger';
            resultMessage.innerHTML = `
                <b>Sbagliato!</b> Riprova al prossimo round!
            `;
        }
    }

    function showFinalResults(data) {
        const finalScore = data.score;
        const totalRounds = 10;

        let message = '';
        let alertClass = '';

        if (finalScore >= 8) {
            message = 'Eccellente! Hai ottenuto un punteggio ottimale.';
            alertClass = 'alert-success';
        } else if (finalScore >= 6) {
            message = 'Complimenti! Hai fatto un buon lavoro.';
            alertClass = 'alert-info';
        } else if (finalScore >= 4) {
            message = 'Non male! Si può ancora migliorare.';
            alertClass = 'alert-warning';
        } else {
            message = 'Peccato! Andrà meglio la prossima volta.';
            alertClass = 'alert-secondary';
        }


        document.querySelector('.card-body').innerHTML = `
            <div class="text-center">
                <h2>Partita Terminata!</h2>
                <div class="my-4">
                    <h1 class="display-1 text-primary">${finalScore}/${totalRounds}</h1>
                    <p class="lead">Hai ottenuto ${finalScore} punt${finalScore !== 1 ? 'i' : 'o'} su ${totalRounds}!</p>
                </div>
                <div class="alert ${alertClass} my-4">
                    ${message}
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="index.php" class="btn btn-primary btn-lg">Torna alla Home</a>
                    <a href="classifica.php" class="btn btn-success btn-lg">Classifica</a>
                    <button onclick="location.reload()" class="btn btn-secondary btn-lg">Gioca Ancora</button>
                </div>
            </div>
        `;
    }
});
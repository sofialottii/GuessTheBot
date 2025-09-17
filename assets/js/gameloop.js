/**
 * gameloop.js
 * Gestisco la logica del gioco
 */
document.addEventListener('DOMContentLoaded', function () {

    const choiceButtons = document.querySelectorAll('.choice-btn');
    const gameForm = document.getElementById('game-form');
    const resultMessage = document.getElementById('result-message');
    const loading = document.getElementById('loading');
    const currentRoundSpan = document.getElementById('current-round');
    const currentScoreSpan = document.getElementById('current-score');

    choiceButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userChoice = this.getAttribute('data-choice');
            
            
            
            handleAnswer(userChoice);
        });
    });

    /**
     * Gestisce l'invio della risposta dell'utente al server
     * @param {string} userChoice - La scelta dell'utente ("human" o "llm")
     *
     */
    function handleAnswer(userChoice) {

        choiceButtons.forEach(btn => btn.disabled = true); //così non può fare più scelte
        loading.style.display = 'block';

        const datas = new FormData();
        datas.append('infographic_id', document.getElementById('infographic-id').value);
        datas.append('text_shown', document.getElementById('text-shown').value);
        datas.append('user_choice', userChoice);

        fetch('../api/submit_answer.php', {
            method: 'POST',
            body: datas
        })
            .then(response => response.json())
            .then(data => {
                loading.style.display = 'none';
                showResult(data);

                if (data.currentRound) {
                    currentRoundSpan.textContent = data.currentRound;
                }
                if (data.score !== undefined) {
                    currentScoreSpan.textContent = data.score;
                }

                //gioco finito
                if (data.gameFinished) {
                    setTimeout(() => {
                        showFinalResults(data);
                    }, 2000);
                } else {
                    //ogni round dura 1 secondo
                    setTimeout(() => {
                        loadNextRound();
                    }, 1000);
                }
            })
            .catch(error => {
                loading.style.display = 'none';
                console.error('Errore:', error);
                resultMessage.className = 'alert alert-danger';
                resultMessage.textContent = 'Errore durante l\'invio della risposta. Riprova.';
                resultMessage.style.display = 'block';
                choiceButtons.forEach(btn => btn.disabled = false);
            });
    }

    function showResult(data) {
        resultMessage.style.display = 'block';

        if (data.isCorrect) {
            resultMessage.className = 'alert alert-success';
            resultMessage.innerHTML = `
                <b>Corretto!</b>
                <br><small>+1 punto</small>
            `;
        } else {
            resultMessage.className = 'alert alert-danger';
            resultMessage.innerHTML = `
                <b>Sbagliato!</b> Riprova al prossimo round!'
            `;
        }
    }

    function loadNextRound() {
        fetch('../api/next_round.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    
                    //facciamo gli aggiornamenti
                    document.getElementById('infographic-image').src = '../' + data.infographic.ImagePath;
                    document.getElementById('infographic-text').textContent = data.textToShow;
                    document.getElementById('infographic-id').value = data.infographic.InfographicID;
                    document.getElementById('text-shown').value = data.textTypeShown;
                    resultMessage.style.display = 'none';

                    //riabilitazione pulsanti
                    choiceButtons.forEach(btn => btn.disabled = false);
                } else {
                    console.error('Errore nel caricamento del round successivo:', data.error);
                }
            })
            .catch(error => {
                console.error('Errore:', error);
            });
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
                    <a href="../index.php" class="btn btn-primary btn-lg">Torna alla Home</a>
                    <a href="../leaderboard.php" class="btn btn-success btn-lg">Classifica</a>
                    <button onclick="location.reload()" class="btn btn-secondary btn-lg">Gioca Ancora</button>
                </div>
            </div>
        `;
    }
});
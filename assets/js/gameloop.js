document.addEventListener("DOMContentLoaded", function() {
    const choiceButtons = document.querySelectorAll(".choice-btn");

    choiceButtons.forEach(button => {
        button.addEventListener("click", function() {

            const userChoice = this.dataset.choice;
            const infographicId = document.getElementById("infographic_id").value;
            const textShown = document.getElementById("text_shown").value;

            const answerData = new FormData();
            answerData.append("infographic_id", infographicId);
            answerData.append("text_shown", textShown);
            answerData.append("user_choice", userChoice);

            fetch("processa_risposta.php", {
                method: "POST",
                body: answerData
            });

            fetch('api/get_domanda.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('infographic-image').src = data.image_path;
                    document.getElementById('infographic-text').textContent = data.text_to_show;

                    document.getElementById('infographic-id').value = data.infographic_id;
                    document.getElementById('text-shown').value = data.text_type_shown;
                })
                .catch(error => console.error('Errore:', error));
                
        });
    });
})
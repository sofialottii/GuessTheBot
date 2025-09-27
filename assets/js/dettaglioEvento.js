document.addEventListener('DOMContentLoaded', function () {

    const editBtn = document.getElementById('edit-btn');
    const cancelBtn = document.getElementById('cancel-edit-btn');
    const saveBtn = document.getElementById('save-edit-btn');
    const viewModeDiv = document.getElementById('view-mode');
    const editModeDiv = document.getElementById('edit-mode');

    function toggleEditMode(showEdit) {
        viewModeDiv.style.display = showEdit ? 'none' : 'block';
        editModeDiv.style.display = showEdit ? 'block' : 'none';
    }

    editBtn.addEventListener('click', function () {
        toggleEditMode(true);
    });

    cancelBtn.addEventListener('click', function () {
        toggleEditMode(false);
    });

    //quando si clicca su salva
    saveBtn.addEventListener('click', function () {
        const form = document.getElementById('edit-event-form');
        const formData = new FormData(form);

        const gameID = new URLSearchParams(window.location.search).get('GameID');
        formData.append('gameID', gameID);

        fetch('../api/update_event_details.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('event-title-container').innerHTML = `<h1 class="h3 mb-0">Dettaglio: ${data.updatedName}</h1>`;
                    document.getElementById('event-date-container').textContent = data.updatedDate;

                    toggleEditMode(false);
                } else {
                    alert('Errore: ' + data.error);
                }
            })
            .catch(error => console.error('Errore:', error));
    });
});
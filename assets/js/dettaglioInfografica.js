document.addEventListener('DOMContentLoaded', function () {
    const tabCaratteristiche = document.getElementById('tab-caratteristiche');
    const tabStatistiche = document.getElementById('tab-statistiche');

    const contentCaratteristiche = document.getElementById('content-caratteristiche');
    const contentStatistiche = document.getElementById('content-statistiche');
    const eventFilterSelect = document.getElementById('eventFilter');

    // lo uso per cambiare da statistiche a caratteristiche e viceversa
    function switchTab(tabToShow) {
        if (tabToShow === 'statistiche') {
            tabStatistiche.classList.add('active');
            tabCaratteristiche.classList.remove('active');
            contentStatistiche.style.display = 'block';
            contentCaratteristiche.style.display = 'none';
        } else {
            tabCaratteristiche.classList.add('active');
            tabStatistiche.classList.remove('active');
            contentCaratteristiche.style.display = 'block';
            contentStatistiche.style.display = 'none';
        }
    }

    tabCaratteristiche.addEventListener('click', function (event) {
        event.preventDefault();
        switchTab('caratteristiche');
    });

    tabStatistiche.addEventListener('click', function (event) {
        event.preventDefault();
        switchTab('statistiche');
    });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('IDGame')) {
        switchTab('statistiche');
    }

    eventFilterSelect.addEventListener('change', function () {
        this.form.submit();
    });
});
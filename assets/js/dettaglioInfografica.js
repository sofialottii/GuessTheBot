document.addEventListener('DOMContentLoaded', function () {
    const tabCaratteristiche = document.getElementById('tab-caratteristiche');
    const tabStatistiche = document.getElementById('tab-statistiche');

    const contentCaratteristiche = document.getElementById('content-caratteristiche');
    const contentStatistiche = document.getElementById('content-statistiche');

    tabCaratteristiche.addEventListener('click', function (event) {
        event.preventDefault();

        tabCaratteristiche.classList.add('active');
        tabStatistiche.classList.remove('active');

        contentCaratteristiche.style.display = 'block';
        contentStatistiche.style.display = 'none';
    });

    tabStatistiche.addEventListener('click', function (event) {
        event.preventDefault();

        tabStatistiche.classList.add('active');
        tabCaratteristiche.classList.remove('active');

        contentStatistiche.style.display = 'block';
        contentCaratteristiche.style.display = 'none';
    });
});
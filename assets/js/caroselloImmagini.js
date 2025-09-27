document.addEventListener('DOMContentLoaded', function () {

    const eventModeSelect = document.getElementById('eventMode');
    const selectionDiv = document.getElementById('infographics-selection');

    eventModeSelect.addEventListener('change', function () {
        selectionDiv.style.display = (this.value === 'fixed') ? 'block' : 'none';
    });

    const counterSpan = document.getElementById('selection-counter');
    const checkboxes = document.querySelectorAll('.infographic-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCounter);
    });

    function updateCounter() {
        const selectedCount = document.querySelectorAll('.infographic-checkbox:checked').length;
        counterSpan.textContent = selectedCount;
    }

    updateCounter();

    const itemsPerPage = 12;
    const infographicItems = document.querySelectorAll('#infographics-grid .infographic-item');
    const totalPages = Math.ceil(infographicItems.length / itemsPerPage);
    let currentPage = 1;

    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const paginationNav = document.getElementById('infographics-pagination');

    function showPage(pageNumber) {
        infographicItems.forEach(item => item.style.display = 'none');

        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        for (let i = startIndex; i < endIndex && i < infographicItems.length; i++) {
            infographicItems[i].style.display = 'block';
        }

        paginationNav.style.display = (totalPages > 1) ? 'flex' : 'none';
    }

    prevPageBtn.addEventListener('click', function (e) {
        e.preventDefault();
        currentPage--;
        if (currentPage < 1) {
            currentPage = totalPages;
        }
        showPage(currentPage);
    });

    nextPageBtn.addEventListener('click', function (e) {
        e.preventDefault();
        currentPage++;
        if (currentPage > totalPages) {
            currentPage = 1;
        }
        showPage(currentPage);
    });

    showPage(1);
});
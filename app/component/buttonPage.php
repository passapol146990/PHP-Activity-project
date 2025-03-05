<div class="pagination d-flex justify-content-center mt-4 mb-5">
    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous" onclick="changePage(currentPage - 1)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <span id="page-numbers" class="d-flex"></span>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next" onclick="changePage(currentPage + 1)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<script>
    const totalPages = 10;
    let currentPage = getCurrentPage();

    function getCurrentPage() {
        const urlParams = new URLSearchParams(window.location.search);
        const page = parseInt(urlParams.get('page')) || 1;
        return Math.max(1, Math.min(page, totalPages));
    }

    function changePage(page) {
        if (page < 1 || page > totalPages) return;
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
    }

    function renderPagination() {
        const pageNumbers = document.getElementById('page-numbers');
        pageNumbers.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
            pageNumbers.appendChild(li);
        }
    }
    renderPagination();
</script>
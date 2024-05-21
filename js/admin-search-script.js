document.addEventListener("DOMContentLoaded", function() {
    var searchBar = document.querySelector('.admin-search-bar');
    var cancelSearchButton = document.querySelector('.admin-cancel-search-button');
    var productRows = document.querySelectorAll('.product-table tr');

    searchBar.addEventListener('input', function () {
        var searchTerm = searchBar.value.toLowerCase();
        for (var i = 1; i < productRows.length; i++) {
            var productName = productRows[i].querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                productRows[i].style.display = 'table-row';
            } else {
                productRows[i].style.display = 'none';
            }
        }
    });
    cancelSearchButton.addEventListener('click', function () {
        searchBar.value = '';
        for (var i = 1; i < productRows.length; i++) {
            productRows[i].style.display = 'table-row';
        }
    });
});

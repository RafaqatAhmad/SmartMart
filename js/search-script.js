document.addEventListener("DOMContentLoaded", function() {
    var searchBar = document.getElementById('search-bar');
    var cancelSearchButton = document.getElementById('cancel-search-button');
    var productRows = document.getElementsByClassName('product-row');
  
    searchBar.addEventListener('input', function () {
      var searchTerm = searchBar.value.toLowerCase();
      for (var i = 0; i < productRows.length; i++) {
        var productName = productRows[i].querySelector('.product-name').textContent.toLowerCase();
        if (productName.indexOf(searchTerm) === 0) {
          productRows[i].style.display = 'table-row';
        } else {
          productRows[i].style.display = 'none';
        }
      }
    });
  
    cancelSearchButton.addEventListener('click', function () {
      searchBar.value = '';
      for (var i = 0; i < productRows.length; i++) {
        productRows[i].style.display = 'table-row';
      }
    });
  });
  
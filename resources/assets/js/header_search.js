document.getElementById("search-button").onclick = function(e) {foldingSearch(e)};

function foldingSearch(e) {

    var searchInput = document.getElementById("search-input");
    var searchButton = document.getElementById("search-button");

    if(searchInput.offsetWidth < 250) {

        // prevent from searching
        e.preventDefault();

        // show the search bar
        searchInput.style.width = "250px";
        searchInput.focus();

        searchButton.classList.add('active');
    }
}
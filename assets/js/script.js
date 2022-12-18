window.addEventListener('DOMContentLoaded', () => {
  
// Link pagination
let links = document.querySelectorAll(".link__pagination");

if (!links) {
    return;
}

function activeLink(e) {

    e.target.classList.add('active');
}

links.forEach(item => {
    item.addEventListener('click', activeLink)
})


// AJAX barre de recherceh
let searchBar = document.querySelector('.search-bar__input');

function displayResult(){
    
     if(searchBar.value != "") {
        fetch('/home/search/'+searchBar.value)
        .then(response => response.text())
        .then(datas => {
           document.querySelector('#resulat').innerHTML = datas;
        })
     }
}

searchBar.addEventListener('input', displayResult);
    
});



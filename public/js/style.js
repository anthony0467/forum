//menu burger 

var toggleButton = document.querySelector('.toggle-menu');
var navBar = document.querySelector('.nav-list');
var burger = document.querySelector('.burger')
toggleButton.addEventListener('click', function () {
    
	navBar.classList.toggle('toggle');
    
});

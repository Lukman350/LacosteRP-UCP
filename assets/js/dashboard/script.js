const pageNav = document.getElementById('navigation');
const btn = document.getElementById('nav-toggler');

btn.addEventListener('click', function(){
	if (pageNav.classList.contains('nav-hidden')) {
		pageNav.classList.remove('nav-hidden');
	} else {
		pageNav.classList.add('nav-hidden');
	}
});

const navItems = document.querySelectorAll(".nav-items");

navItems.addEventListener('click', function (e) {
	if (navItems.classList.contains('active')) {
		navItems.classList.remove('active');
	} else {
		navItems.classList.add('active');
	}
})
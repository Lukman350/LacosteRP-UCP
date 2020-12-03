const pageNav = document.getElementById('navigation');
const btn = document.getElementById('nav-toggler');

btn.addEventListener('click', function(){
	if (pageNav.classList.contains('nav-hidden')) {
		pageNav.classList.remove('nav-hidden');
	} else {
		pageNav.classList.add('nav-hidden');
	}
});
document.addEventListener('DOMContentLoaded', function () {
	const header = document.getElementById('header');
	const scrollToTopBtn = document.getElementById('scrollToTopBtn');

	if (!header || !scrollToTopBtn) {
		return;
	}

	let lastScrollY = window.scrollY;
	const hideHeaderAfter = 120;

	function handleScroll() {
		const currentScrollY = window.scrollY;
		const isScrollingDown = currentScrollY > lastScrollY;

		if (currentScrollY > hideHeaderAfter && isScrollingDown) {
			header.classList.add('header-hidden');
			scrollToTopBtn.classList.add('is-visible');
		} else {
			header.classList.remove('header-hidden');
			scrollToTopBtn.classList.remove('is-visible');
		}

		if (currentScrollY <= hideHeaderAfter) {
			header.classList.remove('header-hidden');
			scrollToTopBtn.classList.remove('is-visible');
		}

		lastScrollY = currentScrollY;
	}

	scrollToTopBtn.addEventListener('click', function () {
		window.scrollTo({
			top: 0,
			left: 0,
			behavior: 'smooth'
		});

		header.classList.remove('header-hidden');
		scrollToTopBtn.classList.remove('is-visible');
	});

	window.addEventListener('scroll', handleScroll);
	handleScroll();
});

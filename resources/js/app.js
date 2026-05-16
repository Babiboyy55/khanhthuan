import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-menu-target]');

if (toggle && menu) {
	toggle.addEventListener('click', () => {
		const isHidden = menu.classList.toggle('hidden');
		toggle.setAttribute('aria-expanded', (!isHidden).toString());
	});
}

const carousel = document.querySelector('[data-carousel]');
const track = carousel?.querySelector('[data-carousel-track]');
const prevBtn = carousel?.querySelector('[data-carousel-prev]');
const nextBtn = carousel?.querySelector('[data-carousel-next]');

if (carousel && track) {
	let isDragging = false;
	let startX = 0;
	let scrollStart = 0;
	let isPaused = false;

	const getStep = () => {
		const item = track.querySelector('.carousel-item');
		return item ? item.getBoundingClientRect().width + 16 : 240;
	};

	const onPointerDown = (event) => {
		isDragging = true;
		startX = event.pageX || event.touches?.[0]?.pageX || 0;
		scrollStart = track.scrollLeft;
	};

	const onPointerMove = (event) => {
		if (!isDragging) {
			return;
		}
		const currentX = event.pageX || event.touches?.[0]?.pageX || 0;
		const delta = currentX - startX;
		track.scrollLeft = scrollStart - delta;
	};

	const onPointerUp = () => {
		isDragging = false;
	};

	track.addEventListener('mousedown', onPointerDown);
	track.addEventListener('mousemove', onPointerMove);
	track.addEventListener('mouseup', onPointerUp);
	track.addEventListener('mouseleave', onPointerUp);
	track.addEventListener('touchstart', onPointerDown, { passive: true });
	track.addEventListener('touchmove', onPointerMove, { passive: true });
	track.addEventListener('touchend', onPointerUp);
	track.addEventListener('mouseenter', () => {
		isPaused = true;
	});
	track.addEventListener('mouseleave', () => {
		isPaused = false;
	});

	if (prevBtn) {
		prevBtn.addEventListener('click', () => {
			track.scrollBy({ left: -getStep(), behavior: 'smooth' });
		});
	}

	if (nextBtn) {
		nextBtn.addEventListener('click', () => {
			track.scrollBy({ left: getStep(), behavior: 'smooth' });
		});
	}

	const autoScroll = () => {
		if (!isPaused && !isDragging) {
			track.scrollLeft += 0.2;
			if (track.scrollLeft >= track.scrollWidth / 2) {
				track.scrollLeft = 0;
			}
		}
		requestAnimationFrame(autoScroll);
	};

	autoScroll();
}

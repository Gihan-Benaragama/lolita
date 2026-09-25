import './bootstrap';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // --- Hero entrance sequence (one orchestrated moment, homepage only) ---
    const hero = document.querySelector('[data-hero]');
    if (hero) {
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
        tl.from('[data-hero-eyebrow]', { opacity: 0, y: 16, duration: 0.6 })
            .from('[data-hero-title]', { opacity: 0, y: 24, duration: 0.8 }, '-=0.3')
            .from('[data-hero-sub]', { opacity: 0, y: 16, duration: 0.6 }, '-=0.4')
            .from('[data-hero-cta]', { opacity: 0, y: 16, duration: 0.6 }, '-=0.4')
            .from('[data-hero-image]', { opacity: 0, scale: 1.04, duration: 1 }, '-=0.9');

        // subtle parallax on scroll
        gsap.to('[data-hero-image]', {
            yPercent: 10,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            },
        });
    }
});

// Cart icon bounce when an item is added — triggered from Livewire via a browser event
document.addEventListener('livewire:init', () => {
    Livewire.on('cart-updated', () => {
        const icon = document.querySelector('[data-cart-icon]');
        if (icon && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            gsap.fromTo(icon, { scale: 1 }, { scale: 1.25, duration: 0.15, yoyo: true, repeat: 1, ease: 'power1.inOut' });
        }
    });
});

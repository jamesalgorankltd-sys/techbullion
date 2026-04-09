/**
 * WACUS Theme - Main JavaScript
 * GSAP Animations, Scroll Effects, Custom Cursor, Smooth Scrolling
 */

(function($) {
    'use strict';

    // Register GSAP Plugins
    gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

    // Global Variables
    let smoother;
    let cursor;
    let cursorFollower;
    let isLoading = true;

    // =====================================================
    // PRELOADER
    // =====================================================
    const Preloader = {
        init: function() {
            const preloader = document.querySelector('.preloader');
            const preloaderProgress = document.querySelector('.preloader-progress');
            const preloaderCounter = document.querySelector('.preloader-counter');
            
            if (!preloader) return;

            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    this.hidePreloader(preloader);
                }
                if (preloaderProgress) {
                    preloaderProgress.style.width = progress + '%';
                }
                if (preloaderCounter) {
                    preloaderCounter.textContent = Math.round(progress) + '%';
                }
            }, 100);
        },

        hidePreloader: function(preloader) {
            gsap.to(preloader, {
                yPercent: -100,
                duration: 1,
                ease: 'power4.inOut',
                delay: 0.5,
                onComplete: () => {
                    preloader.style.display = 'none';
                    isLoading = false;
                    document.body.classList.add('loaded');
                    PageAnimations.init();
                }
            });
        }
    };

    // =====================================================
    // SMOOTH SCROLL (Lenis + GSAP)
    // =====================================================
    const SmoothScroll = {
        lenis: null,

        init: function() {
            // Initialize Lenis
            this.lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                direction: 'vertical',
                gestureDirection: 'vertical',
                smooth: true,
                mouseMultiplier: 1,
                smoothTouch: false,
                touchMultiplier: 2,
                infinite: false,
            });

            // Connect Lenis to GSAP ScrollTrigger
            this.lenis.on('scroll', ScrollTrigger.update);

            gsap.ticker.add((time) => {
                this.lenis.raf(time * 1000);
            });

            gsap.ticker.lagSmoothing(0);

            // Scroll to anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) {
                        this.lenis.scrollTo(target);
                    }
                });
            });
        },

        scrollTo: function(target) {
            if (this.lenis) {
                this.lenis.scrollTo(target);
            }
        }
    };

    // =====================================================
    // CUSTOM CURSOR
    // =====================================================
    const CustomCursor = {
        init: function() {
            cursor = document.querySelector('.cursor');
            cursorFollower = document.querySelector('.cursor-follower');

            if (!cursor || !cursorFollower) return;

            let mouseX = 0, mouseY = 0;
            let cursorX = 0, cursorY = 0;
            let followerX = 0, followerY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            // Animate cursor
            gsap.ticker.add(() => {
                cursorX += (mouseX - cursorX) * 0.2;
                cursorY += (mouseY - cursorY) * 0.2;
                followerX += (mouseX - followerX) * 0.1;
                followerY += (mouseY - followerY) * 0.1;

                gsap.set(cursor, { x: cursorX, y: cursorY });
                gsap.set(cursorFollower, { x: followerX, y: followerY });
            });

            // Hover effects
            this.bindHoverEffects();
        },

        bindHoverEffects: function() {
            // Links and buttons
            const hoverElements = document.querySelectorAll('a, button, .btn, .hover-target');
            
            hoverElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursor.classList.add('cursor-hover');
                    cursorFollower.classList.add('cursor-follower-hover');
                });

                el.addEventListener('mouseleave', () => {
                    cursor.classList.remove('cursor-hover');
                    cursorFollower.classList.remove('cursor-follower-hover');
                });
            });

            // Magnetic elements
            const magneticElements = document.querySelectorAll('.magnetic');
            
            magneticElements.forEach(el => {
                el.addEventListener('mousemove', (e) => {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;

                    gsap.to(el, {
                        x: x * 0.3,
                        y: y * 0.3,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });

                el.addEventListener('mouseleave', () => {
                    gsap.to(el, {
                        x: 0,
                        y: 0,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });

            // View project cursor
            const viewElements = document.querySelectorAll('.cursor-view');
            
            viewElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursor.classList.add('cursor-view-active');
                    cursorFollower.classList.add('cursor-follower-view');
                });

                el.addEventListener('mouseleave', () => {
                    cursor.classList.remove('cursor-view-active');
                    cursorFollower.classList.remove('cursor-follower-view');
                });
            });
        }
    };

    // =====================================================
    // PAGE ANIMATIONS
    // =====================================================
    const PageAnimations = {
        init: function() {
            this.heroAnimations();
            this.textAnimations();
            this.imageAnimations();
            this.counterAnimations();
            this.parallaxAnimations();
            this.staggerAnimations();
            this.cardAnimations();
            this.marqueeAnimations();
        },

        // Hero Section Animations
        heroAnimations: function() {
            const heroSection = document.querySelector('.hero-section');
            if (!heroSection) return;

            const heroTitle = heroSection.querySelector('.hero-title');
            const heroSubtitle = heroSection.querySelector('.hero-subtitle');
            const heroBtn = heroSection.querySelector('.hero-btn');
            const heroMedia = heroSection.querySelector('.hero-media');

            const tl = gsap.timeline({ delay: 0.5 });

            if (heroTitle) {
                const splitTitle = new SplitText(heroTitle, { type: 'chars, words' });
                tl.from(splitTitle.chars, {
                    opacity: 0,
                    y: 100,
                    rotateX: -90,
                    stagger: 0.02,
                    duration: 1,
                    ease: 'power4.out'
                });
            }

            if (heroSubtitle) {
                tl.from(heroSubtitle, {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.5');
            }

            if (heroBtn) {
                tl.from(heroBtn, {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.5');
            }

            if (heroMedia) {
                tl.from(heroMedia, {
                    opacity: 0,
                    scale: 0.9,
                    duration: 1,
                    ease: 'power3.out'
                }, '-=0.8');
            }
        },

        // Text Reveal Animations
        textAnimations: function() {
            // Split text animations
            const splitElements = document.querySelectorAll('.split-text');
            
            splitElements.forEach(el => {
                const split = new SplitText(el, { type: 'lines, words, chars' });
                
                gsap.from(split.lines, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 80%',
                        end: 'bottom 20%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 0,
                    y: 50,
                    stagger: 0.1,
                    duration: 1,
                    ease: 'power3.out'
                });
            });

            // Fade up text
            const fadeUpElements = document.querySelectorAll('.fade-up');
            
            fadeUpElements.forEach(el => {
                gsap.from(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 0,
                    y: 60,
                    duration: 1,
                    ease: 'power3.out'
                });
            });

            // Character reveal
            const charRevealElements = document.querySelectorAll('.char-reveal');
            
            charRevealElements.forEach(el => {
                const split = new SplitText(el, { type: 'chars' });
                
                gsap.from(split.chars, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 0,
                    y: 100,
                    rotationX: -90,
                    stagger: 0.02,
                    duration: 1,
                    ease: 'power4.out'
                });
            });

            // Line reveal
            const lineRevealElements = document.querySelectorAll('.line-reveal');
            
            lineRevealElements.forEach(el => {
                gsap.from(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    },
                    width: 0,
                    duration: 1.5,
                    ease: 'power3.inOut'
                });
            });
        },

        // Image Animations
        imageAnimations: function() {
            // Reveal from left/right
            const imgRevealElements = document.querySelectorAll('.img-reveal');
            
            imgRevealElements.forEach(el => {
                const direction = el.dataset.direction || 'left';
                const overlay = el.querySelector('.img-reveal-overlay');
                const img = el.querySelector('img');

                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 75%',
                        toggleActions: 'play none none reverse'
                    }
                });

                if (overlay) {
                    tl.to(overlay, {
                        scaleX: 0,
                        transformOrigin: direction === 'left' ? 'right center' : 'left center',
                        duration: 1,
                        ease: 'power4.inOut'
                    });
                }

                if (img) {
                    tl.from(img, {
                        scale: 1.3,
                        duration: 1.5,
                        ease: 'power3.out'
                    }, '-=1');
                }
            });

            // Scale up images
            const scaleUpElements = document.querySelectorAll('.scale-up');
            
            scaleUpElements.forEach(el => {
                gsap.from(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    scale: 0.8,
                    opacity: 0,
                    duration: 1,
                    ease: 'power3.out'
                });
            });

            // Clip reveal
            const clipRevealElements = document.querySelectorAll('.clip-reveal');
            
            clipRevealElements.forEach(el => {
                gsap.from(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    clipPath: 'inset(100% 0% 0% 0%)',
                    duration: 1.2,
                    ease: 'power4.inOut'
                });
            });
        },

        // Counter Animations
        counterAnimations: function() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target) || parseInt(counter.textContent);
                const suffix = counter.dataset.suffix || '';
                const prefix = counter.dataset.prefix || '';
                const duration = parseFloat(counter.dataset.duration) || 2;

                gsap.from(counter, {
                    scrollTrigger: {
                        trigger: counter,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    },
                    textContent: 0,
                    duration: duration,
                    ease: 'power2.out',
                    snap: { textContent: 1 },
                    onUpdate: function() {
                        counter.textContent = prefix + Math.round(this.targets()[0].textContent) + suffix;
                    }
                });
            });
        },

        // Parallax Effects
        parallaxAnimations: function() {
            // Vertical parallax
            const parallaxElements = document.querySelectorAll('.parallax');
            
            parallaxElements.forEach(el => {
                const speed = parseFloat(el.dataset.speed) || 0.5;
                
                gsap.to(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: true
                    },
                    y: () => (el.offsetHeight * speed),
                    ease: 'none'
                });
            });

            // Background parallax
            const bgParallaxElements = document.querySelectorAll('.bg-parallax');
            
            bgParallaxElements.forEach(el => {
                gsap.to(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: true
                    },
                    backgroundPositionY: '100%',
                    ease: 'none'
                });
            });

            // Horizontal scroll sections
            const horizontalSections = document.querySelectorAll('.horizontal-scroll');
            
            horizontalSections.forEach(section => {
                const wrapper = section.querySelector('.horizontal-wrapper');
                if (!wrapper) return;

                const items = wrapper.querySelectorAll('.horizontal-item');
                const totalWidth = wrapper.scrollWidth - section.offsetWidth;

                gsap.to(wrapper, {
                    scrollTrigger: {
                        trigger: section,
                        start: 'top top',
                        end: () => `+=${totalWidth}`,
                        scrub: 1,
                        pin: true,
                        anticipatePin: 1
                    },
                    x: -totalWidth,
                    ease: 'none'
                });
            });
        },

        // Stagger Animations
        staggerAnimations: function() {
            const staggerContainers = document.querySelectorAll('.stagger-container');
            
            staggerContainers.forEach(container => {
                const items = container.querySelectorAll('.stagger-item');
                const staggerDelay = parseFloat(container.dataset.stagger) || 0.1;

                gsap.from(items, {
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 0,
                    y: 50,
                    stagger: staggerDelay,
                    duration: 0.8,
                    ease: 'power3.out'
                });
            });

            // Grid stagger
            const gridContainers = document.querySelectorAll('.grid-stagger');
            
            gridContainers.forEach(container => {
                const items = container.querySelectorAll('.grid-item');

                gsap.from(items, {
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 0,
                    y: 60,
                    scale: 0.95,
                    stagger: {
                        amount: 0.8,
                        grid: 'auto',
                        from: 'start'
                    },
                    duration: 0.8,
                    ease: 'power3.out'
                });
            });
        },

        // Card Hover Animations
        cardAnimations: function() {
            const cards = document.querySelectorAll('.animated-card');
            
            cards.forEach(card => {
                const cardInner = card.querySelector('.card-inner');
                const cardImage = card.querySelector('.card-image img');
                const cardContent = card.querySelector('.card-content');

                card.addEventListener('mouseenter', () => {
                    gsap.to(card, {
                        y: -10,
                        duration: 0.3,
                        ease: 'power2.out'
                    });

                    if (cardImage) {
                        gsap.to(cardImage, {
                            scale: 1.1,
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                    }
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        y: 0,
                        duration: 0.3,
                        ease: 'power2.out'
                    });

                    if (cardImage) {
                        gsap.to(cardImage, {
                            scale: 1,
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                    }
                });

                // 3D tilt effect
                if (card.classList.contains('tilt-card')) {
                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;
                        const rotateX = (y - centerY) / 10;
                        const rotateY = (centerX - x) / 10;

                        gsap.to(card, {
                            rotateX: rotateX,
                            rotateY: rotateY,
                            transformPerspective: 1000,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    });

                    card.addEventListener('mouseleave', () => {
                        gsap.to(card, {
                            rotateX: 0,
                            rotateY: 0,
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                    });
                }
            });
        },

        // Marquee Animations
        marqueeAnimations: function() {
            const marquees = document.querySelectorAll('.marquee');
            
            marquees.forEach(marquee => {
                const content = marquee.querySelector('.marquee-content');
                if (!content) return;

                const clone = content.cloneNode(true);
                marquee.appendChild(clone);

                const speed = parseFloat(marquee.dataset.speed) || 20;
                const direction = marquee.dataset.direction || 'left';

                gsap.to(marquee.querySelectorAll('.marquee-content'), {
                    xPercent: direction === 'left' ? -100 : 100,
                    repeat: -1,
                    duration: speed,
                    ease: 'linear'
                });

                // Pause on hover
                marquee.addEventListener('mouseenter', () => {
                    gsap.to(marquee.querySelectorAll('.marquee-content'), {
                        timeScale: 0,
                        duration: 0.3
                    });
                });

                marquee.addEventListener('mouseleave', () => {
                    gsap.to(marquee.querySelectorAll('.marquee-content'), {
                        timeScale: 1,
                        duration: 0.3
                    });
                });
            });
        }
    };

    // =====================================================
    // NAVIGATION
    // =====================================================
    const Navigation = {
        init: function() {
            this.stickyHeader();
            this.mobileMenu();
            this.dropdownMenu();
        },

        stickyHeader: function() {
            const header = document.querySelector('.site-header');
            if (!header) return;

            let lastScroll = 0;

            ScrollTrigger.create({
                start: 'top -100',
                onUpdate: (self) => {
                    const currentScroll = self.scroll();

                    if (currentScroll > 100) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }

                    if (currentScroll > lastScroll && currentScroll > 200) {
                        header.classList.add('header-hidden');
                    } else {
                        header.classList.remove('header-hidden');
                    }

                    lastScroll = currentScroll;
                }
            });
        },

        mobileMenu: function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            const menuClose = document.querySelector('.mobile-menu-close');
            const menuLinks = document.querySelectorAll('.mobile-menu a');

            if (!menuToggle || !mobileMenu) return;

            const openMenu = () => {
                mobileMenu.classList.add('active');
                document.body.classList.add('menu-open');
                
                gsap.fromTo(mobileMenu, 
                    { clipPath: 'circle(0% at 100% 0%)' },
                    { 
                        clipPath: 'circle(150% at 100% 0%)',
                        duration: 0.8,
                        ease: 'power4.inOut'
                    }
                );

                gsap.from('.mobile-menu .menu-item', {
                    opacity: 0,
                    y: 50,
                    stagger: 0.1,
                    duration: 0.5,
                    delay: 0.3,
                    ease: 'power3.out'
                });
            };

            const closeMenu = () => {
                gsap.to(mobileMenu, {
                    clipPath: 'circle(0% at 100% 0%)',
                    duration: 0.6,
                    ease: 'power4.inOut',
                    onComplete: () => {
                        mobileMenu.classList.remove('active');
                        document.body.classList.remove('menu-open');
                    }
                });
            };

            menuToggle.addEventListener('click', openMenu);
            
            if (menuClose) {
                menuClose.addEventListener('click', closeMenu);
            }

            menuLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });
        },

        dropdownMenu: function() {
            const dropdowns = document.querySelectorAll('.has-dropdown');
            
            dropdowns.forEach(dropdown => {
                const submenu = dropdown.querySelector('.submenu');
                if (!submenu) return;

                dropdown.addEventListener('mouseenter', () => {
                    gsap.to(submenu, {
                        opacity: 1,
                        y: 0,
                        visibility: 'visible',
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });

                dropdown.addEventListener('mouseleave', () => {
                    gsap.to(submenu, {
                        opacity: 0,
                        y: 10,
                        visibility: 'hidden',
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });
        }
    };

    // =====================================================
    // THREE.JS 3D EFFECTS
    // =====================================================
    const ThreeEffects = {
        scene: null,
        camera: null,
        renderer: null,
        particles: null,

        init: function() {
            const container = document.querySelector('.three-container');
            if (!container || typeof THREE === 'undefined') return;

            this.setupScene(container);
            this.createParticles();
            this.animate();
            this.handleResize();
        },

        setupScene: function(container) {
            this.scene = new THREE.Scene();
            
            this.camera = new THREE.PerspectiveCamera(
                75,
                container.offsetWidth / container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.z = 5;

            this.renderer = new THREE.WebGLRenderer({ 
                alpha: true,
                antialias: true 
            });
            this.renderer.setSize(container.offsetWidth, container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            container.appendChild(this.renderer.domElement);
        },

        createParticles: function() {
            const particleCount = 1000;
            const geometry = new THREE.BufferGeometry();
            const positions = new Float32Array(particleCount * 3);

            for (let i = 0; i < particleCount * 3; i++) {
                positions[i] = (Math.random() - 0.5) * 10;
            }

            geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

            const material = new THREE.PointsMaterial({
                color: 0xffffff,
                size: 0.02,
                transparent: true,
                opacity: 0.8
            });

            this.particles = new THREE.Points(geometry, material);
            this.scene.add(this.particles);
        },

        animate: function() {
            const self = this;
            
            function render() {
                requestAnimationFrame(render);

                if (self.particles) {
                    self.particles.rotation.x += 0.0005;
                    self.particles.rotation.y += 0.0005;
                }

                self.renderer.render(self.scene, self.camera);
            }

            render();
        },

        handleResize: function() {
            const container = document.querySelector('.three-container');
            if (!container) return;

            window.addEventListener('resize', () => {
                this.camera.aspect = container.offsetWidth / container.offsetHeight;
                this.camera.updateProjectionMatrix();
                this.renderer.setSize(container.offsetWidth, container.offsetHeight);
            });
        }
    };

    // =====================================================
    // ACCORDION / FAQ
    // =====================================================
    const Accordion = {
        init: function() {
            const accordions = document.querySelectorAll('.accordion');
            
            accordions.forEach(accordion => {
                const items = accordion.querySelectorAll('.accordion-item');
                
                items.forEach(item => {
                    const header = item.querySelector('.accordion-header');
                    const content = item.querySelector('.accordion-content');
                    
                    if (!header || !content) return;

                    header.addEventListener('click', () => {
                        const isOpen = item.classList.contains('active');

                        // Close all items
                        items.forEach(otherItem => {
                            if (otherItem !== item) {
                                otherItem.classList.remove('active');
                                gsap.to(otherItem.querySelector('.accordion-content'), {
                                    height: 0,
                                    duration: 0.4,
                                    ease: 'power2.inOut'
                                });
                            }
                        });

                        // Toggle current item
                        if (isOpen) {
                            item.classList.remove('active');
                            gsap.to(content, {
                                height: 0,
                                duration: 0.4,
                                ease: 'power2.inOut'
                            });
                        } else {
                            item.classList.add('active');
                            gsap.to(content, {
                                height: 'auto',
                                duration: 0.4,
                                ease: 'power2.inOut'
                            });
                        }
                    });
                });
            });
        }
    };

    // =====================================================
    // FORM ANIMATIONS
    // =====================================================
    const FormAnimations = {
        init: function() {
            const formGroups = document.querySelectorAll('.form-group');
            
            formGroups.forEach(group => {
                const input = group.querySelector('input, textarea');
                const label = group.querySelector('label');
                
                if (!input) return;

                input.addEventListener('focus', () => {
                    group.classList.add('focused');
                    if (label) {
                        gsap.to(label, {
                            y: -25,
                            scale: 0.85,
                            color: 'var(--color-accent)',
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                });

                input.addEventListener('blur', () => {
                    if (!input.value) {
                        group.classList.remove('focused');
                        if (label) {
                            gsap.to(label, {
                                y: 0,
                                scale: 1,
                                color: 'var(--color-text-secondary)',
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                        }
                    }
                });

                // Check for pre-filled values
                if (input.value) {
                    group.classList.add('focused');
                    if (label) {
                        gsap.set(label, {
                            y: -25,
                            scale: 0.85
                        });
                    }
                }
            });

            // Button ripple effect
            const buttons = document.querySelectorAll('.btn-ripple');
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = button.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    
                    button.appendChild(ripple);

                    gsap.to(ripple, {
                        scale: 4,
                        opacity: 0,
                        duration: 0.6,
                        ease: 'power2.out',
                        onComplete: () => ripple.remove()
                    });
                });
            });
        }
    };

    // =====================================================
    // TABS
    // =====================================================
    const Tabs = {
        init: function() {
            const tabContainers = document.querySelectorAll('.tabs-container');
            
            tabContainers.forEach(container => {
                const tabs = container.querySelectorAll('.tab');
                const panels = container.querySelectorAll('.tab-panel');
                const indicator = container.querySelector('.tab-indicator');

                tabs.forEach((tab, index) => {
                    tab.addEventListener('click', () => {
                        // Update active tab
                        tabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');

                        // Update indicator position
                        if (indicator) {
                            gsap.to(indicator, {
                                x: tab.offsetLeft,
                                width: tab.offsetWidth,
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                        }

                        // Switch panels
                        panels.forEach(panel => {
                            gsap.to(panel, {
                                opacity: 0,
                                y: 20,
                                duration: 0.3,
                                ease: 'power2.out',
                                onComplete: () => {
                                    panel.classList.remove('active');
                                }
                            });
                        });

                        setTimeout(() => {
                            panels[index].classList.add('active');
                            gsap.fromTo(panels[index],
                                { opacity: 0, y: 20 },
                                { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' }
                            );
                        }, 300);
                    });
                });
            });
        }
    };

    // =====================================================
    // VIDEO PLAYER
    // =====================================================
    const VideoPlayer = {
        init: function() {
            const videoContainers = document.querySelectorAll('.video-container');
            
            videoContainers.forEach(container => {
                const video = container.querySelector('video');
                const playBtn = container.querySelector('.play-btn');
                const overlay = container.querySelector('.video-overlay');

                if (!video || !playBtn) return;

                playBtn.addEventListener('click', () => {
                    if (video.paused) {
                        video.play();
                        playBtn.classList.add('playing');
                        
                        if (overlay) {
                            gsap.to(overlay, {
                                opacity: 0,
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                        }
                    } else {
                        video.pause();
                        playBtn.classList.remove('playing');
                        
                        if (overlay) {
                            gsap.to(overlay, {
                                opacity: 1,
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                        }
                    }
                });

                video.addEventListener('ended', () => {
                    playBtn.classList.remove('playing');
                    if (overlay) {
                        gsap.to(overlay, {
                            opacity: 1,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                });
            });
        }
    };

    // =====================================================
    // SCROLL PROGRESS
    // =====================================================
    const ScrollProgress = {
        init: function() {
            const progressBar = document.querySelector('.scroll-progress');
            if (!progressBar) return;

            ScrollTrigger.create({
                start: 'top top',
                end: 'bottom bottom',
                onUpdate: (self) => {
                    gsap.to(progressBar, {
                        scaleX: self.progress,
                        duration: 0.1,
                        ease: 'none'
                    });
                }
            });
        }
    };

    // =====================================================
    // IMAGE HOVER EFFECTS
    // =====================================================
    const ImageHover = {
        init: function() {
            // Zoom effect
            const zoomImages = document.querySelectorAll('.img-zoom');
            
            zoomImages.forEach(container => {
                const img = container.querySelector('img');
                if (!img) return;

                container.addEventListener('mouseenter', () => {
                    gsap.to(img, {
                        scale: 1.1,
                        duration: 0.5,
                        ease: 'power2.out'
                    });
                });

                container.addEventListener('mouseleave', () => {
                    gsap.to(img, {
                        scale: 1,
                        duration: 0.5,
                        ease: 'power2.out'
                    });
                });
            });

            // Reveal effect
            const revealImages = document.querySelectorAll('.img-hover-reveal');
            
            revealImages.forEach(container => {
                const overlay = container.querySelector('.overlay');
                const content = container.querySelector('.hover-content');

                container.addEventListener('mouseenter', () => {
                    if (overlay) {
                        gsap.to(overlay, {
                            opacity: 1,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                    if (content) {
                        gsap.to(content, {
                            opacity: 1,
                            y: 0,
                            duration: 0.3,
                            delay: 0.1,
                            ease: 'power2.out'
                        });
                    }
                });

                container.addEventListener('mouseleave', () => {
                    if (overlay) {
                        gsap.to(overlay, {
                            opacity: 0,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                    if (content) {
                        gsap.to(content, {
                            opacity: 0,
                            y: 20,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                });
            });
        }
    };

    // =====================================================
    // SLIDER / CAROUSEL
    // =====================================================
    const Slider = {
        init: function() {
            const sliders = document.querySelectorAll('.wacus-slider');
            
            sliders.forEach(slider => {
                const slides = slider.querySelectorAll('.slide');
                const prevBtn = slider.querySelector('.slider-prev');
                const nextBtn = slider.querySelector('.slider-next');
                const dots = slider.querySelectorAll('.slider-dot');
                
                let currentIndex = 0;
                const totalSlides = slides.length;

                const goToSlide = (index) => {
                    gsap.to(slides, {
                        opacity: 0,
                        x: -50,
                        duration: 0.5,
                        ease: 'power2.inOut'
                    });

                    gsap.to(slides[index], {
                        opacity: 1,
                        x: 0,
                        duration: 0.5,
                        delay: 0.2,
                        ease: 'power2.out'
                    });

                    currentIndex = index;

                    // Update dots
                    dots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                };

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        const newIndex = currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
                        goToSlide(newIndex);
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        const newIndex = currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
                        goToSlide(newIndex);
                    });
                }

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => goToSlide(index));
                });

                // Auto play
                if (slider.dataset.autoplay === 'true') {
                    const interval = parseInt(slider.dataset.interval) || 5000;
                    setInterval(() => {
                        const newIndex = currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
                        goToSlide(newIndex);
                    }, interval);
                }
            });
        }
    };

    // =====================================================
    // MOUSE MOVEMENT EFFECTS
    // =====================================================
    const MouseMovement = {
        init: function() {
            const moveElements = document.querySelectorAll('.mouse-move');
            
            document.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                const centerX = window.innerWidth / 2;
                const centerY = window.innerHeight / 2;

                moveElements.forEach(el => {
                    const speed = parseFloat(el.dataset.speed) || 0.05;
                    const x = (mouseX - centerX) * speed;
                    const y = (mouseY - centerY) * speed;

                    gsap.to(el, {
                        x: x,
                        y: y,
                        duration: 0.5,
                        ease: 'power2.out'
                    });
                });
            });

            // Rotation on mouse move
            const rotateElements = document.querySelectorAll('.mouse-rotate');
            
            document.addEventListener('mousemove', (e) => {
                rotateElements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    const angle = Math.atan2(y, x) * (180 / Math.PI);

                    gsap.to(el, {
                        rotation: angle,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });
        }
    };

    // =====================================================
    // SCROLL TRIGGERED PINNING
    // =====================================================
    const PinSections = {
        init: function() {
            const pinSections = document.querySelectorAll('.pin-section');
            
            pinSections.forEach(section => {
                const pinDuration = section.dataset.pinDuration || '200%';
                
                ScrollTrigger.create({
                    trigger: section,
                    start: 'top top',
                    end: `+=${pinDuration}`,
                    pin: true,
                    pinSpacing: true
                });
            });
        }
    };

    // =====================================================
    // INITIALIZATION
    // =====================================================
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize preloader
        Preloader.init();

        // Initialize smooth scroll
        SmoothScroll.init();

        // Initialize custom cursor
        CustomCursor.init();

        // Initialize navigation
        Navigation.init();

        // Initialize accordion
        Accordion.init();

        // Initialize form animations
        FormAnimations.init();

        // Initialize tabs
        Tabs.init();

        // Initialize video player
        VideoPlayer.init();

        // Initialize scroll progress
        ScrollProgress.init();

        // Initialize image hover effects
        ImageHover.init();

        // Initialize slider
        Slider.init();

        // Initialize mouse movement effects
        MouseMovement.init();

        // Initialize pin sections
        PinSections.init();

        // Initialize Three.js effects
        ThreeEffects.init();
    });

    // Expose functions globally
    window.WacusTheme = {
        SmoothScroll,
        CustomCursor,
        PageAnimations,
        Navigation,
        ThreeEffects
    };

})(jQuery);

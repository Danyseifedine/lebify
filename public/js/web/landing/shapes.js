document.addEventListener('DOMContentLoaded', function () {
    gsap.from("#kt_app_header", {
        duration: 1.5,
        opacity: 0,
        y: -50,
        ease: "power4.out"
    });
    gsap.from(".intro", {
        duration: 1.5,
        opacity: 0,
        y: -50,
        ease: "power4.out"
    });
    gsap.from(".titles-container .title", {
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        stagger: 0.3
    });
    gsap.from(".sub-of-sub", {
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.7
    });
    gsap.from(".get-template", {
        duration: 1.5,
        opacity: 0,
        scale: 0.5,
        ease: "elastic.out(1, 0.3)",
        delay: 0.1
    });

    gsap.from(".how-it-works", {
        scrollTrigger: {
            trigger: ".how-it-works",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out"
    });
    gsap.from(".how-it-works-cards", {
        scrollTrigger: {
            trigger: ".how-it-works-cards",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out"
    });

    gsap.from(".section-3 .content-title", {
        scrollTrigger: {
            trigger: ".section-3 .content-title",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out"
    });

    gsap.from(".section-3 .content-text", {
        scrollTrigger: {
            trigger: ".section-3 .content-text",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.3
    });

    gsap.from(".section-3 .cards-row-1", {
        scrollTrigger: {
            trigger: ".section-3 .cards-row-1",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".section-3 .cards-row-2", {
        scrollTrigger: {
            trigger: ".section-3 .cards-row-2",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".section-3 .cards-row-3", {
        scrollTrigger: {
            trigger: ".section-3 .cards-row-3",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".quote-mark", {
        scrollTrigger: {
            trigger: ".quote-mark",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.3
    });

    gsap.from(".quote-writer", {
        scrollTrigger: {
            trigger: ".quote-writer",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".section-5 .contact-form", {
        scrollTrigger: {
            trigger: ".section-5 .contact-form",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".line-break-1", {
        scrollTrigger: {
            trigger: ".line-break-1",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        x: -300,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".line-break-2", {
        scrollTrigger: {
            trigger: ".line-break-2",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        x: -300,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".section-logos", {
        scrollTrigger: {
            trigger: ".section-logos",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".card-team-1", {
        scrollTrigger: {
            trigger: ".card-team-1",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });

    gsap.from(".card-team-2", {
        scrollTrigger: {
            trigger: ".card-team-2",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        duration: 1.5,
        opacity: 0,
        y: 50,
        ease: "power4.out",
        delay: 0.6
    });


    function getRandomPosition(max) {
        return Math.floor(Math.random() * max) * (Math.random() < 0.5 ? 1 : -1);
    }

    gsap.to(".shape-1", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 720,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-2", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -720,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-3", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 0,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-4", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 150,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-5", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 360,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });

    gsap.to(".shape-6", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -360,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-7", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 180,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-8", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -180,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-9", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 90,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-10", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -90,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-11", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 270,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-12", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -270,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-13", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 45,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-14", {
        duration: 15,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: -45,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    gsap.to(".shape-15", {
        duration: 10,
        x: () => getRandomPosition(300),
        y: () => getRandomPosition(300),
        rotation: 360,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
});

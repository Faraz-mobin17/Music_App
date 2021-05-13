const musicTL = gsap.timeline();

musicTL.from(".container", {
    duration: 1.2,
    x: -10,
    width: 0,
    opacity: 0,
    ease: "power3.inOut"
})
    .from([".line_wrapper .line_"], {
        delay: -0.5,
        y: -10,
        height: 0,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut",
        stagger: {
            amount: .5
        }
    })
    .from([".logo", ".cart"], {
        delay: -0.2,
        y: -16,
        height: 0,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut"
    })

    .from(".half_circle", {
        delay: -0.2,
        x: -50,
        opacity: 0,
        dutaiton: 0.5,
        ease: "power3.ease"
    })

    .from(".hero", {
        delay: -0.2,
        y: -50,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.ease"
    })

    .from(["h2"], {
        delay: -0.2,
        y: -50,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.ease",
        stagger: {
            amount: .2
        }
    })
    .from([".half_circle span"], {
        delay: -0.8,
        x: 40,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut",
        stagger: {
            amount: .5
        }
    })
    .from(["h1", "h1 span", ".price", ".cta"], {
        delay: -0.8,
        y: -40,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut",
        stagger: {
            amount: .5
        }
    })
    .from(["ul li", ".video"], {
        delay: -0.8,
        y: 40,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut",
        stagger: {
            amount: .5
        }
    })
    .from([".social_media a"], {
        delay: -0.8,
        x: 40,
        opacity: 0,
        dutaiton: 0.8,
        ease: "power3.inOut",
        stagger: {
            amount: .5
        }
    })
// ==============================
// MOBILE MENU TOGGLE
// ==============================
const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

if (menuToggle && navMenu) {
  menuToggle.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });

  // Close nav on link click (mobile)
  const navLinks = navMenu.querySelectorAll("a");
  navLinks.forEach(link =>
    link.addEventListener("click", () => {
      navMenu.classList.remove("active");
    })
  );
}

// ==============================
// ACTIVE LINK HIGHLIGHT
// ==============================
const currentLocation = window.location.pathname.split("/").pop();
const menuItems = document.querySelectorAll(".nav a");

menuItems.forEach(item => {
  const linkPath = item.getAttribute("href");

  if (linkPath === currentLocation || (currentLocation === "" && linkPath === "index.html")) {
    item.classList.add("active");
  }
});

// ==============================
// SMOOTH SCROLL (for same-page links)
// ==============================
const internalLinks = document.querySelectorAll('a[href^="#"]');

internalLinks.forEach(link => {
  link.addEventListener("click", function (e) {
    const targetId = this.getAttribute("href").slice(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      e.preventDefault();
      window.scrollTo({
        top: targetElement.offsetTop - 100, // adjust for header height
        behavior: "smooth"
      });
    }
  });
});

// ==============================
// SCROLL REVEAL ANIMATIONS
// ==============================
const revealElements = document.querySelectorAll(".fade-in, .service-card");

function revealOnScroll() {
  const triggerBottom = window.innerHeight * 0.85;

  revealElements.forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top < triggerBottom) {
      el.classList.add("show");
    }
  });
}

// Run on scroll + load
window.addEventListener("scroll", revealOnScroll);
window.addEventListener("load", revealOnScroll);
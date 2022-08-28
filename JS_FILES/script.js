window.addEventListener("scroll", () => {
  document.body.classList.toggle('active', window.scrollY > 0);
})
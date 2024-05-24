document.addEventListener('DOMContentLoaded', function () {
// Navbar and Collapse Button manipulation
let collapseButton = document.querySelector(".navbar-toggler");
let navbar = document.querySelector("nav");
let scrolled = false;
let collapseOn = false;
$(window).scroll(function () {
	if ($(this).scrollTop() > 60) {
		$("nav").addClass("bg-white shadow");
		scrolled = true;
	} else {
		if (collapseOn == false) {
			$("nav").removeClass("bg-white shadow");
		}
		scrolled = false;
	}
});

if (collapseButton != null) {
  collapseButton.addEventListener("click", () => {
    if (scrolled == false) {
      $("nav").toggleClass("bg-white");
      $("nav").removeClass("transition-color");
    }
    if (collapseOn == false) {
      collapseOn = true;
    } else {
      collapseOn = false;
      $("nav").addClass("transition-color");
    }
    console.log(collapseOn);
  });
}
})

//second navbar
window.onscroll = function () {
  if (typeof window['scrollFunction'] === 'function') {
    scrollFunction();
  }
};


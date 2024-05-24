// Sliders---------------------------------------------------------------
let slideIndex = 0;
let sliderTime;
showSlides();

function showSlides() {
	let i;
	const slides = document.getElementsByClassName("mySlides");
	const dots = document.getElementsByClassName("partner-dot");
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
		slides[i].className.replace(" animated fadeIn", "");
	}
	slideIndex++;
	if (slideIndex > slides.length) {
		slideIndex = 1;
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" partner-active", "");
	}
	
  if (slides[slideIndex - 1] !== undefined) {
    slides[slideIndex - 1].style.display = "block";
	slides[slideIndex - 1].className += " animated fadeIn";
  }

	if (dots[slideIndex - 1] !== undefined) {
    dots[slideIndex - 1].className += " partner-active";
  }
	setTimeout(showSlides, 5000); // Change image every 2 seconds
}
/* --------------------------------------------
            #TESTIMONI SLIDERS#
-----------------------------------------------*/
let slideTesti = 0;
let slidestesti;
showTesti();

//Button sliders
function plusSlides(position) {
	slideTesti += position;
	if (slideTesti > slidestesti.length) {
		slideTesti = 1;
	} else if (slideTesti < 1) {
		slideTesti = slidestesti.length;
	}
	for (d = 0; d < slidestesti.length; d++) {
		slidestesti[d].style.display = "none";
		slidestesti[d].className.replace(" animated fadeIn", "");
	}
	slidestesti[slideTesti - 1].style.display = "block";
	slidestesti[slideTesti - 1].className += " animated fadeIn";
}
//automatic sliders
function showTesti() {
	let d;
	slidestesti = document.getElementsByClassName("testiSlides");
	for (d = 0; d < slidestesti.length; d++) {
		slidestesti[d].style.display = "none";
		slidestesti[d].className.replace(" animated fadeIn", "");
	}
	slideTesti++;
	if (slideTesti > slidestesti.length) {
		slideTesti = 1;
	}

	if (slidestesti[slideTesti - 1] !== undefined) {
    slidestesti[slideTesti - 1].style.display = "block";
	slidestesti[slideTesti - 1].className += " animated fadeIn";
  }
	setTimeout(showTesti, 8000);
}

/*---------------------------------------------
				#	FITUR SLIDE	#
-----------------------------------------------*/
let slidefitur = 1;
showSlidesfitur(slidefitur);

function plusSlidesfitur(n) {
	showSlidesfitur((slidefitur += n));
}

function currentSlidefitur(n) {
	if (sliderTime) window.clearTimeout(sliderTime);
	showSlidesfitur((slidefitur = n));
}

function showSlidesfitur(n) {
	let i;
	const slidesfiturin = document.getElementsByClassName("fiturslide");
	const dotsin = document.getElementsByClassName("dot-fitur");
	if (n > slidesfiturin.length) {
		slidefitur = 1;
	}
	if (n < 1) {
		slidefitur = slidesfiturin.length;
	}
	for (i = 0; i < slidesfiturin.length; i++) {
		slidesfiturin[i].style.display = "none";
		slidesfiturin[i].className.replace(" animated fadeIn", "");
	}
	if (!n) {
		slidefitur++;
	}
	if (slidefitur > slidesfiturin.length) {
		slidefitur = 1;
	}
	for (i = 0; i < dotsin.length; i++) {
		dotsin[i].className = dotsin[i].className.replace(" active", "");
	}

	if (slidesfiturin[slidefitur - 1] !== undefined) {
    slidesfiturin[slidefitur - 1].style.display = "block";
	slidesfiturin[slidefitur - 1].className += " animated fadeIn";
  }

	if (dotsin[slidefitur - 1] !== undefined) {
    dotsin[slidefitur - 1].className += " active";
  }
	sliderTime = setTimeout(showSlidesfitur, 5000);
}

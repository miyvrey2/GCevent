window.addEventListener("load", initEnzowSlider);

function initEnzowSlider(){
	// Let's find our slider
	outerSlider = document.getElementById("enzow_slider_1");

	// Also get our slides
	sliderSlides = document.getElementsByClassName("enzow_slide");

	// Amount of slides
	AmountSlides = sliderSlides.length;
	currentSlide = 0;
	busy = 0;

	// container around the slides
	slidesContainer = document.getElementsByClassName("exeptionContainer");
	slidesContainerChoice = true;
	slidesContainerWidth = '1280px';

	// Set some variables for the slider
	sliderWidth = '100%';
	sliderHeight = '400px';

	// Give the slider the right sizes
	outerSlider.style.width = sliderWidth;
	outerSlider.style.height = sliderHeight;

	// Give the slides also some sizes
	for(i=0; i<sliderSlides.length; i++){
		sliderSlides[i].style.width = sliderWidth;
		sliderSlides[i].style.height = sliderHeight;
	}

	// Check for container option
	if (slidesContainerChoice == true){
		for(i=0; i<slidesContainer.length; i++){
			slidesContainer[i].style.width = slidesContainerWidth;
			slidesContainer[i].style.left = '0px';
		}
	}

	EnzowSlider();
}

function EnzowSlider() {
    //// In the end, be sure the slider is loaded :)
    //document.getElementById("demo").innerHTML = "slider is loaded.";
	for(i=0; i<sliderSlides.length; i++){
		sliderSlides[i].style.opacity = 0;
		sliderSlides[i].style.display = "none";
	}
	sliderSlides[0].style.display = "block";
	sliderSlides[0].style.opacity = 1;
    tid = setInterval(function(){EnzowSliderTransitionOne(currentSlide, 'add');},4000);
}

function EnzowSliderTransitionOne(div, direction){
	// Add the next image
	if(direction == 'add'){
		if(div == (AmountSlides - 1)){
			currentSlide = 0;
		} else {
			currentSlide += 1;
		}
	} else {
		// Less the image
		if(div == 0){
			currentSlide = AmountSlides - 1;
		} else {
			currentSlide -= 1;
		}
	}

	removeOpacity(div);
	addOpacity(currentSlide);
}

function removeOpacity(div){
	sliderSlides[div].style.opacity = 1;

	checkup = tabVisible();
	if(checkup == false){
		(function fade() {
	    	if ((sliderSlides[div].style.opacity -= .05) < 0.05) {
	    		sliderSlides[div].style.display = "none";
	    		sliderSlides[div].style.opacity = 0;
				busy = 0;
	    	} else {
				setTimeout(fade, 20);
				busy = 1;
	    	}
	  })();
	} else {
		sliderSlides[div].style.display = "none";
		sliderSlides[div].style.opacity = 0;
	}
}

function addOpacity(div){
	sliderSlides[div].style.display = "block";

	checkup = tabVisible();
	if(checkup == false){
		(function fade() {
			var val = parseFloat(sliderSlides[div].style.opacity);
			if (!((val += .05) > 1)) {
				sliderSlides[div].style.opacity = val;
				setTimeout(fade, 20);
				busy = 1;
			} else{
				busy = 0;
			}
		})();
	} else {
		sliderSlides[div].style.opacity = 1;
	}
}

function previous(){
	if(busy == 0){
		EnzowSliderTransitionOne(currentSlide, 'less');
		clearInterval(tid);
		tid = setInterval(function(){EnzowSliderTransitionOne(currentSlide, 'add');},4000);
	}
}

function next(){
	if(busy == 0){
		EnzowSliderTransitionOne(currentSlide, 'add');
		clearInterval(tid);
		tid = setInterval(function(){EnzowSliderTransitionOne(currentSlide, 'add');},4000);
	}
}

function tabVisible() {
	var hidden = "hidden";

	// Standards:
	if (hidden in document)
		document.addEventListener("visibilitychange", onchange);
	else if ((hidden = "mozHidden") in document)
		document.addEventListener("mozvisibilitychange", onchange);
	else if ((hidden = "webkitHidden") in document)
		document.addEventListener("webkitvisibilitychange", onchange);
	else if ((hidden = "msHidden") in document)
		document.addEventListener("msvisibilitychange", onchange);
	
	// IE 9 and lower:
	else if ("onfocusin" in document)
		document.onfocusin = document.onfocusout = onchange;
	
	// All others:
	else
		window.onpageshow = window.onpagehide
		= window.onfocus = window.onblur = onchange;

  function onchange (evt) {
    var v = "visible", h = "hidden",
        evtMap = {
          focus:v, focusin:v, pageshow:v, blur:h, focusout:h, pagehide:h
        };

    evt = evt || window.event;
    if (evt.type in evtMap)
		document.body.className = evtMap[evt.type];
    else
	    document.body.className = this[hidden] ? "hidden" : "visible";
		if(busy == 0){
			clearInterval(tid);
			tid = setInterval(function(){EnzowSliderTransitionOne(currentSlide, 'add');},4000);
		}
	}

	// set the initial state (but only if browser supports the Page Visibility API)
	if( document[hidden] !== undefined ){
		onchange({type: document[hidden] ? "blur" : "focus"});
	}

	return document[hidden];
}
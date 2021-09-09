const progressStep = document.querySelector(".pages");
const nextBtnOne = document.querySelector(".firstNext");
const nextBtnTwo = document.querySelector(".next-1");
const nextBtnThree = document.querySelector(".next-2");

const prevBtnOne = document.querySelector(".prev-1");
const prevBtnTwo = document.querySelector(".prev-2");
const prevBtnThree = document.querySelector(".prev-3");

const submitBtn = document.querySelector(".submit");

const progressText = document.querySelectorAll(".step-indicator p");
const progressCheck = document.querySelectorAll(".step-indicator .check");
const section = document.querySelectorAll(".step-indicator .section");
let current = 1;

nextBtnOne.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "-25%";
  section[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnTwo.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "-50%";
  section[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnThree.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "-75%";
  section[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
submitBtn.addEventListener("click", function(){
  section[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;

});

prevBtnOne.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "0%";
  section[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnTwo.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "-25%";
  section[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnThree.addEventListener("click", function(event){
  /* event.preventDefault(); */
  progressStep.style.marginLeft = "-50%";
  section[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});

// Data Picker Initialization
$('.datepicker').datepicker({
    inline: true
  });

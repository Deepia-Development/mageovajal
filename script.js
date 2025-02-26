// const forumSection = document.getElementById("forumSection");
// const forumBtn = document.getElementById("forumBtn");
const emailSection = document.getElementById("emailSection");
const emailInput = document.getElementById("emailInput");
const startBtn = document.getElementById("startBtn");
const quizSection = document.getElementById("quizSection");
const questionForm = document.getElementById("questionForm");
const continueBtn = document.getElementById("continueBtn");
const finalQuizSection = document.getElementById("finalQuizSection");
const continueBtn2 = document.getElementById("continueBtn2");
const fianlSection = document.getElementById("fianlSection");
const unlockBtn = document.getElementById("unlock-btn");
const ageGenderQuiz = document.getElementById("ageGenderQuiz");
const unlockIcon = document.getElementById("unlock-icon");
const acceptTerms = document.getElementById("acceptTerms");
const termsCheckbox = document.getElementById("acceptTerms");
const options = Array.from(document.getElementsByClassName("checkbox"));
const question = document.getElementById("question").textContent;
const router_id = document.getElementById("routerIDiv").getAttribute("data-variable");
const mac1 = document.getElementById("mac1Div").getAttribute("data-variable");
const mac2 = document.getElementById("mac2Div").getAttribute("data-variable");
const router_model = document.getElementById("routerModelDiv").getAttribute("data-variable");
var municipalityName = "Desconocido";

let responses = [];
document.getElementsByClassName("headText")[2].addEventListener("click", function()
{
    responses = [];
})

startBtn.classList.add('disabled-btn');
continueBtn.classList.add('disabled-btn');
continueBtn2.classList.add('disabled-btn');
unlockBtn.classList.add('blue-bg');

startBtn.style.pointerEvents = "none";
continueBtn.style.pointerEvents = "none";
continueBtn2.style.pointerEvents = "none";
//unlockBtn.style.pointerEvents = "none";

termsCheckbox.disabled = true;

function municipalityChange(sel){
    municipalityName = sel.options[sel.selectedIndex].text;
    console.log(municipalityName);
}

emailInput.addEventListener("input", () => {
    const emailValue = emailInput.value.trim();
    const isValidEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailValue);
    
    if (isValidEmail) {
        startBtn.classList.remove('disabled-btn');
        startBtn.classList.add('blue-bg');
        startBtn.style.pointerEvents = "auto";
    } else {
        startBtn.classList.remove('blue-bg');
        startBtn.classList.add('disabled-btn');
        startBtn.style.pointerEvents = "none"
    }
});

// forumBtn.addEventListener("click", (e) => {
//     e.preventDefault();
//     forumSection.style.display = "none"; 
//     emailSection.style.display = "block";
// });

startBtn.addEventListener("click", (e) => {
    e.preventDefault();  
    emailSection.style.display = "none"; 
    quizSection.style.display = "block"; 
});

questionForm.addEventListener("change", () => {
    const selectedOptions = document.querySelectorAll('input[name="objectives"]:checked');
    
    if (selectedOptions.length === 5) {
        continueBtn.classList.remove('disabled-btn');
        continueBtn.classList.add('blue-bg');
        continueBtn.style.pointerEvents = "auto"; 
    } else {
        continueBtn.classList.remove('blue-bg');
        continueBtn.classList.add('disabled-btn');
        continueBtn.style.pointerEvents = "none";
    }
});

continueBtn.addEventListener("click", (e) => {
    e.preventDefault();  
    quizSection.style.display = "none"; 
    finalQuizSection.style.display = "block";
});

ageGenderQuiz.addEventListener("change", () => {
    const genderSelect = document.getElementById("gender");
    const ageSelect = document.getElementById("ageInput");
    const municipalitySelect = document.getElementById("municipality");
    const age = parseInt(ageSelect.value, 10);
    const isAgeValid = age >=5 && age <= 125;
    
    if (genderSelect.value && ageSelect.value && isAgeValid) {
        termsCheckbox.disabled = false; 
    } else {
        termsCheckbox.disabled = true; 
    }
});

termsCheckbox.addEventListener("change", () => {
    const ageSelect = document.getElementById("ageInput");
    const age = parseInt(ageSelect.value, 10);
    const isAgeValid = age >=5 && age <= 125;

    if (termsCheckbox.checked) {
        ageSelect.disabled = true;
        document.getElementById("municipality").disabled = true;
        document.getElementById("gender").disabled = true;
        continueBtn2.classList.remove('disabled-btn');
        continueBtn2.classList.add('blue-bg');
        // unlockIcon.classList.add("fa-wifi");
        continueBtn2.style.pointerEvents = "auto"; 
    } else {
        continueBtn2.classList.remove('blue-bg');
        continueBtn2.classList.add('disabled-btn');
        continueBtn2.style.pointerEvents = "none"; 
    }
});

continueBtn2.addEventListener("click", (e) => {
    e.preventDefault();  
    finalQuizSection.style.display = "none"; 
    fianlSection.style.display = "block"; 
});

unlockBtn.addEventListener("click", (e) => {
    let email = document.getElementById("emailInput").value;
    let municipalityID =  document.getElementById("municipality").value;
    let age =  document.getElementById("ageInput").value;
    let gender =  document.getElementById("gender").value;
    options.forEach(option => {
        if(option.checked){
            responses.push(option.value);
        }        
    });
    responses = JSON.stringify(responses);
    e.preventDefault();  
    unlockIcon.classList.remove("fa-lock"); 
    window.location.href = "successful_connection.php?rid=" + router_id + "&model=" + router_model + "&mac1=" + mac1 + "&mac2=" + mac2 + "&email="+ email + "&question=" + question + "&responses=" + responses + "&municipalityName=" + municipalityName + "&municipalityID=" + municipalityID + "&age=" + age + "&gender=" + gender;
});

/*
const timerSpan = document.getElementById("timer-span");
            const unlockBtn = document.getElementById("unlock-btn");
            const unlockIcon = document.getElementById("unlock-icon");
            const form = document.getElementById("visitWebsiteForm");
            const router_id = document.getElementById("routerIDiv").getAttribute("data-variable");
            const mac1 = document.getElementById("mac1Div").getAttribute("data-variable");
            const mac2 = document.getElementById("mac2Div").getAttribute("data-variable");
            const router_model = document.getElementById("routerModelDiv").getAttribute("data-variable");
            const quiz = document.getElementById("ageGenderQuiz");
            function changeQuiz(){
                if(document.getElementById("genero").selectedIndex != 0 && document.getElementById("edad").selectedIndex != 0){
                    timerSpan.innerHTML = `<i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>Pulsa el botón para conectarte`;
                    unlockBtn.setAttribute("href", "successful_connection.php?rid=" + router_id + "&model=" + router_model  + "&mac1=" + mac1 + "&mac2=" + mac2);
                    unlockBtn.classList.add("blue-bg");
                    unlockIcon.classList.add("fa-wifi");
                    unlockIcon.classList.remove("fa-lock");
                }
                else{
                    timerSpan.innerHTML = `<i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>Completa los pasos para acceder`;
                    unlockBtn.setAttribute("href", "");
                    unlockBtn.classList.remove("blue-bg");
                    unlockIcon.classList.remove("fa-wifi");
                    unlockIcon.classList.add("fa-lock");
                }
            }
            document.getElementById("visit-website-btn").addEventListener("click", function() {
            form.submit();
        });
*/
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Encuesta Jalisco | Conéctate a Internet</title>
  <style>
    /* ======== RESET Y LAYOUT GENERAL ======== */
    html, body {
      margin: 0; 
      padding: 0; 
      width: 100%; 
      height: 100%;
      /* Ojo: 'overflow: hidden' puede tapar el botón en móviles 
         si el teclado o el contenido es muy grande */
      overflow: hidden; 
      font-family: Arial, sans-serif;
      background-color: #1e1e1e; 
      color: #fff; 
    }

    .main-container {
      display: none;        
      width: 100vw; 
      height: 100vh;
      position: relative;   
      background-color: #1e1e1e;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      text-align: center;
    }
    .main-container.active {
      display: flex;
    }

    .timer-container {
      flex-shrink: 0;
      padding: 1em; /* margen superior en desktop */
      background-color: #2c2c2c;
      width: 100%;
      box-sizing: border-box;
    }
    .headText {
      margin: 0;
      font-weight: bold;
    }
    .image-container, .image-container2 {
      flex: 1; 
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.8em; /* margen default en desktop */
      box-sizing: border-box;
      width: 85%;
    }
    .image-container img, .image-container2 img {
      max-width: 85%;
      max-height: 85%;
      object-fit: cover;
    }

    /* ======== BOTÓN FLOTANTE ======== */
    .floating-btn {
      position: fixed;       
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #007BFF;
      color: #fff;
      text-align: center;
      text-decoration: none;
      font-size: 1rem;
      padding: 1em 0;
      border: none;
      cursor: pointer;
      z-index: 9999;
      border-radius: 0;
    }
    .floating-btn:hover {
      background-color: #0056b3;
    }
    .disabled-btn {
      background-color: #555;
      cursor: not-allowed;
    }
    .blue-bg {
      background-color: #007BFF;
    }

    /* ======== FORMULARIOS Y ELEMENTOS ======== */
    form {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 0.4em;
      width: 95%;
      background: #fff;
      color: #000;
      padding: 1em; /* Padding default desktop */
      border-radius: 8px;
      box-sizing: border-box;
    }

    .checkbox {
      transform: scale(1.2); 
    }
    .option-group {
      display: flex;
      gap: 0.20em;
    }
    input[type="email"],
    input[type="number"],
    select {
      width: 80%;
      padding: 0.4em;
      font-size: 1rem;
      margin-bottom: 0.25em;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    #visitWebsiteForm {
      display: none; /* Oculto (opcional) */
    }

    /* Mensaje de alerta en Sección 2 (cuando no son 5 checkboxes) */
    label.alert-form {
      color: red;
      font-size: 0.9rem;
      display: none; /* Por defecto oculto, se mostrará con JS */
    }

    /* Ejemplo para mostrar el estado de OPcache */
    #opcache-status {
      text-align: center;
      padding: 0.25em;
      background: #444;
      font-size: 0.9rem;
    }

    /* ======== MEDIA QUERY PARA MÓVILES ========
       Reduce márgenes y padding a la mitad en pantallas <= 600px
    */
    @media (max-width: 600px) {
      .timer-container {
        padding: 0.5em;
      }
      .image-container, .image-container2 {
        padding: 0.25em;
      }
      form {
        padding: 0.5em;
      }
    }
  </style>
</head>
<body>


<!-- Sección 1 -->
<div id="emailSection" class="main-container active">
  <div class="timer-container">
    <p class="headText" style="font-size:13px;">No cierres esta ventana 1/4</p>
    <span id="timer-span" style="font-size:13px;">Ingresa tu email para liberar internet</span>
  </div>
  <div class="image-container">
    <img id="template-picture" src="GOBJAL-1.webp" alt="Imagen sección 1"  height: 70%; width: 70%; >
  </div>
  <!-- Botón flotante (Comenzar) -->
  <a id="startBtn" class="floating-btn disabled-btn">Comenzar</a>
</div>

<!-- Sección 2 -->
<div id="quizSection" class="main-container">
  <div class="timer-container">
    <p class="headText" style="font-size:13px;">No cierres esta ventana 2/4</p>
    <span id="timer-span" style="font-size:13px;">Contesta el cuestionario para liberar internet</span>
  </div>
  <div class="image-container">
    <form id="questionForm">
      <h2 style="font-size:15px;margin-bottom:10px;" id="question">
        ¿Hacia qué objetivos consideras que tendrían que estar encaminadas 
        las primeras acciones del Gobierno de Jalisco? [selecciona solo 5]
      </h2>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion1" name="objectives" value="1">
        <label for="opcion1">Cuidar el medio ambiente.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion2" name="objectives" value="2">
        <label for="opcion2">Mejorar las carreteras.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion3" name="objectives" value="3">
        <label for="opcion3">Generar mejores empleos.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion4" name="objectives" value="4">
        <label for="opcion4">Mejorar la educación.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion5" name="objectives" value="5">
        <label for="opcion5">Garantizar los derechos para todas las personas.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion6" name="objectives" value="6">
        <label for="opcion6">Cuidar la salud física y mental de la ciudadanía.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion7" name="objectives" value="7">
        <label for="opcion7">Asegurar el derecho a una vida libre de violencias.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion8" name="objectives" value="8">
        <label for="opcion8">Promover la ayuda y el apoyo mutuo entre las comunidades.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion9" name="objectives" value="9">
        <label for="opcion9">Asegurar la paz y la tranquilidad en los lugares públicos.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion10" name="objectives" value="10">
        <label for="opcion10">Eliminar la impunidad y la corrupción.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion11" name="objectives" value="11">
        <label for="opcion11">Acabar con todo tipo de discriminación.</label>
      </div>
      <div class="option-group">
        <input type="checkbox" class="checkbox" id="opcion12" name="objectives" value="12">
        <label for="opcion12">Proteger a la niñez y su integridad.</label>
      </div>
      <label class="alert-form">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
        Debes seleccionar exactamente 5 opciones
      </label>
    </form>
  </div>
  <!-- Botón flotante (Continuar) -->
  <a id="continueBtn" class="floating-btn disabled-btn">Continuar</a>
</div>

<!-- Sección 3 -->
<div id="finalQuizSection" class="main-container">
  <div class="timer-container">
    <p class="headText" style="font-size:13px;">No cierres esta ventana 3/4</p>
    <span id="timer-span" style="font-size:13px;">
      Contesta el cuestionario y acepta las políticas de privacidad para liberar internet
    </span>
  </div>
  <div class="image-container">
    <form id="ageGenderQuiz">
      <label for="municipality">¿En qué municipio vives? *obligatorio</label>
      <select name="municipality" id="municipality" required>
        <option value="">Elegir</option>
                                <option value="1">Acatic</option>
                                <option value="2">Acatlán de Juárez</option>
                                <option value="3">Ahualulco de Mercado</option>
                                <option value="4">Amacueca</option>
                                <option value="5">Amatitán</option>
                                <option value="6">Ameca</option>
                                <option value="8">Arandas</option>
                                <option value="11">Atengo</option>
                                <option value="12">Atenguillo</option>
                                <option value="10">Atemajac de Brizuela</option>
                                <option value="13">Atotonilco el Alto</option>
                                <option value="14">Atoyac</option>
                                <option value="15">Autlán de Navarro</option>
                                <option value="16">Ayotlán</option>
                                <option value="17">Ayutla</option>
                                <option value="19">Bolaños</option>
                                <option value="20">Cabo Corrientes</option>
                                <option value="21">Casimiro Castillo</option>
                                <option value="22">Cihuatlán</option>
                                <option value="23">Cocula</option>
                                <option value="25">Colotlán</option>
                                <option value="26">Concepción de Buenos Aires</option>
                                <option value="27">Cuautitlán de García Barragán</option>
                                <option value="28">Cuautla</option>
                                <option value="29">Cuquío</option>
                                <option value="30">Chapala</option>
                                <option value="31">Chimaltitán</option>
                                <option value="32">Chiquilistlán</option>
                                <option value="33">Degollado</option>
                                <option value="9">El Arenal</option>
                                <option value="37">El Grullo</option>
                                <option value="54">El Limón</option>
                                <option value="70">El Salto</option>
                                <option value="35">Encarnación de Díaz</option>
                                <option value="36">Etzatlán</option>
                                <option value="38">Guachinango</option>
                                <option value="39">Guadalajara</option>
                                <option value="40">Hostotipaquillo</option>
                                <option value="41">Huejúcar</option>
                                <option value="42">Huejuquilla el Alto</option>
                                <option value="44">Ixtlahuacán de los Membrillos</option>
                                <option value="45">Ixtlahuacán del Río</option>
                                <option value="46">Jalostotitlán</option>
                                <option value="47">Jamay</option>
                                <option value="48">Jesús María</option>
                                <option value="49">Jilotlán de los Dolores</option>
                                <option value="50">Jocotepec</option>
                                <option value="51">Juanacatlán</option>
                                <option value="52">Juchitlán</option>
                                <option value="53">Lagos de Moreno</option>
                                <option value="18">La Barca</option>
                                <option value="43">La Huerta</option>
                                <option value="57">La Manzanilla de la Paz</option>
                                <option value="55">Magdalena</option>
                                <option value="58">Mascota</option>
                                <option value="59">Mazamitla</option>
                                <option value="60">Mexticacán</option>
                                <option value="61">Mezquitic</option>
                                <option value="62">Mixtlán</option>
                                <option value="63">Ocotlán</option>
                                <option value="64">Ojuelos de Jalisco</option>
                                <option value="65">Pihuamo</option>
                                <option value="66">Poncitlán</option>
                                <option value="67">Puerto Vallarta</option>
                                <option value="69">Quitupan</option>
                                <option value="71">San Cristóbal de la Barranca</option>
                                <option value="72">San Diego de Alejandría</option>
                                <option value="113">San Gabriel</option>
                                <option value="73">San Juan de los Lagos</option>
                                <option value="74">San Julián</option>
                                <option value="75">San Marcos</option>
                                <option value="76">San Martín de Bolaños</option>
                                <option value="77">San Martín Hidalgo</option>
                                <option value="78">San Miguel el Alto</option>
                                <option value="79">Gómez Farías</option>
                                <option value="80">San Sebastián del Oeste</option>
                                <option value="81">Santa María del Oro</option>
                                <option value="82">Santa María de los Ángeles</option>
                                <option value="83">Sayula</option>
                                <option value="84">Tala</option>
                                <option value="85">Talpa de Allende</option>
                                <option value="86">Tamazula de Gordiano</option>
                                <option value="87">Tapalpa</option>
                                <option value="88">Tecalitlán</option>
                                <option value="89">Techaluta de Montenegro</option>
                                <option value="90">Tecolotlán</option>
                                <option value="91">Tenamaxtlán</option>
                                <option value="92">Teocaltiche</option>
                                <option value="93">Teocuitatlán de Corona</option>
                                <option value="94">Tequila</option>
                                <option value="95">Teuchitlán</option>
                                <option value="96">Tepatitlán de Morelos</option>
                                <option value="97">Tizapán el Alto</option>
                                <option value="98">Tlajomulco de Zúñiga</option>
                                <option value="99">Tolimán</option>
                                <option value="100">Tomatlán</option>
                                <option value="101">Tonalá</option>
                                <option value="102">Tonaya</option>
                                <option value="103">Tonila</option>
                                <option value="104">Totatiche</option>
                                <option value="105">Tototlán</option>
                                <option value="106">Tuxcacuesco</option>
                                <option value="107">Tuxcueca</option>
                                <option value="108">Tuxpan</option>
                                <option value="109">Unión de San Antonio</option>
                                <option value="110">Unión de Tula</option>
                                <option value="111">Valle de Guadalupe</option>
                                <option value="112">Valle de Juárez</option>
                                <option value="114">Villa Corona</option>
                                <option value="115">Villa Guerrero</option>
                                <option value="116">Villa Hidalgo</option>
                                <option value="117">Cañadas de Obregón</option>
                                <option value="118">Yahualica de González Gallo</option>
                                <option value="119">Zacoalco de Torres</option>
                                <option value="120">Zapopan</option>
                                <option value="121">Zapotiltic</option>
                                <option value="122">Zapotitlán de Vadillo</option>
                                <option value="123">Zapotlán del Rey</option>
                                <option value="124">Zapotlanejo</option>
      </select>

      <label>¿Cuál es tu edad?</label>
     <input type="number" min="5" max="125" step="1" id="ageInput" placeholder="5-125" required />

      <label for="gender">¿Cómo te identificas? *Obligatorio</label>
      <select name="gender" id="gender" required>
        <option value="" disabled selected>Elegir</option>
        <option value="Mujer">Mujer</option>
        <option value="Hombre">Hombre</option>
        <option value="Persona no binaria">Persona no binaria</option>
        <option value="Prefiero no decirlo">Prefiero no decirlo</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="emailInput">Email (opcional)</label>
      <input type="email" id="emailInput" placeholder="ejemplo@email.com"/>
      
      <!-- Checkbox Términos con id="acceptTerms" para que el JS lo detecte -->
      <div class="aceptar-terminos" style="margin-top:20px;">
        <label>
          <input type="checkbox" id="acceptTerms" required disabled />
          Acepto los Términos y Condiciones <a href="Aviso_de_privacidad_integral_de_la_SPPC[1].pdf"> terminos y condiciones</a>
        </label>
      </div>
    </form>
  </div>
  <!-- Botón flotante (Continuar) -->
  <a id="continueBtn2" class="floating-btn disabled-btn">Continuar</a>
</div>

<!-- Sección 4 -->
<div id="fianlSection" class="main-container">
  <div class="timer-container">
    <p class="headText" style="font-size:13px;">No cierres esta ventana 4/4</p>
    <span id="timer-span" style="font-size:13px;">Presiona el botón para liberar internet</span>
  </div>
  <div class="image-container2">
    <img id="template-picture" src="3.webp" alt="Imagen Sección final">
  </div>
  <div class="buttons-container" style="margin-bottom:1.5em;">
    <form id="visitWebsiteForm" action="" method="POST">
      <div id="routerIDiv" data-variable="123ABC"></div>
      <div id="routerModelDiv" data-variable="ModelXYZ"></div>
      <div id="mac1Div" data-variable="AA:BB:CC:11:22:33"></div>
      <div id="mac2Div" data-variable="DD:EE:FF:44:55:66"></div>
      <input type="text" name="submitAction" value="hola"/>
      <input type="submit" name="submitWebsite"/>
    </form>
  </div>
  <!-- Botón flotante (Liberar internet) -->
  <a id="unlock-btn" class="floating-btn blue-bg">
    Liberar internet <i id="unlock-icon" class="fa fa-wifi fa-btn" aria-hidden="true"></i>
  </a>
</div>

<script>
  /****************************************
   * REFERENCIAS A LOS ELEMENTOS
   ****************************************/
  const emailSection     = document.getElementById("emailSection");
  const quizSection      = document.getElementById("quizSection");
  const finalQuizSection = document.getElementById("finalQuizSection");
  const fianlSection     = document.getElementById("fianlSection"); // "fianl" por el original
  const startBtn         = document.getElementById("startBtn");
  const continueBtn      = document.getElementById("continueBtn");
  const continueBtn2     = document.getElementById("continueBtn2");
  const unlockBtn        = document.getElementById("unlock-btn");

  const questionForm     = document.getElementById("questionForm");
  const ageGenderQuiz    = document.getElementById("ageGenderQuiz");
  const acceptTerms      = document.getElementById("acceptTerms");
  const municipalitySelect = document.getElementById("municipality");
  const options          = Array.from(document.getElementsByClassName("checkbox"));

  // Router info
  const router_id        = document.getElementById("routerIDiv").getAttribute("data-variable");
  const mac1             = document.getElementById("mac1Div").getAttribute("data-variable");
  const mac2             = document.getElementById("mac2Div").getAttribute("data-variable");
  const router_model     = document.getElementById("routerModelDiv").getAttribute("data-variable");

  // Pregunta y otras variables
  const question         = document.getElementById("question").textContent;
  let municipalityName   = "Desconocido";
  let responses          = [];

  // Para cambiar el municipio
  function municipalityChange(sel){
    municipalityName = sel.options[sel.selectedIndex].text;
    console.log("Municipio:", municipalityName);
  }

  // Activar directamente el botón "Comenzar" sin validar email:
  startBtn.classList.remove('disabled-btn');
  startBtn.classList.add('blue-bg');
  startBtn.style.pointerEvents = "auto";

  // SECCIÓN 1 -> SECCIÓN 2
  startBtn.addEventListener("click", (e) => {
    e.preventDefault();  
    emailSection.style.display = "none"; 
    quizSection.style.display  = "flex"; 
  });

  /****************************************
   * Sección 2: Validar EXACTAMENTE 5 checks
   ****************************************/
  const alertLabel = questionForm.querySelector(".alert-form");
  questionForm.addEventListener("change", () => {
    const selectedOptions = document.querySelectorAll('input[name="objectives"]:checked');
    if (selectedOptions.length === 5) {
      // Ocultamos el label de alerta
      alertLabel.style.display = "none";
      continueBtn.classList.remove('disabled-btn');
      continueBtn.classList.add('blue-bg');
      continueBtn.style.pointerEvents = "auto"; 
    } else {
      // Mostramos alerta si != 5
      alertLabel.style.display = "block";
      continueBtn.classList.remove('blue-bg');
      continueBtn.classList.add('disabled-btn');
      continueBtn.style.pointerEvents = "none";
    }
  });

  // SECCIÓN 2 -> SECCIÓN 3
  continueBtn.addEventListener("click", (e) => {
    e.preventDefault();  
    quizSection.style.display       = "none"; 
    finalQuizSection.style.display  = "flex";
  });

  /****************************************
   * Sección 3: Validar campos 
   ****************************************/
  ageGenderQuiz.addEventListener("change", () => {
    const genderSelect  = document.getElementById("gender");
    const ageInputEl    = document.getElementById("ageInput");
    const age           = parseInt(ageInputEl.value, 10);
    const isAgeValid    = (age >= 5 && age <= 125);

    // Si municipio, género y edad están correctos, habilitar check de Términos
    if (municipalitySelect.value && genderSelect.value && isAgeValid) {
      acceptTerms.disabled = false; 
    } else {
      acceptTerms.disabled = true; 
      acceptTerms.checked  = false;
      continueBtn2.classList.remove('blue-bg');
      continueBtn2.classList.add('disabled-btn');
      continueBtn2.style.pointerEvents = "none";
    }
  });

  // Checkbox de Términos
  acceptTerms.addEventListener("change", () => {
    if (acceptTerms.checked) {
      // Bloqueamos los campos para evitar cambios (opcional)
      document.getElementById("ageInput").disabled = true;
      municipalitySelect.disabled = true;
      document.getElementById("gender").disabled = true;

      continueBtn2.classList.remove('disabled-btn');
      continueBtn2.classList.add('blue-bg');
      continueBtn2.style.pointerEvents = "auto"; 
    } else {
      continueBtn2.classList.remove('blue-bg');
      continueBtn2.classList.add('disabled-btn');
      continueBtn2.style.pointerEvents = "none"; 
    }
  });

  // SECCIÓN 3 -> SECCIÓN 4
  continueBtn2.addEventListener("click", (e) => {
    e.preventDefault();  
    finalQuizSection.style.display = "none"; 
    fianlSection.style.display     = "flex";
  });

  /****************************************
   * Sección 4: "Liberar internet"
   ****************************************/
  unlockBtn.addEventListener("click", (e) => {
    e.preventDefault();

    // Tomar datos
    const email   = document.getElementById("emailInput").value;
    const age     = document.getElementById("ageInput").value;
    const gender  = document.getElementById("gender").value;
    const munID   = municipalitySelect.value;

    // Recopilar checks marcados (Sección 2)
    options.forEach(option => {
      if(option.checked){
        responses.push(option.value);
      }
    });
    responses = JSON.stringify(responses);

    // Redirige con parámetros GET
    window.location.href = 
      "successful_connection.php?" +
      "rid=" + encodeURIComponent(router_id) +
      "&model=" + encodeURIComponent(router_model) +
      "&mac1=" + encodeURIComponent(mac1) +
      "&mac2=" + encodeURIComponent(mac2) +
      "&email=" + encodeURIComponent(email) +
      "&question=" + encodeURIComponent(question) +
      "&responses=" + encodeURIComponent(responses) +
      "&municipalityName=" + encodeURIComponent(municipalityName) +
      "&municipalityID=" + encodeURIComponent(munID) +
      "&age=" + encodeURIComponent(age) +
      "&gender=" + encodeURIComponent(gender);
  });
</script>

</body>
</html>

let paso=1;const pasoInicial=1,pasoFinal=3,cita={nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI()}function mostrarSeccion(){const o=document.querySelector(".mostrar");o&&o.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const e=document.querySelector(".actual");e&&e.classList.remove("actual");document.querySelector(`[data-paso='${paso}']`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(o=>{o.addEventListener("click",o=>{paso=parseInt(o.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}function botonesPaginador(){const o=document.querySelector("#siguiente"),e=document.querySelector("#anterior");1===paso?(e.classList.add("ocultar"),o.classList.remove("ocultar")):3===paso?(o.classList.add("ocultar"),e.classList.remove("ocultar")):(e.classList.remove("ocultar"),o.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginador())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginador())})}async function consultarAPI(){try{const o="http://localhost:3000/api/servicios",e=await fetch(o);mostrarServicios(await e.json())}catch(o){console.log(o)}}function mostrarServicios(o){o.forEach(o=>{const{id:e,nombre:t,precio:c}=o,a=document.createElement("p");a.classList.add("nombre-servicio"),a.textContent=t;const s=document.createElement("p");s.classList.add("precio-servicio"),s.textContent=c;const i=document.createElement("div");i.classList.add("servicio"),i.dataset.idServicio=e,i.onclick=function(){seleccionarServicio(o)},i.appendChild(a),i.appendChild(s),document.querySelector("#servicios").appendChild(i)})}function seleccionarServicio(o){const{servicios:e}=cita;cita.servicios=[...e,o],console.log(cita)}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));
//# sourceMappingURL=app.js.map

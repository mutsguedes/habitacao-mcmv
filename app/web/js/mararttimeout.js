/* global Swal */

//window.setTimeout('checkIfContinue()', 10*60*1000);  //10 minutes
/*window.setTimeout('checkIfContinue()', 5000);  //10 minutes
 
 
 function checkIfContinue()
 {
 /* if(confirm("Do you want to continue?"))
 {
 //window.setTimeout('checkIfContinue()', 10*60*1000);  //start the timer again
 window.setTimeout('checkIfContinue()', 5000);  //10 minutes
 
 }
 else
 {
 window.location = '/';
 }
 }
 */
function idleLogout() {
  var t;
  window.onload = resetTimer;
  window.onmousemove = resetTimer;
  window.onmousedown = resetTimer; // catches touchscreen presses as well
  window.ontouchstart = resetTimer; // catches touchscreen swipes as well
  window.onclick = resetTimer; // catches touchpad clicks as well
  window.onkeydown = resetTimer;
  window.addEventListener("scroll", resetTimer, true); // improved; see comments

  function timeFunction() {
    // your function for too long inactivity goes here
    // e.g. window.location.href = 'logout.php';
    // var user = window.UserContext.userId;
    // currentUserId =
    // var myVariable = html("<? Yii::app()->user->getState('myVariable', '') ?>");
    // alert(myVariable);
    swalWithBootstrapButtons
      .fire({
        title: "<h3>Final de Sessão!!!</h3>",
        icon: "warning",
        text: "Renovar sua Sessão?",
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          '<span class="fa fa-check"></span>&nbsp;&nbsp;Sim, renovar',
        cancelButtonText:
          '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Não, renovar',
        backdrop: "rgba(240,173,78,0.4)",
        allowOutsideClick: false,      })
      .then((result) => {
        if (result.value) {
          // Refresh the page and bypass the cache
          location.reload(true);
          resetTimer;
        } else {
          $.ajax({
            url: "/web/site/logout",
            type: "POST",
          });
        }
      });
  }

  function resetTimer() {
    clearTimeout(t);
    //t = setTimeout(timeFunction, 1000); // 1 segundo time is in milliseconds
    //t = setTimeout(timeFunction, 3000);  // 3 segundos time is in milliseconds
    // t = setTimeout(timeFunction, 180000);  // 3 minutos time is in milliseconds
    //t = setTimeout(timeFunction, 720000); // 12 minutos time is in milliseconds
    t = setTimeout(timeFunction, 1440000); // 24 minutos time is in milliseconds
  }
}
idleLogout();

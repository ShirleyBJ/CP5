//récupération élements
var btnValidate = document.querySelector('#register form');

//Ajout écouteurs
btnValidate.addEventListener('submit', function(evt){
    let pass1 = document.getElementById('pass').value;
    //console.log(pass1);
    let pass2 = document.getElementById('pass2').value;
    //console.log(pass2);

    if(pass1 !== pass2){
        evt.preventDefault();
        alert("Attention ! Les mot de passe ne correspondent pas.");
    }
});







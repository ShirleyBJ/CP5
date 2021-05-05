/**
 * *Fonction appeler lorsque l'on change de langue dans la liste(select): AJAX
 */

document.getElementById('lang').addEventListener('change', function() {
        //step1: instanciation d'un objet 
        let xhr = new XMLHttpRequest();
        //step2: ouverture de la requête AJAX
        xhr.open('GET','ajax-result.php?lang=' + this.value, true);
        //step3:envoie de la requete AJAX
        xhr.send();
        //step4:attend le retour du serveur -> ecoute de l'event readyState
        xhr.addEventListener('readystatechange', function(){
            if(xhr.readyState == 4 &&(xhr.status == 200 || xhr.status == 0)){
                document.getElementById('pays').innerHTML=xhr.responseText;
            }
        });
    }
);
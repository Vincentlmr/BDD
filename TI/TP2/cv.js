var btnfr = document.getElementById('fr');
var btnangl = document.getElementById('angl');
var cvfr = document.getElementById('cv-fr');
var cvangl = document.getElementById('cv-angl');

// Créer et ajouter un attribut "onclick" pour chaque bouton
btnfr.setAttribute('onclick', 'afficherCV(cvfr)');
btnangl.setAttribute('onclick', 'afficherCV(cvangl)');

function afficherCV(cv) {
  // Masquer tous les CV
  var cvs = document.querySelectorAll('.cv');
  for (var i = 0; i < cvs.length; i++) {
    cvs[i].style.display = 'none';
  }

  // Afficher le CV correspondant
  cv.style.display = 'block';
}

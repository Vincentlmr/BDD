var joueur1; // Variable pour stocker le nom du joueur 1
var joueur2; // Variable pour stocker le nom du joueur 2
var pion = 0; // Compteur pour suivre le nombre de pions joués
var tour; // Variable pour suivre le tour en cours
var score1 = 0; // Score du joueur 1
var score2 = 0; // Score du joueur 2

// On récupère les id des boutons
var btn = document.getElementById("jouer"); // Bouton pour lancer le jeu
var btn_r = document.getElementById("recommence"); // Bouton pour redémarrer le jeu 
var btn_col1 = document.getElementById("col1"); // Bouton pour la colonne 1
var btn_col2 = document.getElementById("col2"); // Bouton pour la colonne 2
var btn_col3 = document.getElementById("col3"); // Bouton pour la colonne 3
var btn_col4 = document.getElementById("col4"); // Bouton pour la colonne 4
var btn_col5 = document.getElementById("col5"); // Bouton pour la colonne 5
var btn_col6 = document.getElementById("col6"); // Bouton pour la colonne 6
var btn_col7 = document.getElementById("col7"); // Bouton pour la colonne 7

// Afficher le pseudo du joueur actif
var tourJoueurElement = document.getElementById("a_jouer"); // Élément pour afficher le joueur actif
var zone_j1 = document.getElementById("j1"); // Élément pour afficher les informations du joueur 1
var zone_j2 = document.getElementById("j2"); // Élément pour afficher les informations du joueur 2

// Fonction pour obtenir la couleur d'une case
function getColor(caseElement) {
  if (caseElement.classList.contains("yellow")) {
    return "yellow";
  } else if (caseElement.classList.contains("red")) {
    return "red";
  } else {
    return "empty";
  }
}

// Fonction pour vérifier si une position est valide dans la grille
function isValidPosition(i, j) {
  return i >= 0 && i < 6 && j >= 0 && j < 7;
}

// Fonction pour vérifier si une case a la même couleur que celle spécifiée
function isSameColor(i, j, couleur) {
  const ind = i * 7 + j + 1;
  const caseElement = document.getElementById(ind);
  const color = getColor(caseElement);
  return color !== "empty" && color === couleur;
}

// Fonction pour vérifier si un joueur a gagné
function fin(ind, couleur) {
  const directions = [
    { di: 0, dj: 1 }, // Droite
    { di: 1, dj: 0 }, // Bas
    { di: 1, dj: 1 }, // Diagonale bas-droite
    { di: 1, dj: -1 } // Diagonale bas-gauche
  ];

  const currentCase = document.getElementById(ind);
  const color = getColor(currentCase);

  for (const direction of directions) {
    let count = 1;
    let i = Math.floor((ind - 1) / 7) + direction.di;
    let j = ((ind - 1) % 7) + direction.dj;

    while (
      count < 4 &&
      isValidPosition(i, j) &&
      isSameColor(i, j, couleur)
    ) {
      count++;
      i += direction.di;
      j += direction.dj;
    }

    i = Math.floor((ind - 1) / 7) - direction.di;
    j = ((ind - 1) % 7) - direction.dj;

    while (
      count < 4 &&
      isValidPosition(i, j) &&
      isSameColor(i, j, couleur)
    ) {
      count++;
      i -= direction.di;
      j -= direction.dj;
    }

    if (count >= 4) {
      return true; // Le joueur a gagné
    }
  }

  return false; // Le joueur n'a pas gagné
}

// Fonction pour changer la couleur des cases dans une colonne
function changeColumn(column) {
  let couleur_j = tour === 1 ? "yellow" : "red"; // Couleur du joueur en cours
  let i = column;
  let trouve = 0;

  while (trouve === 0 && i < column + 36) {
    let currentCase = document.getElementById(i);
    if (currentCase.classList.contains("empty")) {
      currentCase.classList.remove("empty");
      currentCase.classList.add(couleur_j);
      trouve = 1; // Une case vide a été trouvée
    } else {
      i += 7; // Passer à la case en dessous
    }
  }

  let btn_col = document.getElementById("col" + (8 - column));
  if (i >= column + 35) {
    btn_col.disabled = true; // Désactiver le bouton de la colonne si celle-ci est pleine
  }

  tour = tour === 1 ? 2 : 1; // Changer de tour

  pion += 1; // Incrémenter le nombre de pions joués

  if (fin(i, couleur_j)) {
    setTimeout(function() {
      let winner = tour === 1 ? joueur2 : joueur1;
      alert("Bravo! " + winner + " a gagné");
      if (winner === joueur1) {
        score1 += 1;
      } else {
        score2 += 1;
      }
      resetGame();
      zone_j1.innerHTML = "Joueur 1 : " + joueur1 + "<br>Score : " + score1;

      zone_j2.innerHTML = "Joueur 2 : " + joueur2 + "<br>Score : " + score2;
    }, 100); // Ajoute un délai de 100 millisecondes
  } else if (pion === 42) {
    alert("Dommage! Egalité");
    resetGame();
  }

  tourJoueurElement.textContent =
    "C'est à " + (tour === 1 ? joueur1 : joueur2) + " de jouer"; // Mettre à jour l'affichage du joueur actif
}

// Fonction pour lancer le jeu
function jeu() {
  console.log("Joue");

  // Obtenir le pseudo du joueur n°1
  joueur1 = document.getElementById("joueur1").value;

  // Obtenir le pseudo du joueur n°2
  joueur2 = document.getElementById("joueur2").value;

  // Choix du premier joueur en aléatoire
  let random = Math.floor(Math.random() * 2) + 1;

  zone_j1.innerHTML = "Joueur 1 : " + joueur1 + "<br>Score : " + score1; // Afficher les informations du joueur 1
  zone_j2.innerHTML = "Joueur 2 : " + joueur2 + "<br>Score : " + score2; // Afficher les informations du joueur 2

  if (random === 1) {
    tourJoueurElement.textContent = "C'est à " + joueur1 + " de jouer"; // Débuter avec le joueur 1
    tour = 1;
  } else {
    tourJoueurElement.textContent = "C'est à " + joueur2 + " de jouer"; // Débuter avec le joueur 2
    tour = 2;
  }
}

function resetGame() {
  // Réinitialiser les variables de jeu
  pion = 0;

  let random = Math.floor(Math.random() * 2) + 1;
  if (random === 1) {
    tourJoueurElement.textContent = "C'est à " + joueur1 + " de jouer";
    tour = 1;
  } else {
    tourJoueurElement.textContent = "C'est à " + joueur2 + " de jouer";
    tour = 2;
  }

  // Sélectionner toutes les cases avec la classe "circle"
  var circles = document.querySelectorAll('.circle');

  // Parcourir chaque case et les remettre à l'état "empty"
  circles.forEach(function(circle) {
    circle.classList.remove('yellow', 'red');
    circle.classList.add('empty');
  });

  // Réactiver tous les boutons de colonne
  var btn_cols = document.querySelectorAll('.col');
  btn_cols.forEach(function(btn_col) {
    btn_col.disabled = false;
  });
}

btn_r.onclick = resetGame;

// Ajouter des événements aux boutons de chaque colonne
btn_col1.onclick = function() {
  changeColumn(7);
};
btn_col2.onclick = function() {
  changeColumn(6);
};
btn_col3.onclick = function() {
  changeColumn(5);
};
btn_col4.onclick = function() {
  changeColumn(4);
};
btn_col5.onclick = function() {
  changeColumn(3);
};
btn_col6.onclick = function() {
  changeColumn(2);
};
btn_col7.onclick = function() {
  changeColumn(1);
};

// Ajouter un événement au formulaire de jeu
document.getElementById("frm").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêche la soumission du formulaire

  // Appel de la fonction jeu
  jeu();

  // Masquer le formulaire
  document.getElementById("frm").style.display = "none";

  // Afficher les boutons
  document.getElementById("boutons").style.display = "block";
  document.getElementById("recommence").style.display = "block";
});

// Fonction pour obtenir la couleur d'une case
function getColor(caseElement) {
  if (caseElement.classList.contains("yellow")) {
    return "yellow";
  } else if (caseElement.classList.contains("red")) {
    return "red";
  } else {
    return "empty";
  }
}

// Fonction pour vérifier si une position est valide dans la grille
function isValidPosition(i, j) {
  return i >= 0 && i < 6 && j >= 0 && j < 7;
}

// Fonction pour vérifier si une case a la même couleur que celle spécifiée
function isSameColor(i, j, couleur) {
  const ind = i * 7 + j + 1;
  const caseElement = document.getElementById(ind);
  const color = getColor(caseElement);
  return color !== "empty" && color === couleur;
}

// Fonction pour vérifier si un joueur a gagné
function fin(ind, couleur) {
  const directions = [
    { di: 0, dj: 1 }, // Droite
    { di: 1, dj: 0 }, // Bas
    { di: 1, dj: 1 }, // Diagonale bas-droite
    { di: 1, dj: -1 } // Diagonale bas-gauche
  ];

  const currentCase = document.getElementById(ind);
  const color = getColor(currentCase);

  for (const direction of directions) {
    let count = 1;
    let i = Math.floor((ind - 1) / 7) + direction.di;
    let j = ((ind - 1) % 7) + direction.dj;

    while (
      count < 4 &&
      isValidPosition(i, j) &&
      isSameColor(i, j, couleur)
    ) {
      count++;
      i += direction.di;
      j += direction.dj;
    }

    i = Math.floor((ind - 1) / 7) - direction.di;
    j = ((ind - 1) % 7) - direction.dj;

    while (
      count < 4 &&
      isValidPosition(i, j) &&
      isSameColor(i, j, couleur)
    ) {
      count++;
      i -= direction.di;
      j -= direction.dj;
    }

    if (count >= 4) {
      return true; // Le joueur a gagné
    }
  }

  return false; // Le joueur n'a pas gagné
}

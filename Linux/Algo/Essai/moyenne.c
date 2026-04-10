#include <stdio.h>

int main() {
   int entierCourant, sommeEntier, nbEntiers;
   
   // Initialisation
   sommeEntier = 0;
   nbEntiers = 0;
   
   // Boucle de traitement
   printf("Veuillez saisir un entier : ");
   while (scanf("%d",&entierCourant) != EOF) // Test de fin de fichier
   {
      sommeEntier = sommeEntier + entierCourant;
      nbEntiers++;
      printf("Veuillez saisir un entier : ");
   }
   
   // Affichage du resultat : reel avec deux decimales
   if (nbEntiers != 0)
      printf("\n\nLa moyenne des entiers saisies est : %.2f\n\n", (float)sommeEntier/nbEntiers); // Cast
   else printf("\n\nAucun entier saisi\n\n");
}
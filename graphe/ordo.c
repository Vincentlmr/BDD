#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

#include "ordo.h"

#define MAX_LINE_SIZE 256

/*
Données :
G[]: Tableau de structures, contenant les sommets du graphe
S[]: sommet trié par niveau
n : nb de sommets
resulat:
Entier: durée
*/

int duree (struct tache* G, int n,int* S){
    return (G[S[n]].date_tot+G[S[n]].durée); // la durée totale se calcul avec la date au plus tot da la dernière tâche dans le tableau trié + sa durée
}

/*Données/ Résultats :
G[]: Tableau de structures, contenant les sommets du graphe
C[]: Tableau des nom des tâches qui sont critiques
n: nb sommets
Variables locales :
i: entier d’indice de boucle
*/

void marge_critique(struct tache* G,int n){
    int i;
    for (i=0;i<=n;i++){
        G[i].marge=G[i].date_tard-G[i].date_tot; // la marge se calcul en faisant la soustraction de la date au plus tot et celle au plus tard
        if(G[i].marge==0){// si la marge est nulle alors la tâche est critique
            G[i].t_critique = 1;

        }
    }
}
    
/*******************************************************************
Données : 
    G : Graphe (n : nombre de sommets) 
Résultat : 
    N[] : Tableau contenant le niveau des sommets 
Locales : 
    change : Booléen indiquant s’il y a eu un changement 
    i, j : Variables de boucle 
    nb: taille du vecteur de predecesseur 
*******************************************************************/

void niveau(struct tache* G, int n, int N[]) {
    int change = 1;
    int i, j;

    // Initialisation du tableau N
    for (i = 1; i <= n; i++) {
        N[i] = 0;
    }

    // Calcul du niveau des sommets
    while (change) {
        change = 0;

        for (i = 1; i <= n; i++) {
            struct maillon* pred = G[i].pred->head;

            while (pred != NIL) {
                j = pred->nom;

                if (N[i] < N[j] + 1) {
                    N[i] = N[j] + 1;
                    change = 1;
                }

                pred = pred->suivant;
            }
        }
    }
}



void ajouter_en_fin_liste(struct tache* G,int i,int j) {
    struct maillon* nouveau;
    struct maillon* courant;
    
    nouveau = (struct maillon*) malloc(sizeof(struct maillon));
    if (nouveau == NIL) {
        fprintf(stderr, "erreur: mémoire saturée\n");
        exit(1);
    }
    
    nouveau->nom = j;
    nouveau->suivant = NIL;
    
    if (G[i].pred->head == NIL) {
        // Si la liste est vide, le nouvel élément devient la tête de liste
        G[i].pred->head = nouveau;
        
    } else {
        // Parcourir la liste jusqu'au dernier élément
        
        courant = G[i].pred->head;
        while (courant->suivant != NIL) {
    
            courant = courant->suivant;
            
        }
        
        // Ajouter le nouvel élément à la fin de la liste
        
        courant->suivant = nouveau;
    }
    
    G[i].pred->nbelem += 1;
}

void ajouter_en_fin_liste2(struct tache* G,int i,int j) {
    struct maillon* nouveau;
    struct maillon* courant;
    
    nouveau = (struct maillon*) malloc(sizeof(struct maillon));
    if (nouveau == NIL) {
        fprintf(stderr, "erreur: mémoire saturée\n");
        exit(1);
    }
    
    nouveau->nom = j;
    nouveau->suivant = NIL;
    
    if (G[i].suc->head == NIL) {
        // Si la liste est vide, le nouvel élément devient la tête de liste
        G[i].suc->head = nouveau;
        
    } else {
        // Parcourir la liste jusqu'au dernier élément
        
        courant = G[i].suc->head;
        while (courant->suivant != NIL) {
    
            courant = courant->suivant;
            
        }
        
        // Ajouter le nouvel élément à la fin de la liste
        
        courant->suivant = nouveau;
    }
    
    G[i].suc->nbelem += 1;
}

/*Acton Afficher
Données/ Résultats :
G[]: Tableau de structures, contenant les sommets du graphe
C[]: Tableau des nom des tâches qui sont critiques
n: nb sommets
Variables locales :
i: entier d’indice de boucle
j: entier indice de boucle
*/
void afficher(struct tache* G,int n){
    int N[MAX_LINE_SIZE];
    int S[MAX_LINE_SIZE];
    printf("\n");
    
    niveau(G,n,N);
    printf(" Tâche |");
    printf(" Niveaux |");
    printf("\n");
    printf(" ----- |");
    printf(" ------- |");
    
    printf("\n");
    for(int i=1;i<=n;i++){
        if(i<10){
            printf("   %d.  |",i);
        }else{
            printf("   %d  |",i);
        }
        printf("    %d    |",N[i]);
        printf("\n");
    }
    
    printf("\n \n");
    
    tri(n,N,S);
    
    printf("Tâches triées |");
    for(int i=1;i<=n;i++){
        printf(" %d |",S[i]);
    }
    printf("\n \n");
    
    bellman_tot( G, n,  S);
    int D= duree(G, n,S);
    
    bellman_tard(G, n, N,D);
    printf("Durée minimal du projet: %d\n \n",D);
    
    marge_critique(G, n);
    
    printf("   Tâche   |");
    printf(" Date_tot  |");
    printf(" Date_tard |");
    printf("   Marge   |");
    printf(" Critique? |");
    printf("\n");
    for(int i=0;i<5;i++){
        printf(" --------- |");
    }
    printf("\n");
    for(int i=1;i<=n;i++){
        if(i<10){
            printf("     %d     |",i);
        }else{
            printf("    %d     |",i);
        }
        if(G[i].date_tot<10){
            printf("     %d     |",G[i].date_tot);
        }else{
            printf("    %d     |",G[i].date_tot);
        }
        
        if(G[i].date_tard<10){
            printf("     %d     |",G[i].date_tard);
        }else{
            printf("    %d     |",G[i].date_tard);
        }
        if(G[i].marge<10){
            printf("     %d     |",G[i].marge);
        }else{
            printf("    %d     |",G[i].marge);
        }
        if(G[i].t_critique==1){
            printf("    oui    |");
        }else{
            printf("    non    |");
        }
        printf("\n");
    }
    printf("\n \n");
    
    printf("Tâches Critiques |");
    
    for(int i=1;i<=n;i++){
        if(G[i].t_critique==1){
            printf(" %d |",i);
        }
    }
    printf("\n");
    

   
}

/*    N[] : un tableau représentant les niveaux des sommets.
    n : le nombre de sommets.

Sortie :

    S[] : un tableau contenant les sommets triés par niveau.

Locales :

    p : position courante dans le tableau S.
    niv : indique le niveau en cours d'examen.
    i : variable de boucle
    */


void tri( int n,int* N, int* S) {
    int p = 0;
    int niv = 0;
    int i;

    while (p <= n) {
        for (i = 0; i <= n; i++) {
            if (N[i] == niv) {
                S[p] = i;
                p++;
            }
        }
        niv++;
    }
}

void clear_liste(struct liste* L) {
    struct maillon* courant;
    struct maillon* suivant;
    int i;

    courant = L->head;
    for (i = 0; i < L->nbelem; i++) {
        suivant = courant->suivant;
        free(courant);
        courant = suivant;
    }
}


void bellman_tot(struct tache* G, int n, int* S) {
    int i, j, k;
    int date_tot_pred;
    struct liste* pred;
    struct maillon* current;
    
    for (k = 1; k <= n ; k++) {
        for (i = 1; i <= n; i++) {
            if (S[i] <= k) {
                pred = G[i].pred;
                current = pred->head;
                
                // Parcours des prédécesseurs de la tâche courante
                while (current != NIL) {
                    
                    j = current->nom;
                    //calcul de la date au plus tot 
                    date_tot_pred = G[j].date_tot + G[j].durée;
                    
                    //Mise à jour de la date au plus tot  si necessaire
                    if (G[i].date_tot < date_tot_pred){
                        G[i].date_tot = date_tot_pred;
                    }

                    current = current->suivant; // passage au predecesseursuivant
                }
            }
        }
    }
}


void bellman_tard(struct tache* G, int n, int* N,int D) {
    int i;
    
    struct maillon* current;

    // Initialisation de la date de fin au plus tard des tâches sans successeurs
    for(i = 1;i<=n;i++){
        if(G[i].suc->head==NIL){
            G[i].date_tard=D-G[i].durée; // cela correpond à prendre la durée minimale du projet et à la soustraire avec la durée de la tâche
            
        }
    }
    // Parcours des tâches en partant de la tâche précédente jusqu'à la première tâche
    for (i = n; i > 0; i--) {
        
        // Récupération de la liste des tâches prédécesseurs de la tâche courante
        current = G[i].pred->head;

        // Parcours des prédécesseurs de la tâche courante
        while (current != NIL) {
            // Vérification si la date au plus tard du prédécesseur est déjà définie c
            
            if((N[current->nom]!=0)&&(G[current->nom].date_tard == 0)){
                // Calcul de la date au plus tard du prédécesseur
            
                G[current->nom].date_tard = G[i].date_tard - G[current->nom].durée;
                
            } else {
                // Mise à jour de la date  plus tard du prédécesseur si nécessaire
                if (G[current->nom].date_tard > G[i].date_tard - G[current->nom].durée) {
                    G[current->nom].date_tard = G[i].date_tard - G[current->nom].durée;
                }
            }
            
            current = current->suivant; // Passage au prédécesseur suivant
        }
    }
}

   

    
    
    

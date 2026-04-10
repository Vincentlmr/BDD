/* abr.h */
#include <stdio.h>
#include <stdbool.h>


struct tache {
 int nom;
 int durée;
 struct liste* pred;
 struct liste* suc;
 int date_tot;
 int date_tard;
 int marge;
 bool t_critique;
};

struct liste {
    struct maillon* head ;
    int nbelem;
};

struct maillon{ 
    char nom ;
    struct maillon* suivant;
};


#define NIL (struct maillon*)0


/* 
 * Constructeur. Initialise son paramètre à la liste vide 
 */


// Le destructeur
extern void clear_liste(struct liste *L);

// recherche du niveau d’un sommet

extern void niveau( struct tache *G,int taille,int*); 

// trie selon les niveaux

extern void tri(int taille, int* ,int*); 





// afficher resultat

extern void afficher(struct tache *G,int taille);

// durée 

extern int duree(struct tache* ,int taille, int*);

// marge critique
extern void marge_critique(struct tache *G,int taille);

// ajouter tache 
extern void ajouter_en_fin_liste( struct tache* , int, int );

extern void ajouter_en_fin_liste2( struct tache* , int, int );

extern void chargement(char* file_name,struct tache* G, int* n);

extern void bellman_tot(struct tache* , int , int* );

// bellman date au plus date_tard
extern void bellman_tard(struct tache* , int, int*, int );


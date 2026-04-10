/*
 *  chargement.c
 *
 *  Created by Bernard Carré
 *
 *  Ce squelette de code ne fait que lire les données d'un fichier au format DIMACS du projet et les reafficher.
 *
 *  Vous en inspirer pour construire votre SD a partir des donnees ainsi obtenues
 *  en incrustant les lignes de code necessaires.
 *
 *  Un main de test est fourni, a parametrer par un fichier DIMACS :
 *  > gcc -o main chargement.c
 *  > main fichier-dimacs
 *
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

#include "ordo.h"

#define MAX_LINE_SIZE 256
/*
 * Extrait les donnees du fichier de nom file_name et les reaffiche.
 * Provoque une erreur si le fichier est inaccessible.
 */
void chargement(char* file_name,struct tache* G, int* n) {    
    char ligne[MAX_LINE_SIZE]; // pour le passage de ligne
    int nb_noeuds; // nombre de noeuds
        
    // Acces au fichier.
    FILE* fp = fopen(file_name,"r");
    if (fp==NULL) {
        fprintf(stderr, "%s non accessible\n", file_name);
        exit(1);
    }
        
    // Lecture du fichier
    
    // 'c nom du probleme' en ligne de commentaire, on passe ...
    fgets(ligne,MAX_LINE_SIZE,fp);

    // 'p nombre de noeuds'
    fgetc(fp);fgetc(fp); //on passe l'entete 'p '
    fscanf(fp,"%d",&nb_noeuds);
    *n=nb_noeuds;
    printf("nombre de noeuds = %d\n", nb_noeuds);

    // Lecture des noeuds : lignes 'v num_noeud duree' 
    {
        int num_noeud; 
        int duree;
        
        for(num_noeud=1; num_noeud<=nb_noeuds; num_noeud++) {
            fgetc(fp);fgetc(fp); //on passe l'entete 'v '
            fscanf(fp,"%d",&num_noeud);
            G[num_noeud].nom=num_noeud;
            fscanf(fp,"%d",&duree);
            // on initialise toutes les composantes de chaques tâches à 0
            G[num_noeud].durée=duree;
            G[num_noeud].date_tard=0;
            G[num_noeud].date_tot=0;
            G[num_noeud].marge=0;
            G[num_noeud].t_critique=0;
            G[num_noeud].pred = (struct liste*) malloc(sizeof(struct liste));
            G[num_noeud].suc = (struct liste*) malloc(sizeof(struct liste));
            G[num_noeud].pred->head = NIL;
            G[num_noeud].suc->head = NIL;
            G[num_noeud].pred->nbelem = 0;
        }
    }

    // Lecture des arcs : lignes 'a num_pred num_noeud'
    {
        int num_pred; 
        int num_noeud;
        char c;

        fgets(ligne,MAX_LINE_SIZE,fp); // passage a la ligne
        c=fgetc(fp);
        while(c=='a') {
            fscanf(fp, "%d", &num_pred);
            fscanf(fp, "%d", &num_noeud);
            // on ajoutes les predecesseurs et successeurs 
            ajouter_en_fin_liste(G,num_noeud,num_pred);
            ajouter_en_fin_liste2(G,num_pred,num_noeud);
            
            fgets(ligne,MAX_LINE_SIZE,fp); // passage a la ligne
            c=fgetc(fp);
        }	
        
    }
    
    

    fclose(fp);
}


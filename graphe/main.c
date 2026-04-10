/*main.c */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

#include "ordo.h"

#define MAX_LINE_SIZE 256


    

int main(int argc, char *argv[]) {
    struct tache G[MAX_LINE_SIZE];
    int n;


    if(argc!=2) {
        fprintf(stderr, "Usage: main fichier-dimacs\n");
        exit(1);
    }
    // on initialise
    chargement(argv[1],G,&n);
    
    // on affiche
    afficher(G,n);
    
    // on clear 
    for(int i=1;i<=n;i++){
        clear_liste(G[i].pred);
        clear_liste(G[i].suc);
        free(G[i].pred);
        free(G[i].suc);
    }

    return(0);
}


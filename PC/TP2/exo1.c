#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
int main() {
    printf("lancement de la commande ls\n");
    if (execlp("ls", "ls", "-l", NULL) == -1) {
        perror("echec execlp");
        exit(1);
    }
    return 0 ;
}

// on obtient  le chemin de ls. Elle remplace le programme en cours d'exécution par le programme spécifié.

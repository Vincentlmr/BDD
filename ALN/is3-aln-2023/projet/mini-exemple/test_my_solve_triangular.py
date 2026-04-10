# test_my_solve_triangular

import numpy as np
from my_solve_triangular import my_solve_triangular

def test_my_solve_triangular_1 () :
    A = np.array ([[2, 0, 0], [3, 5, 0], [-1, 6, -2]], dtype=np.float64)
    x = np.array ([3, 8, -31], dtype=np.float64)
    b = np.dot (A, x)
    xbar = my_solve_triangular (A, b)
    assert (np.allclose (x,xbar)), "bug dans my_solve_triangular"

# La liste L des fonctions définies ci-dessus (à adapter !)

L = [test_my_solve_triangular_1]

# A partir d'ici, il n'y a plus rien à changer.
# La boucle suivante exécute chaque test et compte les succès.
nb_succès = 0
nb_échecs = 0
for test in L :
    print ('Exécution de', test.__name__, end='')
    try:
        test ()
        nb_succès += 1
        print (' : succès')
    except:
        nb_échecs += 1
        print (' : échec')

# Synthèse des résultats
print ('Nombre de tests  :', len(L))
print ('Nombre de succès :', nb_succès)
print ("Nombre d'échecs  :", nb_échecs)


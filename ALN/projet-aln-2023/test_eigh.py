# test_my_solve_triangular

import numpy as np
import scipy.linalg as nla
from eigh import vap_vep

def test_eigh_1 () :
    A = np.array ([[2, 0, 0], [3, 5, 0], [-1, 6, -2]], dtype=np.float64)
    m, n = A.shape
    for k in range (0,n) :
        A[:,k] = A[:,k] - np.average(A[:,k])

    
    C = 1/(n-1) * np.dot (np.transpose (A), A)
    b = nla.eigh(C)
    x = b[0]
    c = vap_vep(C)
    xbar = c[0]
    assert (np.allclose (x,xbar)), "bug dans eigh"

def test_eigh_2 () :
    A = np.array ([[2, 0, 0], [3, 5, 0], [-1, 6, -2]], dtype=np.float64)
    m, n = A.shape
    for k in range (0,n) :
        A[:,k] = A[:,k] - np.average(A[:,k])
    
   
    C = 1/(n-1) * np.dot (np.transpose (A), A)
    b = nla.eigh(C)
    x = abs(b[1])
    c = vap_vep(C)
    xbar = abs(c[1])
    assert (np.allclose (x,xbar)), "bug dans eigh"

# La liste L des fonctions définies ci-dessus 

L = [test_eigh_1,test_eigh_2]



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


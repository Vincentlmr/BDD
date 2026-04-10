# my_solve_triangular

import numpy as np

# my_solve_triangular reproduit une partie de la fonction suivante avec
# une interface compatible

# scipy.linalg.solve_triangular(a, b, trans=0, lower=False, unit_diagonal=False, overwrite_b=False, check_finite=True)

# Résout A . x = b où A est une matrice triangulaire
#         trans : 'N' ou 'T' (indique s'il faut transposer A ou pas)
#         lower : True ou False (indique où sont les données)
# unit_diagonal : True ou False
# Retourne le vecteur x solution

def my_solve_triangular (A, b, trans='N', lower=True, unit_diagonal=False) :
    m = A.shape[0]
    x = np.empty (m, dtype=np.float64)
    if trans == 'N' :
        if lower :
            for i in range (0, m) :
                x[i] = b[i]
                for j in range (0, i) :
                    x[i] = x[i] - A[i,j] * x[j]
                x[i] = x[i] / A[i,i]
        else :
            raise ValueError ("pas encore implémenté")
    else :
        raise ValueError ("pas encore implémenté")
    return x



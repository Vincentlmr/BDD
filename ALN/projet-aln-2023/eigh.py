import numpy as np
import scipy.linalg as nla



def hessenberg(matrix):
    # Calcul de la forme de Hessenberg d'une matrice
    n = matrix.shape[0]
    hessenberg_matrix = matrix.copy().astype(float)
    for k in range(1, n - 1):
        x = hessenberg_matrix[k:, k-1]
        v = x.copy()
        v[0] += np.sign(v[0]) * np.sqrt(np.dot(v, v))  
        v = v / nla.norm(v)
        hessenberg_matrix[k:, k-1:] -= 2 * np.outer(v, np.dot(v, hessenberg_matrix[k:, k-1:]))
        hessenberg_matrix[:, k:] -= 2 * np.outer(np.dot(hessenberg_matrix[:, k:], v), v)
    return hessenberg_matrix

def qr_decomposition(matrix):
    # Décomposition QR d'une matrice
    m, n = matrix.shape
    q = np.zeros((m, n))
    r = np.zeros((n, n))

    for j in range(n):
        v = matrix[:, j].copy()
        for i in range(j):
            r[i, j] = np.dot(q[:, i], matrix[:, j])
            v -= r[i, j] * q[:, i]
        r[j, j] = nla.norm(v)
        q[:, j] = v / r[j, j]

    return q, r

def qr_algorithm(matrix, max_iterations=1000, tolerance=1e-10):
    # Algorithme QR pour calculer les valeurs propres d'une matrice
    n = matrix.shape[0]
    eigenvalues = np.zeros(n)
    for i in range(max_iterations):
        q, r = qr_decomposition(matrix)
        matrix = np.dot(r, q)
        eigenvalues_new = np.diag(matrix)
        eigenvalues = eigenvalues_new
    return eigenvalues


'''def QR_opti(A0, epsilon):
    # Calcul des valeurs propres d'une matrice avec l'algorithme QR optimisé
    A = hessenberg(A0)
    m = A.shape[0]
    K1 = m - 1

    while K1 > 1:
        K0 = K1
        while K0 > 2 and abs(A[K0, K0-1] > epsilon):
            K0 = K0 - 1
        if K0 == K1:
            yield A[K1, K1]
            K1 = K1 - 1
        else:
            mu = A[K1, K1]
            B = A[K0:K1+1, K0:K1+1] - mu * np.eye(K1-K0+1)
            Q, R = nla.qr(B)
            B = np.dot(R, Q)
            A[K0:K1+1, K0:K1+1] = B + mu * np.eye(K1-K0+1)

    yield A[1, 1]'''


def custom_solve(A, eigenvalue, x):
    # Résolution d'un système linéaire avec une valeur propre donnée
    n = A.shape[0]
    augmented_matrix = np.concatenate((A - eigenvalue * np.eye(n), x[:, np.newaxis]), axis=1)

    # Étape de réduction
    for i in range(n):
        # Vérifie si le pivot est nul
        if augmented_matrix[i, i] == 0:
            # Cherche un pivot non nul dans les lignes en dessous
            for j in range(i+1, n):
                if augmented_matrix[j, i] != 0:
                    augmented_matrix[[i, j]] = augmented_matrix[[j, i]]
                    break
            else:
                raise ValueError("Système linéaire indéterminé ou impossible à résoudre.")

        # Réduit le pivot à 1
        augmented_matrix[i] /= augmented_matrix[i, i]

        # Soustrait le pivot de chaque ligne en dessous
        for j in range(i+1, n):
            factor = augmented_matrix[j, i]
            augmented_matrix[j] -= factor * augmented_matrix[i]

    # Étape de rétro-substitution
    solution = np.zeros(n)
    for i in range(n-1, -1, -1):
        solution[i] = augmented_matrix[i, -1]
        for j in range(i+1, n):
            solution[i] -= augmented_matrix[i, j] * solution[j]

    return solution


def inverse_power_iteration(A, eigenvalue, tolerance=1e-10, max_iterations=1000):
    # Méthode de la puissance inverse pour trouver le vecteur propre correspondant à une valeur propre donnée
    n = A.shape[0]
    x = np.ones(n)
    x = x / nla.norm(x)
    for i in range(max_iterations):
        x = custom_solve(A - eigenvalue * np.eye(n), eigenvalue, x)#remplace nla.solve
        x = x / nla.norm(x, 2)
    return x


def vap_vep(A):
    # Calcul des valeurs propres et vecteurs propres d'une matrice
    eigenvectors = []
    eigenvalue = []
    
    hessenberg_matrix = hessenberg(A) #remplace la fonction nla.hessenberg
    
    eigenvalues = qr_algorithm(hessenberg_matrix) #remplace la fonction nla.qr
    eigenvalues = np.flip(eigenvalues)
    
    for eigenvalue in eigenvalues:
        eigenvector2 = inverse_power_iteration(A, eigenvalue)
        eigenvectors.append(eigenvector2)

    matrix = np.vstack(eigenvectors)
    matrix = np.transpose(matrix)

    return eigenvalues, matrix



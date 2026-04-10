#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Sun May 28 12:48:17 2023

@author: vlemeur
"""

import numpy as np
import scipy.linalg as nla

from bidiagonale import *
from eigh import *

A =np.array([[-7/10,-109/25,1/50],[7/10,-31/25,209/50],[23/10,-49/25,161/50],[-23/10,-91/25,49/50]])


print("---------------------Méthode nla.svd----------------------------------")
np.set_printoptions(linewidth=160)

m, n = A.shape
for k in range (0,n) :
    A[:,k] = A[:,k] - np.average(A[:,k])
    
    
C = 1/(n-1) * np.dot (np.transpose (A), A)

lmbda,Q=nla.eigh(C)
print("Les valeurs propres à trouver:")
print(lmbda)


print("Vecteurs propres à trouver :")
print(Q)
vap,vep=vap_vep(C)
print("Valeurs propres du test:")
print(vap)
print("Vecteurs propres du test :")
print(vep)

print("---------------Programme de la Méthode nla.svd-------------------------")

U, Sigma, Vt = nla.svd(A, full_matrices=False)
print("Le U à trouver:")
print(U)
print("Le Sigma à trouver:")
print(Sigma)
print("Le Vt à trouver:")
print(Vt)


U, Sigma, Vt = decom_val_sing(A)
print("Le U du test:")
print(U)
print("Le Sigma du test:")
print(Sigma)
print("Le Vt du test:")
print(Vt)



#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Sat May 27 09:53:31 2023
@author: idepagne
"""

import numpy as np
import scipy.linalg as nla




# m, n = A.shape
# for k in range (0,n) :
#     A[:,k] = A[:,k] - np.average(A[:,k])

#test avec exemple du cour
#A =np.array([[-7/10,-109/25,1/50],[7/10,-31/25,209/50],[23/10,-49/25,161/50],[-23/10,-91/25,49/50]])





def reflecteur(p, v):
    """
    Calcule la matrice de réflexion de Householder.
    """
    y = v.shape[0]
    F = np.eye(y) - 2 * np.outer(v, v)
    Q = np.eye(p, dtype=np.float64)
    Q[p - y:p, p - y:p] = F
    return Q



def decom_val_sing(A):
    """
    Décomposition en valeurs singulières (SVD) pour une matrice A.

    Args:
        A (numpy.ndarray): La matrice à décomposer.

    Returns:
        tuple: Un tuple contenant les matrices U, Sigma et Vt.
    """
    m, n = A.shape
    B = np.copy(A)
    x = B[0:m, 0]
    v = np.copy(x)
    v[0] = v[0] + np.sign(v[0]) * nla.norm(x, 2)
    v = (1 / nla.norm(v, 2)) * v
    VL = [v]
    Q = reflecteur(m, v)
    B = np.dot(Q, B)
    x = B[0, 1:n]
    v = np.copy(x)
    v[0] = v[0] + np.sign(v[0]) * nla.norm(x, 2)
    v = (1 / nla.norm(v, 2) )* v
    VR = [v]
    Q = reflecteur(n, v)
    B = np.dot(B, Q)
    x = B[1:m, 1]
    v = np.copy(x)
    v[0] = v[0] + np.sign(v[0]) * nla.norm(x, 2)
    v = (1 / nla.norm(v, 2) )* v
    VL.append(v)
    Q = reflecteur(m, v)
    B = np.dot(Q, B)#B est la matrice bidiagonal de A Ici que la bidiagonal nous importe les autres elements importe
    B=B[0:n,0:n]#pour cette methode il nous faut une matrice carré
    H=np.zeros([2*n,2*n],dtype=np.float64)#calcul H meme si pas obligatoire plus facile
    H[0:n,n:2*n]=np.transpose(B)
    H[n:2*n,0:n]=B
    P=np.zeros([2*n,2*n],dtype=np.float64)#calcul P meme si pas obligatoire plus facile
    for i in range(0,n):
        P[i,2*i]=1
        P[n+i,2*i+1]=1
    
    T=np.dot(np.transpose(P),np.dot(H,P))#Calcule la matrice trdiagonale T
    d=np.zeros(2*n,dtype=np.float64)
    e=np.array([T[i+1,i]for i in range (0,2*n-1)],dtype=np.float64)
    eigvals, eigvecs=nla.eigh_tridiagonal(d, e)
    Lambda=eigvals[n:2*n]#recuperation des valeur propre positif
    Q=eigvecs[:,n:2*n]#vecteur propre corespondant a lambda
    Y=np.sqrt(2)*np.dot(P,Q)
    newVt=np.transpose(Y[0:n,:])
    newVt = newVt[::-1]
    newU=np.zeros([m,n],dtype=np.float64)
    newU[0:n,:]=Y[n:2*n,:]
    newSigma=np.array(np.diag(Lambda),dtype=np.float64)#dans l'odre croisant
    newSigma= np.flip(newSigma)#pour correspondre a svd de base
    for i in range (len(VL)-1,-1,-1):#Attention au borne qui doit commencer a len(VL)-1 et pas a n-1
        Q=reflecteur(m,VL[i])
        newU=np.dot(Q,newU)
        
        
        
    for i in range(len(VR)-1,-1,-1):#Attention au borne qui doit commencer a len(VR)-1 et pas a n-3
        Q=reflecteur (n, VR[i])
        newVt=np.dot(newVt,Q)
    #newA=np.dot(newU,np.dot(newSigma, newVt))#on verrifie bien que new A est egale A 
    Sig=newSigma.diagonal()
    return newU,Sig,newVt

# U, Sigma, Vt = decom_val_sing(A)

# print(U)
# print(Sigma)
# print(Vt)



# U, Sigma, Vt = nla.svd(A, full_matrices=False)
# print(U)
# print(Sigma)
# print(Vt)


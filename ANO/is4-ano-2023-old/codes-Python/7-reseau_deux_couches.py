#!/bin/python3

import autograd as ag
import autograd.numpy as np

A = np.array ([[0,0,1],[0,1,1],[1,0,1],[1,1,1]], dtype=np.float64)
y = np.array ([0,0,1,1], dtype=np.float64)
p, m = A.shape

def sigmoid (w) :
    return 1. / (1. + np.exp (- w))

def reseau (w, A) :
    l0 = A
    A_w = np.dot (A, w)
    l1 = sigmoid (A_w)
    return l1

# Les deux fonctions suivantes pourraient recevoir A et y en paramètre
def residuel (w) :
    return y - reseau (w, A)

def objectif (w) :
    r = residuel (w)
    return 1/2 * np.sum (r*r)

g = ag.grad (objectif)

# Poids aléatoires initialement pris entre -1 et 1
np.random.seed (1)
w = 2 * np.random.random (m) - 1.
for i in range (1000) :
    h = - g (w)
    w = w + h

for i in range (0, p) :
    a = A[i,:] ; print (a, '->', reseau (w, a))

a = np.array ([1,0,0]) ; print (a, '->', reseau (w, a))
a = np.array ([1,1,0]) ; print (a, '->', reseau (w, a))
a = np.array ([0,1,0]) ; print (a, '->', reseau (w, a))
a = np.array ([0,0,0]) ; print (a, '->', reseau (w, a))



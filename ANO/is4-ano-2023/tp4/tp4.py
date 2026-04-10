#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Wed Dec 13 10:20:30 2023

@author: vlemeur
"""

import autograd as ag
import autograd.numpy as np
import matplotlib.pyplot as plt

def f(a,b):
    return a**3+2*a**2-2*a*b+b**2+a*b**3-2*b+5

def c(a,b):
    return a**2+b**2-1/2

print( 'Question 1:')
print()

print('L(a,b,lambda) = f(a,b) + lambda * c(a,b)')
print()

print('************************************************************************')

print()
print( 'Question 2:')
print()

print('On peut distinguer les vecteurs gradients de la contrainte et ceux des courbes de niveau sur la figure:')
print('- En effet les petits correspondent au gradient de la contrainte')
print('- Et les grands au gradient de lobjectif')


print()

print('************************************************************************')

print()
print( 'Question 3:')
print()

print('u5 est un point stationnaire (soit un minimum soit un maximum) ')

print('La direction du gradient de u5 est la plus grane pente montante.')
print('Donc c est un minimum local.')

print('Entre u3 et u4 on à aussi un point stationnaire')

print('************************************************************************')

print()
print( 'Question 8:')
print()

print('************************************************************************')

print()
print( 'Question 4:')
print()

print('Non, le minimum local ne satisfait pas la contrainte')
print('Oui, la contrainte sera active')
print('c(a,b) = a**2 + b**2 - 1/2')

print()

print('************************************************************************')

print()
print( 'Question 5:')
print()

print('Graphiquement on trouve les points (0.17,0.7) comme minimum local')
print('Et (0.5, -0.6)')

print()

print('************************************************************************')

print()
print( 'Question 6:')
print()
print('************************************************************************')

print()
print( 'Question 8:')
print()
def nabla_c(a,b):
    return np.array([2*a,2*b],dtype=np.float64)

print(nabla_c(0.17,0.66))
a=np.array([0.17,0.68],dtype=np.float64)
print(nabla_c(0.68,-0.5))
b=np.array([0.5,-0.5],dtype=np.float64)
print()

print('************************************************************************')

print()
print( 'Question 7:')
print()

print('Voir graphe.py')
print()

print('************************************************************************')

print()
print( 'Question 8:')
print()

def Lagrangien(u):
    a=u[0]
    b=u[1]
    lmbda=u[2]
    return f(a,b)+lmbda*c(a,b)

print('************************************************************************')

print()
print( 'Question 9:')
print()

print('premier point:')
u1=np.array([a[0],a[1],0],dtype=np.float64)
nabla_Lagrangien1= ag.grad(Lagrangien)(u1)
H_Lagrangien1=ag.hessian(Lagrangien)(u1)
print('nabla_Lagrangien :', nabla_Lagrangien1)
print('H_Lagrangien :')
print( H_Lagrangien1)

print()
print('Deuxième point:')

u2=np.array([b[0],b[1],0],dtype=np.float64)
nabla_Lagrangien2= ag.grad(Lagrangien)(u2)
H_Lagrangien2=ag.hessian(Lagrangien)(u2)
print('nabla_Lagrangien :', nabla_Lagrangien2)
print('H_Lagrangien :')
print( H_Lagrangien2)

print('************************************************************************')

print()
print( 'Question 10:')
print()

def nabla_f (a,b) :
    return np.array ([b**3 + 3*a**2 + 4*a - 2*b, 
                      3*a*b**2 - 2*a + 2*b - 2], dtype=np.float64)

print('Pour le 1er point')
print()
for i in range(6):
    a=u1[0]
    b=u1[1]
    lmbda=u1[2]
    z =Lagrangien(u1)
    print('u[%d]='%i,u1,'f(u[%d]) ='%i,z)
    H= H_Lagrangien1
    g= nabla_Lagrangien1
    h=np.linalg.solve(-H,g)
    u1=u1+h
    grad_f=nabla_f(a,b)
    grad_c=nabla_c(a,b)
    grad_f=(1/np.linalg.norm(grad_f,2))*grad_f
    grad_c=(1/np.linalg.norm(grad_c,2))*grad_c
    print('      nabla f normalisé =', grad_f)
    print('      nabla c normalisé =', grad_c)
    print('      valeur de la contrainte =',c(a,b))

print()
print('Pour le 2eme point')
print()
for i in range(6):
    a=u2[0]
    b=u2[1]
    lmbda=u2[2]
    z =Lagrangien(u1)
    print('u[%d]='%i,u2,'f(u[%d]) ='%i,z)
    H= H_Lagrangien1
    g= nabla_Lagrangien1
    h=np.linalg.solve(-H,g)
    u2=u2+h
    grad_f=nabla_f(a,b)
    grad_c=nabla_c(a,b)
    grad_f=(1/np.linalg.norm(grad_f,2))*grad_f
    grad_c=(1/np.linalg.norm(grad_c,2))*grad_c
    print('      nabla f normalisé =', grad_f)
    print('      nabla c normalisé =', grad_c)
    print('      valeur de la contrainte =',c(a,b))


print('************************************************************************')

print()
print( 'Question 11:')
print()

def objectif(v):
    x1,x2,x3,x4,x5,y1,y2,y3,y4,y5=v
    z=4000*x1+5000*x2
    w=8*y1+7*y2+3*y3
    return (z-w)**2

print('************************************************************************')

print()
print( 'Question 12:')
print()
def contraintes(v):
    x1,x2,x3,x4,x5,y1,y2,y3,y4,y5=v
    return np.array([2*x1+x2+x3-8,
    x1+2*x2+x4-7,
    x2+x5-3,
    2*y1+y2+y4-4000,
    y1+2*y2+y3+y5-5000,
    x1*y4,
    x2*y5,
    x3*y1,
    x4*y2,
    x5*y3])

print('************************************************************************')

print()
print( 'Question 13:')
print()

print('Il faut 10 multiplicateurs de Lagrange')
print('Il faut donc 20 variables en tout')
print()
def lagrangien(u):
    v=u[0:10]
    lmbda=u[10:20]
    return objectif(v)+np.dot(lmbda,contraintes(v))

print('************************************************************************')

print()
print( 'Question 14:')
print()

u = np.array([3,2,0,0,1,1000,2000,0,0,0,0,0,0,0,0,0,0,0,0,0],dtype=np.float64)
print('On prend u =', u)

lagrangien(u)
    
    



#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Thu Oct 13 10:20:58 2022

@author: vlemeur
"""

import numpy as np
import matplotlib.pyplot as plt

 #from Tp2 import eval_Horner

x=np.array([1,2,3,5],dtype=np.float64)
y=np.array([1,4,2,5],dtype=np.float64)

A=np.vander(x,4,increasing=True)

poly=np.linalg.solve(A,y)

#rint(eval_Horner(3, x))

#----------------------------------------------------------------------------#
'Horner'

def eval_Horner(x,A):
    n=len(A)-1
    y=A[n]
    for i in range(n-1,-1,-1):
        y=y*x+A[i]
    return y

#----------------------------------------------------------------------------#


#-----------------------------------------------------------------------------#
#                        1                                                    #
#-----------------------------------------------------------------------------#

def Vandermonde(x):
    n=len(x)
    A=np.empty([n,n])
    for i in range(n):
        
        for j in range(n):
            A[i,j]=x[i]**j
        return A
    
#-----------------------------------------------------------------------------#
#                       2                                                     #
#-----------------------------------------------------------------------------#    
    
def eval_Neuville(x,y,z):
    n=len(x)-1
    P=np.empty([n+1,n+1],dtype=np.float64)
    for i in range(0,n+1):
        P[i,0]=y[i]
    for j in range(1,n+1):
        for i in range(j,n+1):
            P[i,j]=((x[i]-z)*P[i-1,j-1]+(z-x[i-j]*P[i,j-1]))/(x[i]-x[i-j])
    return(P[n,n])

#-----------------------------------------------------------------------------#
#                       2.2                                                   #
#-----------------------------------------------------------------------------#


#Tableau de coefficients

def tableau_des_différences_divisées(x,y):
    n=len(x)-1
    c=np.empty([n+1,n+1],dtype=np.float64)
    for i in range(0,n+1):
        c[i,0]=y[i]
    for j in range(1,n+1):
        for i in range(j,n+1):
            c[i,j]=(c[i,j-1]-c[i-1,j-1])/(x[i]-x[i-j])
    return c

''' Test eval Newton avec Neuville 


def eval_Newton1(x,z,c):
    n=len(x)-1
    P=np.empty([n+1,n+1],dtype=np.float64)
    P[0,0]=c[0,0]
    for i in range(1,n+1):
        temp=c[i,i]
        for j in range(i):
            temp=temp(z-x[j-1])
        P[i,i]=P[i-1,i-1]+temp
    return(P)

'''


    
def eval_Newton_interp(x,z,c):
    n=len(x)-1
    y=c[n,n]
    #print('lui c le 1er y,',y)
    for i in range(n-1,-1,-1):
        y=y*(z-x[i])+c[i,i]
        #print('lui c le 2ème y,',y)
    return y  

#def eval_Newton


#print(eval_Neuville(x, y, 0))
#print(eval_Newton_interp(x, 0, c))
        

#-------------------------------------------------------------
# Test
#-------------------------------------------------------------
  
# Je prends P(x)=x²-2x+1

x = np.array ([-5,-3,-2,1,2,3,5], dtype=np.float64) 
y = np.array ([36,16,9,0,1,4,16], dtype=np.float64)

plt.scatter (x, y, color="green", label="points à interpoler")
xplot = np.linspace (x[0]-.5, x[-1]+.5, 40)
c = tableau_des_différences_divisées (x, y)
yplot = np.array ([eval_Newton_interp(x, z, c) for z in xplot])
plt.plot (xplot, yplot, color="red", label="graphe du polynôme d’interpolation")
plt.legend ()
plt.show ()
  
            



            
            


'''for i in range(0,x.shape[0]):
    y_calc=eval_Horner(x[i],poly)
    assest(y_calc==y[i])'''
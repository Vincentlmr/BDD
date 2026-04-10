#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Tue Oct 18 10:18:15 2022

@author: vlemeur
"""

import matplotlib.pyplot as plt
import numpy as np
import scipy.interpolate 
#from Tp3 import eval_Newton_interp
#from Tp3 import tableau_des_différences_divisées

x=np.array([1,2,3,4,5,6,7,8,9,10,11,12],dtype=np.float64)
y=np.array([8.6,7,6.4,4,2.8,1.8,1.8,2.3,3.2,4.7,6.2,7.9],dtype=np.float64)

#-----------------------Graphique tracé---------------------------------------#

x=np.array([1,2,3,4,5,6,7,8,9,10,11,12],dtype=np.float64)
y=np.array([8.6,7,6.4,4,2.8,1.8,1.8,2.3,3.2,4.7,6.2,7.9],dtype=np.float64)
n=len(x)-1

A=np.polynomial.polynomial.polyfit(x,y,n)

plt.scatter(x,y)

xplot=np.linspace(x[0]-.1,x[-1]+.1,120)
yplot=[np.polynomial.polynomial.polyval(z,A) for z in xplot]
plt.plot (xplot, yplot, color="blue")


x1=np.array([1,2,4,5,6,7,8,9,10,11,12],dtype=np.float64)
y1=np.array([8.6,7,4,2.8,1.8,1.8,2.3,3.2,4.7,6.2,7.9],dtype=np.float64)
n1=len(x)-1

A1=np.polynomial.polynomial.polyfit(x1,y1,n1)

plt.scatter(x1,y1)

xplot1=np.linspace(x[0]-.1,x[-1]+.1,120)
yplot1=[np.polynomial.polynomial.polyval(z,A1) for z in xplot1]
plt.plot (xplot1, yplot1, color="red")
plt.legend ()
plt.show ()

#%%

x=np.array([1,2,3,4,5,6,7,8,9,10,11,12],dtype=np.float64)
y=np.array([8.6,7,6.4,4,2.8,1.8,1.8,2.3,3.2,4.7,6.2,7.9],dtype=np.float64)

P=scipy.interpolate.CubicSpline(x,y,bc_type="natural")

xplot=np.linspace(x[0],x[-1],200)
yplot=P(xplot)
plt.scatter(x,y,color='blue')
plt.plot(xplot,yplot)

#%%

def Python_h(i):
    return(x[i+1-x[i]])







'''
tableau_des_différences_divisées(x, y)
plt.scatter (x, y, color="green", label="points à interpoler")
xplot = np.linspace (x[0]-.5, x[-1]+.5, 40)
c = tableau_des_différences_divisées (x, y)
yplot = np.array ([eval_Newton_interp(x, z, c) for z in xplot])
plt.plot (xplot, yplot, color="red", label="graphe du polynôme d’interpolation")
plt.legend ()
plt.show ()'''
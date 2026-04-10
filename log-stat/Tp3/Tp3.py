#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Wed Nov 30 08:11:01 2022

@author: vlemeur
"""
import math

#----------------------------------------------------------------------
#                      Exercice 1
#----------------------------------------------------------------------

#Q1
compte="Buffon"
fauteuil=1
nombre=3.14
utilisation=complex(1/2,(math.sqrt(3)/2))
type(compte)

#Q2

Liste=[1707,1788]

Liste[1]=2002

Tuple=(1707,1788)

Tuple[1] #on peut pas changer les valeurs d'un tuple

#Q3

dictionnaire = {"Mulan": "Mulan", "Nemo": ["Nemo","marin","Dori"]}

dictionnaire["Oui Oui Sauve Noel"]="Oui Oui"

dictionnaire["Nemo"][1]

for i in dictionnaire.items():
    print(i)
    
for cle ,valeur in dictionnaire.items():
    print("dans",cle,"est present",valeur)
    
    
import pandas as pd

a=pd.DataFrame(dictionnaire)

data={}
data["Prix"]=[14,2,69,333]
data["Article"]=["Poupée OUI OUI","Jambon","Oupsi","Diable"]
data=pd.DataFrame(data)

    
#----------------------------------------------------------------------
#                      Exercice 2
#----------------------------------------------------------------------

#Q1

def population(t):
    return(11*(2**t))

def ressources(t):
    return(11+t*11)

#Q2
from matplotlib.pylab import plot,arange
import matplotlib.pyplot as plt

X=arange(0,6,1)
Y1=population(X)
Y2=ressources(X)
plt.xlim(0,7)
plot(X,Y1)
plot(X,Y2)

#Q3
t=0
while(population(t)<63):
    t=t+1
    
print("la populaion aura dépassé 63 millions en",t,"periodes","soit",25*t,"années")
    
print("les ressources seront alors pour",ressources(t),"millions d'hab")
    
#Q6
japon=pd.read_csv('/home/v/l/vlemeur/log-stat/Tp3/japon.csv')
japon.head()
#b) il y a eu la guerre ils sont tous mort RIP

#c)

#v[0]=83.6
#v[30]=v[0]*q**30=116.8
#Q=(v[30]/v[0])**1/30

v0=83.6
v30=116.8

(v30/v0)**(1/30)
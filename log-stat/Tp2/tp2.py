#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Mon Nov 28 08:13:58 2022

@author: vlemeur
"""

import random as rd
import numpy.random as nr
import math
import numpy as np
import matplotlib.pyplot as plt
import scipy as sp
import statistics as stat
import pandas as pd
#----------------------------------------------------------------------
#                      Exercice 1
#----------------------------------------------------------------------

print(rd.random())       #nombre entre 0 et 1
print(nr.random(5))    #5 lignes et 4 colonnes
print(rd.randint(10,20)) # un entier entre [10,20]
print(nr.randint(10,20)) # un entier entre [10,20[
print(nr.randint(1,7,5)) # 5 entiers entre [1,7[

def bernoulli(p):
    assert 0<p<1
    
    
    if(rd.random()<p):
        return 1
    else:
        return 0
    

def binomiale(n,p):
    assert 0<p<1 and type(n)==int and n>0
    compteur=0
    for i in range(n):
        compteur = compteur+bernoulli(p)
    return compteur

print(binomiale(10,0.07))

def poisson(l):
    p=nr.random()
    x=0
    y=math.exp(-1)
    z=y
    while(z<p):
        x+=1
        y=y*l/2
        z+=y
    return x

print(poisson(5))

p=0.15
n=3
l=2

nr.binomial(n,p)
nr.binomial(1,p)
nr.poisson(l)
    
def indicateur(n,a,b):
    somme=0.0
    sommeCarres=0.0
    for i in range(n):
        x=rd.randint(a,b)
        somme=somme+x
        sommeCarres=sommeCarres+x*x
    moyenne=somme/n
    ecarType=math.sqrt(sommeCarres/n-moyenne*moyenne)
    return moyenne,ecarType

print(indicateur(6,40,50))


def chaineADN(n):
    chaine=[]
    for i in range(n):
        nucleotide=rd.randint(0,3)
        chaine.append("ATCG"[nucleotide])
    return(chaine)

print(chaineADN(6))

#--------------------------------------------------------------------
#                       Exercice 2
#--------------------------------------------------------------------

#q2
foot=pd.read_csv('/home/v/l/vlemeur/Téléchargements/data.csv')
foot.head()

#q3
foot.shape

#q4
foot.info()

#q5

list(foot.columns)

#q6
foot.describe()
foot.Age.describe()
foot.Age.min()
foot.Age.var()
foot.Age.std()
stat.mode(foot.Age)

foot.Age.quantile([0.25,0.50,0.75])


foot.Age.hist()
foot.Age.plot(kind="kde")


foot.boxplot(column = "Age", grid =True)
foot.boxplot(column = "Age", grid =False)


foot.Club.describe()

foot.Club.unique()

foot.Club.value_counts()

pd.crosstab(foot.Club, "freq")

tableau =pd.crosstab(foot["Preferred Foot"],"freq")
tableau.plot.bar()



load("~/IS4/S7/CS/TP3/prema.RData")


#1
str(prema)
prema$DIAB = as.factor(prema$DIAB)
attach(prema)

#2
table_con <- table(prema$PREMATURE,prema$GEMEL)
table_con


#3
proba <- table_con[2,1]/sum(table_con[2,])
proba

#4
plot(prema$PREMATURE ~ prema$GEMEL)

#5
model1 <- glm(PREMATURE ~ GEMEL, family = "binomial", data = prema)#binomiale car à 2 groupes
summary(model1)

#6

OR <- table_con[1,1]*table_con[2,2]/(table_con[1,2]*table_con[2,1])
OR

#ou 

exp(coef(model1))[2]

# oui il est significatif
# Test de rapport de vraissemblance pour vérifier

#7

table_prem <- table(prema$PREMATURE)
n=sum(table_prem[])
n0=table_prem[1]
n1=table_prem[2]

l0=log(n0/n)+log(n1/n)
l0

D0=-2+l0
D0

pi1<- predict(model1,prema,type = "response")
pi1
y = ifelse(PREMATURE == 'positif', 1,0)

l=sum(y*log(pi1)+(1-y)*log(1-pi1))

D=-2*l
D

AIC<- D+4
AIC

#8

moy_effac <- by(prema$EFFACE ,prema$PREMATURE, mean)
moy_effac

#9

library("ggplot2")

ggplot(prema, aes(EFFACE, fill = PREMATURE)) + geom_density(alpha = 0.2)

plot(EFFACE~PREMATURE)

#10

model2 <- glm(PREMATURE ~ EFFACE, family = "binomial", data = prema)
summary(model2)

beta<- coef(model2)
beta


#11
b0<-beta[1]
b1<-beta[2]

pi=function(x){
  exp(b0+b1*x)/(1+exp(b0+b1*x))
}

#12

pi(60)

#13

pi(EFFACE)

pi_hat = predict(model2, prema, type = "response")
model2$fitted.valu

#14

model3 <- glm(PREMATURE ~ GEMEL + EFFACE, family = "binomial",
              data = prema)
summary(model3)

#15

anova(model2,model3,test="LRT")

#16

#on retient lemodèle qui à l'AIC le plus faible
# ici c'est la modèle 3

#17

fullmodel <- glm(PREMATURE ~ ., family = "binomial", data = prema)
summary(fullmodel)

#18

#On regarde si au moins une des p-valeur est inférieure à 0.05 pour dire si le coefficient est significatif


reduced <- step(fullmodel)

summary(reduced)

anova(reduced ,fullmodel, test = "LRT")

#19

exp(cbind(OR=coef(reduced), confint(reduced)))

# Les facteurs de rsiques ont un OR>1
#-> DILATE, EFFACE,GRAVID,GEMELMULTIPLE

# Les facteurs protecteur ont un OR<1
#-> GEST,MEMBRANNon, MEMBRANIncertain,PARIT,DIABNon,TRANSNon

exp(cbind(OR=coef(reduced), confint(reduced)))[,1]<1

#20

S <- predict(reduced, type = "response",newdata = prema)
S

boxplot(S~PREMATURE, main = "Boîte à moustaches des valeurs prédites", ylab = "Valeurs prédites")

#21


Snew = ifelse(S > 0.5, 1,0)

table(Snew,PREMATURE)

#22

seuil <- tail(S, 1)  


Snew2 <- ifelse(S > seuil, 1, 0)

table(Snew2,PREMATURE)

#23

library(ROCR)


pred = prediction(S[-c(which(is.na(prema),arr.ind=T)[,1])], prema$PREMATURE[-c(which(is.na(prema),arr.ind=T)[,1])])
perf = performance(pred, "tpr", "fpr")
plot(perf)

#24

perf@x.values[[1]]
perf@y.values[[1]]



#25

AUC = performance(pred, "auc")
attr(AUC, "y.values")[[1]]
   
#26


tpr_values <- unlist(perf@y.values[[1]])
fpr_values <- unlist(perf@x.values[[1]])



seuil_optimal <- perf@alpha.values[[1]][which.min(sqrt((1 - tpr_values)^2 + fpr_values^2))]

seuil_optimal

which.min(sqrt((1 - tpr_values)^2 + fpr_values^2))

points(unlist(perf@x.values[[1]])[217],unlist(perf@y.values[[1]])[217])

Snew3 <- ifelse(S > seuil_optimal , 1, 0)

table(Snew3,PREMATURE)


#TP2


#1
library(mvtnorm)

#2

simu <- rbinom(1000, size = 1, prob = 0.5)

simu

#3

Y=rbinom(1000, size = 1, prob = 0.5)

X <-matrix(NA,1000,2) 

for(i in 1:1000){
  if(Y[i]==0){
    X[i,]=rmvnorm(1,mean=c(0,0), sigma =matrix(c(1,0,0,1),ncol=2))
  }else{
    X[i,]=rmvnorm(1,mean=c(2,2), sigma =matrix(c(1,0.8,0.8,1),ncol=2))
  }
}


## faux
#n_1<- sum(Y)
#X0<-rmvnorm(n_1, mean=c(0,0),sigma=matrix(c(1,0,0,1),ncol=2))   
#X0<-cbind(X0,rep(1, n_1))

#X1<-rmvnorm((1000-n_1), mean=c(2,2),sigma=matrix(c(1,0.8,0.8,1),ncol=2))   
#X1<-cbind(X1,rep(1, (1000-n_1)))

#cbind(X0,X1)
##


#4

plot(X,Y)

#5

x <- c(1,2)

f0_12 <- dmvnorm(x,mean=c(0,0), sigma=matrix(c(1,0,0,1),ncol=2))
f0_12

f1_12 <- dmvnorm(x,mean=c(2,2), sigma=matrix(c(1,0.8,0.8,1),ncol=2))
f1_12

#6

#theoreme de bayes

p0=0.5
p1=0.5

t0_12=p0*f0_12/(p0*f0_12+p1*f1_12)
t0_12

t1_12=p1*f1_12/(p0*f0_12+p1*f1_12)
t1_12

#7

which.max(c(t0_12,t1_12))
#l'individu est dans la classe 1 (le plus grand)

#8

f0_X =  dmvnorm(X, mean = c(0, 0), sigma = matrix(c(1, 0, 0, 1), ncol = 2))
f1_X =  dmvnorm(X, mean = c(2, 2), sigma = matrix(c(1, 0.8, 0.8, 1), ncol = 2))

f_all = p0*f0_X + p1*f1_X
t_all = prop.table(cbind(p0*f0_X,p1*f1_X),1)

Yp = apply(t_all,1,which.max)-1
head(Yp)

#9

data_ggplot <- data.frame(X, Y = as.factor(Y), YPred = as.factor(Yp))
data_ggplot$Classement <- factor( 2*as.numeric(Y) + Yp, levels = c(0,1,2,3),
                                  labels = c("Y = 0, Ypred = 0", "Y = 0, Ypred = 1", "
Y = 1, Ypred = 0", "Y = 1, Ypred = 1") )
ggplot(data = data_ggplot,
       aes(x = X1, y = X2, color = Classement, shape = Classement)) +
  geom_point(size = 2, alpha = 0.8) +
  labs(title = "Données simulées - Erreurs de classement (vert et bleu)") +
  theme_minimal() +
  scale_colour_brewer(palette = "Set1")
#10

matconf <- table(Y,Yp)

TBC = mean(Yp!=Y)
TMC

#11

matconf[2,2]/(matconf[2,2]+matconf[2,1])

#12

library(ROCR)

pred_ROC = prediction(t_all[,2] ,Y)
perf_ROC <- performance(pred_ROC,"tpr","fpr")
plot(perf_ROC)

#Calcul de l'AUC
AUC_ROC <- performance(pred_ROC,"auc")
#Avec ggplot
data_ggplot <- data.frame(X = perf_ROC@x.values[[1]], Y = perf_ROC@y.values[[1]])
ggplot(data = data_ggplot, aes(x = X, y = Y)) +
  geom_line(size = 1) +
  labs(title = "Courbe ROC",
       subtitle = paste0( "AUC : ", round(AUC_ROC@y.values[[1]],4) )) +
  ylab(perf_ROC@y.name) + xlab(perf_ROC@x.name) +
  theme_minimal() +
  coord_fixed()

#13

CutPoint = performance(pred_ROC, "cost", cost.fp = 1, cost.fn = 1)
SeuilOptimal <- pred_ROC@cutoffs[[1]][which.min(CutPoint@y.values[[1]])]
SeuilOptimal

ggplot(data = data_ggplot, aes(x = X, y = Y)) +
  geom_line(size = 1) +
  geom_point(aes(x=perf_ROC@x.values[[1]][which.min(CutPoint@y.values[[1]])],
                 y=perf_ROC@y.values[[1]][which.min(CutPoint@y.values[[1]])]),
             colour="red", size = 2) +
  labs(title = "Courbe ROC",
       subtitle = paste0( "AUC : ", round(AUC_ROC@y.values[[1]],4) )) +
  ylab(perf_ROC@y.name) + xlab(perf_ROC@x.name) +
  annotate(geom="text",
           x=1.1*perf_ROC@x.values[[1]][which.min(CutPoint@y.values[[1]])],
           y=0.99*perf_ROC@y.values[[1]][which.min(CutPoint@y.values[[1]])],
           label="Couple (Se, 1-Sp) associé au seuil optimal",
           color="black", hjust=0) +
  theme_minimal() +
  coord_fixed()

#14

Yp_Opt <- 1*(t_all[,2] > SeuilOptimal)
MatriceConfusion <- table(Yreel = Y,Ypredit = Yp_Opt)
MatriceConfusion


TMC <- mean(Y != Yp_Opt)
TMC

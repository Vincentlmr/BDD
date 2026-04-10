

#1.1 

V2V1<-matrix(c(50,0,0,25,0,25), nrow = 3, ncol = 2, byrow=TRUE)
chisq.test(V2V1)

V<-(100/100)
V

#1.2

V2V2<-matrix(c(30,20,30,20,10,15,10,15), nrow = 4, ncol = 2, byrow=TRUE)
chisq.test(V2V2)

V2<-(5.36/150)
V2

#1.3
G1<-c(4,5,7,8,9)
G2<-c(2,3,4,5,7,8)

l<- c(G1,G2)

X<-mean(l)
X0=mean(G1)
X1<-mean(G2)

SCF<-(mean(x[1:5])-mean(x))^2*5+(mean(x[6:11])-mean(x))^2*6
SCR<-sum(c((x[1:5]-mean(x[1:5]))^2,(x[6:11]-mean(x[6:11]))^2))
Fstat<-(SCF/1)/(SCR/9)
pval<-pf(Fstat,1,9,lower.tail=FALSE)
Rsq<-SCF/(SCF+SCR)
c(SCF,SCR,Fstat,pval,Rsq)

group <- factor(rep(c("G1", "G2"), c(length(G1), length(G2))))
data <- data.frame(value = l, group = group)
model <- aov(value ~ group, data = data)
summary(model)


#2.1

data("iris")

names(iris) <- c("X1", "X2", "X3", "X4", "Y")

head(iris)


#2.2

library(ggplot2)
library(tidyr)
library(dplyr)
iris %>%
  gather("variable","mesure",-Y) %>%
  ggplot(aes(x = Y, y = mesure, col = Y)) +
  geom_boxplot() +
  facet_wrap(~ variable, scales = "free_y")

#ou
plot(X1~Y,data=iris) 
ggplot(aes(x = Y, y = X1, fill = Y),
data = iris) +geom_boxplot() 

#2.3

library(GGally)
ggpairs(iris, aes(color=Y))

#2.4


allanov<-lapply(1:4,FUN=function(i){
  anova(lm(get(paste0("X",i))~Y,data=iris)) #paste0 -> coller le X avec le i et le get c pour le reccupérer
})

allpval<-sapply(allanov,FUN=function(x) x$`Pr(>F)`[1]) 
#c comme ci on faisait allanov[[1]]$'Pr'[1] pour tous les x

#sapply équivaut ici à unlist(lapply())
#unlist c pour transformer les listes en vecteurs
allpval
allr2<-sapply(summary(lm(cbind(X1,X2,X3,X4)~Y,data=iris)),
              FUN=function(x) x$r.squared)
allr2

#3.1.1
V=cov.wt(iris[,1:4], method="ML")$cov
#ML maximum de vraissemblance ( diviser par 1/n )
V

cov.wt(iris[,1:4], method="ML", cor=TRUE)$cor

#3.1.2

W1=cov.wt(iris[iris$Y=="setosa",1:4], method="ML")$cov

by(iris[,1:4], iris$Y, function(x){cov.wt(x,method="ML")$cov})

ni = table(iris$Y)
ni

W = (ni[1]*W1 + ni[2]*W2 + ni[3]*W3)/sum(ni)
W

Wi = lapply(levels(iris$Y), function(k)
  cov.wt(iris[iris$Y== k,1:4],method="ML")$cov) # Liste de Wi
ni = table(iris$Y)  # Vecteur de ni

W = Reduce('+',Map('*',Wi,ni))/sum(ni)

#3.1.3

moyennes=by(iris[,1:4],iris$Y,colMeans)
moyennes

G=matrix(unlist(moyennes),3,4,byrow=T)
rownames(G)=levels(iris$Y)
colnames(G)=paste0(colnames(iris[,1:4]),"bar") 
G

G = t(simplify2array(by(iris[,1:4],iris$Y, colMeans)))
colnames(G)=paste0(colnames(iris[,1:4]),"bar") 


B=cov.wt(G,wt = as.vector(table(iris$Y)),method="ML")$cov
# on precise wt : pour pondérer par l'effectif des classes
# as.vector(table(iris$Y)) prend seulement les valeurs numériques
B


X <- colMeans(iris[,1:4])
B_formule <- (50/150)*(G[1,]-X)%*%t((G[1,]-X)) + (50/150)*(G[2,]-X)%*%t((G[2,]-X)) + (50/150)*(G[3,]-X)%*%t((G[3,]-X))
B_formule

#3.1.4

V-(B+W)

#3.2.1

ACP=eigen(V)$vectors
c=as.matrix(iris[,1:4])%*%ACP[,1:2]
plot(c,col=iris$Y)

l=eigen(V)$values
prop_var=l/sum(l)

cumsum(prop_var)

library(FactoMineR)
library(factoextra)
pca = PCA(iris[,0:4], graph = F)
pca$eig

#96%

#3.2.2

AFD=eigen(solve(V)%*%B)$vectors
d=as.matrix(iris[,1:4])%*%AFD[,1:2]
plot(d,col=iris$Y)

#3.2.3

#première methode
l=eigen(solve(V)%*%B)$values
l[1]


#2 eme méthode
summary(lm(d[,1]~iris$Y))$r.squared
 
#la part est donc de 96,8%

#3.2.4

AFD=eigen(solve(W)%*%B)$vectors
d=as.matrix(iris[,1:4])%*%AFD[,1:2]
plot(d,col=iris$Y)

vp=(l[1])/(1-l[1])
vp

l3=eigen(solve(W)%*%B)$values
l3[1]

l3[1]==vp

#3.2.3

plot(d, col=iris$Y)


#3.3.1

alpha=matrix(0,5,3)
rownames(alpha)= c("intercept","X1","X2","X3","X4")
colnames(alpha)= levels(iris$Y)

for(i in 1:3){
  barXi=matrix(G[i,])
  alpha[1,i]=-t(barXi)%*%solve(W)%*%barXi
  alpha[2:5,i]=2*solve(W)%*%barXi
}
alpha

for(i in 1:3){
  barXi=matrix(G[i,])
  alpha[1,i]=-t(barXi)%*%solve(W)%*%barXi
  alpha[2:5,i]=2*solve(W)%*%barXi
}


#3.3.2


s=as.matrix(cbind(1,iris[,1:4]))%*%alpha
s

#ça appartient au score le plus haut

#3.4.1 question de cours

#3.4.2

library(MASS)

AFDXY=lda(iris[,1:4],grouping=iris[,5], prior=prop.table(rep(1,nlevels(iris[,5]))))

#3.4.3

Yp<-predict(AFDXY, iris[1:4])
names(Yp)

table(iris[,5],Ypredict=Yp$class)

#3.4.4

AFDXY=lda(iris[,1:4],grouping=iris[,5], prior=prop.table(rep(1,nlevels(iris[,5]))))
AFDv=AFDXY$scaling
AFDv

Projec=as.matrix(iris[,1:4])%*%AFDv
plot(Projec,col=iris$iris[,5])


library(ggplot2)
Projec2 <- as.data.frame(Projec)
Projec2$Y <- iris[,5]
ggplot(data = Projec2,
       aes(x = LD1, y = LD2, color = Y, shape = Y)) +
  geom_point(size = 2, alpha = .6) +
  labs(title = "Projection des données") +
  theme_minimal() +
  scale_colour_brewer(palette = "Set1")

#3.5.1

table(iris[,5],Ypredict=Yp$class)

#3.5.2

TBC=mean(iris[,5]==Yp$class)
TBC

TMC=mean(iris[,5]!=Yp$class)
TMC

#3.5.3

##Les mêmes donnés sont utilisées pour l apprentissage et le test 

#3.5.4

set.seed(1234)
sample_indices <- sample(1:nrow(iris), size = 0.7 * nrow(iris),replace=FALSE)
train_data <- iris[sample_indices, ]
test_data <- iris[-sample_indices, ]

AFD <-lda(train_data[1:4],grouping=train_data[,5], prior=prop.table(rep(1,nlevels(train_data[,5]))))

Yp<-predict(AFD, test_data[1:4])
names(Yp)

table(test_data[,5],Ypredict=Yp$class)

#3.5.5

TBC=mean(test_data[,5]==Yp$class)
TBC

TMC=mean(test_data[,5]!=Yp$class)
TMC

#limite : peu d'individus donc le taux vont dépendre fortement de la base 

#2.5.6

k <- 15

YpCV <- factor()
  
for(i in 1:k){
  train_data <- iris[-c ( trunc((i-1)*(nrow(iris)/k))+1: trunc((i)*(nrow(iris)/k)) ),]
  test_data <- iris[-c ( trunc((i-1)*(nrow(iris)/k))+1: trunc((i)*(nrow(iris)/k)) ),]
  
  AFDCV <- lda(train_data[1:4],grouping=train_data[,5], prior= c(1/3,1/3,1/3))
  
  YpCV[c(trunc((i-1)*(nrow(iris)/k)) : trunc((i)*(nrow(iris)/k)))]<-predict(AFDCV,test_data[1:4])$class             
               
}

table(Y=iris[5,],YpCV)
TBC=mean(iris$Y==YpCV)
TMc=1-TBC

#3.4.1



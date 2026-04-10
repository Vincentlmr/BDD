################################################################################
#--------------------------------------TP1------------------------------------##
################################################################################


#Quetion 1


library(readr)
fiabilites <- read_delim("SI/TP1/fiabilites.csv", 
                         "\t", escape_double = FALSE, col_names = FALSE, 
                         locale = locale(decimal_mark = ",", grouping_mark = ""), 
                         trim_ws = TRUE)
View(fiabilites) # on importe le dossier provenant des données fournies

echantillon1<-sample(fiabilites$X1,30)
echantillon2<-sample(fiabilites$X1,50)
echantillon3<-sample(fiabilites$X1,80)

summary(echantillon1)
summary(echantillon2)
summary(echantillon3)

par(mfrow = c(2,2))



hist(echantillon1)
hist(echantillon2)
hist(echantillon3)

title("Distribution", outer=TRUE, line=-1)sssss

#Question 2

log_vrais <- function(echantillon,mu,sigma){
  n <- length(echantillon)
  
  L <- n/2 * log(2*pi*sigma^2) - 1/(2*sigma^2) * sum((sample-mu)^2)
  
  return L
}



#Question 3 utiliser la fonction optim

q3 <- function(param,echantillon){
  mu <- param[1]
  sigma <- param[2]
  
  return -L
}
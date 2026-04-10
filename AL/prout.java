package ejb.sessions;

import java.util.Collection;
import ejb.entites.*;

public interface ServiceQuestionnaire {
	
	public Collection<Questionnaire> getListeQuestionnaire();
	
	public Questionnaire getQuestionnaire(String nom) throws QuestionnaireInconnuException;
	
	public void creerQuestionnaire(String nom) throws QuestionnaireDejaCreeException;
	
	public enum TypeSpec {OUVERTE, REPSIMPLE, CHOIXMULTIPLE} ;
	
	public void creerQuestion(String intitule,String reponse, TypeSpec type);
	
	public void creerReponse(String reponse, boolean estVrai);
	
	public void affecterReponse(int idRep, int idQuest, TypeSpec type) throws QuestionInconnueException,
        ReponseInconnueException, ReponseDejaAffecteeException;
	
	public Collection<Question> getQuestions(String nomQuestionnaire) throws QuestionnaireInconnuException;
	
	public void affecterQuestion(String nomQuestionnaire, int idQuestion, TypeSpec type) throws QuestionnaireInconnuException, 
        QuestionInconnueException, QuestionDejaAffecteeException;

	public Collection<Reponse> getReponses(int idQuestion, TypeSpec type) throws QuestionInconnueException;
	
	public Collection<String> getBonnesReponses(int idQuestion, TypeSpec type) throws QuestionInconnueException;
}





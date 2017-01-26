#include <stdio.h>
#include <stdlib.h>
#include <string.h>
	
	
typedef struct {  //Tdado, com as informaçoes sobre os participantes
		char nome [50];
		char tel [15];
		int numAcompanhante;
		
		
}Tdado;
		
struct Tno {		//Tno estrutura para os nós da lista
				Tdado info;
				struct Tno *prox;
};	
	
struct Tno *listaFesta;
	
		int i;
	char c;
	
struct Tno *iniciaLista(struct Tno *lista)// Iniciar Lista
{
		lista = NULL;    
  		return(lista);
}
	
int listaVazia(struct Tno *lista)// Verifica se lista esta vazia
{
		if (lista == NULL)   //se lista aponta vazio eh porque estah vazia
   		return(1);         //retorno diferente de 0 significa verdadeiro
  		else return(0); 
}
	
void imprimeLista(struct Tno *lista)
{
		struct Tno *p;
		p=lista;
		while(p != NULL)
		{
			printf("%s - ", p->info.nome);
			printf("%s - ", p->info.tel); 
			printf("%d  ", 	p->info.numAcompanhante);   
			printf("\n");  
			p = p->prox;
		}
}
	
	
int tamanhoLista(struct Tno *lista)
	{
		int cont;
		struct Tno *p;
		p=lista;
		cont = 0;
		
		while(p!= NULL)
		{
			cont ++;
			p = p->prox;
		}
		
		return(cont);
		
}
	

struct Tno *insereInicio(struct Tno *lista, Tdado elem)
{
  		struct Tno *p;                   
  
 		p = malloc(sizeof(struct Tno));// esta dando erro
  		p->prox = lista;   
  		lista = p;         
  		p->info = elem;    
  
 		return(lista);
}
	

	
struct Tno *removeElemento(struct Tno *lista, Tdado elem)
	{
		struct Tno *p, *q;
		
		p= lista;
		
		
			while((p != NULL) && ( p->info.nome != elem.nome))
			{
				q = p;
				p = p->prox;
			}
			if(p == NULL) printf("ERRO! Participante não encontrado.");
			else{
				q->prox = p->prox;
				free(p);
				printf("\nParticipante removido com sucesso!");
			}
	
		
		return(lista);
}
	
int qtParticipantesSemAcompanhante(struct Tno *lista)
	{
	struct Tno *p;
	
	int cont;
	cont = 0;
	p = lista;
	while(p != NULL){
		cont ++;
		p = p->prox;
	}
	
	return(cont);
}

int qtParticipantesComAcompanhante(struct Tno *lista)
	{		
		struct Tno *p;
		int cont;
		cont = 0;
		p = lista;
		while(p != NULL){
			cont += p->info.numAcompanhante;
			cont += 1;
		
		p = p->prox;
	}
	
	return(cont);
}	
	
void consultaNome(struct Tno *lista, char Nome[50])
{
	
		
	struct Tno *p;
 	p = lista; 
  	int cont = 0; 
  
  while(p != NULL)
  {
  	if(strcmp(p->info.nome,Nome ) == 0 )
  	{
  		printf("%s - ", p->info.nome);
		printf("%s - ", p->info.tel); 
		printf("%d - ", p->info.numAcompanhante);   
		printf("\n");  
		cont = 1 ;
  	}
  	p = p->prox; 
  }
	if(cont == 0)
	{
		printf("Não foi encontrado ninguém com esse nome!");
	}
}

void consultaTelefone(struct Tno *lista, char Telefone[50])
{
	
	struct Tno *p;
  p = lista; 
  
  int cont = 0; 
  
  while(p != NULL)
  {
  	
  	if(strcmp(p->info.tel,Telefone ) == 0 )
  	{
  		printf("%s - ", p->info.nome);
		printf("%s - ", p->info.tel); 
		printf("%d - ", p->info.numAcompanhante);   
		printf("\n");  
		cont = 1 ;
  	}
  	p = p->prox; 
  }
  if(cont == 0)
	{
		printf("Não foi encontrado ninguém com esse nome!");
	}
	
}

int menu(void){
	
  int opcao;  
  
  do {  
    system("cls");    //Limpa a tela - biblioteca <stdlib.h>
    printf("Lista Festa\n"); //Titulo do menu
    
    printf("MENU\n\n");
    printf(" 1 - Cadastrar Participante\n");
    printf(" 2 - Remover Participante\n");
    printf(" 3 - Listar Todos Participantes\n");
    printf(" 4 - Consultar Quantidade de Participantes Cadastrados(Sem Acompanhante)\n");
    printf(" 5 - Consultar Quantidade de Participantes Cadastrados(Com Acompanhante)\n");
    printf(" 6 - Consultar por Nome\n");
    printf(" 7 - Consultar por Telefone\n");
    printf(" 8 - Sair\n");
    
    printf("\n\nOpcao: ");
    scanf("%d", &opcao);
    if((opcao<1)||(opcao>11)) {     //Caso o usuario digite uma opcao invalida
      printf("\n\nOpcao '%d' invalida! Escolha entre <0> e <7>.\n", opcao);
      printf("\nTecle <ENTER> para continuar e tentar novamente...");
      c = getche();                                                                     //Esta dando erro
    }
  } while((opcao<1)||(opcao>11));  //Repete ate ler uma opcao valida
  return(opcao);
} 

	


main(void) {
	
 int op;              //Variavel para receber a opcao do menu
 
 Tdado elemento;
      
  listaFesta = iniciaLista(listaFesta);  //Inicialização da lista com todos os nos disponiveis
  
  do {

    op = menu();         //Chamada da rotina do menu
  
    switch(op){
      case 1:  
                          
           
           printf("\nDigite o Nome do Participante: ");
		   scanf("%s", &elemento.nome);
        	
           printf("\nDigite o Telefone do Participante: ");
           scanf("%s", &elemento.tel);
           
           printf("\nDigite o Numero de Acompanhantes do Participante: ");
           scanf("%d", &elemento.numAcompanhante);
           
           
           printf("\n");
           listaFesta = insereInicio(listaFesta, elemento);
           printf("Participante cadastrado com sucesso!\n");
       
        break;
      case 2: 
	  if(listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
          char nomeExclui[50];
          
          
        	printf("\nParticipantes: ");
        	printf("\n");
			imprimeLista(listaFesta);
			printf("\nDigite o Nome do Participante: ");
			scanf("%s",&nomeExclui);
		
			struct Tno *p; //Variavel auxiliar que percorre a lista para imprimir as informacoes
  			Tdado elem;
  		
 				p = listaFesta;        //A partir do primeiro elemento...
  				while (p != NULL) {
				  
				  		if(strcmp(nomeExclui, p->info.nome) == 0 )
						  {
				  			elem = p->info;
						}
    			p = p->prox;                 //Salta para o proximo no
 				} //Fim
			 
			listaFesta = removeElemento(listaFesta, elem);
			
					
        printf("\n\n");       
        } 
                 
        break;              
      case 3:   
           if (listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
          imprimeLista(listaFesta);   
          printf("\n\nTodos participantes foram listados!\n");      
        } 
        break;              
      case 4:  
          if (listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
        	int cont;
        	
          cont =qtParticipantesSemAcompanhante(listaFesta);   
          
          printf("\n A quantidade de participantes sem acompanhante é: %d", cont);  
		      
        } 
        break;       
		 case 5:  
        if (listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
         
          
          printf("\n A quantidade de participantes com acompanhante é: %d",qtParticipantesComAcompanhante(listaFesta));  
      }
        break;   
		
		case 6:  
		if (listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
		char nomeBusca[50];
		
		printf("\nDigite o Nome do Participante: ");
		scanf("%s", &nomeBusca);
		
		consultaNome(listaFesta, nomeBusca);
		
        printf("\n\n"); 
    }
        break;  
		       
      case 7:  
      if (listaVazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
      char telBusca[15];
		
		printf("\nDigite o Telefone do Participante: ");
		scanf("%s",&telBusca);
		
		consultaTelefone(listaFesta, telBusca);
		
        printf("\n\n"); 
    }
        break;   

    }  //Fim do switch(op)     
    printf("\npressione <ENTER> para continuar...");
    c = getche();      
    printf("\n");
		} while(op != 8); //Repete o processo ate ser escolhida a opcao de saida - 9

  printf("Tecle <ENTER> para encerrar\n");
 c = getche();
}

#include <stdio.h>
#include <stdlib.h>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

	typedef struct {
		char nome [50];
		char tel [15];
		int numAcompanhante;
		
		
	}Tdado;
		
	typedef struct{
		Tdado info;
		int prox;
	}Tno;	
	
	typedef struct{
		Tno l[50];         
  		int prim;           
  		int dispo;
	}Tlista;
	
	Tlista listaFesta;
	
	int i;
	char c;
	
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
      c = getche();
    }
  } while((opcao<1)||(opcao>11));  //Repete ate ler uma opcao valida
  return(opcao);
} 
	
	
	void iniciaLista(Tlista *lista)
//Rotina de inicializacao de uma lista encadeada com implementacao estatica
//Parametro de entrada: a lista a ser inicializada
//Parametro de saida: a lista inicializada
//Retorno: inexistente - funcao void
{
  for(i=0; i<50; i++) {lista->l[i].prox = i+1;} //cada no aponta seu proximo
  lista->l[50].prox = -1;      //Ultimo no aponta como proximo o final da lista
  lista->prim = -1;           //Primeiro elemento aponta vazio (lista vazia)
  lista->dispo = 0;           //Primeiro disponivel aponta primeiro no do vetor
}

int cheia(Tlista lista)
//Rotina que verifica se uma lista esta cheia
//Parametro de entrada: a lista a ser verificada
//Parametro de saida: inexistente
//Retorno: retorna 1 se estiver cheia, e 0 caso contrario 
{
  if(lista.dispo == -1) return(1); //Se a lista esta cheia, nao ha no disponivel
  else return(0);
}

int vazia(Tlista lista)
//Rotina que verifica se uma lista esta vazia
//Parametro de entrada: a lista a ser verificada
//Parametro de saida: inexistente
//Retorno: retorna 1 se estiver vazia, e 0 caso contrario 
{
 if(lista.prim == -1) return(1); //Uma lista vazia nao possui primeiro elemento
 else return(0);    
}

void insereInicio(Tlista *lista, Tdado elem)
//Rotina para insercao de um elemento no inicio de uma lista
//Parametros de entrada: a lista a ser alterada e o elemento a ser inserido
//Parametro de saida: a lista alterada
//Retorno: inexistente - funcao void
{
  int p;   //Variavel auxiliar para apontar o novo no que fara parte da lista
       
  p = lista->dispo;                //Toma o primeiro no disponivel, faz seu 
  lista->dispo = lista->l[lista->dispo].prox;  //proximo apontar para o atual
  lista->l[p].prox = lista->prim;  //primeiro elemento, e faz o ponteiro do
  lista->prim = p;                 //primeiro apontar o novo no, que passa
  lista->l[p].info = elem;         //a ser o primeiro da lista.
  
}   



void removeElemento(Tlista *lista, Tdado elem)
//Rotina para remocao de um elemento especifico da lista
//Parametro de entrada: a lista a ser alterada e o elemento a ser removido
//Parametro de saida: a lista alterada
//Retorno: inexistente - funcao void
{
  int p;      //Variavel auxiliar que apontara o no a ser removido
  int q;      //Variavel auxiliar que apontara o no anterior ao elemento
  
  p = lista->prim;                    //se o elemento eh o primeiro da lista, 
  if(lista->l[p].info.nome == elem.nome) removeInicio(lista); //basta chamar removeInicio.
  else {                              //Caso contrario, percorre-se a lista ate
    while((p != -1)&&(lista->l[p].info.nome != elem.nome)) { //achar o elemento, e o seu  
      q = p;                          //antecessor, ou chegar ao final. 
      p = lista->l[p].prox;           //Se p passou do final, eh porque o 
    }                                 //elemento nao estah cadastrado na lista.
    if(p == -1) printf("\n\nERRO! Participante nao encontrado na lista.\n");
    else {                            //Mas se nao chegou ao final, eh porque 
      lista->l[q].prox = lista->l[p].prox;  //achou o elemento. Seu antecessor  
      lista->l[p].prox = lista->dispo;  //passa a apontar seu sucessor, e o no 
      lista->dispo = p;                 //eh devolvido aos disponiveis.
      printf("\nRemocao realizada com sucesso!\n");
    }
  }  
}



void removeInicio(Tlista *lista)
//Rotina para remocao de um elemento do inicio da lista
//Parametro de entrada: a lista a ser alterada
//Parametro de saida: a lista alterada
//Retorno: inexistente - funcao void
{
  int p;      //Variavel auxiliar que apontara o no a ser removido
  
  p = lista->prim;                  //p aponta no a ser eliminado, o segundo da
  lista->prim = lista->l[lista->prim].prox; //lista passa a ser o primeiro, e
  lista->l[p].prox = lista->dispo;  //o no eliminado passa a ser o primeiro dos
  lista->dispo = p;                 //nos disponiveis para novas insercoes.
}

void imprimeLista(Tlista lista)
//Rotina para impressao da lista na tela
//Parametro de entrada: a lista a ser impressa
//Parametro de saida: inexistente
//Retorno: inexistente - funcao void
{
  int p; //Variavel auxiliar que percorre a lista para imprimir as informacoes
  
  p = lista.prim;        //A partir do primeiro elemento...
  while (p != -1) {      //Enquanto não encontra o final da lista...
    printf("%s - ", lista.l[p].info.nome);
	printf("%s - ", lista.l[p].info.tel); 
	printf("%d  ", lista.l[p].info.numAcompanhante);   
	printf("\n");  
    p = lista.l[p].prox;                 //Salta para o proximo no
  } //Fim do while(p != -1)
}


int qtParticipantesSemAcompanhante(Tlista lista)
{
	int cont, p;
	cont = 0;
	p = lista.prim;
	while(p != -1){
		cont ++;
		p = lista.l[p].prox;
	}
	
	return(cont);
}

int qtParticipantesComAcompanhante(Tlista lista)
{
	int cont, p;
	cont = 0;
	p = lista.prim;
	while(p != -1){
		cont += lista.l[p].info.numAcompanhante;
		cont += 1;
		
		p = lista.l[p].prox;
	}
	
	return(cont);
}

void consultaNome(Tlista lista, char Nome[50])
{
	
	int p;  
  p = lista.prim;  
  int cont =0;
  
  while(p != -1)
  {
  	if(strcmp(Nome, lista.l[p].info.nome) == 0 )
  	{
  		printf("%s - ", lista.l[p].info.nome);
		printf("%s - ", lista.l[p].info.tel); 
		printf("%d - ", lista.l[p].info.numAcompanhante);   
		printf("\n");
		cont = 1;  
  	}
  	p = lista.l[p].prox; 
  }
	if(cont == 0)
	{
		printf("Não foi encontrado ninguém com esse nome!");
	}
}

void consultaTelefone(Tlista lista, char Telefone[50])
{
	
	int p;  
  p = lista.prim; 
  int cont = 0; 
  
  while(p != -1)
  {
  	if(lista.l[p].info.nome == Telefone)
  	{
  		printf("%s - ", lista.l[p].info.nome);
		printf("%s - ", lista.l[p].info.tel); 
		printf("%d - ", lista.l[p].info.numAcompanhante);   
		printf("\n");  
		cont = 1 ;
  	}
  	p = lista.l[p].prox; 
  }
  if(cont == 0)
	{
		printf("Não foi encontrado ninguém com esse nome!");
	}
	
}
Tdado carregaNome(Tlista lista, char nomeExclui)
{
		int p; //Variavel auxiliar que percorre a lista para imprimir as informacoes
  		Tdado elem;
  		
 				p = lista.prim;        //A partir do primeiro elemento...
  				while (p != -1) {
				  
				  		if(strcmp(nomeExclui, lista.l[p].info.nome) == 0 )
						  {
				  			elem = lista.l[p].info;
						}
    			p = lista.l[p].prox;                 //Salta para o proximo no
 				} //Fim do while(p != -1)

	return(elem);			
}




main(void) {
	
 int op;              //Variavel para receber a opcao do menu
 
 Tdado elemento;
      
  iniciaLista(&listaFesta);  //Inicialização da lista com todos os nos disponiveis
  
  do {

    op = menu();         //Chamada da rotina do menu
  
    switch(op){
      case 1:  
         if (cheia(listaFesta)) printf("ERRO! Lista cheia. Impossivel inserir."); 
         else {
           
           
           printf("\nDigite o Nome do Participante: ");
		   scanf("%s", &elemento.nome);
        	
           printf("\nDigite o Telefone do Participante: ");
           scanf("%s", &elemento.tel);
           
           printf("\nDigite o Numero de Acompanhantes do Participante: ");
           scanf("%d", &elemento.numAcompanhante);
           
           
           printf("\n");
           insereInicio(&listaFesta, elemento);
           printf("Participante cadastrado com sucesso!\n");
       }
        break;
      case 2: 
	  if(vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
          char nomeExclui[50];
          
          
        	printf("\nParticipantes: ");
        	printf("\n");
			imprimeLista(listaFesta);
			printf("\nDigite o Nome do Participante: ");
			scanf("%s",&nomeExclui);
		
			int p; //Variavel auxiliar que percorre a lista para imprimir as informacoes
  			Tdado elem;
  		
 				p = listaFesta.prim;        //A partir do primeiro elemento...
  				while (p != -1) {
				  
				  		if(strcmp(nomeExclui, listaFesta.l[p].info.nome) == 0 )
						  {
				  			elem = listaFesta.l[p].info;
						}
    			p = listaFesta.l[p].prox;                 //Salta para o proximo no
 				} //Fim
			 
			removeElemento(&listaFesta, elem);
		
        printf("\n\n");       
        } 
                 
        break;              
      case 3:   
           if (vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
          imprimeLista(listaFesta);   
          printf("\n\nTodos participantes foram listados!\n");      
        } 
        break;              
      case 4:  
          if (vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
        	int cont;
        	
          cont =qtParticipantesSemAcompanhante(listaFesta);   
          
          printf("\n A quantidade de participantes sem acompanhante é: %d", cont);  
		      
        } 
        break;       
		 case 5:  
        if (vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
         
          
          printf("\n A quantidade de participantes com acompanhante é: %d",qtParticipantesComAcompanhante(listaFesta));  
      }
        break;   
		
		case 6:  
		if (vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
        else {
		char nomeBusca[50];
		
		printf("\nDigite o Nome do Participante: ");
		scanf("%s", &nomeBusca);
		
		consultaNome(listaFesta, nomeBusca);
		
        printf("\n\n"); 
    }
        break;  
		       
      case 7:  
      if (vazia(listaFesta)) printf("\nLista vazia! Nao ha participantes.\n"); 
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

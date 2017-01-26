#include <stdio.h>
#include <stdlib.h>

typedef struct {
        char L[10];
        int N;
        } Tlista;

Tlista list;

char c, elemento;
int opcao, posicao, tam;

void iniciaLista(Tlista *lista)
{
     lista->N = 0;
}

int cheia(Tlista list)
{
     return (list.N == 10);
}

int vazia(Tlista list)
{
     return (list.N == 0);
}

void insereFinal(Tlista *lista, char elem)
{
     lista->L[lista->N] = elem;
     lista->N++;
}

void insereInicio(Tlista *lista, char elem)
{	int i;	
	for(i = lista->N; i > 0; i--)
		lista->L[i] = lista->L[i-1];
	lista->L[0] = elem;
	lista->N++;
}

void insereInterior(Tlista *lista, char elem, int pos)
{
	int i;
	
	for(i = lista->N; i > (pos-1); i--)
		lista->L[i] = lista->L[i-1];
	lista->L[pos-1] = elem;
	lista->N++;
}

void removeFinal(Tlista *lista)
{
	lista->N--;
}

void removeInicio(Tlista *lista)
{
	int i;
	
	for(i = 0; i < (lista->N - 1); i++)
		lista->L[i] = lista->L[i+1];
	lista->N--;
}

void removeInterior(Tlista *lista, int pos)
{
	int i;
	
	for(i = (pos-1); i < (lista->N - 1); i++)
		lista->L[i] = lista->L[i+1];
	lista->N--;
}

void listagemLista(Tlista lista)
{
     int i;
     for(i=0; i<lista.N; i++)
       printf("%c - ", lista.L[i]);
     printf("\n");       
}
 
int tamanho(Tlista lista)
{
	return(lista.N);
} 
 
main(void)
{
  iniciaLista(&list);
  do 
  { system("cls");
    printf("Menu:\n\n");
    printf("1- Inserir no final\n");
    printf("2- Inserir no inicio\n");
    printf("3- Inserir no interior\n");
    printf("4- Remocao no final\n");
    printf("5- Remocao no inicio\n");
    printf("6- Remocao no interior\n");
    printf("7- Listar elementos da lista\n");
    printf("8- Tamanho da lista\n");
    printf("0- Sair do programa\n");
    printf("\nOpcao: ");
    scanf("%d", &opcao);
    switch (opcao){
      case 1:
              if(cheia(list)){
                printf("\nERRO! Lista cheia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
              }
              else {
                printf("\nDigite o elemento a ser inserido: ");
                //scanf("%c", &elemento);   
                elemento = getche();
                printf("\n");
                insereFinal(&list, elemento);
              }
           break;
      case 2:
      		if(cheia(list)){
                printf("\nERRO! Lista cheia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
              }
             else {
             	printf("\nDigite o elemento a ser inserido: ");
                //scanf("%c", &elemento);   
                elemento = getche();
                printf("\n");
                insereInicio(&list, elemento);
          	}
           break;
      case 3:
      		if(cheia(list)){
                printf("\nERRO! Lista cheia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
              }
             else {
             	printf("\nDigite o elemento a ser inserido: ");
                //scanf("%c", &elemento);   
                elemento = getche();
                printf("\n");
                printf("\nDigite a posicao a inserir o elemento: ");
                scanf("%d", &posicao);   
                //posicao = getche();
                printf("\n");
                
                insereInterior(&list, elemento, posicao);
          	}
           break;
      case 4: 
      		if(vazia(list)){
                printf("\nERRO! Lista vazia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
            }
            else {
            	removeFinal(&list);
            }
      	break;
      case 5: 
      		if(vazia(list)){
                printf("\nERRO! Lista vazia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
            }
            else {
            	removeInicio(&list);
            }
      	break;
      case 6: 
      		if(vazia(list)){
                printf("\nERRO! Lista vazia.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();          
            }
            else {
            	printf("\nDigite a posicao a ter o elemento removido: ");
                scanf("%d", &posicao);   
                printf("\n");
            	removeInterior(&list, posicao);
            }
	  	break;	
	  case 7:
              if (vazia(list)) {
                printf("\nLista vazia! Sem ele/os p/ listar.\n");
                printf("\nPressione <ENTER> para continuar.");
                c = getche();   
              }       
              else {
                printf("\nElementos cadastrados:\n\n");
                listagemLista(list);
              }  
           break;
      case 8:
      		tam = tamanho(list);
      		printf("\nTamanho da lista - %d elementos.\n", tam);
           break;
      case 0: printf("\nFINAL DE PROGRAMA!!!\n\n");
           break;     
      default: printf("\nERRO! Opcao invalida!!!");
           break;                            
    } // do switch(opcao)

    printf("\nPressione <ENTER> para continuar.");
    c = getche();          
  } while (opcao != 0); 
} // main
          

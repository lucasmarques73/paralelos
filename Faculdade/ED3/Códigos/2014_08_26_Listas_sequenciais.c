#include<stdio.h>
#include<stdlib.h>


typedef struct {
	char L[10];
	int N;
} TLista;
	
TLista list;
	
void iniciaLista(TLista *lista)
{
	lista->N = 0;
}
	
int vazia(TLista lista)
{
	return(lista.N == 0);
}
	
int cheia(TLista lista)
{
	return(lista.N == 10);
}
	
void insereFinal(TLista *lista, char elem)
{
	lista->L[lista->N] = elem;
	lista->N++;
}
	
void listagem(TLista lista)
{
	int i;
		
	for(i = 0; i < lista.N; i++)
	  printf("%c - ", lista.L[i]);
	printf("\n");
}
	
main(void)
{	
	char elemento;
	int opcao;
	
	iniciaLista(&list);
	do {
		system("cls");
		printf("Menu:\n\n");
		printf("1 - Inserir no final\n");
		printf("2 - Inserir no inicio\n");
		printf("3 - Inserir no interior\n");
		printf("4 - Listar elementos da lista\n");
		printf("0 - Sair do programa\n");
		printf("\nOpcao: ");
		scanf("%d", &opcao);
		
		switch (opcao){
			case 1: 
				if(cheia(list)){
					printf("ERRO! Lista cheia\n\n");
				}
				else {
					printf("Elemento a ser inserido: ");
					elemento = getche();
					printf("\n");
					insereFinal(&list, elemento);
				} 
				break;
			case 2:
				break;
			case 3:
				break;
			case 4:
				if (vazia(list)){
					printf("Lista vazia. Listagem inviavel.\n");
				}
				else {
					printf("Elementos jah cadastrados:\n\n");
					listagem(list);
				}
				break;
			case 0: printf("FINAL DE PROGRAMA!\n");
				break;
			default: printf("ERRO - Opcao invalida!\n");
			break;
		} //do switch
		
		printf("\nPressione qq tecla p/ continuar");
		getch();
		
	} while(opcao != 0);
} //do main

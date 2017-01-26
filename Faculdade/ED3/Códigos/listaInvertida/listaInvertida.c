struct Tno * inverteLista(struct Tno * lista)
{
	
	struct Tno *p, *q;
	int tam;
	
	
	p = lista;
	
	tam = tamanhoLista(p);
	
	for(int i = tam; i>0;i--)
	{
		
		q = q->prox;
		p = p->prox;
		
		q->info = p->info;
	}
	
	
	return(q);
	
	
}




int tamanho (struct Tno *lista)
{
	int cont;
	struct Tno *p;
	
	cont = 0;
	p = lista;
	
	while(p != NULL)
	{
		cont ++;
		p = p->prox;
		
	}
	
	return(cont);
	
	
}

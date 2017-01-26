using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;
using System.Threading.Tasks;
using System.Threading;

namespace ProjetoInt
{
    class Program
    {
        public static string arq_cardapio = "Cardápio.txt";
        public static StreamWriter escrita;
        public static StreamReader leitura;


        static void Main(string[] args)
        {
            login();
            while (true)
            {
                try
                {

                    Console.Clear();
                    /* Console.WriteLine("|--------------------------------------------- |");
                     Console.WriteLine("##     MENU Principal - ESCOLHA UMA OPÇÃO     ##");
                     Console.WriteLine("|--------------------------------------------- |");
                     Console.WriteLine("  1- Administrador");
                     Console.WriteLine("  2- Caixa ");
                     Console.WriteLine("  3- Cliente");
                     Console.WriteLine("  4- Contador");
                     Console.WriteLine("  0- Fechar");
                     Console.WriteLine("|--------------------------------------------- |");
                     Console.WriteLine("|--------------------------------------------- |");*/
                    cabecalho("MENU PRINCIPAL - ESCOLHA UMA OPÇÃO");
                    cabecalho("");
                    Console.WriteLine();
                    cabecalho("1- Administrador");
                    cabecalho("2- Caixa        ");
                    cabecalho("3- Cliente      ");
                    cabecalho("4- Contador     ");
                    cabecalho("0- Fechar       ");
                    cabecalho("");
                    Console.Write("Opçao: ");
                    int opcao_escolhida = int.Parse(Console.ReadLine());


                    if (opcao_escolhida == 1)
                    {
                        ADMINISTRADOR();
                    }
                    else if (opcao_escolhida == 2)
                    {
                        Console.WriteLine("Caixa(ocorreu problemas de sintaxe )");
                    }
                    else if (opcao_escolhida == 3)
                    {
                        Console.Clear();
                        menu_cardapio_cliente();
                    }
                    else if (opcao_escolhida == 4)
                    {
                        menu_contador();
                        CONTADOR();
                    }
                    else if (opcao_escolhida == 0)
                    {
                        break;
                    }
                    else
                    {
                        Console.WriteLine("OPÇAO INVÁLIDA ");
                    }

                }
                catch (Exception ex)
                {
                    Console.WriteLine(ex.Message);
                    Console.ReadKey();
                }
            }
        }




        // CABEÇALHO
        public static void cabecalho(string cabçlho)
        {
            int tam, espaço, i;
            for (i = 0; i < 79; i++)
                Console.Write("-");
            Console.WriteLine();
            tam = cabçlho.Length;
            espaço = 40 - tam / 2;
            for (i = 0; i < espaço; i++)
                Console.Write(" ");
            Console.WriteLine(cabçlho);
            //for(i=0; i<78;i++)
            //  Console.Write("-");


        }

        // MENU DO ADM
        public static void menu_adm()
        {
            Console.Clear();
            /*Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("#    MENU ADMINISTRADOR - ESCOLHA UMA OPÇÃO    #");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("  1- Cardápio(cadastrar, excluir, editar pratos) ");
            Console.WriteLine("  2- Porcentagens ");
            Console.WriteLine("  3- Lucros/Prejuizos ");
            Console.WriteLine("  4- Pratos mais vendidos");
            Console.WriteLine("  5- Relatórios do contador");
            Console.WriteLine("  0- Sair");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("|--------------------------------------------- |");*/
            cabecalho("MENU ADMINISTRADOR - ESCOLHA UMA OPÇÃO");
            cabecalho("");
            Console.WriteLine();
            cabecalho("1- Cardápio(cadastrar, excluir, editar)");
            cabecalho("2- Porcentagens                        ");
            cabecalho("3- Lucros/Prejuizos                    ");
            cabecalho("4- Pratos mais vendidos                ");
            cabecalho("5- Relatórios do contador              ");
            cabecalho("0- Sair                                ");
            cabecalho("");
            Console.Write("Opçao: ");
        }

        //MENU DO CONTADOR
        public static void menu_contador()
        {
            Console.Clear();
            /* Console.WriteLine("|--------------------------------------------- |");
             Console.WriteLine("#      MENU CONTADOR - ESCOLHA UMA OPÇÃO       #");
             Console.WriteLine("|--------------------------------------------- |");
             Console.WriteLine("  1- Montante, lucro/prejuízo, gastos ");
             Console.WriteLine("  2- Redigir relatório para o administrador ");
             Console.WriteLine("  0- Voltar ao menu anterior ");
             Console.WriteLine("|--------------------------------------------- |");
             Console.WriteLine("|--------------------------------------------- |");*/
            cabecalho("MENU CONTADOR - ESCOLHA UMA OPÇÃO");
            cabecalho("");
            Console.WriteLine();
            cabecalho("1- Montante, lucro/prejuízo, gastos      ");
            cabecalho("2- Redigir relatório para o administrador");
            cabecalho("0- Voltar ao menu anterior               ");
            cabecalho("");
            Console.Write("Opçao: ");
        }

        // MENU DO CARDAPIO
        public static void menu_cardapio()
        {
            Console.Clear();
            /*Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("#       MENU CARDAPIO - ESCOLHA UMA OPÇÃO      #");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("  1- Cadastrar prato ");
            Console.WriteLine("  2- Editar prato ");
            Console.WriteLine("  3- Excluir prato ");
            Console.WriteLine("  0- Voltar ao menu anterior");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("|--------------------------------------------- |");*/
            cabecalho("MENU ADMINISTRADOR - ESCOLHA UMA OPÇÃO");
            cabecalho("");
            Console.WriteLine();
            cabecalho("1- Cadastrar prato        ");
            cabecalho("2- Editar prato           ");
            cabecalho("3- Excluir prato          ");
            cabecalho("0- Voltar ao menu anterior");
            cabecalho("");
            Console.Write("Opçao: ");
        }

        // MENU DO CARDAPIO DO CLIENTE(MODELO A SER SEGUIDO AOS MENUS)
        public static void menu_cardapio_cliente()
        {

            cabecalho("CÁRDAPIO - ESCOLHA UMA OPÇÃO");
            cabecalho("");
            Console.WriteLine();
            cabecalho("1- Pratos família");
            cabecalho("2- Pratos da casa");
            cabecalho("3- Porções       ");
            cabecalho("4- Bebidas       ");
            cabecalho("5- Petiscos      ");
            cabecalho("88- Para ver o valor total da comanda");
            cabecalho("99- Para finalizar o pedido          ");
            cabecalho("");
            Console.WriteLine();
        }

        // ESTRUTURA PARA O CARDAPIO
        public struct CadPrato
        {
            public string prato, ingredientes;
            public double preco;
            public int tprato;

        }

        // Rotina de login adm
        public static void login()
        {
            Console.Clear();
            string nome_arquivo, user, senha, confirma_senha, user_arq = "a", senha_arq = "a";
            StreamWriter escrita; //objeto de ligação com arquivo(escrita no arquivo)
            StreamReader leitura; //objeto de ligação com arquivo(leitura do arquivo)
            nome_arquivo = "Destino login.txt";

            if (!File.Exists(nome_arquivo)) //verifica se ja existe um arquivo com o nome especificado
            {
                escrita = new StreamWriter(nome_arquivo, true); //se o arquivo existir, o que for digitado sera concatenado ao seu conteudo
                Console.WriteLine("Cadastre seu usuario e sua senha.");
                Console.Write("Nome do usuário: ");
                user = Console.ReadLine();
                Console.Write("Senha: ");
                senha = Console.ReadLine();
                Console.Write("Confirme sua senha: ");
                confirma_senha = Console.ReadLine();
                while (senha != confirma_senha)//Confimando a senha do usuario
                {
                    Console.WriteLine("A senha não está igual a confirmação, por favor tente novamente. ");
                    Console.Write("Senha: ");
                    senha = Console.ReadLine();
                    Console.Write("Confirme sua senha: ");
                    confirma_senha = Console.ReadLine();
                }
                Console.WriteLine("Cadastrado com Sucesso !");
                escrita.WriteLine(user);//salvando a senha e user no arquivo
                escrita.WriteLine(senha);
                escrita.Close();


            }
            //Se ja existir o arquivo simplismente compara para ver se é mesmo o usuario
            else
            {
                /*Console.WriteLine("|----------------------------------------------------|");
                Console.WriteLine("###                 FAÇA SEU LOGIN                 ###");
                Console.WriteLine("|----------------------------------------------------|");
                Console.WriteLine("|                                                    |");
                Console.WriteLine("***  Para mudar usuario e senha digite 0 em ambos  ***");
                Console.WriteLine("|                                                    |");
                Console.WriteLine("|----------------------------------------------------|");*/
                cabecalho("");
                cabecalho("## FAÇA SEU LOGIN ##");
                Console.WriteLine();
                cabecalho("Para mudar usuáeio e senha digite 0 em ambos os campos");
                Console.WriteLine();
                cabecalho("");
                leitura = new StreamReader(nome_arquivo); //para ler a senha
                while (!leitura.EndOfStream) //comando que verifica se é o final da stream
                {
                    user_arq = leitura.ReadLine();
                    senha_arq = leitura.ReadLine();
                }
                Console.Write("Usuário: ");
                user = Console.ReadLine();
                Console.Write("Senha: ");
                senha = Console.ReadLine();
                while ((user != user_arq || senha != senha_arq) && (user != "0" || senha != "0"))
                {
                    Console.WriteLine("Usuario e/ou senha incorreto(s), por favor tente novamente. ");
                    Console.Write("Usuário: ");
                    user = Console.ReadLine();
                    Console.Write("Senha: ");
                    senha = Console.ReadLine();

                }
                leitura.Close();
                if (user == "0" && senha == "0")
                {
                    Console.Write("Confirme seu Usuário: ");
                    user = Console.ReadLine();
                    Console.Write("Confime sua Senha: ");
                    senha = Console.ReadLine();
                    while ((user != user_arq || senha != senha_arq) && (user != "0" || senha != "0"))
                    {
                        Console.WriteLine("Usuario e/ou senha incorreto(s), por favor tente novamente. ");
                        Console.Write("Confirme seu Usuário: ");
                        user = Console.ReadLine();
                        Console.Write("Confime sua Senha: ");
                        senha = Console.ReadLine();

                    }

                    if (user == user_arq && senha == senha_arq)
                    {
                        Console.Clear();
                        /* Console.WriteLine("|----------------------------------------------------|");
                         Console.WriteLine("###                 FAÇA SEU LOGIN                 ###");
                         Console.WriteLine("|----------------------------------------------------|");
                         Console.WriteLine("|                                                    |");
                         Console.WriteLine("***  Para mudar usuario e senha digite 0 em ambos  ***");
                         Console.WriteLine("|                                                    |");
                         Console.WriteLine("|----------------------------------------------------|");*/
                        cabecalho("");
                        cabecalho("## FAÇA SEU LOGIN ##");
                        Console.WriteLine();
                        cabecalho("Para mudar usuário e senha digite 0 em ambos os campos");
                        Console.WriteLine();
                        cabecalho("");
                        escrita = new StreamWriter(nome_arquivo, true); //se o arquivo existir, o que for digitado sera concatenado ao seu conteudo
                        Console.WriteLine("Recadastre seu usuario e sua senha.");
                        Console.Write("Nome do usuário: ");
                        user = Console.ReadLine();
                        Console.Write("Senha: ");
                        senha = Console.ReadLine();
                        Console.Write("Confirme sua senha: ");
                        confirma_senha = Console.ReadLine();
                        while (senha != confirma_senha)//Confimando a senha do usuario
                        {
                            Console.WriteLine("A senha não está igual a confirmação, por favor tente novamente. ");
                            Console.Write("Senha: ");
                            senha = Console.ReadLine();
                            Console.Write("Confirme sua senha: ");
                            confirma_senha = Console.ReadLine();
                        }
                        Console.WriteLine("Cadastrado com Sucesso !");
                        escrita.WriteLine(user);//salvando a senha e user no arquivo
                        escrita.WriteLine(senha);
                        escrita.Close();
                    }// fim do if da confirmação para recadastro de senha



                }
            }

        }// fim da rotina login

        //ROTINA ADM
        public static void ADMINISTRADOR()
        {
            Console.WriteLine();
            /* Console.Write("(Loading) ");
             for (int ld = 0; ld < 69; ld++)
             {
                 Thread.Sleep(25);
                 Console.Write("║");
             }
             Thread.Sleep(300);
             Console.WriteLine();
             Console.Clear();
             Console.WriteLine();*/

            int escolha, escolha2;
            menu_adm();

            //menu principal adm
            do
            {
                escolha = Convert.ToInt16(Console.ReadLine());
                if (escolha == 1)
                {
                    string opcao;
                    // menu cardapio
                    menu_cardapio();
                    do
                    {
                        escolha2 = Convert.ToInt16(Console.ReadLine());
                        if (escolha2 == 1)
                        {
                            do
                            {
                                CadPrato novoCad;

                                Console.Write("Nome do prato: ");
                                novoCad.prato = Console.ReadLine();
                                Console.Write("Ingredientes do prato: ");
                                novoCad.ingredientes = Console.ReadLine();
                                Console.Write("Preço do prato: ");
                                novoCad.preco = Convert.ToDouble(Console.ReadLine());
                                Console.Write("Tipo: ");
                                novoCad.tprato = Convert.ToInt16(Console.ReadLine());

                                cadastraCardapio(novoCad);

                                Console.Write("Deseja cadastrar outro prato? Y/N: ");
                                opcao = Console.ReadLine();
                                Console.Clear();
                                menu_cardapio();

                            } while (opcao != "n" && opcao != "N");

                            menu_cardapio();
                        }
                        else if (escolha2 == 2)
                        {
                            CadPrato[] cad_cardapio = retornaCardapio();

                            for (int i = 0; i < cad_cardapio.Count(); i++)
                            {
                                Console.WriteLine((i + 1) + " - " + cad_cardapio[i].prato);
                            }


                            Console.WriteLine();
                            Console.Write("Digite o número do prato a ser editado: ");
                            int num = Convert.ToInt16(Console.ReadLine());
                            Console.WriteLine();

                            Console.WriteLine("Nome: " + cad_cardapio[num - 1].prato);
                            Console.WriteLine("Ingredientes: " + cad_cardapio[num - 1].ingredientes);
                            Console.WriteLine("Preço: " + cad_cardapio[num - 1].preco);
                            Console.WriteLine("Tipo: " + cad_cardapio[num - 1].tprato);

                            Console.WriteLine();

                            Console.Write("O que deseja editar? (nome, ingredientes, preço ou tipo)(99 para sair): ");
                            string op_edição;
                            op_edição = Console.ReadLine();
                            //LOOP PARA EDIÇÃO
                            do
                            {
                                if (op_edição == "nome")
                                {
                                    Console.Write("Novo nome: ");
                                    cad_cardapio[num - 1].prato = Console.ReadLine();
                                }
                                else if (op_edição == "ingredientes")
                                {
                                    Console.Write("Novos ingredientes: ");
                                    cad_cardapio[num - 1].ingredientes = Console.ReadLine();
                                }
                                else if (op_edição == "preço")
                                {
                                    Console.Write("Novo preço: ");
                                    cad_cardapio[num - 1].preco = Convert.ToDouble(Console.ReadLine());
                                }
                                else if (op_edição == "tipo")
                                {
                                    Console.Write("Novo tipo: ");
                                    cad_cardapio[num - 1].tprato = Convert.ToInt16(Console.ReadLine());
                                }
                                else if (op_edição != "nome" && op_edição != "ingredientes" && op_edição != "preço" && op_edição != "tipo" && op_edição != "99")
                                {
                                    Console.WriteLine("Você digitou uma opção inválida, tente um comando válido.");
                                    Console.Write("O que deseja editar? (nome, ingredientes, preço ou tipo)(99 para sair): ");
                                    op_edição = Console.ReadLine();
                                }
                                if (op_edição != "99")
                                {
                                    Console.Write("Se deseja alterar mais algum campo digite o nome do campo desejado ou (99) para finalizar : ");
                                    op_edição = Console.ReadLine();
                                }


                            } while (op_edição != "99");
                            //FIM DO LOOP PARA EDIÇÃO


                            geraNovoCardapio(cad_cardapio);



                            menu_cardapio();
                        }
                        else if (escolha2 == 3)
                        {
                            CadPrato[] cad_cardapio = retornaCardapio();

                            for (int i = 0; i < cad_cardapio.Count(); i++)
                            {
                                Console.WriteLine((i + 1) + " - " + cad_cardapio[i].prato);
                            }


                            Console.WriteLine();
                            Console.Write("Digite o número do prato a ser deletado: ");
                            int num = Convert.ToInt16(Console.ReadLine());

                            deletarCardapio(num);


                            menu_cardapio();
                        }
                        else if (escolha2 != 1 && escolha2 != 2 && escolha2 != 3 && escolha2 != 0)
                        {
                            Console.WriteLine("Opção inválida");
                        }

                    } while (escolha2 != 0);
                    menu_adm();
                }
                else if (escolha == 2)
                {
                }
                else if (escolha == 3)
                {
                    Console.WriteLine("Hell Yeah!");
                }
                else if (escolha == 4)
                {
                }
                else if (escolha == 5)
                {
                }
                else if (escolha != 1 && escolha != 2 && escolha != 3 && escolha != 4 && escolha != 5 && escolha != 0)
                {
                    Console.WriteLine("   #*# OPÇÃO INVÁLIDA #*#");
                }
            } while (escolha != 0);
        }// FIM DA ROTINA ADMINISTRADOR

        //ROTINA CONTADOR
        public static void CONTADOR()
        {
            menu_contador();
            int escolha_cont;
            string relatorio, nome_arq_cont = "Relátorio do contador";

            do
            {
                escolha_cont = Convert.ToInt16(Console.ReadLine());

                if (escolha_cont == 1)
                {

                    /* deve somar o preço de todos os pratos\bebidas vendidos e somar, e imprimi na tela o montante resultante
                     * deve somar os gastos de todos os pratos vendidos e imprimir na tela o gasto total
                     * deve subtrair o montante pelo gasto e imprimir na tela o lucro/prejuizo na tela */
                }
                if (escolha_cont == 2)
                {
                    // deverá haver a opção de assunto do relatorio, e a opcao para o adm de escolher qual assunto quiser ler
                    escrita = new StreamWriter(nome_arq_cont);
                    Console.WriteLine("Digite o Relatório para o adm: ");
                    relatorio = Console.ReadLine();
                    escrita.WriteLine(relatorio);
                    escrita.Close();
                }
                if (escolha_cont != 1 && escolha_cont != 2 && escolha_cont != 0)
                {
                    Console.WriteLine("      OPÇÃO INVÁLIDA");
                }



            } while (escolha_cont != 0);
        }

        public static CadPrato[] retornaCardapio()
        {

            int j = 0;

            leitura = new StreamReader(arq_cardapio);

            while (leitura.ReadLine() != null)
            {
                j++;
            }

            CadPrato[] cad_cardapio = new CadPrato[j / 4];

            j = 0;

            leitura.Close();

            leitura = new StreamReader(arq_cardapio);

            while (!leitura.EndOfStream)
            {
                cad_cardapio[j].prato = leitura.ReadLine();
                cad_cardapio[j].ingredientes = leitura.ReadLine();
                cad_cardapio[j].preco = Convert.ToDouble(leitura.ReadLine());
                cad_cardapio[j].tprato = Convert.ToInt16(leitura.ReadLine());
                j++;
            }

            leitura.Close();

            return cad_cardapio;
        }

        public static bool cadastraCardapio(CadPrato cardapio)
        {
            if (File.Exists(arq_cardapio))//verifica se ja existe um arquivo com o nome especificado;
            {
                escrita = new StreamWriter(arq_cardapio, true); //se o arquivo existir, o que for digitado sera concatenado ao seu conteudo;
            }
            else
            {
                escrita = new StreamWriter(arq_cardapio); //se nao o arquivo sera criado;
            }
            escrita.WriteLine(cardapio.prato);
            escrita.WriteLine(cardapio.ingredientes);
            escrita.WriteLine(cardapio.preco);
            escrita.WriteLine(cardapio.tprato);
            escrita.Close();

            return true;
        }

        public static bool deletarCardapio(int codProduto)
        {
            CadPrato[] cad_cardapio = retornaCardapio();

            //List<CadPrato> cad_cardapio2 = new List<CadPrato>();

            //cad_cardapio2.OrderBy(x => x.tprato);

            //Count conta o total de registros cadastrados
            CadPrato[] novo_cad_cardapio = new CadPrato[cad_cardapio.Count() - 1];

            int cont2 = 0;

            for (int cont = 0; cont < cad_cardapio.Count(); cont++)
            {
                if (codProduto != (cont + 1))
                {
                    novo_cad_cardapio[cont2] = cad_cardapio[cont];
                    cont2++;
                }
            }

            geraNovoCardapio(novo_cad_cardapio);

            return true;
        }

        public static bool geraNovoCardapio(CadPrato[] novoCardapio)
        {
            escrita = new StreamWriter(arq_cardapio);

            for (int cont = 0; cont < novoCardapio.Count(); cont++)
            {
                escrita.WriteLine(novoCardapio[cont].prato);
                escrita.WriteLine(novoCardapio[cont].ingredientes);
                escrita.WriteLine(novoCardapio[cont].preco);
                escrita.WriteLine(novoCardapio[cont].tprato);
            }

            escrita.Close();

            return true;
        }









        //Exemplo de testar usuarios

        static string localDados = @"C:/ProjetoIntegrador/Prog_Cond/";

        static string arquivoDadosUsuarios = @"Usuario.txt";

        static bool testaLogin(string usuario, string senha)
        {
            CadPrato[] cad_cardapio = retornaCardapio();

            for (int i = 0; i < cad_cardapio.Count(); i++)
            {
                if (cad_cardapio[i].prato == usuario && cad_cardapio[i].ingredientes == senha)
                {
                    return true;
                }
            }

            return false;

        }



    }
}
























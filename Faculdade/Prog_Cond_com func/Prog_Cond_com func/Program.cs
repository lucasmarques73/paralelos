﻿using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;

namespace Prog_Cond_com_func
{
    class Program
    {

        #region Structs
        public struct tipo_morador
        {
            public int cod;
            public string nome;
            public string tel;
            public int num_dependentes;
            public string cpf;
            public string rua;
            public int num;
            public int complemento;
            public DateTime inicio_moradia;
            
        }
        public struct tipo_condominio
        {
            public string nome;
            public int num_apartamentos, cod;
            public double valor_total_condominio;
        }
        public struct tipo_despesa
        {
            public int cod;
            public string data_pagamento ;
            public string data_vencimento;
            public string descricao;
            public double valor;
            public double valor_pago;
            public bool pago;

        }
        public struct tipo_controle_pagamento
        {
            public int cod;
            public int cod_morador;
            public string nome_morador;
            public string data_referencia;
            public string data_pagamento;
            public double valor_condominio_morador;            
            public bool pago;

        }
        public struct tipo_usuario
        {
           public string usuario;
           public string senha;
        }
        #endregion

        #region Variaveis Arquivos
        static string localDados = @"C:/ProjetoIntegrador/Prog_Cond/";
        static string arquivoDadosCondominio = @"Condominio.txt";
        static string arquivoDadosMorador = @"Morador.txt";
        static string arquivoDadosDespesas = @"Despesas.txt";
        static string arquivoDadosPagamentos = @"Pagamento.txt";
        static string arquivoDadosUsuarios = @"Usuario.txt";
        #endregion

        static void Main(string[] args)
        {
            #region Arquivo
            DirectoryInfo dirInfo = new DirectoryInfo(localDados);
            if (!dirInfo.Exists)
            {
                dirInfo.Create();
            }

            if (!File.Exists(localDados + arquivoDadosMorador))
            {
                File.Create(localDados + arquivoDadosMorador);
            }

            if (!File.Exists(localDados + arquivoDadosDespesas))
            {
                File.Create(localDados + arquivoDadosDespesas);
            }

            if (!File.Exists(localDados + arquivoDadosPagamentos))
            {
                File.Create(localDados + arquivoDadosPagamentos);
            }

            if (!File.Exists(localDados + arquivoDadosCondominio))
            {
                File.Create(localDados + arquivoDadosCondominio);
            }
            if (!File.Exists(localDados + arquivoDadosUsuarios))
            {
                File.Create(localDados + arquivoDadosUsuarios);
            }
            #endregion

            cria_login_admin();
            login();

            ConfigurarJanela();

            //Menu
            while (true)
            {
                try
                {
                    Console.Clear();
                    cabecalho("MENU PRINCIPAL - ESCOLHA UMA OPÇÃO");
                    Console.WriteLine("   1 - CONDOMINIO");
                    Console.WriteLine("   2 - MORADOR");
                    Console.WriteLine("   3 - DESPESAS");
                    Console.WriteLine("   4 - PAGAMENTOS");
                    Console.WriteLine("   0 - SAIR");
                    cabecalho("");
                    Console.Write("OPÇÃO:");
                    int op = int.Parse(Console.ReadLine());
                    if (op == 1)
                    {
                        Console.Clear();
                        cabecalho("MENU CONDOMÍNIO - ESCOLHA UMA OPÇÃO");
                        menu_condominio();
                    }
                    else if (op == 2)
                    {
                        Console.Clear();
                        // cabecalho("MENU MORADOR - ESCOLHA UMA OPÇÃO");
                        menu_morador();
                    }
                    else if (op == 3)
                    {
                        Console.Clear();
                        //   cabecalho("MENU DESPESAS - ESCOLHA UMA OPÇÃO");
                        menu_despesas();
                    }
                    else if (op == 4)
                    {
                        Console.Clear();
                        //  cabecalho("MENU PAGAMENTOS - ESCOLHA UMA OPÇÃO");
                        menu_pagamentos();
                    }
                    else if (op == 0)
                    {
                        break;
                    }
                    else
                    {
                        cabecalho("OPÇÃO INVÁLIDA!");
                        Console.Beep();
                        Console.ReadKey();
                    }
                  
                }
                catch (Exception ex)
                {
                    linha();
                    Console.WriteLine("");
                    Console.Write("ERRO:");
                    Console.WriteLine(ex.Message);
                    Console.Beep();

                    cabecalho("PRECIONE ALGUMA TELCA PARA VOLTAR AO MENU");
                 
                    Console.ReadLine();
                }
            }
        }

        #region Layout
        public static void linha()
        {
            Console.Write("|");
            for (int i = 1; i < 148; i++)
                Console.Write("-");
            Console.Write("|");
            
        }
        public static void cabecalho(string op)
        {
            int tam, espaco, i;


            linha();
            tam = op.Length;
            espaco = 75 - tam / 2;
            for (i = 0; i < espaco; i++)
            {
                Console.Write(" ");
                if (i == 0)
                    Console.Write("|");
            }
            Console.Write(op);

            for (i = (tam + espaco); i < 149; i++)
            {
                Console.Write(" ");
                if (i == 147)
                    Console.Write("|");
            }

            linha();
            Console.WriteLine("");
        }
        public static void ConfigurarJanela()
        {
            Console.Title = "SISTEMA DE GERENCIAMENTO DE CONDOMÍNIO";
            Console.BackgroundColor = ConsoleColor.DarkCyan;
            Console.ForegroundColor = ConsoleColor.White;
          //  Console.BufferHeight = 50;
           Console.BufferWidth = 150;
            Console.SetWindowSize(150, 50);
        }
        public static void loading()
        {
            Console.Clear();
            Console.WriteLine();
            Console.Write("(Loading) ");
            for (int ld = 0; ld < 69; ld++)
            {
                Thread.Sleep(25);
                Console.Write("║");
            }
            Thread.Sleep(300);
            Console.WriteLine();
            Console.Clear();
        }
        #endregion

        #region Login
        public static void cria_login_admin()
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosUsuarios);
            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();

            if(j==0)
            {
                StreamWriter writer = File.AppendText(localDados + arquivoDadosUsuarios);
            writer.WriteLine("admin");
            writer.WriteLine("NQZVA");
            writer.Close();
            writer.Dispose();
            }
        }
        public static void login()
        {
            string pass = "", user = "", senha = "";


            do
            {
                pass = "";
                user = "";
                senha = "";

                Console.Write("Enter your username: ");
                user = Console.ReadLine();
                Console.Write("Enter your password: ");
                ConsoleKeyInfo key;

                do
                {
                    key = Console.ReadKey(true);

                    // Backspace Should Not Work
                    if (key.Key != ConsoleKey.Backspace && key.Key != ConsoleKey.Enter)
                    {
                        pass += key.KeyChar;
                        Console.Write("*");
                    }
                    else
                    {
                        if (key.Key == ConsoleKey.Backspace && pass.Length > 0)
                        {
                            pass = pass.Substring(0, (pass.Length - 1));
                            Console.Write("\b \b");
                        }

                    }
                }
                // Stops Receving Keys Once Enter is Pressed
                while (key.Key != ConsoleKey.Enter);

                senha = criptografia(pass);

                if (testaLogin(user, senha))
                {
                    Console.WriteLine("\nLogin Correct!");
                }
                else
                {
                    Console.WriteLine("\nLogin Incorrect");
                    Console.WriteLine("ACCESS DENIED");
                }
            } while (testaLogin(user, senha) != true);


            Console.WriteLine("Register new user?");
            Console.WriteLine("1 - Yes  2 - No");
            int op = int.Parse(Console.ReadLine());

            if (op == 1)
            {
                string new_pass = "", new_user = "", confirm_new_pass = "";

                Console.WriteLine("New User:");
                new_user = Console.ReadLine();
                new_pass = "";
                Console.WriteLine("Password:");
                ConsoleKeyInfo key;

                do
                {

                    key = Console.ReadKey(true);

                    // Backspace Should Not Work
                    if (key.Key != ConsoleKey.Backspace && key.Key != ConsoleKey.Enter)
                    {
                        new_pass += key.KeyChar;
                        Console.Write("*");
                    }
                    else
                    {
                        if (key.Key == ConsoleKey.Backspace && new_pass.Length > 0)
                        {
                            new_pass = new_pass.Substring(0, (new_pass.Length - 1));
                            Console.Write("\b \b");
                        }

                    }
                } while (key.Key != ConsoleKey.Enter);
                confirm_new_pass = "";
                Console.WriteLine("\nConfirm Password:");
                ConsoleKeyInfo key2;

                do
                {

                    key2 = Console.ReadKey(true);

                    // Backspace Should Not Work
                    if (key2.Key != ConsoleKey.Backspace && key2.Key != ConsoleKey.Enter)
                    {
                        confirm_new_pass += key2.KeyChar;
                        Console.Write("*");
                    }
                    else
                    {
                        if (key2.Key == ConsoleKey.Backspace && confirm_new_pass.Length > 0)
                        {
                            confirm_new_pass = confirm_new_pass.Substring(0, (confirm_new_pass.Length - 1));
                            Console.Write("\b \b");
                        }

                    }
                } while (key2.Key != ConsoleKey.Enter);

                while (new_pass != confirm_new_pass)
                {

                    new_pass = "";


                    Console.WriteLine("\nDIFFERENT PASSWORDS");
                    Console.WriteLine("Password:");
                    ConsoleKeyInfo key3;

                    do
                    {
                        key3 = Console.ReadKey(true);

                        // Backspace Should Not Work
                        if (key3.Key != ConsoleKey.Backspace && key3.Key != ConsoleKey.Enter)
                        {
                            new_pass += key3.KeyChar;
                            Console.Write("*");
                        }
                        else
                        {
                            if (key3.Key == ConsoleKey.Backspace && new_pass.Length > 0)
                            {
                                new_pass = new_pass.Substring(0, (new_pass.Length - 1));
                                Console.Write("\b \b");
                            }

                        }
                    } while (key3.Key != ConsoleKey.Enter);
                    confirm_new_pass = "";
                    Console.WriteLine("\nConfirm Password:");
                    ConsoleKeyInfo key4;

                    do
                    {

                        key4 = Console.ReadKey(true);

                        // Backspace Should Not Work
                        if (key4.Key != ConsoleKey.Backspace && key4.Key != ConsoleKey.Enter)
                        {
                            confirm_new_pass += key4.KeyChar;
                            Console.Write("*");
                        }
                        else
                        {
                            if (key4.Key == ConsoleKey.Backspace && confirm_new_pass.Length > 0)
                            {
                                confirm_new_pass = confirm_new_pass.Substring(0, (confirm_new_pass.Length - 1));
                                Console.Write("\b \b");
                            }

                        }
                    } while (key4.Key != ConsoleKey.Enter);
                }

                string new_pass_crip = criptografia(new_pass);

                StreamWriter writer = File.AppendText(localDados + arquivoDadosUsuarios);

                writer.WriteLine(new_user);
                writer.WriteLine(new_pass_crip);
                writer.Close();
                writer.Dispose();

                loading();
            }
            else
            {
                loading();
            }
        }
        public static bool testaLogin(string user, string pass)
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosUsuarios);
            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }

            tipo_usuario[] usuario = new tipo_usuario[j / 2];

            reader.Close();

            j = 0;

            reader = new StreamReader(localDados + arquivoDadosUsuarios);

            while (!reader.EndOfStream)
            {
                usuario[j].usuario = reader.ReadLine();
                usuario[j].senha = reader.ReadLine();
                j++;
            }

            reader.Close();
            reader.Dispose();

            for (int i = 0; i < usuario.Count(); i++)
            {
                if (usuario[i].usuario == user && usuario[i].senha == pass)
                {
                    return true;
                }
            }

            return false;
        }
        public static string criptografia(string pass)
        {
            string texto_cript = "", texto_tabela = "";
            int chave = 13;



            //Pega o texto digitado pelo usuario e converto os espaços e pontuação para as letras da tabela
            texto_tabela = pass.ToUpper().Replace(" ", "WBRW").Replace(",", "WVRW").Replace(".", "WPTW").Replace(";", "WPVW").Replace(":", "WDPW").Replace("!", "WEXW").Replace("?", "WINW").Replace("-", "WHFW");


            for (int i = 0; i < texto_tabela.Length; i++)
            {
                //Devolve o codigo ASCII da letra
                int ASCII = (int)texto_tabela[i];

                //Coloca a chave fixa adicionando n posições no numero da tabela ASCII
                int ASCIIC = ASCII + chave;
                //subtrai 65 do numero obtido para que possa ser feito o MOD 26
                int texto_menos_65 = ASCIIC - 65;
                // faz o resto da divisao por 26 e obtem um numero de 0 a 25
                int mod = (texto_menos_65 % 26);
                //depois de obter um numero de 0 a 25, somamos 65 para obter o numero da letra em codigo ascii
                int texto_mais_65 = mod + 65;


                //Concatena o texto e o coloca na variável sem mod
                texto_cript += Char.ConvertFromUtf32(texto_mais_65);
            }


            return (texto_cript);





        }
        #endregion

        #region Condominio
        public static void cadastro_condominio()
        {
             StreamReader reader = new StreamReader(localDados + arquivoDadosCondominio);

            
            int contaRegistro = 0;
         
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }
            
            reader.Close();
           
            reader.Dispose();

            if (contaRegistro >= 1 )
            {
                cabecalho("VOCÊ NÃO PODE CADASTRAR MAIS CONDOMÍNIOS");
                Console.ReadKey();
            }
            else
            {
            tipo_condominio condominio;          
            Console.WriteLine("DIGITE O NOME DO CONDOMÍNIO:");
            condominio.nome = Console.ReadLine().ToUpper().Replace(';', ' ');
            Console.WriteLine("NUMERO DE APARTAMENTOS DO CONDOMINO:");
            condominio.num_apartamentos = int.Parse(Console.ReadLine());

            condominio.valor_total_condominio = 0.00;
           
            Console.Clear();
            StreamWriter writer = File.AppendText(localDados + arquivoDadosCondominio);

            condominio.cod = contaRegistro + 1;
            writer.WriteLine(condominio.cod + ";" + condominio.nome + ";" + condominio.num_apartamentos + ";" + condominio.valor_total_condominio);

                writer.Close();

                writer.Dispose();


                cabecalho("CODIGO DO CONDOMÍNIO: " + condominio.cod + "");
                cabecalho("SUCESSO");
                Console.ReadKey();
            }
            
        }
        public static void consulta_condominio()
        {
                
                
                Console.WriteLine("DIGITE O NOME DO CONDOMÍNIO:");
                string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


                cabecalho("RESULTADOS");


                StreamReader reader = new StreamReader(localDados + arquivoDadosCondominio);
                
                string resultado;
                while ((resultado = reader.ReadLine()) != null)
                {
                    
                    if (resultado.Contains(termoBusca))
                    {

                        string[] condominio_resultado = resultado.Split(';');


                        tipo_condominio condominio;
                        condominio.cod = Convert.ToInt32(condominio_resultado[0]);
                        condominio.nome = condominio_resultado[1];
                        condominio.num_apartamentos = int.Parse(condominio_resultado[2]);
                   

                        
                        Console.WriteLine("CODIGO DO CONDOMÍNIO:");
                        Console.WriteLine(condominio.cod);
                        Console.WriteLine("NOME DO CONDOMÍNIO:");
                        Console.WriteLine(condominio.nome);
                        Console.WriteLine("NUMERO DE APARTAMENTOS:");
                        Console.WriteLine(condominio.num_apartamentos);
                        cabecalho("");
                        Console.WriteLine("");
                    }
                }

                
                reader.Close();                
                reader.Dispose();

                Console.ReadKey();
        }
        public static void calcular_condominio()
       {
           tipo_controle_pagamento controle;
           bool val_data = false;

           controle.data_referencia = "";
            tipo_controle_pagamento[] controle2 = retorna_controle();
            string[] testa_data = new string[controle2.Count()];
           for (int cont = 0; cont < controle2.Count(); cont++)
           {
               testa_data[cont] = controle2[cont].data_referencia;
           }

          
            Console.WriteLine("MÊS PARA CALCULO:(MM/AAAA)");
            string data_referencia = Console.ReadLine();

            for (int t = 0; t < controle2.Count(); t++)
            {
                if (testa_data[t] == data_referencia)
                {
                    val_data = true;
                }
            }
            if (val_data == true)
            {
                cabecalho("DATA DE REFERÊNCIA INVÁLIDA!");
                cabecalho("ESTE MÊS JÁ FOI CALCULADO.");
                Console.ReadKey();
            }
            else
            {
                cabecalho("CALCULO DO VALOR DO CONDOMINIO");

                double valor_total_condominio = 0;
                controle.valor_condominio_morador = 0;


                tipo_despesa[] despesa = retorna_despesas();
                for (int i = 0; i < despesa.Count(); i++)
                {
                    if (despesa[i].pago != true)
                        valor_total_condominio = valor_total_condominio + despesa[i].valor;
                }


                tipo_condominio[] condominio = retorna_condominio();
                int k = 0;
                for (k = 0; k < condominio.Count(); k++)
                {


                    controle.valor_condominio_morador = valor_total_condominio / condominio[k].num_apartamentos;
                    condominio[k].valor_total_condominio = valor_total_condominio;


                    Console.WriteLine("NOME DO CONDOMÍNIO:");
                    Console.WriteLine(condominio[k].nome);
                    Console.WriteLine("DESPESAS DO CONDOMÍNIO:");
                    for (int i = 0; i < despesa.Count(); i++)
                    {
                        if (despesa[i].pago != true)
                        {
                            Console.WriteLine("CÓDIGO: " + despesa[i].cod);
                            Console.WriteLine("DESCRIÇÃO: " + despesa[i].descricao);
                            Console.WriteLine("VALOR: " + despesa[i].valor);
                        }
                    }
                    Console.WriteLine("VALOR TOTAL DAS DESPESAS DO CONDOMÍNIO:");
                    Console.WriteLine(condominio[k].valor_total_condominio);
                    Console.WriteLine("NUMERO DE APARTAMENTOS CONDOMÍNIO:");
                    Console.WriteLine(condominio[k].num_apartamentos);
                    Console.WriteLine("VALOR A SER PAGO DE CONDOMÍNIO POR MORADOR:");
                    Console.WriteLine(Math.Round(controle.valor_condominio_morador, 2));
                    cabecalho("");


                }

                k = 0;

                StreamWriter writer = new StreamWriter(localDados + arquivoDadosCondominio);
                writer.WriteLine(condominio[k].cod + ";" + condominio[k].nome + ";" + condominio[k].num_apartamentos + ";" + condominio[k].valor_total_condominio);

                writer.Close();
                writer.Dispose();


                StreamReader reader = new StreamReader(localDados + arquivoDadosPagamentos);
                int cod = 0;
                while (reader.ReadLine() != null)
                {
                    cod++;
                }
                reader.Close();
                reader.Dispose();
                tipo_morador[] morador = retorna_morador();
                controle.data_pagamento = "00/00/0000";
                controle.pago = false;
                StreamWriter writer_pag = File.AppendText(localDados + arquivoDadosPagamentos);

                for (int i = 0; i < morador.Count(); i++)
                {

                    cod = cod + 1;
                    writer_pag.WriteLine(cod + ";" + Math.Round(controle.valor_condominio_morador, 2) + ";" + data_referencia + ";" + controle.data_pagamento + ";" + morador[i].cod + ";" + morador[i].nome + ";" + controle.pago);

                }
                writer_pag.Close();
                writer_pag.Dispose();

                cabecalho("SUCESSO!");
                Console.ReadKey();
            }
            

        }
        public static tipo_condominio[] retorna_condominio()
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosCondominio);
            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();

            reader = new StreamReader(localDados + arquivoDadosCondominio);
            tipo_condominio[] condominio = new tipo_condominio[j];
            j = 0;
            while (!reader.EndOfStream)
            {
                string[] condominio_resultado = reader.ReadLine().Split(';');

                condominio[j].cod = Convert.ToInt32(condominio_resultado[0]);
                condominio[j].nome = condominio_resultado[1];
                condominio[j].num_apartamentos = int.Parse(condominio_resultado[2]);
                j++;
            }

            reader.Close();
            reader.Dispose();
            return condominio;
        }
        #endregion

        #region Morador
        public static void cadastro_morador()
        {
                      
            tipo_morador morador;
            
            Console.WriteLine("DIGITE O NOME DO MORADOR:");
            morador.nome = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("DIGITE O CPF DO MORADOR: (Somente números)");
            morador.cpf = Console.ReadLine();
            Console.WriteLine("DIGITE O TELEFONE DO MORADOR");
            morador.tel = Console.ReadLine().Replace(';', ' ');
            Console.WriteLine("DIGITE O NUMERO DE DEPENDETES DO MORADOR:");
            morador.num_dependentes = Convert.ToInt16(Console.ReadLine().Replace(';', ' '));
            Console.WriteLine("DIGITE O ENDEREÇO");
            Console.WriteLine("RUA:");
            morador.rua = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("NUMERO:");
            morador.num = Convert.ToInt16(Console.ReadLine().Replace(';', ' '));
            Console.WriteLine("COMPLEMENTO:");
            morador.complemento = Convert.ToInt16(Console.ReadLine().Replace(';', ' '));
            Console.WriteLine("DIGITE O INICIO DA MORADIA: (DD/MM/AAAA)");
            morador.inicio_moradia = DateTime.Parse(Console.ReadLine());
            

            Console.Clear();

            StreamReader reader = new StreamReader(localDados + arquivoDadosMorador);

            
            int contaRegistro = 0;
            
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }
            
            reader.Close();
            
            reader.Dispose();

            
            StreamWriter writer = File.AppendText(localDados + arquivoDadosMorador);

            
                morador.cod = contaRegistro + 1;


            
                writer.WriteLine(morador.cod + ";" + morador.nome + ";" + morador.cpf + ";" + morador.tel + ";" + morador.num_dependentes + ";" + morador.rua + ";" + morador.num + ";" + morador.complemento+ ";" + morador.inicio_moradia.ToShortDateString());
            
            writer.Close();
            
            writer.Dispose();

            cabecalho("CODIGO DO MORADOR" + morador.cod + "");
            cabecalho("SUCESSO");
            Console.ReadKey();
        }
        public static void consulta_morador()
        {
                
                Console.WriteLine("DIGITE O NOME DO MORADOR:");
                string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


                cabecalho("RESULTADOS");

                
                StreamReader reader = new StreamReader(localDados + arquivoDadosMorador);
                
                string resultado;
                while ((resultado = reader.ReadLine()) != null)
                {
                    
                    if (resultado.Contains(termoBusca))
                    {
                        
                        string[] morador_resultado = resultado.Split(';');

                        
                        tipo_morador morador;
                        morador.cod = Convert.ToInt32(morador_resultado[0]);
                        morador.nome = morador_resultado[1];
                        morador.cpf = morador_resultado[2];
                        morador.tel = morador_resultado[3];
                        morador.num_dependentes = Convert.ToInt16(morador_resultado[4]);
                        morador.rua = morador_resultado[5];
                        morador.num = Convert.ToInt16(morador_resultado[6]);
                        morador.complemento = Convert.ToInt16(morador_resultado[7]);
                        morador.inicio_moradia = DateTime.Parse(morador_resultado[8]);

                        
                        Console.WriteLine("CODIGO DO MORADOR:");
                        Console.WriteLine(morador.cod);
                        Console.WriteLine("NOME DO MORADOR:");
                        Console.WriteLine(morador.nome);
                        Console.WriteLine("CPF DO CLIENTE: (Somente números)");
                        Console.WriteLine(morador.cpf);
                        Console.WriteLine("TELEFONE DO CLIENTE:");
                        Console.WriteLine(morador.tel);
                        Console.WriteLine("NUMERO DE DEPENDENTES DO CLIENTE:");
                        Console.WriteLine(morador.num_dependentes);
                        Console.WriteLine("ENDEREÇO DO CLIENTE:");
                        Console.WriteLine("RUA "+ morador.rua + " NUM " + morador.num + " AP " + morador.complemento);                       
                        Console.WriteLine("INICIO DA MORADIA DO CLIENTE: (DD/MM/AAAA)");
                        Console.WriteLine(morador.inicio_moradia);
                        cabecalho("");
                        Console.WriteLine("");
                    }
                }

                
                reader.Close();                
                reader.Dispose();

                Console.ReadKey();
        }
        public static tipo_morador[] retorna_morador()
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosMorador);

            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();

            reader = new StreamReader(localDados + arquivoDadosMorador);
            tipo_morador[] morador = new tipo_morador[j];
            j = 0;
            while (!reader.EndOfStream)
            {
                string[] morador_resultado = reader.ReadLine().Split(';');

                morador[j].cod = Convert.ToInt32(morador_resultado[0]);
                morador[j].nome = morador_resultado[1];
                morador[j].cpf = morador_resultado[2];
                morador[j].tel = morador_resultado[3];
                morador[j].num_dependentes = Convert.ToInt16(morador_resultado[4]);
                morador[j].rua = morador_resultado[5];
                morador[j].num = Convert.ToInt16(morador_resultado[6]);
                morador[j].complemento = Convert.ToInt16(morador_resultado[7]);
                morador[j].inicio_moradia = DateTime.Parse(morador_resultado[8]);
                j++;
            }
            reader.Close();
            reader.Dispose();
            return morador;
        }

#endregion

        #region Despesas
        public static void cadastro_despesa()
        {
            tipo_despesa nova_despesa;
            nova_despesa.cod = 0;
            Console.WriteLine("DIGITE A DESCRIÇÃO:");
            nova_despesa.descricao = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("DIGITE O VALOR:");
            nova_despesa.valor = Convert.ToDouble(Console.ReadLine());
            Console.WriteLine("DIGITE A DATA DO VENCIMENTO DA DESPESA: (DD/MM/AAAA)");
            nova_despesa.data_vencimento = (Console.ReadLine());

            nova_despesa.data_pagamento = "00/00/0000";
            nova_despesa.valor_pago = 00.00;
            nova_despesa.pago = false;

            cadastra_despesa(nova_despesa);

             //  cabecalho("CODIGO DA DESPESA" + nova_despesa.cod + "");
                cabecalho("SUCESSO");
                Console.ReadKey();
            }
        public static bool cadastra_despesa(tipo_despesa despesa)
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            int contaRegistro = 0;
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }

            reader.Close();
            reader.Dispose();

            StreamWriter writer = File.AppendText(localDados + arquivoDadosDespesas);
            despesa.cod = contaRegistro + 1;

            writer.WriteLine(despesa.cod + ";" + despesa.data_vencimento + ";" + despesa.data_pagamento + ";" + despesa.descricao + ";" + despesa.valor + ";" + despesa.valor_pago + ";" + despesa.pago);

            writer.Close();
            writer.Dispose();

            return true;

        }
        public static void consulta_despesa()
            {
                
                Console.WriteLine("DIGITE A DESCRIÇÃO DA DESPESA:");
                string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


                cabecalho("RESULTADO");

                
                StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);
                
                string resultado;
                while ((resultado = reader.ReadLine()) != null)
                {
                    
                    if (resultado.Contains(termoBusca))
                    {
                        
                        string[] despesa_resultado = resultado.Split(';');

                        
                        tipo_despesa despesa;
                        despesa.cod = Convert.ToInt32(despesa_resultado[0]);                        
                        despesa.data_vencimento = (despesa_resultado[1]);
                        despesa.data_pagamento = (despesa_resultado[2]);
                        despesa.descricao = despesa_resultado[3];
                        despesa.valor = Convert.ToDouble(despesa_resultado[4]);
                        despesa.valor_pago = Convert.ToDouble(despesa_resultado[5]);
                        despesa.pago = bool.Parse(despesa_resultado[6]);

                        
                        
                        Console.WriteLine("CODIGO DA DESPESA:");
                        Console.WriteLine(despesa.cod);                        
                        Console.WriteLine("DATA DO VENCIMENTO:");
                        Console.WriteLine(despesa.data_vencimento);
                        Console.WriteLine("DESCRIÇÃO:");
                        Console.WriteLine(despesa.descricao);
                        Console.WriteLine("VALOR:");
                        Console.WriteLine(despesa.valor);
                        if (despesa.pago == true)
                        {
                            Console.WriteLine("ESTA DESPESA ESTÁ PAGA!");
                        }
                        else
                        {
                            Console.WriteLine("ESTA DESPESA NÃO ESTÁ PAGA");
                        }
                        cabecalho("");
                        Console.WriteLine("");
                       
                        
                    }
                }

                
                reader.Close();                
                reader.Dispose();

                Console.ReadKey();
            }
        public static tipo_despesa[] retorna_despesas()
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();
            reader = new StreamReader(localDados + arquivoDadosDespesas);
            tipo_despesa[] despesa = new tipo_despesa[j];
            j = 0;
            while (!reader.EndOfStream)
            {
                string[] despesa_resultado = reader.ReadLine().Split(';');

                despesa[j].cod = Convert.ToInt32(despesa_resultado[0]);
                despesa[j].data_vencimento = (despesa_resultado[1]);
                despesa[j].data_pagamento = (despesa_resultado[2]);
                despesa[j].descricao = despesa_resultado[3];
                despesa[j].valor = Convert.ToDouble(despesa_resultado[4]);
                despesa[j].valor_pago = Convert.ToDouble(despesa_resultado[5]);
                despesa[j].pago = bool.Parse(despesa_resultado[6]);
                j++;
            }
            reader.Close();
            reader.Dispose();
            return despesa;
        }
        public static void relatorio_despesas()
        {
            Console.WriteLine("DIGITE O MÊS E O ANO: (MM/AAAA)");
            string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();

            cabecalho("RESULTADO");


            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {

                if (resultado.Contains(termoBusca))
                {

                    string[] despesa_resultado = resultado.Split(';');
                    tipo_despesa despesa;
                    despesa.cod = Convert.ToInt32(despesa_resultado[0]);
                    despesa.data_vencimento = (despesa_resultado[1]);
                    despesa.data_pagamento = (despesa_resultado[2]);
                    despesa.descricao = despesa_resultado[3];
                    despesa.valor = Convert.ToDouble(despesa_resultado[4]);
                    despesa.valor_pago = Convert.ToDouble(despesa_resultado[5]);
                    despesa.pago = bool.Parse(despesa_resultado[6]);


                    if (despesa.pago == false)
                    {
                        Console.WriteLine("CODIGO DA DESPESA:");
                        Console.WriteLine(despesa.cod);
                        Console.WriteLine("DATA DO VENCIMENTO:");
                        Console.WriteLine(despesa.data_vencimento);
                        Console.WriteLine("DESCRIÇÃO:");
                        Console.WriteLine(despesa.descricao);
                        Console.WriteLine("VALOR:");
                        Console.WriteLine(despesa.valor);
                        cabecalho("");
                        Console.WriteLine("");
                    }
                }


            }
            reader.Close();
            reader.Dispose();

            Console.ReadKey();
        }
        #endregion

        #region Pagamentos
        public static bool cadastra_pagamento(tipo_despesa[] despesa)
        {


            StreamWriter writer = new StreamWriter(localDados + arquivoDadosDespesas);
            for (int i = 0; i < despesa.Count(); i++)
            {
                writer.WriteLine(despesa[i].cod + ";" + despesa[i].data_vencimento + ";" + despesa[i].data_pagamento + ";" + despesa[i].descricao + ";" + despesa[i].valor + ";" + despesa[i].valor_pago + ";" + despesa[i].pago);

            }

            writer.Close();
            writer.Dispose();

            return true;

        }
        public static void cadastro_pagamento()
        {
            cabecalho("DESPESAS CADASTRADAS");
            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            tipo_despesa[] despesa = retorna_despesas();
            for (int i = 0; i < despesa.Count(); i++)
            {
                if(despesa[i].pago != true)
                Console.WriteLine("CÓDIGO: " + despesa[i].cod + " DESCRIÇÃO: " + despesa[i].descricao + " VALOR: " + despesa[i].valor +" DATA DO VENCIMENTO: "+despesa[i].data_vencimento);
            }
            reader.Close();
            reader.Dispose();

            Console.WriteLine("DIGITE O CÓDIGO DA DESPESA:");
            int x = int.Parse(Console.ReadLine());

            x = x - 1;

            if (despesa[x].pago == true)
            {
                Console.WriteLine("DESPESA JÁ ESTA PAGA!");
            }
            else
            {
                Console.WriteLine("CODIGO DA DESPESA:");
                Console.WriteLine(despesa[x].cod);
                Console.WriteLine("DATA DO VENCIMENTO:");
                Console.WriteLine(despesa[x].data_vencimento);
                Console.WriteLine("DESCRIÇÃO:");
                Console.WriteLine(despesa[x].descricao);
                Console.WriteLine("VALOR:");
                Console.WriteLine(despesa[x].valor);
                Console.WriteLine("DATA DO PAGAMENTO:");
                despesa[x].data_pagamento = Console.ReadLine();
                Console.WriteLine("VALOR PAGO:");
                despesa[x].valor_pago = Convert.ToDouble(Console.ReadLine());
                despesa[x].pago = true;


            }



            if (cadastra_pagamento(despesa))
            {
                cabecalho("SUCESSO!");
            }
            Console.ReadKey();
        }
        public static void consulta_pagamento()
        {
                
               
                Console.WriteLine("DIGITE A DESCRIÇÃO DA DESPESA PAGA:");
                string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


                cabecalho("RESULTADO");

                
                StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);
                
                string resultado;
                while ((resultado = reader.ReadLine()) != null)
                {
                    
                    if (resultado.Contains(termoBusca))
                    {
                        
                        string[] despesa_resultado = resultado.Split(';');


                        tipo_despesa despesa;
                        despesa.cod = Convert.ToInt32(despesa_resultado[0]);
                        despesa.data_vencimento = (despesa_resultado[1]);
                        despesa.data_pagamento = (despesa_resultado[2]);
                        despesa.descricao = despesa_resultado[3];
                        despesa.valor = Convert.ToDouble(despesa_resultado[4]);
                        despesa.valor_pago = Convert.ToDouble(despesa_resultado[5]);
                        despesa.pago = bool.Parse(despesa_resultado[6]);

                        if (despesa.pago == true)
                        {
                            Console.WriteLine("CODIGO DA DESPESA:");
                            Console.WriteLine(despesa.cod);
                            Console.WriteLine("DATA DO VENCIMENTO:");
                            Console.WriteLine(despesa.data_vencimento);
                            Console.WriteLine("DATA DO PAGAMENTO:");
                            Console.WriteLine(despesa.data_pagamento);
                            Console.WriteLine("DESCRIÇÃO:");
                            Console.WriteLine(despesa.descricao);
                            Console.WriteLine("VALOR:");
                            Console.WriteLine(despesa.valor);
                            Console.WriteLine("VALOR PAGO:");
                            Console.WriteLine(despesa.valor_pago);
                            cabecalho("");
                            Console.WriteLine("");
                        }
                        else
                        {
                            cabecalho("NÃO EXISTE DESPESAS PAGAS");
                        }
                        
                    }
                }

                
                reader.Close();                
                reader.Dispose();

                Console.ReadKey();
            
        }
        public static void relatorio_pagamentos()
        {

            
            Console.WriteLine("DIGITE O MÊS E O ANO: (MM/AAAA)");
            string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();

            cabecalho("RESULTADO");

                
                StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);
                
                string resultado;
                while ((resultado = reader.ReadLine()) != null)
                {

                    if (resultado.Contains(termoBusca))
                    {

                        string[] despesa_resultado = resultado.Split(';');
                        tipo_despesa despesa;
                        despesa.cod = Convert.ToInt32(despesa_resultado[0]);
                        despesa.data_vencimento = (despesa_resultado[1]);
                        despesa.data_pagamento = (despesa_resultado[2]);
                        despesa.descricao = despesa_resultado[3];
                        despesa.valor = Convert.ToDouble(despesa_resultado[4]);
                        despesa.valor_pago = Convert.ToDouble(despesa_resultado[5]);
                        despesa.pago = bool.Parse(despesa_resultado[6]);


                        if (despesa.pago == true)
                        {
                            Console.WriteLine("CODIGO DA DESPESA:");
                            Console.WriteLine(despesa.cod);
                            Console.WriteLine("DATA DO VENCIMENTO:");
                            Console.WriteLine(despesa.data_vencimento);
                            Console.WriteLine("DATA DO PAGAMENTO:");
                            Console.WriteLine(despesa.data_pagamento);
                            Console.WriteLine("DESCRIÇÃO:");
                            Console.WriteLine(despesa.descricao);
                            Console.WriteLine("VALOR:");
                            Console.WriteLine(despesa.valor);
                            Console.WriteLine("VALOR PAGO:");
                            Console.WriteLine(despesa.valor_pago);
                            cabecalho("");
                            Console.WriteLine("");
                        }
                    }

               }
                reader.Close();
                reader.Dispose();

                Console.ReadKey();
 
        }
        #endregion

        #region Controle Pagamento

        public static tipo_controle_pagamento[] retorna_controle()
        {
            StreamReader reader = new StreamReader(localDados + arquivoDadosPagamentos);
            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();
            reader = new StreamReader(localDados + arquivoDadosPagamentos);
            tipo_controle_pagamento[] controle = new tipo_controle_pagamento[j];
            j = 0;
            while (!reader.EndOfStream)
            {
                string[] controle_resultado = reader.ReadLine().Split(';');

                controle[j].cod = int.Parse(controle_resultado[0]);
                controle[j].valor_condominio_morador = Convert.ToDouble(controle_resultado[1]);
                controle[j].data_referencia = controle_resultado[2];
                controle[j].data_pagamento = controle_resultado[3];
                controle[j].cod_morador =int.Parse( controle_resultado[4]);
                controle[j].nome_morador = controle_resultado[5];
                controle[j].pago =bool.Parse( controle_resultado[6]);
                j++;
            }

            reader.Close();
            reader.Dispose();
            return controle;
        }
        public static void controle_cadastro_pagamento()
        {
            cabecalho("MORADORES DEVEDORES DO CONDOMINIO");

           

            tipo_controle_pagamento[] controle = retorna_controle();
            for (int i = 0; i < controle.Count(); i++)
            {
                if(controle[i].pago != true)
               Console.WriteLine("CODIGO: "+controle[i].cod+" CODIGO DO MORADOR: "+controle[i].cod_morador+" NOME DO MORADOR: "+controle[i].nome_morador +" DATA DA REFERÊNCIA: "+controle[i].data_referencia+" VALOR DO CONDOMÍNIO: " + (Math.Round(controle[i].valor_condominio_morador, 2)));
            }

            Console.WriteLine("DIGITE O CÓDIGO:");
            int x = int.Parse(Console.ReadLine());
            x = x - 1;

            Console.WriteLine("CODIGO:");
            Console.WriteLine(controle[x].cod);
            Console.WriteLine("CODIGO DO MORADOR:");
            Console.WriteLine(controle[x].cod_morador);
            Console.WriteLine("NOME DO MORADOR:");
            Console.WriteLine(controle[x].nome_morador);
            Console.WriteLine("DATA DA REFERÊNCIA:");
            Console.WriteLine(controle[x].data_referencia);
            Console.WriteLine("VALOR DO CONDOMÍNIO:");
            Console.WriteLine((Math.Round(controle[x].valor_condominio_morador, 2)));
            Console.WriteLine("DATA DO PAGAMENTO:(DD/MM/AAAA)");
            controle[x].data_pagamento = Console.ReadLine();

            controle[x].pago = true;
            

            if (controle_cadastra_pagamento(controle))
            {
                cabecalho("SUCESSO!");
            }
            Console.ReadKey();
        }
        public static bool controle_cadastra_pagamento(tipo_controle_pagamento[] controle)
        {         
            StreamWriter writer_pag = new StreamWriter(localDados + arquivoDadosPagamentos);
            for (int i = 0; i < controle.Count(); i++)
            {
                writer_pag.WriteLine(controle[i].cod+";"+Math.Round(controle[i].valor_condominio_morador, 2) + ";" + controle[i].data_referencia + ";" + controle[i].data_pagamento + ";" + controle[i].cod_morador + ";" + controle[i].nome_morador + ";" + controle[i].pago);

            }
            writer_pag.Close();
            writer_pag.Dispose();
            return true;
        }
        public static void moradores_pagamento_em_dia()
        {
            cabecalho("MORADORES COM PAGAMENTO EM DIA");
            
            tipo_controle_pagamento[] controle = retorna_controle();
            for (int i = 0; i < controle.Count(); i++)
            {
                if (controle[i].pago == true)
                    Console.WriteLine("CODIGO: "+controle[i].cod+" CODIGO DO MORADOR: " + controle[i].cod_morador + " NOME DO MORADOR: " + controle[i].nome_morador + " DATA DA REFERÊNCIA: " + controle[i].data_referencia + " VALOR DO CONDOMÍNIO: " + (Math.Round(controle[i].valor_condominio_morador, 2)) + " DATA DO PAGAMENTO: " + controle[i].data_pagamento);
            }

            Console.ReadKey();
        }

        #endregion


        #region Menus
        public static void menu_pagamentos()
        {
            Console.Clear();

            cabecalho("MENU PAGAMENTOS - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR PAGAMENTOS");
            Console.WriteLine("   2 - CONSULTAR PAGAMENTOS");
            Console.WriteLine("   3 - RELATÓRIO DOS PAGAMENTOS");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");
            cabecalho("");
            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                cabecalho("CADASTRO DE PAGAMENTO");
                cadastro_pagamento();
            }
            else if (op == 2)
            {
                Console.Clear();
                cabecalho("CONSULTA DE PAGAMENTO");
                consulta_pagamento();
            }
            else if (op == 3)
            {
                Console.Clear();
                cabecalho("RELATORIO DESPESAS PAGAS");
                relatorio_pagamentos();
            }
            else if (op == 0)
            {
                
            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
        }
        public static void menu_despesas()
        {
            Console.Clear();

            cabecalho("MENU DESPESAS - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR DESPESAS");
            Console.WriteLine("   2 - CONSULTAR DESPESAS");
            Console.WriteLine("   3 - RELATÓRIO DAS DESPESAS");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");
            cabecalho("");
            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                cabecalho("CADASTRO DE DESPESA");
                cadastro_despesa();
            }
            else if (op == 2)
            {
                Console.Clear();
                cabecalho("CONSULTA DE DESPESA");
                consulta_despesa();
            }
            else if (op == 3)
            {
                Console.Clear();
                cabecalho("RELATORIO DESPESAS À PAGAR");
                relatorio_despesas();
            }
            else if (op == 0)
            {
                
            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
        }
        public static void menu_morador()
        {
            Console.Clear();

            cabecalho("MENU MORADOR - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR MORADOR");
            Console.WriteLine("   2 - CONSULTAR MORADOR");
            //Console.WriteLine("   3 - RELATÓRIO DAS DESPESAS");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");
            cabecalho("");
            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                cabecalho("CADASTRO DE MORADOR");
                cadastro_morador();
            }
            else if (op == 2)
            {
                Console.Clear();
                cabecalho("CONSULTA DE MORADOR");
                consulta_morador();
            }
          /*  else if (op == 3)
            {
                Console.Clear();
                cabecalho("RELATORIO DESPESAS À PAGAR");
                relatorio_despesas();
            }*/
            else if (op == 0)
            {
                
            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
        }
        public static void menu_condominio()
        {
            Console.Clear();

            cabecalho("MENU CONDOMINIO - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR CONDOMINIO");
            Console.WriteLine("   2 - CONSULTAR CONDOMINIO");
            Console.WriteLine("   3 - CALCULAR VALOR DO CONDOMÍNIO");
            Console.WriteLine("   4 - CADASTRAR PAGAMENTO DO CONDOMINIO");
            Console.WriteLine("   5 - MORADORES COM PAGAMENTO EM DIA");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");
            cabecalho("");
            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                cabecalho("CADASTRO DE CONDOMÍNIO");
                cadastro_condominio();
            }
            else if (op == 2)
            {
                Console.Clear();
                cabecalho("CONSULTA DE CONDOMÍNIO");
                consulta_condominio();
            }
            else if (op == 3)
            {
                  Console.Clear();
                 cabecalho("CALCULO DO VALOR DO CONDOMÍNIO");
                  calcular_condominio();
            }
            else if (op == 4)
            {
                Console.Clear();
                cabecalho("CADASTRAR PAGAMENTO DO CONDOMINIO");
                controle_cadastro_pagamento();
            }
            else if (op == 5)
            {
                Console.Clear();
                //cabecalho("CADASTRAR PAGAMENTO DO CONDOMINIO");
                moradores_pagamento_em_dia();
            }
            else if (op == 0)
            {
               
            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
        }
        #endregion
    }
}



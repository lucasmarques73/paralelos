using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Proj_Int_Dio
{
    class Program
    {
        //Structs

        struct Cliente
        {
            public int codigo;
            public string nome;
            public string cpf;
            public string rg;
            public string telefone;
            public string endereco;
            public string cidade;
            public DateTime dataNascimento;
        }

        struct Produto
        {
            public int codigo;
            public string codigoReferencia;
            public string nome;
            public string descricao;
            public decimal valorCusto;
            public decimal valorVenda;
            public int estoque;
        }

        struct Venda
        {
            public int codigo;
            public int codigoProduto;
            public int codigoCliente;
            public DateTime data;
        }

        //Variaveis Fixas

        static string localDados = @"C:/ProjetoIntegrador/";
        static string arquivoDadosCliente = @"Cliente.txt";
        static string arquivoDadosProduto = @"Produto.txt";
        static string arquivoDadosVenda = @"Venda.txt";


        static void Main(string[] args)
        {
            //Visual do programa
            Console.BackgroundColor = ConsoleColor.Black;
            Console.ForegroundColor = ConsoleColor.Cyan;

            //Cria diretorio e arquivos de dados caso não existam
            DirectoryInfo dirInfo = new DirectoryInfo(localDados);
            if (!dirInfo.Exists)
            {
                dirInfo.Create();
            }

            if (!File.Exists(localDados + arquivoDadosCliente))
            {
                File.Create(localDados + arquivoDadosCliente);
            }

            if (!File.Exists(localDados + arquivoDadosProduto))
            {
                File.Create(localDados + arquivoDadosProduto);
            }

            if (!File.Exists(localDados + arquivoDadosVenda))
            {
                File.Create(localDados + arquivoDadosVenda);
            }


            //Loop infinito para rodar o menu do programa
            while (true)
            {
                try
                {
                    Console.Clear();
                    Console.WriteLine("|----- MENU PRINCIPAL - ESCOLHA UMA OPÇÃO -----|");
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.WriteLine("   1 - CADASTRAR CLIENTE");
                    Console.WriteLine("   2 - BUSCAR CLIENTE");
                    Console.WriteLine("   3 - CADASTRAR PRODUTO");
                    Console.WriteLine("   4 - BUSCAR PRODUTO");
                    Console.WriteLine("   5 - LANÇAR VENDA");
                    Console.WriteLine("   6 - RELATÓRIO DE VENDA");
                    Console.WriteLine("   9 - SAIR");
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.WriteLine("|--------------------------------------------- |");
                    int opcaoEscolhida = int.Parse(Console.ReadLine());

                    if (opcaoEscolhida == 1)
                    {
                        ClienteNovo();
                    }
                    else if (opcaoEscolhida == 2)
                    {
                        ClienteBusca();
                    }
                    else if (opcaoEscolhida == 3)
                    {
                        ProdutoNovo();
                    }
                    else if (opcaoEscolhida == 4)
                    {
                        ProdutoBusca();
                    }
                    else if (opcaoEscolhida == 5)
                    {
                        VendaNovo();
                    }
                    else if (opcaoEscolhida == 6)
                    {
                        VendaRelatorio();
                    }
                    else if (opcaoEscolhida == 7)
                    {

                    }
                    else if (opcaoEscolhida == 8)
                    {

                    }
                    else if (opcaoEscolhida == 9)
                    {
                        break;
                    }
                    else
                    {
                        Console.WriteLine("OPÇÃO INVÁLIDA!");

                    }
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.WriteLine("|- PRECIONE ALGUMA TELCA PARA VOLTAR AO MENU - |");
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.ReadLine();
                }
                catch (Exception ex)
                {
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.WriteLine("ERRO:");
                    Console.WriteLine(ex.Message);
                    Console.WriteLine("|--------------------------------------------- |");
                    Console.WriteLine("Precione alguma tecla para voltar ao menu principal.");
                    Console.ReadLine();
                }
            }

        }



        static void ClienteNovo()
        {
            Console.Clear();


            //Cria um tipo cliente e armazena os dados digitados em uma linha em um arquivo separados por ponto e virgula
            Cliente cliente;
            Console.WriteLine("|------------- CADASTRAR CLIENTE --------------|");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("   DIGITE O NOME DO CLIENTE:");
            cliente.nome = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O CPF DO CLIENTE: (Somente números)");
            cliente.cpf = Console.ReadLine();
            Console.WriteLine("   DIGITE O RG DO CLIENTE:");
            cliente.rg = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O TELEFONE DO CLIENTE:");
            cliente.telefone = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O ENDEREÇO, NÚMERO, COMPLEMENTO DO CLIENTE:");
            cliente.endereco = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE A CIDADE DO CLIENTE:");
            cliente.cidade = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE A DATA DE NASCIMENTO DO CLIENTE: (DD/MM/AAAA)");
            cliente.dataNascimento = DateTime.Parse(Console.ReadLine());

            Console.Clear();

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosCliente);

            //Lendo o Arquivo e pulando uma linha
            int contaRegistro = 0;
            //conta quantos registros tem gravados
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }
            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            //Declaração do método StreamWriter passando o caminho e nome do arquivo que deve ser salvo, lembrando que o appendText serve para não perder os textos que ja tinham no arquivo
            StreamWriter writer = File.AppendText(localDados + arquivoDadosCliente);

            //gera um codigo para o cliente baseado no total de linhas armazenadas + 1
            cliente.codigo = contaRegistro + 1;


            //Escrevendo o Arquivo e pulando uma linha
            writer.WriteLine(cliente.codigo + ";" + cliente.nome + ";" + cliente.cpf + ";" + cliente.rg + ";" + cliente.telefone + ";" + cliente.endereco + ";" + cliente.cidade + ";" + cliente.dataNascimento.ToShortDateString());
            //Fechando o arquivo
            writer.Close();
            //Limpando a referencia dele da memória
            writer.Dispose();

            Console.WriteLine("|----------------------------------------------|");
            Console.WriteLine("|------------------ SUCESSO -------------------|");
            Console.WriteLine("|----------------------------------------------|");
        }

        static void ClienteBusca()
        {
            Console.Clear();
            Console.WriteLine("|--------------- BUSCAR CLIENTE ---------------|");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("   DIGITE O NOME DO CLIENTE:");
            string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


            Console.Clear();
            Console.WriteLine("|----------------- RESULTADOS -----------------|");
            Console.WriteLine("|--------------------------------------------- |");

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosCliente);
            //Lendo o Arquivo e pulando uma linha
            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {
                //Pega a linha que contenha o termo da busca
                if (resultado.Contains(termoBusca))
                {
                    //Quebra a linha vetor de string cujo o ; é o separador
                    string[] clienteReultado = resultado.Split(';');

                    //Cria um tipo Cliente e armazena os dados da linha quebrada
                    Cliente cliente;
                    cliente.codigo = Convert.ToInt32(clienteReultado[0]);
                    cliente.nome = clienteReultado[1];
                    cliente.cpf = clienteReultado[2];
                    cliente.rg = clienteReultado[3];
                    cliente.telefone = clienteReultado[4];
                    cliente.endereco = clienteReultado[5];
                    cliente.cidade = clienteReultado[6];
                    cliente.dataNascimento = DateTime.Parse(clienteReultado[7]);

                    //Exibe o resultado para o cliente
                    Console.WriteLine("CODIGO DO CLIENTE:");
                    Console.WriteLine(cliente.codigo);
                    Console.WriteLine("NOME DO CLIENTE:");
                    Console.WriteLine(cliente.nome);
                    Console.WriteLine("CPF DO CLIENTE: (Somente números)");
                    Console.WriteLine(cliente.cpf);
                    Console.WriteLine("RG DO CLIENTE:");
                    Console.WriteLine(cliente.rg);
                    Console.WriteLine("TELEFONE DO CLIENTE:");
                    Console.WriteLine(cliente.telefone);
                    Console.WriteLine("ENDEREÇO DO CLIENTE:");
                    Console.WriteLine(cliente.endereco);
                    Console.WriteLine("CIDADE DO CLIENTE:");
                    Console.WriteLine(cliente.cidade);
                    Console.WriteLine("DATA DE NASCIMENTO DO CLIENTE: (DD/MM/AAAA)");
                    Console.WriteLine(cliente.dataNascimento);
                    Console.WriteLine("|--------------------------------------------- |");
                }
            }

            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();
        }

        static void ProdutoNovo()
        {
            Console.Clear();

            //Cria um tipo produto e armazena os dados digitados em uma linha em um arquivo separados por ponto e virgula
            Produto produto;
            Console.WriteLine("|------------- CADASTRAR PRODUTO --------------|");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("   DIGITE O CÓDIGO DE REFERÊNCIA DO PRODUTO:");
            produto.codigoReferencia = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O NOME DO PRODUTO:");
            produto.nome = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE UMA DESCRIÇÃO DO PRODUTO:");
            produto.descricao = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O VALOR DE CUSTO DO PRODUTO:");
            produto.valorCusto = decimal.Parse(Console.ReadLine());
            Console.WriteLine("   DIGITE O VALOR DE VENDA DO PRODUTO:");
            produto.valorVenda = decimal.Parse(Console.ReadLine());
            Console.WriteLine("   DIGITE A QUANTIDADE DE ESTOQUE DO PRODUTO:");
            produto.estoque = int.Parse(Console.ReadLine());

            Console.Clear();

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosProduto);

            //Lendo o Arquivo e pulando uma linha
            int contaRegistro = 0;
            //conta quantos registros tem gravados
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }
            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            //Declaração do método StreamWriter passando o caminho e nome do arquivo que deve ser salvo, lembrando que o appendText serve para não perder os textos que ja tinham no arquivo
            StreamWriter writer = File.AppendText(localDados + arquivoDadosProduto);

            //gera um codigo para o cliente baseado no total de linhas armazenadas + 1
            produto.codigo = contaRegistro + 1;


            //Escrevendo o Arquivo e pulando uma linha
            writer.WriteLine(produto.codigo + ";" + produto.codigoReferencia + ";" + produto.nome + ";" + produto.descricao + ";" + produto.valorCusto + ";" + produto.valorVenda + ";" + produto.estoque);
            //Fechando o arquivo
            writer.Close();
            //Limpando a referencia dele da memória
            writer.Dispose();

            Console.WriteLine("|----------------------------------------------|");
            Console.WriteLine("|------------------ SUCESSO -------------------|");
            Console.WriteLine("|----------------------------------------------|");
        }

        static void ProdutoBusca()
        {
            Console.Clear();
            Console.WriteLine("|--------------- BUSCAR PRODUTO ---------------|");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("   DIGITE O CODIDO DE REFERENCIA OU NOME DO PRODUTO:");
            string termoBusca = Console.ReadLine().Replace(';', ' ').ToUpper();


            Console.Clear();
            Console.WriteLine("|----------------- RESULTADOS -----------------|");
            Console.WriteLine("|--------------------------------------------- |");

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosProduto);
            //Lendo o Arquivo e pulando uma linha
            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {
                //Pega a linha que contenha o termo da busca
                if (resultado.Contains(termoBusca))
                {
                    //Quebra a linha vetor de string cujo o ; é o separador
                    string[] produtoReultado = resultado.Split(';');

                    //Cria um tipo Cliente e armazena os dados da linha quebrada
                    Produto produto;
                    produto.codigo = Convert.ToInt32(produtoReultado[0]);
                    produto.codigoReferencia = produtoReultado[1];
                    produto.nome = produtoReultado[2];
                    produto.descricao = produtoReultado[3];
                    produto.valorCusto = decimal.Parse(produtoReultado[4]);
                    produto.valorVenda = decimal.Parse(produtoReultado[5]);
                    produto.estoque = int.Parse(produtoReultado[6]);

                    //Exibe o resultado para o cliente
                    Console.WriteLine("CODIGO DO PRODUTO:");
                    Console.WriteLine(produto.codigo);
                    Console.WriteLine("CODIGO DE REFERENCIA DO PRODUTO:");
                    Console.WriteLine(produto.codigoReferencia);
                    Console.WriteLine("NOME DO PRODUTO:");
                    Console.WriteLine(produto.nome);
                    Console.WriteLine("DESCRIÇÃO DO PRODUTO:");
                    Console.WriteLine(produto.descricao);
                    Console.WriteLine("VALOR DE CUSTO DO PRODUTO:");
                    Console.WriteLine(produto.valorCusto);
                    Console.WriteLine("VALOR DE VENDA DO PRODUTO:");
                    Console.WriteLine(produto.valorVenda);
                    Console.WriteLine("ESTOQUE DO PRODUTO:");
                    Console.WriteLine(produto.estoque);
                    Console.WriteLine("|--------------------------------------------- |");
                }
            }

            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();
        }

        static void VendaNovo()
        {
            //Cria um tipo venda e armazena os dados digitados em uma linha em um arquivo separados por ponto e virgula
            Console.Clear();
            Venda venda;
            Console.WriteLine("|-------------- CADASTRAR VENDA ---------------|");
            Console.WriteLine("|--------------------------------------------- |");
            Console.WriteLine("   DIGITE O CODIGO DO PRODUTO:");
            venda.codigoProduto = int.Parse(Console.ReadLine());
            Console.WriteLine("   DIGITE O CODIGO DO CLIENTE:");
            venda.codigoCliente = int.Parse(Console.ReadLine());
            venda.data = DateTime.Now;

            Console.Clear();

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosVenda);

            //Lendo o Arquivo e pulando uma linha
            int contaRegistro = 0;
            //conta quantos registros tem gravados
            while (reader.ReadLine() != null)
            {
                contaRegistro++;
            }
            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            //Declaração do método StreamWriter passando o caminho e nome do arquivo que deve ser salvo, lembrando que o appendText serve para não perder os textos que ja tinham no arquivo
            StreamWriter writer = File.AppendText(localDados + arquivoDadosVenda);

            //gera um codigo para o cliente baseado no total de linhas armazenadas + 1
            venda.codigo = contaRegistro + 1;


            //Escrevendo o Arquivo e pulando uma linha
            writer.WriteLine(venda.codigo + ";" + venda.codigoProduto + ";" + venda.codigoCliente + ";" + venda.data);
            //Fechando o arquivo
            writer.Close();
            //Limpando a referencia dele da memória
            writer.Dispose();

            Console.WriteLine("|----------------------------------------------|");
            Console.WriteLine("|------------------ SUCESSO -------------------|");
            Console.WriteLine("|----------------------------------------------|");
        }

        static void VendaRelatorio()
        {
            int totalProdutosVendidos = 0;
            decimal totalLucro = 0;

            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosVenda);
            //Lendo o Arquivo e pulando uma linha
            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {

                //Quebra a linha vetor de string cujo o ; é o separador
                string[] vendaRelatorio = resultado.Split(';');
                Produto produto = RetornaProduto(int.Parse(vendaRelatorio[1]));
                Cliente cliente = RetornaCliente(int.Parse(vendaRelatorio[2]));
                totalProdutosVendidos++;
                totalLucro += (produto.valorVenda - produto.valorCusto);


            }

            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            Console.WriteLine("TOTAL DE PRODUTOS VENDIDOS:");
            Console.WriteLine(totalProdutosVendidos);
            Console.WriteLine("LUCRO TOTAL:");
            Console.WriteLine("R$" + totalLucro);


        }



        static Cliente RetornaCliente(int codigo)
        {


            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosCliente);
            //Lendo o Arquivo e pulando uma linha
            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {
                //Quebra a linha vetor de string cujo o ; é o separador
                string[] clienteReultado = resultado.Split(';');


                //Pega a linha que contenha o termo da busca
                if (clienteReultado[0].Contains(codigo.ToString()))
                {

                    // armazena os dados da linha quebrada
                    Cliente cliente;
                    cliente.codigo = Convert.ToInt32(clienteReultado[0]);
                    cliente.nome = clienteReultado[1];
                    cliente.cpf = clienteReultado[2];
                    cliente.rg = clienteReultado[3];
                    cliente.telefone = clienteReultado[4];
                    cliente.endereco = clienteReultado[5];
                    cliente.cidade = clienteReultado[6];
                    cliente.dataNascimento = DateTime.Parse(clienteReultado[7]);
                    return cliente;
                }
            }

            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            return new Cliente();

        }


        static Produto RetornaProduto(int codigo)
        {


            //Declaração do método StreamReader passando o caminho e nome do arquivo que deve ser lido
            StreamReader reader = new StreamReader(localDados + arquivoDadosProduto);
            //Lendo o Arquivo e pulando uma linha
            string resultado;
            while ((resultado = reader.ReadLine()) != null)
            {
                //Quebra a linha vetor de string cujo o ; é o separador
                string[] produtoReultado = resultado.Split(';');


                //Pega a linha que contenha o termo da busca
                if (produtoReultado[0].Contains(codigo.ToString()))
                {

                    // armazena os dados da linha quebrada
                    Produto produto;
                    produto.codigo = Convert.ToInt32(produtoReultado[0]);
                    produto.codigoReferencia = produtoReultado[1];
                    produto.nome = produtoReultado[2];
                    produto.descricao = produtoReultado[3];
                    produto.valorCusto = decimal.Parse(produtoReultado[4]);
                    produto.valorVenda = decimal.Parse(produtoReultado[5]);
                    produto.estoque = int.Parse(produtoReultado[6]);
                    return produto;
                }
            }

            //Fechando o arquivo
            reader.Close();
            //Limpando a referencia dele da memória
            reader.Dispose();

            return new Produto();

        }
    }
}
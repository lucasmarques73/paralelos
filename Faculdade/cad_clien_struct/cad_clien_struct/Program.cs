using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cad_clien_struct
{
    class Program
    {
        struct tipo_filiacao
        {
            public string pai;
            public string mae;
        }
        struct tipo_pessoa
        {
            public string nome;
            public tipo_filiacao filiacao;
            public char sexo;
        }
        struct tipo_end
        {
            public string rua;
            public string bairro;
            public int num;
        }
        struct reg_cliente
        {
            public int cheque;
            public string livro;
            // public string aluno; Achei desnecessario o uso dele por isso deixei comentado.
            public tipo_end endereco;
            public tipo_pessoa pessoa;
        }
        static void Main(string[] args)
        {
            //Declaraçao das variaveis

            reg_cliente cliente;
            
            //Receber os dados

                Console.WriteLine("Digite o num do cheque bancario");
                cliente.cheque = Convert.ToInt16(Console.ReadLine());

                Console.WriteLine("Digite o livro");
                cliente.livro = Console.ReadLine();

                Console.WriteLine("Digite o endereço");
                Console.WriteLine("Rua");
                cliente.endereco.rua = Console.ReadLine();
                Console.WriteLine("Bairro");
                cliente.endereco.bairro = Console.ReadLine();
                Console.WriteLine("Num");
                cliente.endereco.num = Convert.ToInt16(Console.ReadLine());

                Console.WriteLine("Cadastro do cliente");
                Console.WriteLine("Nome");
                cliente.pessoa.nome = Console.ReadLine();
                Console.WriteLine("Filiação");
                Console.WriteLine("Mae");
                cliente.pessoa.filiacao.mae = Console.ReadLine();
                Console.WriteLine("Pai");
                cliente.pessoa.filiacao.pai = Console.ReadLine();
                Console.WriteLine("Sexo");
                Console.WriteLine("M - Masculino F - Feminino");
                cliente.pessoa.sexo = Convert.ToChar(Console.ReadLine());

            //Exibir os dados

                Console.WriteLine("Nome:" + cliente.pessoa.nome);
                Console.WriteLine("Filiação");
                Console.WriteLine("Mae:" + cliente.pessoa.filiacao.mae);
                Console.WriteLine("Pai:" + cliente.pessoa.filiacao.pai);
                Console.WriteLine("Sexo: "+cliente.pessoa.sexo);
                Console.WriteLine("Endereço:");
                Console.WriteLine("Rua: "+cliente.endereco.rua+" , "+cliente.endereco.num+" Bairo: "+cliente.endereco.bairro);
                Console.WriteLine("Livro:"+cliente.livro);
                Console.WriteLine("Cheque Bancario: "+cliente.cheque);
        }
    }
}

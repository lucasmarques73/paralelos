using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cliente_struct_ex2_lista01
{
    class Program
    {
        struct tipo_end
        {
            public string rua;
            public string bairro;
            public int num;
        }
        struct reg_cliente
        {
            public string nome;
            public tipo_end end;
            public string tel;
        }
        static void Main(string[] args)
        {
            int cont, qtcliente = 50;
            reg_cliente[] cliente = new reg_cliente[qtcliente];
            char nvcliente;

            cont = 0; 

            do{
                

                Console.WriteLine("Cadastrar o " + (cont + 1) + "º cliente:");

                Console.WriteLine("Nome do " + (cont + 1) + "º cliente:");
                cliente[cont].nome = Console.ReadLine();

                Console.WriteLine("Endereço do " + (cont + 1) + "º cliente:");
                Console.WriteLine("Rua:");
                cliente[cont].end.rua = Console.ReadLine();
                Console.WriteLine("Numero:");
                cliente[cont].end.num = Convert.ToInt16(Console.ReadLine());
                Console.WriteLine("Bairro:");
                cliente[cont].end.bairro = Console.ReadLine();

                Console.WriteLine("Telefone do " + (cont + 1) + "º cliente:");
                cliente[cont].tel = Console.ReadLine();

                cont++;

                Console.WriteLine("Novo Cliente S/N");
                nvcliente = Convert.ToChar(Console.ReadLine());

                Console.Clear();

            }while (nvcliente == 'S');
                
                    Console.WriteLine("Obrigado por usar nosso sistema.");
                    Console.ReadKey();
                

            }

        }
    }


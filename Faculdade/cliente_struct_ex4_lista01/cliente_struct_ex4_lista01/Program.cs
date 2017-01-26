using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cliente_struct_ex4_lista01
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
            public string nome, tel;
            public tipo_end end;
            public int cod;
        }
        static void Main(string[] args)
        {
            int cont, qtcliente, cod_consulta, cliente_cadastrados = 0;
            
            char nvcliente;

            cont = 0;

            Console.WriteLine("Digite quantos cliente serão cadastrados:");
            qtcliente = Convert.ToInt16(Console.ReadLine());

            reg_cliente[] cliente = new reg_cliente[qtcliente];


            do{
                

                Console.WriteLine("Cadastrar o " + (cont + 1) + "º cliente:");

                Console.WriteLine("Nome do " + (cont + 1) + "º cliente:");
                cliente[cliente_cadastrados].nome = Console.ReadLine();

                Console.WriteLine("Endereço do " + (cont + 1) + "º cliente:");
                Console.WriteLine("Rua:");
                cliente[cliente_cadastrados].end.rua = Console.ReadLine();
                Console.WriteLine("Numero:");
                cliente[cliente_cadastrados].end.num = Convert.ToInt16(Console.ReadLine());
                Console.WriteLine("Bairro:");
                cliente[cliente_cadastrados].end.bairro = Console.ReadLine();
            
                Console.WriteLine("Telefone do " + (cont + 1) + "º cliente:");
                cliente[cliente_cadastrados].tel = Console.ReadLine();

                cliente[cliente_cadastrados].cod = (cont + 1);

                Console.WriteLine("O codigo do cliente é: "+(cliente[cliente_cadastrados].cod));

                cont++;
                cliente_cadastrados++;

                Console.WriteLine("Se você tentar cadastrar mais usuarios do que solicitou vai dar erro.");
                Console.WriteLine("Novo Cliente S/N");
                nvcliente = Convert.ToChar(Console.ReadLine());

                Console.Clear();

                

               

            }while (nvcliente == 'S');

           
        
            Console.WriteLine("Consultar Cliente");
           
            //Segunda parte do programa " A Consulta "

            
            
            do{
                
                Console.WriteLine("Digite o código do cliente ou Digite 999 para sair:");
                
                cod_consulta = Convert.ToInt16(Console.ReadLine());

                Console.Clear();
                
               
                    for (cont = 0; cont < qtcliente; cont++)
                    {
                        if (cliente[cont].cod == cod_consulta)
                        {
                            Console.WriteLine("Nome:" + cliente[cont].nome);
                            Console.WriteLine("Endereço");
                            Console.WriteLine("Rua:" + cliente[cont].end.rua);
                            Console.WriteLine("Numero:" + cliente[cont].end.num);
                            Console.WriteLine("Bairro:" + cliente[cont].end.bairro);
                            Console.WriteLine("Telefone:" + cliente[cont].tel); 
                            
                        }
                    }


                    
               

            } while (cod_consulta != 999);

            Console.WriteLine("Obrigado por usar nosso sistema.");
            Console.ReadKey();
        }
    }
}

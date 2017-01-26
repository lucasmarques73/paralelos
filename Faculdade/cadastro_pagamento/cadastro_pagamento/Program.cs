using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace cadastro_pagamento
{
    class Program
    {
        public struct tipo_despesa
        {
            public int cod;
            public string data_pagamento;
            public string data_vencimento;
            public string descricao;
            public double valor;
            public double valor_pago;
            public bool pago;

        }
        static string localDados = @"C:/ProjetoIntegrador/Prog_Cond/";
        static string arquivoDadosDespesas = @"Despesas.txt";
        static void Main(string[] args)
        {
            #region 'Arquivo'
            DirectoryInfo dirInfo = new DirectoryInfo(localDados);
            if (!dirInfo.Exists)
            {
                dirInfo.Create();
            }
            if (!File.Exists(localDados + arquivoDadosDespesas))
            {
                File.Create(localDados + arquivoDadosDespesas);
            }
            #endregion

          
            Console.WriteLine("DESPESAS CADASTRADAS");
            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            tipo_despesa[] despesa = retorna_despesas();
            for (int i = 0; i < despesa.Count(); i++)
            {
                Console.WriteLine("CÓDIGO: "+despesa[i].cod +" DESCRIÇÃO: "+ despesa[i].descricao+" VALOR: " +despesa[i].valor);
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
                    Console.WriteLine("DATA DO PAGAMENTO");
                    despesa[x].data_pagamento = Console.ReadLine();
                    Console.WriteLine("VALOR PAGO:");
                    despesa[x].valor_pago = Convert.ToDouble(Console.ReadLine());
                    despesa[x].pago = true;

                                       
                }



            if (cadastra_pagamento(despesa))
            {
                Console.WriteLine("Sucesso!");
            }

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
    }
}


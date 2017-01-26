using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace cadastro_despesa
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
            #region "Arquivos"
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

            tipo_despesa nova_despesa;
            
            nova_despesa.cod = 0;
            

            Console.WriteLine("   DIGITE A DESCRIÇÃO:");
            nova_despesa.descricao = Console.ReadLine().Replace(';', ' ').ToUpper();
            Console.WriteLine("   DIGITE O VALOR:");
            nova_despesa.valor = Convert.ToDouble(Console.ReadLine());
            Console.WriteLine("   DIGITE A DATA DO VENCIMENTO DA DESPESA: (DD/MM/AAAA)");
            nova_despesa.data_vencimento = (Console.ReadLine());

            nova_despesa.data_pagamento = "00/00/0000";
            nova_despesa.valor_pago = 00.00;
            nova_despesa.pago = false;

            cadastra_despesa(nova_despesa);
            



        }

        public static bool cadastra_despesa(tipo_despesa despesa)
        {
            #region "Arquivos"
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
    }
}

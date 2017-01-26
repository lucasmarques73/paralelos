using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace retorna_despesa
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
            StreamReader reader = new StreamReader(localDados + arquivoDadosDespesas);

            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
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
        }
    }
}

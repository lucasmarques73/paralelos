using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace cria_admin
{
    class Program
    {
        static string localDados = @"C:/ProjetoIntegrador/Prog_Cond/teste/";
        static string arquivoDadosCondominio = @"Condominio.txt";
        static string arquivoDadosMorador = @"Morador.txt";
        static string arquivoDadosDespesas = @"Despesas.txt";
        static string arquivoDadosPagamentos = @"Pagamento.txt";
        static string arquivoDadosUsuarios = @"Usuario.txt";

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


            StreamReader reader = new StreamReader(localDados + arquivoDadosUsuarios);
            int j = 0;
            while (reader.ReadLine() != null)
            {
                j++;
            }
            reader.Close();
            reader.Dispose();

            if (j == 0)
            {
                StreamWriter writer = File.AppendText(localDados + arquivoDadosUsuarios);
                writer.WriteLine("admin");
                writer.WriteLine("NQZVA");
                writer.Close();
                writer.Dispose();
            }
        }
    }
}

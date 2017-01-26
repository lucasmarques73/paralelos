using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SqlClient;

namespace TPI_Modulo_Acesso
{
    public class Conexao
    {
        public static SqlConnection con = null;
        public void conecta()
        {
            con = new SqlConnection(@"Data Source=.\sqlexpress;Initial Catalog=db_mod_app;Integrated Security=True");
            con.Open();
        }
        public void desconecta()
        {
            con.Close();
        }
    }
}

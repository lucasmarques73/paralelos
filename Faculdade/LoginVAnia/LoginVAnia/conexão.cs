using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;


namespace LoginVAnia
{
    class conexão
    {
        static SqlConnection con = null;

        public void conect()
        {
            string url = @"Data Source=LUCAS-NOT;Initial Catalog=bdAula;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();
        }

        public void desconect()
        {
            con.Close();
        }

        public void comparaLogin(string login, string senha)
        {
                
            string query = "select login,senha from tblUser login = @l AND senha = @s";

            SqlCommand comp = new SqlCommand(query, con);

            comp.Parameters.AddWithValue("l", login);
            comp.Parameters.AddWithValue("s", senha);
            
            comp.ExecuteNonQuery();





        }
      
    }
}

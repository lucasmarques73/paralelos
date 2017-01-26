using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace aula_13_11
{
    class cont
    {
        static SqlConnection con = null;

        public void conect()
        {
            string url = "@Data Source=TIAGO\\SQLEXPRESS;Initial Catalog=Tb.Va_user;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();

        }
        public void desconect()
        {
            con.Close();

        }

        public void inserePessoa(string cpf, string nome,string dataN, string login, string senha, string setor)
        {
            string query = "insert into user(cpf,nome,datNasc,login,senha,setor)values(@c,@n,@d,@l,@s,@s)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("c", cpf);
            aux.Parameters.AddWithValue("l", login);
            aux.Parameters.AddWithValue("s", senha);
            aux.Parameters.AddWithValue("n", nome);
            aux.Parameters.AddWithValue("s", setor);
            aux.Parameters.AddWithValue("d", dataN);

            aux.ExecuteNonQuery();



        }
    }
}

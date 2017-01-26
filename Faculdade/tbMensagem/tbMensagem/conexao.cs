using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace tbMensagem
{
    class conexao
    {
        static SqlConnection con = null;

        public void conect()
        {
            string url = @"Data Source=LUCAS-NOT;Initial Catalog=bdTR2014;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();
        }

        public void desconect()
        {
            con.Close();
        }

        public void inserePessoa(string cpf, string login, string senha, string nome, string email)
        {
            string query = "insert into tblPessoa(cpf, login, senha , nome, email) values (@c, @l, @s , @n, @e)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("c", cpf);
            aux.Parameters.AddWithValue("l", login);
            aux.Parameters.AddWithValue("s", senha);
            aux.Parameters.AddWithValue("n", nome);
            aux.Parameters.AddWithValue("e", email);

            aux.ExecuteNonQuery();


        }

    }
}

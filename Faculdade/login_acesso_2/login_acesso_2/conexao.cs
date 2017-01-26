using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace login_acesso_2
{
    class conexao
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

        public void insereCad(string nome, string cpf, string dtnasc,string setor, string login, string senha )
        {
            string query = "insert into tblUser( Nome, CPF, dtNasc, login, senha, setor) values(@nome,@cpf,@data ,@login,@senha, @setor)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("data", Convert.ToDateTime(dtnasc));
            aux.Parameters.AddWithValue("nome",nome);
            aux.Parameters.AddWithValue("cpf", cpf);
            aux.Parameters.AddWithValue("login", login);
            aux.Parameters.AddWithValue("senha", senha);
            aux.Parameters.AddWithValue("setor", setor);

            aux.ExecuteNonQuery();


        }





    }
}

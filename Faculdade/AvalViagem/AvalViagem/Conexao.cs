using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace AvalViagem
{
    class Conexao
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

        public void insereOpniao(DateTime data, string local, string opniao, int nota)
        {
            string query = "insert into tblAvalViagem(data, local, nota , opniao) values (@d, @l, @n , @o)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("d", data);
            aux.Parameters.AddWithValue("l", local);
            aux.Parameters.AddWithValue("n", nota);
            aux.Parameters.AddWithValue("o", opniao);

            aux.ExecuteNonQuery();


        }


        public SqlDataReader buscaOpiniao(string local)
        {
            SqlDataReader dados = null;
            string query = "select * from  tblAvalViagem where local = @local";

            SqlCommand comando = new SqlCommand(query, con);

            comando.Parameters.AddWithValue("local", local);
            dados = comando.ExecuteReader();

            return dados;
            

        }

    }
}

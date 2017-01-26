using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace provaVania20_11
{
    class conexao
    {
        static SqlConnection con = null;

        public void conect()
        {
            string url = @"Data Source=LUCAS-NOT;Initial Catalog=bdProvaVania;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();
        }

        public void desconect()
        {
            con.Close();
        }

        public void inserePessoa(string nome, string rg, string cpf, string end, string tel)
        {
            string query = "insert into tblPessoa(nome, rg,cpf,endereco,telefone) values(@nome , @rg, @cpf, @end, @tel)";
            SqlCommand aux = new SqlCommand(query, con);

           
            aux.Parameters.AddWithValue("nome", nome);
            aux.Parameters.AddWithValue("cpf", cpf);
            aux.Parameters.AddWithValue("rg", rg);
            aux.Parameters.AddWithValue("end", end);
            aux.Parameters.AddWithValue("tel", tel);

            aux.ExecuteNonQuery();


        }

        public void insereCarro(string placa, string renavan, string fabr, string modelo, int ano)
        {
            string query = "insert into tblCarro(placa, renavan, fabricante,modelo, ano) values (@placa, @renavan, @fabricante, @modelo, @ano)";
            SqlCommand aux = new SqlCommand(query, con);


            aux.Parameters.AddWithValue("placa", placa);
            aux.Parameters.AddWithValue("renavan", renavan);
            aux.Parameters.AddWithValue("fabricante", fabr);
            aux.Parameters.AddWithValue("modelo", modelo);
            aux.Parameters.AddWithValue("ano", ano);

            aux.ExecuteNonQuery();


        }
        public void insereOcorrencia(string data, string local, string desc, string placa)
        {
            string query = "insert into tblOcorrencia(data, local, descricao, placa) values(@data, @local, @desc, @placa)";
            SqlCommand aux = new SqlCommand(query, con);


            aux.Parameters.AddWithValue("data", data);
            aux.Parameters.AddWithValue("local", local);
            aux.Parameters.AddWithValue("desc", desc);
            aux.Parameters.AddWithValue("placa", placa);
            

            aux.ExecuteNonQuery();


        }

        public SqlDataReader buscaOcorrencia(string placa)
        {
            SqlDataReader dados = null;
            string query = "select * from  tblOcorrencia where placa = @placa";

            SqlCommand comando = new SqlCommand(query, con);

            comando.Parameters.AddWithValue("placa", placa);
            dados = comando.ExecuteReader();

            return dados;


        }

        public SqlDataReader buscaCarro()
        {
            SqlDataReader dados = null;
            string query = "select * from  tblCarro where ano > 2009";

            SqlCommand comando = new SqlCommand(query, con);

           // comando.Parameters.AddWithValue("", ano);
            dados = comando.ExecuteReader();

            return dados;


        }
    }
}

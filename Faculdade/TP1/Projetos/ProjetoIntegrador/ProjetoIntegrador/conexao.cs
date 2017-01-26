using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace ProjetoIntegrador
{
    class conexao
    {
        static SqlConnection con = null;

        public void conect()
        {
            string url = @"Data Source=LUCAS-NOT;Initial Catalog=bdLojaInfo;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();
        }

        public void desconect()
        {
            con.Close();
        }
        public void insereCategoria(string nomeCategoria, string descricaoCategoria)
        {
            string query = "insert into tblCategoria(nomeCategoria, descricao) values (@n, @d)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("n", nomeCategoria);
            aux.Parameters.AddWithValue("d", descricaoCategoria);
            

            aux.ExecuteNonQuery();


        }

        public void insereTipoServico(string nomeTipoServico, string descricaoTipoServico)
        {

            string query = "insert into tblTipoServico(descricaoTipoServico, descricaoTipoServico) values (@n, @d)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("n", nomeTipoServico);
            aux.Parameters.AddWithValue("d", descricaoTipoServico);


            aux.ExecuteNonQuery();

        }

        public void insereUnidade(string nomeUnidade)
        {
            string query = "insert into tblTipoServico(nomeUnidade) values (@n)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("n", nomeUnidade);          


            aux.ExecuteNonQuery();
        }

        public void insereTelefone(string tipo, string ddd, string numero)
        {
            string query = "insert into tblTelefone(tipo, ddd, numero) values (@t, @d, @n)";
            SqlCommand aux = new SqlCommand(query,con);

            aux.Parameters.AddWithValue("t", tipo);
            aux.Parameters.AddWithValue("d", ddd);
            aux.Parameters.AddWithValue("n", numero);

            aux.ExecuteNonQuery();
        }

        public void insereEndereco(string rua, int numero, string complemento, string bairro,string cidade, string uf, string cep, string pais)
        {
            string query = "insert into tblEnd(logradouro, numero, complemento,cidade, bairro, uf, cep, pais) values (@r, @n, @c,@cidade, @b, @u,@cep,@p)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("r", rua);
            aux.Parameters.AddWithValue("n", numero);
            aux.Parameters.AddWithValue("c", complemento);
            aux.Parameters.AddWithValue("cidade", cidade);
            aux.Parameters.AddWithValue("b", bairro);
            aux.Parameters.AddWithValue("u", uf);
            aux.Parameters.AddWithValue("cep", cep);
            aux.Parameters.AddWithValue("p", pais);

            aux.ExecuteNonQuery();
 
        }

        public void inserePessoa(string nome, string cpf, string cnpj, string obs, DateTime dtNasc, DateTime dtCad, int codEnd, int codTel)
        {
            string query = "insert into tblTelefone(nome, CPF, CNPJ, obs, dtNasc, dtCadastro, codEnd, codTel) values (@nome, @cpf, @cnpj, @obs, @dtn, @dtcad, @codEnd, @codTel)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("nome",nome );
            aux.Parameters.AddWithValue("cpf", cpf);
            aux.Parameters.AddWithValue("cnpj", cnpj);
            aux.Parameters.AddWithValue("obs", obs);
            aux.Parameters.AddWithValue("dtn", dtNasc);
            aux.Parameters.AddWithValue("dtcad", dtCad);
            aux.Parameters.AddWithValue("codEnd", codEnd);
            aux.Parameters.AddWithValue("codTel", codTel);
            

            aux.ExecuteNonQuery();
        }
        public SqlDataReader buscaUltimoEnd()
        {
            SqlDataReader dadosEnd = null;
            string query = "select max(codEnd) from tblEnd";

            SqlCommand comandoEnd = new SqlCommand(query,con);

            dadosEnd = comandoEnd.ExecuteReader();

            return dadosEnd;
        }
        public  SqlDataReader buscaUltimoTel()
        {
            SqlDataReader dadosTel = null;
            string query = "select MAX(codTelefone) from tblTelefone";

            SqlCommand comandoTel = new SqlCommand(query, con);

            dadosTel = comandoTel.ExecuteReader();

            return dadosTel;
        }


        public SqlDataReader buscaPessoa(string nome)
        {
            SqlDataReader dados = null;
            string query = "select * from  tblPessoa where nome = %@nome%";

            SqlCommand comando = new SqlCommand(query, con);

            comando.Parameters.AddWithValue("nome", nome);
            dados = comando.ExecuteReader();

            return dados;
        }

        public void insereProduto(string nomeProduto,string descricao,float valorCusto,float valorVenda,int codDesconto,float qtEstque,int codUnidade, int codCategoria,int codFornecedor)
        {
            string query = "insert into tblProduto(nomeProduto, descricao, valorCusto, valorVenda, codDesconto, qtEstque, codUnidade, codCategoria, codFornecedor) values (@nomeProduto, @descricao, @valorCusto, @valorVenda, @codDesconto, @qtEstque, @codUnidade, @codCategoria, @codFornecedor)";
            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("nomeProduto", nomeProduto);
            aux.Parameters.AddWithValue("descricao", descricao);
            aux.Parameters.AddWithValue("valorCusto", valorCusto);
            aux.Parameters.AddWithValue("valorVenda", valorVenda);
            aux.Parameters.AddWithValue("codDesconto", codDesconto);
            aux.Parameters.AddWithValue("qtEstque", qtEstque);
            aux.Parameters.AddWithValue("codUnidade", codUnidade);
            aux.Parameters.AddWithValue("codCategoria", codCategoria);
            aux.Parameters.AddWithValue("codFornecedor", codFornecedor);

            aux.ExecuteNonQuery();
        }

        public SqlDataReader buscaCod(string nome)
        {
            SqlDataReader dados = null;
            string query = "select codCategoria from tblCategoria where nomeCategoria like 'mouse'";

            SqlCommand comando = new SqlCommand(query, con);

            comando.Parameters.AddWithValue("nome", nome);
            dados = comando.ExecuteReader();

            return dados;
 
        }


    }
}

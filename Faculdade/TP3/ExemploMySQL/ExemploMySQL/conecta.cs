using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data;
using MySql.Data;
using MySql.Data.MySqlClient;

namespace ExemploMySQL
{
    public class conecta
    {
        // Definir a String de Conexão
        static String strConexao = @"SERVER=localhost;DATABASE=bdexemplo;UID=root;PASSWORD=123456;";

        MySqlConnection con = new MySqlConnection(strConexao);

        //Metodo para executar comandos SQL
        public string executaComando(string comandoSql)
        {
            try
            {
                con.Open();
                MySqlCommand cmd = new MySqlCommand(comandoSql, con);
                cmd.ExecuteNonQuery();
                return "Ok";
            }
            catch (Exception erro)
            {
                return erro.Message;
            }
            finally
            {
                con.Close();
            }

        }


        //Metedo para retornar valor
        public int retornaValor(string comandoSql)
        {
            try
            {
                con.Open();
                MySqlCommand cmd = new MySqlCommand(comandoSql, con);

                int result = Convert.ToInt32(cmd.ExecuteScalar());

                return result;
            }
            catch (Exception erro)
            {
                Console.WriteLine("Erro: " + erro.Message);
                throw;
            }
            finally
            {
                con.Close();
            }
        }

        //Metodo para retornar tabela
        public DataTable retornaTabela(string comandoSql)
        {
            try
            {
                con.Open();
                DataTable dt = new DataTable();
                MySqlDataAdapter da = new MySqlDataAdapter(comandoSql,con);
                da.Fill(dt);

                return dt;
            }
            catch (Exception erro)
            {
                Console.WriteLine("Erro: " + erro.Message);
                throw;
            }
            finally
            {
                con.Close();
            }
        }
    }
}
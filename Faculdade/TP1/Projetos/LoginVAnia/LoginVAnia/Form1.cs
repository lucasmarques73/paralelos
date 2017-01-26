using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Data.SqlClient;

namespace LoginVAnia
{
    public partial class Form1 : Form
    {
        private bool Logado = false;

        public Form1()
        {
            InitializeComponent();
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btLogar_Click(object sender, EventArgs e)
        {
            bool result =VerificaLogin();

               Logado = result;

            if (result)
                {

                    MessageBox.Show("Seja bem vindo!");

                    this.Close();
                }
            else
                {
                    MessageBox.Show("Usuário ou senha incorreto!");
                }
              }

         bool VerificaLogin()
        {
            bool result = false;
            string StringDeConexao = @"Data Source=LUCAS-NOT;Initial Catalog=bdAula;Integrated Security=True";
            using (SqlConnection cn = new SqlConnection())
            {
                cn.ConnectionString = StringDeConexao;

                try
                {
                    SqlCommand cmd = new SqlCommand("select * from login where usuario = " + tbLogin.Text + " and senha = " + tbSenha.Text + ";", cn);
                    cn.Open();
                    SqlDataReader dados = cmd.ExecuteReader();
                    result = dados.HasRows;

                }
                catch (SqlException e)
                {
                    throw new Exception(e.Message);
                }
                finally
                {
                    cn.Close();
                }
            }
            return result;
        }

         private void Form1_FormClosed(object sender, FormClosedEventArgs e)
         {
             if (Logado)
             {
                 this.Close();
             }
             else
             {
                 Application.Exit();
             }
         }

       

        

       
    }
}

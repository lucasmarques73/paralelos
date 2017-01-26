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

namespace login_acesso_2
{
    public partial class Form1 : Form
    {
        string connectionString = "Data Source=LUCAS-NOT;Initial Catalog=bdAula;Integrated Security=True";
        

        string login, senha, setor;

        public Form1()
        {
            InitializeComponent();
        }

        private void btAcessar_Click(object sender, EventArgs e)
        {
            string sql = "SELECT * FROM tblUser WHERE login='" + tblogin.Text + "'AND senha='" + tbsenha.Text+"'";
            SqlConnection con = new SqlConnection(connectionString);
            SqlCommand cmd = new SqlCommand(sql, con);
            cmd.CommandType = CommandType.Text;
            SqlDataReader reader;
            con.Open();

            
              try
              {
                  reader = cmd.ExecuteReader();
                  if (reader.Read())
                  {
                      login = reader[4].ToString();
                      senha = reader[5].ToString();

                      if (login == tblogin.Text && senha == tbsenha.Text)
                      {
                          string sql2 = "SELECT * FROM tblUser WHERE login =  '" + tblogin.Text + "'";
                          SqlConnection con2 = new SqlConnection(connectionString);
                          SqlCommand cmd2 = new SqlCommand(sql2, con2);
                          cmd2.CommandType = CommandType.Text;
                          SqlDataReader reader2;
                          con2.Open();

                          try
                          {

                              reader2 = cmd2.ExecuteReader();

                              if (reader2.Read())
                              {
                                  setor = reader2[6].ToString();

                                  if (setor == "Administrador")
                                  {
                                      new admin().ShowDialog();
                                  }
                                  else if (setor == "Convidado")
                                  {
                                      new guest().ShowDialog();
                                  }
                                  else
                                  {
                                      new func().ShowDialog();
                                  }

                              }
                          }
                          catch (Exception ex)
                          {
                              MessageBox.Show("Erro: " + ex.ToString());
                          }
                          finally {
                              con2.Close();
                          }

                          
                      }

                      
                  }
                  else 
                  {
                      MessageBox.Show("Login e senha inválido","ERRO!", MessageBoxButtons.OKCancel, MessageBoxIcon.Error);

                  }
                      
   
              }
              catch (Exception ex)
              {
                  MessageBox.Show("Erro: " + ex.ToString());
              }
              finally
              {
                  con.Close();
              }

              


        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void btSair_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btNovo_Click(object sender, EventArgs e)
        {
            new cadLogin().ShowDialog();
        }
    }
}

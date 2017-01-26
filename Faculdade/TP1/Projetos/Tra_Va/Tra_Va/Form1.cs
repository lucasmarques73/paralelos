using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data;
using System.Data.SqlClient;

namespace Tra_Va
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void bt_logar_Click(object sender, EventArgs e)
        {
            SqlConnection objCon = new SqlConnection(@"Data Source=TIAGO\SQLEXPRESS;Initial Catalog=Tb.Va_user;Integrated Security=True");
            objCon.Open();
            SqlCommand cmd = new SqlCommand();
            cmd.Connection = objCon;
            cmd.CommandText = "select login, senha from tbl_user where login = @login and senha = @senha";
            cmd.Parameters.Add("@login", SqlDbType.VarChar);
            cmd.Parameters["@login"].Value = tbx_login.Text;
            cmd.Parameters.Add("@senha", SqlDbType.VarChar);
            cmd.Parameters["@senha"].Value = tbx_senha.Text;
            SqlDataReader dr = cmd.ExecuteReader();
            bool bTemLinhas = dr.HasRows;
            dr.Close();
            objCon.Close();
            if (bTemLinhas)
            {
                

                MessageBox.Show("Deu certo");
            }
            else
                MessageBox.Show( "Usuário ou senha não codastrados.");

        }

        private void bt_cadastrar_Click(object sender, EventArgs e)
        {
            Frm_Cadastro cadastro =new Frm_Cadastro();
            cadastro.Show();
        }
    }
}

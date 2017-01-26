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

namespace TPI_Modulo_Acesso
{
    public partial class Frm_Login : Form
    {
        public void Sair()
        {
            Close();
        }
        public Frm_Login()
        {
            InitializeComponent();
        }

        private void bt_sair_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
        public void Limpar()
        {
            tb_login.Clear();
            tb_senha.Clear();
        }
        private void bt_entrar_Click(object sender, EventArgs e)
        {

            string usuario = tb_login.Text;
            string senha = tb_senha.Text;

            Conexao conexao = new Conexao();
            conexao.conecta();

            SqlCommand conn = new SqlCommand();
            conn.Connection = Conexao.con;

            conn.CommandText = "select * from tbl_usuario where usuario = @usuario and senha = @senha";
            conn.Parameters.Add(new SqlParameter("@usuario", usuario));
            conn.Parameters.Add(new SqlParameter("@senha", senha));
            SqlDataReader dr = conn.ExecuteReader();
            if (dr.Read())
            {
                string con = dr[4].ToString();
                if (con == "Administrador")
                    MessageBox.Show("Olá Administrador, \nvocê possui controle TOTAL\ndo sistema!", "Administrador", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                else if (con == "Usuário")
                    MessageBox.Show("Olá Usuário,\nvocê está HABILITADO \npara ir TRABALHAR!", "Usuário", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                else if (con == "Convidado")
                    MessageBox.Show("Olá Convidado,\no projeto integrador \nfoi um execelente\nsoftware de gestão :D", "Convidado", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                Limpar();
            }
            else
            {
                tb_login.Focus();
                MessageBox.Show("DADOS INCORRETOS \n  OU INEXISTENTES!", "ERRO", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Limpar();
            }
        }

        private void bt_cadastrar_Click(object sender, EventArgs e)
        {
            Frm_Cadastro cadastro = new Frm_Cadastro();
            cadastro.Show();
            this.Hide();
        }
    }
}

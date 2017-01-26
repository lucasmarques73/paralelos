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
using TPI_Modulo_Acesso.Properties;

namespace TPI_Modulo_Acesso
{
    public partial class Frm_Cadastro : Form
    {
        public Frm_Cadastro()
        {
            InitializeComponent();
        }        
        public void Limpar()
        {
            tb_cpf.Clear();
            tb_nome.Clear();
            tb_senha.Clear();
            cb_setor.Text = "";
            tb_usuario.Clear();
            msk_dt_nasc.Clear();
        }
        public void Sair()
        {
            Close();
        }
        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                Conexao conexao = new Conexao();
                conexao.conecta();

                SqlCommand conn = new SqlCommand();
                conn.Connection = Conexao.con;

                conn.CommandText = "Insert into tbl_usuario(nome, data_nasc, usuario, senha, setor, cpf) values (@nome, @data_nasc, @usuario, @senha, @setor, @cpf)";

                conn.Parameters.AddWithValue("nome", tb_nome.Text);
                conn.Parameters.AddWithValue("data_nasc", msk_dt_nasc.Text);
                conn.Parameters.AddWithValue("usuario", tb_usuario.Text);
                conn.Parameters.AddWithValue("senha", tb_senha.Text);
                conn.Parameters.AddWithValue("setor", cb_setor.Text);
                conn.Parameters.AddWithValue("cpf", tb_cpf.Text);

                if (tb_cpf.Text == "" || tb_nome.Text == "" || tb_senha.Text == "" || cb_setor.Text == "" || tb_usuario.Text == "")
                {
                    MessageBox.Show("CAMPOS NÃO CADASTRADOS", "AVISO", MessageBoxButtons.OK, MessageBoxIcon.Information);
                }
                else
                {
                    conn.ExecuteNonQuery();
                    MessageBox.Show("DADOS ARMAZENADOS \n COM SUCESSO!", "Obaaa", MessageBoxButtons.OK, MessageBoxIcon.Information);
                    DialogResult result = MessageBox.Show("CADASTRAR NOVAMENTE?", "E agora??", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                    if (result == DialogResult.Yes)
                        Limpar();
                    else
                    {
                        Sair();
                        Frm_Login login = new Frm_Login();
                        login.Show();
                    }
                }
            }
            catch (Exception)
            {
                DialogResult resul = MessageBox.Show("CPF JÁ CADASTRADO! \nTENTE OUTRO.", "Erro", MessageBoxButtons.OKCancel, MessageBoxIcon.Error);
                if (resul == DialogResult.OK)
                {
                    tb_cpf.Clear();
                    tb_cpf.Focus();
                }
                else
                {
                    Sair();
                    Frm_Login login = new Frm_Login();
                    login.Show();
                }
            }
            }
        private void bt_sair_Click_1(object sender, EventArgs e)
        {
            Sair();
            Frm_Login login = new Frm_Login();
            login.Show();
        }            
   }
}


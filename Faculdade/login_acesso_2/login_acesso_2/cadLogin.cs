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
    public partial class cadLogin : Form
    {

        string connectionString = "Data Source=LUCAS-NOT;Initial Catalog=bdAula;Integrated Security=True";

        public cadLogin()
        {
            InitializeComponent();
        }
        public cadLogin(string Nome)
        {
            
            InitializeComponent();

            tbNomeCad.Text = Nome;
        }


        private void cadLogin_Load(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            conexao c = new conexao();
            c.conect();
           
                  try
                  {
                      c.insereCad(tbNomeCad.Text, mtbCPFCad.Text, dtNascCad.Text, cbSetorCad.Text,tbLoginCad.Text,tbSenhaCad.Text);
                          MessageBox.Show("Cadastro realizado com sucesso!");
                  }
                  catch (Exception ex)
                  {
                      MessageBox.Show("Erro: " + ex.ToString());
                  }
                  
        }

        private void btExcluir_Click(object sender, EventArgs e)
        {
            tbSenhaCad.Text = "";
            tbNomeCad.Text = "";
            tbLoginCad.Text = "";
            cbSetorCad.Text = "";
            mtbCPFCad.Text = "";
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace tbMensagem
{
    public partial class cadPessoa : Form
    {
        public cadPessoa()
        {
            InitializeComponent();
        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            conexao c = new conexao();
            c.conect();
            c.inserePessoa(mtbCPF.Text, tbLogin.Text,tbSenha.Text, tbNome.Text, tbEmail.Text);
            MessageBox.Show("Salvo com sucesso!");
        }

        private void tbCPF_TextChanged(object sender, EventArgs e)
        {

        }

        
    }
}

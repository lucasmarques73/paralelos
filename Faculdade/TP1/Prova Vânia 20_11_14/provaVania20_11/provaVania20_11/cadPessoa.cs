using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace provaVania20_11
{
    public partial class cadPessoa : Form
    {
        public cadPessoa()
        {
            InitializeComponent();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbNome.Text = "";
            tbEnd.Text = "";
            tbRG.Text = "";
            tbTel.Text = "";
            mtbCPFCad.Text = "";
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btSalvarCad_Click(object sender, EventArgs e)
        {
            conexao c = new conexao();
            c.conect();

            try
            {
                c.inserePessoa(tbNome.Text, tbRG.Text,mtbCPFCad.Text,tbEnd.Text,tbTel.Text);
                MessageBox.Show("Cadastro realizado com sucesso!");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro: " + ex.ToString());
            }
        }
    }
}

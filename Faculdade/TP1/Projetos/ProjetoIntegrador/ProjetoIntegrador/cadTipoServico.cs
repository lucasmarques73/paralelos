using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ProjetoIntegrador
{
    public partial class cadTipoServico : Form
    {
        public cadTipoServico()
        {
            InitializeComponent();
        }

        private void btSalvarServico_Click(object sender, EventArgs e)
        {
            if (tbNomeServico.Text != "")
            {
                conexao c = new conexao();
                c.conect();
                c.insereTipoServico(tbNomeServico.Text, tbDescServico.Text);
                MessageBox.Show("Salvo com sucesso!");
            }
            else
            {
                MessageBox.Show("Itens em branco!");
            }
        }

        private void btLimparServico_Click(object sender, EventArgs e)
        {
            tbNomeServico.Text = "";
            tbDescServico.Text = "";
        }

        private void btSairServico_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}

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
    public partial class cadCategoria : Form
    {
        public cadCategoria()
        {
            InitializeComponent();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btSalvarOS_Click(object sender, EventArgs e)
        {
            if (tbNomeCategoria.Text != "")
            {
                conexao c = new conexao();
                c.conect();
                c.insereCategoria(tbNomeCategoria.Text, tbDescCategoria.Text);
                MessageBox.Show("Salvo com sucesso!");
            }
            else { MessageBox.Show("Itens em Branco!"); }
        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbNomeCategoria.Text = "";
            tbDescCategoria.Text = "";
        }
    }
}

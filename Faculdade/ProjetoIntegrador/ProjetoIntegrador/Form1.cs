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
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btOutros_Click(object sender, EventArgs e)
        {
            new FormOutros().Show();
        }

        private void btAddPessoa_Click(object sender, EventArgs e)
        {
            new cadPessoa().Show();
        }

        private void btAddForn_Click(object sender, EventArgs e)
        {
            new cadFornecedor().Show();
        }

        private void btAddProd_Click(object sender, EventArgs e)
        {
            new cadProduto().Show();
        }

        private void btAddVenda_Click(object sender, EventArgs e)
        {
            new cadVenda().Show();
        }

        private void btAddAten_Click(object sender, EventArgs e)
        {
            new cadOS().Show();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btBuscPessoa_Click(object sender, EventArgs e)
        {
            new buscaPessoa().ShowDialog();
        }
    }
}

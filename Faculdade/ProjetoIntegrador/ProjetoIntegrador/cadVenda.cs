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
    public partial class cadVenda : Form
    {
        public cadVenda()
        {
            InitializeComponent();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btAddProd_Click(object sender, EventArgs e)
        {
            new buscaPRod().ShowDialog();
        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbValorDesc.Text = "";
            tbValorPagar.Text = "";
            tbValorTotal.Text = "";
        }
    }
}

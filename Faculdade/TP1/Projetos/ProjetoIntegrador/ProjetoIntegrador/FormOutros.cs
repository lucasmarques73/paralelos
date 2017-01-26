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
    public partial class FormOutros : Form
    {
        public FormOutros()
        {
            InitializeComponent();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btAddDesc_Click(object sender, EventArgs e)
        {
            new cadDesconto().ShowDialog();
        }

        private void btAddTipoServ_Click(object sender, EventArgs e)
        {
            new cadTipoServico().ShowDialog();
        }

        private void btAddCatProd_Click(object sender, EventArgs e)
        {
            new cadCategoria().ShowDialog();
        }

        private void btAddFunc_Click(object sender, EventArgs e)
        {
            new cadFunc().ShowDialog();
        }
    }
}

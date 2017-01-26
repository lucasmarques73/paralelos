using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Prl
{
    public partial class FormACG : Form
    {
        public FormACG()
        {
            InitializeComponent();
        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbnome.Clear();
            tbentidade.Clear();
            tbcarga.Clear();
            tbobs.Clear();
            cbtipo.Text = "";
            dtpdata.Text = "";  
        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            tbsaida.AppendText(tbnome.Text + "-" + cbtipo.Text +
                "-" + tbcarga.Text + "-" + dtpdata.Text + "-" + 
                tbobs.Text + "-\n");
        }
    }
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_12_08
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        
        private void tbNome_TextChanged(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            MessageBox.Show(tbNome.Text + ", você tem " + tbIdade.Text + " anos.");

            tbListaNomes.AppendText(tbNome.Text + " - " + tbIdade.Text + "\n");
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbNome.Clear();
            tbIdade.Clear();
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void tbIdade_TextChanged(object sender, EventArgs e)
        {

        }

        private void btVerificar_Click(object sender, EventArgs e)
        {
            if (Convert.ToInt16(tbIdade.Text) >= 18)
            {
                tbListaNomes.AppendText(tbNome.Text + " - " + tbIdade.Text + "\n");
            }
            else
            {
                MessageBox.Show(tbNome.Text + " você não tem idade permitida!!");
                tbNome.Clear();
                tbIdade.Clear();
            }
        }
    }
}

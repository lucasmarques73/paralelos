using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_14_08_agenda
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbNome.Clear();
            mtbCelular.Text = "";
            tbEmail.Clear();
            mtbTelefone.Text = "";
            mtbDataNasc.Text = "";
            cbSexo.Text = "";
        }

        private void lbDataNasc_Click(object sender, EventArgs e)
        {

        }

        private void tbTelefone_TextChanged(object sender, EventArgs e)
        {

        }

        private void lbTelefone_Click(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void maskedTextBox2_MaskInputRejected(object sender, MaskInputRejectedEventArgs e)
        {

        }
    }
}

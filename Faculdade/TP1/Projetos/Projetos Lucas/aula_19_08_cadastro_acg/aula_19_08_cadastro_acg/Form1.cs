using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_19_08_cadastro_acg
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbCargaHoraria.Text = "";
            tbEntidade.Text = "";
            tbObs.Text = "";
            tbNomeEvento.Text = "";
            cbTipo.Text = "";
            dtData.Text = "";




        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);

            dgLista.Rows.Add(tbNomeEvento.Text, cbTipo.Text, tbCargaHoraria.Text, dtData.Text, tbEntidade.Text, tbObs.Text);

            //tbLista.AppendText(tbNomeEvento.Text + " - " + cbTipo.Text + " - " + tbCargaHoraria.Text+" - "+dtData.Text+" - "+tbEntidade.Text + " - " + tbObs.Text +"\n");
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }
    }
}

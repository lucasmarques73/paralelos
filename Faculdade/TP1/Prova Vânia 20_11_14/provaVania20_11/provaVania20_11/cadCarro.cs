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
    public partial class cadCarro : Form
    {
        public cadCarro()
        {
            InitializeComponent();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbAno.Text = "";
            tbFabr.Text = "";
            tbModelo.Text = "";
            tbPlaca.Text = "";
            tbRenavan.Text = "";
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
                c.insereCarro(tbPlaca.Text, tbRenavan.Text, tbFabr.Text,tbModelo.Text,Convert.ToInt16(tbAno.Text));
                MessageBox.Show("Cadastro realizado com sucesso!");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro: " + ex.ToString());
            }
        }
    }
}

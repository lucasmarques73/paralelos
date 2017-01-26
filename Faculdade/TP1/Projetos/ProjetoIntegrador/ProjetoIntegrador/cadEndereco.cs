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
    public partial class cadEndereco : Form
    {
        public cadEndereco()
        {
            InitializeComponent();
        }
        public cadEndereco(string nomeEnd)
        {
           
            InitializeComponent();
            tbNomeEnd.Text = nomeEnd;
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btSalvarOS_Click(object sender, EventArgs e)
        {
            conexao c = new conexao();
            c.conect();
            c.insereEndereco(tbRua.Text, Convert.ToInt16(tbNumero.Text), tbComplemento.Text,tbBairro.Text,tbCidade.Text,cbEstado.Text,mtbCEP.Text,cbPais.Text);
            MessageBox.Show("Salvo com sucesso!");
        }

        private void cadEndereço_Load(object sender, EventArgs e)
        {

        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbRua.Text = "";
            tbNumero.Text = "";
            tbComplemento.Text = "";
            tbCidade.Text = "";
            tbBairro.Text = "";
            cbPais.Text = "";
            cbEstado.Text = "";
            mtbCEP.Text = "";
        }
    }
}

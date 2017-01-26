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
    public partial class cadOcorrencia : Form
    {
        public cadOcorrencia()
        {
            InitializeComponent();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbDesc.Text = "";
            tbLocal.Text = "";
            cbPlaca.Text = "";
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
                c.insereOcorrencia(dtData.Text,tbLocal.Text,tbDesc.Text,cbPlaca.Text);
                MessageBox.Show("Cadastro realizado com sucesso!");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro: " + ex.ToString());
            }
        }

        private void cadOcorrencia_Load(object sender, EventArgs e)
        {
            // TODO: This line of code loads data into the 'bdProvaVaniaDataSet.tblCarro' table. You can move, or remove it, as needed.
            this.tblCarroTableAdapter.Fill(this.bdProvaVaniaDataSet.tblCarro);

        }
    }
}

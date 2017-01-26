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
    public partial class cadDesconto : Form
    {
        public cadDesconto()
        {
            InitializeComponent();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void cadDesconto_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblUnidade'. Você pode movê-la ou removê-la conforme necessário.
            this.tblUnidadeTableAdapter.Fill(this.bdLojaInfoDataSet.tblUnidade);

        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbNomeDesc.Text = "";
            tbValorDesc.Text = "";
            dtIniDesc.Text = "";
            dtFimDesc.Text = "";
        }
    }
}

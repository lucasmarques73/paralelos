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
    public partial class cadFornecedor : Form
    {
        public cadFornecedor()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            new cadEndereco(tbNomeForn.Text).ShowDialog();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            new cadTelefone(tbNomeForn.Text).ShowDialog();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void tabPage2_Click(object sender, EventArgs e)
        {

        }

        private void cadFornecedor_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblTelefone'. Você pode movê-la ou removê-la conforme necessário.
           // this.tblTelefoneTableAdapter.Fill(this.bdLojaInfoDataSet.tblTelefone);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblEnd'. Você pode movê-la ou removê-la conforme necessário.
           // this.tblEndTableAdapter.Fill(this.bdLojaInfoDataSet.tblEnd);

        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbNomeForn.Text = "";
            mtbCNPJForn.Text = "";
            tbDescForn.Text = "";
        }
    }
}

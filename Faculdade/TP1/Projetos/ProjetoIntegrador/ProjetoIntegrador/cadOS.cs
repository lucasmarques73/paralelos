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
    public partial class cadOS : Form
    {
        public cadOS()
        {
            InitializeComponent();
        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            dtOS.Text = "";
            cbClienteOS.Text = "";
            cbFuncOS.Text = "";
            cbServicoOS.Text = "";
            
            tbObsOS.Text = "";
            tbValorOS.Text = "";
                
        }

        private void cadOS_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblUnidade'. Você pode movê-la ou removê-la conforme necessário.
            this.tblUnidadeTableAdapter.Fill(this.bdLojaInfoDataSet.tblUnidade);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblTipoServico'. Você pode movê-la ou removê-la conforme necessário.
            this.tblTipoServicoTableAdapter.Fill(this.bdLojaInfoDataSet.tblTipoServico);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblFuncionario'. Você pode movê-la ou removê-la conforme necessário.
            this.tblFuncionarioTableAdapter.Fill(this.bdLojaInfoDataSet.tblFuncionario);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblPessoa'. Você pode movê-la ou removê-la conforme necessário.
            this.tblPessoaTableAdapter.Fill(this.bdLojaInfoDataSet.tblPessoa);

        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}

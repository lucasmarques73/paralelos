using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data;
using System.Data.SqlClient;

namespace ProjetoIntegrador
{
    public partial class cadPessoa : Form
    {
        public cadPessoa()
        {
            InitializeComponent();
        }

        private void tabPage3_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            new cadEndereco(tbNomePessoa.Text).ShowDialog();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            new cadTelefone(tbNomePessoa.Text).ShowDialog();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void cadPessoa_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblTelefone'. Você pode movê-la ou removê-la conforme necessário.
            //this.tblTelefoneTableAdapter.Fill(this.bdLojaInfoDataSet.tblTelefone);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblEnd'. Você pode movê-la ou removê-la conforme necessário.
           // this.tblEndTableAdapter.Fill(this.bdLojaInfoDataSet.tblEnd);

        }

        private void tabPage4_Click(object sender, EventArgs e)
        {

        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbNomePessoa.Text = "";
            mtbCNPJPessoa.Text = "";
            mtbCPFPEssoa.Text = "";
            dtNascPessoa.Text = "";
            tbObsPessoa.Text = "";
        }

        private void btSalvarOS_Click(object sender, EventArgs e)
        {
            conexao c = new conexao();
            c.conect();
            
            DateTime dtCad = DateTime.Now;
            SqlDataReader dadosTel = c.buscaUltimoTel();
            while (dadosTel.Read())
            {
                dadosTel.GetInt32(0);
            }

            

            SqlDataReader dadosEnd = c.buscaUltimoEnd();
            while (dadosEnd.Read())
            {
                dadosEnd.GetInt32(0);
            }
            

            
            
            
            c.inserePessoa(tbNomePessoa.Text, mtbCPFPEssoa.Text, mtbCNPJPessoa.Text, tbObsPessoa.Text, Convert.ToDateTime(dtNascPessoa.Text),dtCad,dadosTel.GetInt16(0),dadosEnd.GetInt16(0));
            MessageBox.Show("Salvo com sucesso!");

        }
    }
}

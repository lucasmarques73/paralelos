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
    public partial class cadProduto : Form
    {
        public cadProduto()
        {
            InitializeComponent();
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void cadProduto_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblUnidade'. Você pode movê-la ou removê-la conforme necessário.
            this.tblUnidadeTableAdapter.Fill(this.bdLojaInfoDataSet.tblUnidade);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblDesconto'. Você pode movê-la ou removê-la conforme necessário.
            this.tblDescontoTableAdapter.Fill(this.bdLojaInfoDataSet.tblDesconto);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblFornecedor'. Você pode movê-la ou removê-la conforme necessário.
            this.tblFornecedorTableAdapter.Fill(this.bdLojaInfoDataSet.tblFornecedor);
            // TODO: esta linha de código carrega dados na tabela 'bdLojaInfoDataSet.tblCategoria'. Você pode movê-la ou removê-la conforme necessário.
            this.tblCategoriaTableAdapter.Fill(this.bdLojaInfoDataSet.tblCategoria);

        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            tbDescProd.Text = "";
            tbNomeProd.Text = "";
            tbQtEstoque.Text = "";
            tbValorCusto.Text = "";
            tbValorVenda.Text = "";
            cbCatProd.Text = "";
            cbDesconProd.Text = "";
            cbFornProd.Text = "";
            cbUnidadeProd.Text = "";
        }

        private void btSalvarOS_Click(object sender, EventArgs e)
        {
            conexao con = new conexao();
            con.conect();
            SqlDataReader dados = con.buscaCod(cbCatProd.Text);

            while (dados.Read())
            {
                int y = dados.GetInt16(0);
            }

            int x = Convert.ToInt16(dados.GetInt16(0));


            conexao c = new conexao();
            c.conect();
          //  c.insereProduto(tbNomeProd.Text,tbDescProd.Text,float.Parse(tbValorCusto.Text),float.Parse(tbValorVenda.Text),Convert.ToInt16(cbDesconProd.),float.Parse(tbQtEstoque.Text),(cbUnidadeProd.Text),Convert.ToInt16(cbCatProd.ValueMember),Convert.ToInt16(cbFornProd.ValueMember));
            MessageBox.Show("Salvo com sucesso!");

        }
    }
}

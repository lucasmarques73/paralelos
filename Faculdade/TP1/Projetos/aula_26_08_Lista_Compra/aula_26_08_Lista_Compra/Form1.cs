using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_26_08_Lista_Compra
{
    public partial class Form1 : Form
    {

        double valorTotal = 0;

        public Form1()
        {
            InitializeComponent();
        }

        private void lbQuantidadde_Click(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {

            if ((cbProduto.Text == "") || (tbQuantidade.Text == "") || (tbValorUni.Text == ""))
            {
                MessageBox.Show("Campos em branco", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            else
            {



                valorTotal += (Convert.ToDouble(tbValorUni.Text) * Convert.ToDouble(tbQuantidade.Text));

                if (valorTotal > 320)
                {
                    MessageBox.Show("Limite de Compra Ultrapassado!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    valorTotal -= (Convert.ToDouble(tbValorUni.Text) * Convert.ToDouble(tbQuantidade.Text));
                }
                else
                {



                    MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);

                    dgListaCompra.Rows.Add(cbProduto.Text, tbQuantidade.Text, (Convert.ToDouble(tbValorUni.Text) * Convert.ToDouble(tbQuantidade.Text)));

                }

                tbValorTotal.Text = Convert.ToString(valorTotal);

            }
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            cbProduto.Text = "";
            tbQuantidade.Text = "";
            tbValorUni.Text = "";
        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void tbValorTotal_TextChanged(object sender, EventArgs e)
        {
            
        }

        private void btExcluir_Click(object sender, EventArgs e)
        {

          

            if (valorTotal == 0)
            {
                MessageBox.Show("Lista Vazia!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
            else
            {

                valorTotal -= Convert.ToDouble(dgListaCompra.CurrentRow.Cells[2].Value);

                dgListaCompra.Rows.RemoveAt(dgListaCompra.CurrentRow.Index);

               

                tbValorTotal.Text = Convert.ToString(valorTotal);

                
            }

            
        }
    }
}

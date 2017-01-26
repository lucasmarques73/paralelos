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
    public partial class cadTelefone : Form
    {
        public cadTelefone()
        {
            InitializeComponent();
        }

        public cadTelefone(string nome)
        {
            InitializeComponent();
            tbNomeTel.Text = nome;
        }

        private void btSairOS_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btSalvarOS_Click(object sender, EventArgs e)
        {

            if ((cbTipoTel.Text != "") || (mtbDDD.Text != "") || (mtbNumero.Text != ""))
            {
                conexao c = new conexao();
                c.conect();
                c.insereTelefone(cbTipoTel.Text, mtbDDD.Text, mtbNumero.Text);

                MessageBox.Show("Salvo com sucesso!");
            }
            else { MessageBox.Show("Itens em branco!"); }
        }

        private void btLimparOS_Click(object sender, EventArgs e)
        {
            cbTipoTel.Text = "";
            mtbNumero.Text = "";
            mtbDDD.Text = "";
        }

        private void cadTelefone_Load(object sender, EventArgs e)
        {

        }
    }
}

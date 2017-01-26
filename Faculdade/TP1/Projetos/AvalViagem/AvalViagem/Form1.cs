using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace AvalViagem
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            Conexao c = new Conexao();
            c.conect();
            c.insereOpniao(Convert.ToDateTime(dtData.Text), tbLocal.Text, tbOpinao.Text,Convert.ToInt16( cbNota.Text));
            MessageBox.Show("Salvo com sucesso!");

            
        }

        private void btBuscar_Click(object sender, EventArgs e)
        {
            new Form2().ShowDialog();
        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbLocal.Text = "";
            cbNota.Text = "";
            tbOpinao.Text = "";
        }

        
    }
}

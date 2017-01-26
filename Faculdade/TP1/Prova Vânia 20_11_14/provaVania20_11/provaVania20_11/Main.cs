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
    public partial class Main : Form
    {
        public Main()
        {
            InitializeComponent();
        }

        private void btSalvarCad_Click(object sender, EventArgs e)
        {
            new cadPessoa().ShowDialog();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            new cadCarro().ShowDialog();
        }

        private void button5_Click(object sender, EventArgs e)
        {
            new cadOcorrencia().ShowDialog();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            new buscaOcorrencia().ShowDialog();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            new anoMaior2009().ShowDialog();
        }
    }
}

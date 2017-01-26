using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_30_09_Livraria
{
    public partial class Livraria : Form
    {
        public Livraria()
        {
            InitializeComponent();
        }

        private void sairToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void editoraToolStripMenuItem_Click(object sender, EventArgs e)
        {
            new Editora().Show();
        }

        private void generoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            new Genero().Show();
        }

        private void livroToolStripMenuItem_Click(object sender, EventArgs e)
        {
            new Livro().Show();
        }

        private void arquivoToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }
    }
}

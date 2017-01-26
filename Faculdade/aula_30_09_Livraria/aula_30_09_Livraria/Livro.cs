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
    public partial class Livro : Form
    {
        public Livro()
        {
            InitializeComponent();
        }

        private void btFecharLivro_Click(object sender, EventArgs e)
        {
            Close();
        }

       
    }
}

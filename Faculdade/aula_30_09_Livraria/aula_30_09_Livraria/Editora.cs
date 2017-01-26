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
    public partial class Editora : Form
    {
        public Editora()
        {
            InitializeComponent();
        }

        private void btFecharEditora_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}

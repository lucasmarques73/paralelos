using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace CadastrodeClientes
{
    public partial class VerCadastros : Form
    {
        public VerCadastros()
        {
            InitializeComponent();
        }

        private void VerCadastros_Load(object sender, EventArgs e)
        {
            // TODO: This line of code loads data into the 'clientesDataSet1.tbClientes' table. You can move, or remove it, as needed.
            this.tbClientesTableAdapter1.Fill(this.clientesDataSet1.tbClientes);
            // TODO: This line of code loads data into the 'clientesDataSet.tbClientes' table. You can move, or remove it, as needed.
            this.tbClientesTableAdapter1.Fill(this.clientesDataSet1.tbClientes);

        }
    }
}

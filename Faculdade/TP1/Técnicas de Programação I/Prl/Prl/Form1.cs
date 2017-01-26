using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Prl
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void btfechar_Click(object sender, EventArgs e)
        {
            Application.Exit();

        }

        private void btlimpar_Click(object sender, EventArgs e)
        {
            tbnome.Clear();
            tbemail.Clear();
            cbsexo.Text = "";
            //cbsexo.SelectedIndex = -1;
            mtbcel.Clear();
            mtbdtnasc.Clear();
            mtbtel.Clear();
        }
    }
}

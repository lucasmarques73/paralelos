using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_21_08_Enquete_Festa
{
    public partial class Form1 : Form
    {

        int contDataOp1 = 0, contDataOp2 = 0, contDataOp3 = 0, contDataOp4 = 0;
        int contLocalOp1 = 0, contLocalOp2 = 0, contLocalOp3 = 0, contLocalOp4 = 0;


        public Form1()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            rbDataOp1.Checked = false;
            rbDataOp2.Checked = false;
            rbDataOp3.Checked = false;
            rbDataOp4.Checked = false;
            rbLocalOp1.Checked = false;
            rbLocalOp2.Checked = false;
            rbLocalOp3.Checked = false;
            rbLocalOp4.Checked = false;
                       
        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            //Contador Data
            if (rbDataOp1.Checked)
            {
                contDataOp1++;
            }
            else if (rbDataOp2.Checked)
            {
                contDataOp2++;
            }
            else  if (rbDataOp3.Checked)
            {
                contDataOp3++;
            }
            else if(rbDataOp4.Checked)
            {
                contDataOp4++;
            }
         
            //Contador Local
            if (rbLocalOp1.Checked)
            {
                contLocalOp1++;
            }
            else if (rbLocalOp2.Checked)
            {
                contLocalOp2++;
            }
            else if (rbLocalOp3.Checked)
            {
                contLocalOp3++;
            }
            else  if (rbLocalOp4.Checked)
            {
                contLocalOp4++;
            }


            rbDataOp1.Checked = false;
            rbDataOp2.Checked = false;
            rbDataOp3.Checked = false;
            rbDataOp4.Checked = false;
            rbLocalOp1.Checked = false;
            rbLocalOp2.Checked = false;
            rbLocalOp3.Checked = false;
            rbLocalOp4.Checked = false;
        }

        private void btResultado_Click(object sender, EventArgs e)
        {
            MessageBox.Show(rbDataOp1.Text + " - " + contDataOp1 +"\n"+ rbDataOp2.Text + " - " + contDataOp2 + "\n"+ rbDataOp3.Text + " - " + contDataOp3 + "\n"+ rbDataOp4.Text + " - " + contDataOp4 +"\n"+ rbLocalOp1.Text + " - " + contLocalOp1 + "\n"+ rbLocalOp2.Text + " - " + contLocalOp2 + "\n"+ rbLocalOp3.Text + " - " + contLocalOp3 +"\n"+ rbLocalOp4.Text + " - " + contLocalOp4, "Resultado", MessageBoxButtons.OK,MessageBoxIcon.Information);
        }
    }
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace testeMySql
{
    public partial class Form1 : Form
    {



        public Form1()
        {
            InitializeComponent();

            DataSet mDataSet = new DataSet();
            MySqlConnection  mConn = new MySqlConnection("Persist Security Info = False; server = localhost; database = cadastro; uid = root; server = localhost; database = cadastro; uid= root; pwd = 123456");


            try
            {
                mConn.Open();
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.Message.ToString());
            }

            if (mConn.State == ConnectionState.Open)
            {
                MySqlDataAdapter mAdapter = new MySqlDataAdapter("SELECT * FROM clientes", mConn);

                mAdapter.Fill(mDataSet, "Clientes");

                dataGridView1.DataSource = mDataSet;
                dataGridView1.DataMember = "Clientes";
                
            }

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }
    }
}

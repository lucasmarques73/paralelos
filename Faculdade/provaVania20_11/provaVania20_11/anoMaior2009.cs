using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace provaVania20_11
{
    public partial class anoMaior2009 : Form
    {
        public anoMaior2009()
        {
            InitializeComponent();
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void anoMaior2009_Load(object sender, EventArgs e)
        {
            conexao con = new conexao();
            con.conect();
            SqlDataReader dados = con.buscaCarro();
            while (dados.Read())
            {
                dtExibeCar.Rows.Add(dados.GetString(0), dados.GetString(1), dados.GetString(2),dados.GetString(3),dados.GetInt32(4));
            }
        }

        private void dtExibeCar_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }
    }
}

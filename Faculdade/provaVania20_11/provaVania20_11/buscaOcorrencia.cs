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
    public partial class buscaOcorrencia : Form
    {
        public buscaOcorrencia()
        {
            InitializeComponent();
        }

        private void btBuscar_Click(object sender, EventArgs e)
        {

            dtExibe.Rows.Clear();

            conexao con = new conexao();
            con.conect();
            SqlDataReader dados = con.buscaOcorrencia(tbBuscaPlaca.Text);
            while (dados.Read())
            {
                dtExibe.Rows.Add(dados.GetInt32(0), dados.GetString(1), dados.GetString(2), dados.GetString(3));
            }
        }

        private void btSair_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}

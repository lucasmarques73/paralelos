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

namespace AvalViagem
{
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        private void btBuscar_Click(object sender, EventArgs e)
        {
            Conexao con = new Conexao();
            con.conect();
            SqlDataReader dados = con.buscaOpiniao(tbLocalPes.Text);
            while (dados.Read())
            {
                dtExibe.Rows.Add(dados["data"],dados.GetInt32(3), dados.GetString(4));
            }



        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}

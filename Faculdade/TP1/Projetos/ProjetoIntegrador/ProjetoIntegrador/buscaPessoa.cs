using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data;
using System.Data.SqlClient;

namespace ProjetoIntegrador
{
    public partial class buscaPessoa : Form
    {
        public buscaPessoa()
        {
            InitializeComponent();
        }

        private void btSairPessoa_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btBuscar_Click(object sender, EventArgs e)
        {
            conexao con = new conexao();
            con.conect();
            SqlDataReader dados = con.buscaPessoa(tbNomePessoa.Text);
            while (dados.Read())
            {
                dtExibePessoa.Rows.Add(dados.GetInt16(0), dados.GetString(1));
                
                
            }

        }
    }
}

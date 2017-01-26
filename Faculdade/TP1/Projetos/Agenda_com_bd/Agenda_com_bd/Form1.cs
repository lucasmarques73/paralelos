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

namespace Agenda_com_bd
{
    public partial class Form1 : Form
    {
        SqlConnection con = null;

        public Form1()
        {
            InitializeComponent();
        }

        private void tblPessoaBindingNavigatorSaveItem_Click(object sender, EventArgs e)
        {
            this.Validate();
            this.tblPessoaBindingSource.EndEdit();
            this.tableAdapterManager.UpdateAll(this.bdAgendaDataSet);

        }

        private void tblPessoaBindingNavigatorSaveItem_Click_1(object sender, EventArgs e)
        {
            this.Validate();
            this.tblPessoaBindingSource.EndEdit();
            this.tableAdapterManager.UpdateAll(this.bdAgendaDataSet);

        }

        private void Form1_Load(object sender, EventArgs e)
        {
            // TODO: esta linha de código carrega dados na tabela 'bdAgendaDataSet.tblPessoa'. Você pode movê-la ou removê-la conforme necessário.
            this.tblPessoaTableAdapter.Fill(this.bdAgendaDataSet.tblPessoa);

            string url = @"Data Source=LUCAS-NOT;Initial Catalog=bdAgenda;Integrated Security=True";
            con = new SqlConnection(url);
            con.Open();


        }

        private void dataNascDateTimePicker_ValueChanged(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            String query = "insert into tblPessoa(Nome, dataNasc, telefone, email)  values (@n, @d, @t, @e)";

            SqlCommand aux = new SqlCommand(query, con);

            aux.Parameters.AddWithValue("n", tbNome.Text);
            aux.Parameters.AddWithValue("d", Convert.ToDateTime(dtDataNasc.Text));
            aux.Parameters.AddWithValue("t", tbTelefone.Text);
            aux.Parameters.AddWithValue("e", tbEmail.Text);


            aux.ExecuteNonQuery();

            MessageBox.Show("Salvo com sucesso!");
        }

        private void btExcluir_Click(object sender, EventArgs e)
        {

            String query = "delete tblPessoa where nome like @nom";
            
            SqlCommand aux = new SqlCommand(query,con);

            aux.Parameters.AddWithValue("@nom", tbNome.Text);


            aux.ExecuteNonQuery();


            MessageBox.Show("Excluido com sucesso!");
        }
    }
}

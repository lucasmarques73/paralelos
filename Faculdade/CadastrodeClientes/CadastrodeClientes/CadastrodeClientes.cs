using System;
using System.Configuration;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace CadastrodeClientes
{
    public partial class CadastrodeClientes : Form
    {
        public CadastrodeClientes()
        {
            InitializeComponent();
        }

        private void btnGravar_Click(object sender, EventArgs e)
        {
            try
            {
                if (txtNome.Text != string.Empty && txtEndereco.Text != string.Empty
                    && txtBairro.Text != string.Empty && ddlEstado.SelectedItem.ToString()
                    != string.Empty && txtTelefone.Text != string.Empty && txtCelular.Text
                    != string.Empty && txtEmail.Text != string.Empty)
                {

                    //Instancio o SqlConnection, passando como parâmetro a string de conexão ao banco
                    SqlConnection conn = new SqlConnection(@"Data Source=WELLINGT-45545B\SQLEXPRESS;
                Initial Catalog=Clientes;Integrated Security=True;Pooling=False");

                    //Instancio o SqlCommand, responsável pelas instruções SQL e
                    //Passo ao SqlCommand que a conexão que ele usará é o SqlConnection
                    SqlCommand comm = new SqlCommand();
                    comm.Connection = conn;

                    //No CommandText do SqlCommand, passo a instrução SQL referente a inserção dos dados
                    comm.CommandText = "INSERT INTO tbCLIENTES (NOMECLIENTE, ENDERECOCLIENTE, " +
                                       " BAIRRO, ESTADO, TELEFONECLIENTE, CELULARCLIENTE, EMAILCLIENTE) " +
                        //Nos Values, passo os valores referentes aos controles digitados pelo usuário
                                       " VALUES (@NOMECLIENTE, @ENDERECOCLIENTE, @BAIRRO, @ESTADO, " +
                                       "         @TELEFONECLIENTE, @CELULARCLIENTE, @EMAILCLIENTE) ";

                    comm.Parameters.AddWithValue("@NOMECLIENTE", txtNome.Text);
                    comm.Parameters.AddWithValue("@ENDERECOCLIENTE", txtEndereco.Text);
                    comm.Parameters.AddWithValue("@BAIRRO", txtBairro.Text);
                    comm.Parameters.AddWithValue("@ESTADO", ddlEstado.SelectedItem.ToString());
                    comm.Parameters.AddWithValue("@TELEFONECLIENTE", txtTelefone.Text);
                    comm.Parameters.AddWithValue("@CELULARCLIENTE", txtCelular.Text);
                    comm.Parameters.AddWithValue("@EMAILCLIENTE", txtEmail.Text);

                    //Abro a conexão, uso o método ExecuteNonQuery e fecho a conexão
                    conn.Open();
                    comm.ExecuteNonQuery();
                    conn.Close();

                    //Exibo ao usuário a mensagem de inserção efetuada com sucesso
                    MessageBox.Show("Dados atualizados com sucesso!", "Mensagem",
                                    MessageBoxButtons.OK, MessageBoxIcon.Information);
                }
                else
                {
                    MessageBox.Show("Informe os valores corretamente para completar o cadastro. " +
                    "Somente os campos Celular e Email podem ficar vazios ", "Erro do Sistema",
                    MessageBoxButtons.OK, MessageBoxIcon.Information);
                }
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void btnNovo_Click(object sender, EventArgs e)
        {
            try
            {
                if (MessageBox.Show("Deseja cancelar o cadastro e fazer um novo?", "Mensagem do Sistema",
                    MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                {
                    txtNome.Text = "";
                    txtEndereco.Text = "";
                    txtBairro.Text = "";
                    ddlEstado.SelectedIndex = -1;
                    txtTelefone.Text = "";
                    txtCelular.Text = "";
                    txtEmail.Text = "";
                }
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void btnVerCadastros_Click(object sender, EventArgs e)
        {
            VerCadastros ver = new VerCadastros();
            ver.ShowDialog();
        }
    }
}

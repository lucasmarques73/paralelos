using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
// Adiciona as bibliotecas de conexão com BD MySQL
using MySql.Data;
using MySql.Data.MySqlClient;
using System.Data;

namespace ExemploMySQL
{
    public partial class cadastro : System.Web.UI.Page
    {


        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                this.populaDDl();
                this.populaDataGridFunc();
            }

            // btSalvar.Visible = false;

        }

        protected void btnCadastrar_Click(object sender, EventArgs e)
        {

            string comando = @"insert into tblfuncionario(nome, idade, salario, idprofissao)
            values ('" + txtNome.Text + "', " + txtIdade.Text.Trim() + ", " + txtSalario.Text.Trim() + ", " + ddlProf.SelectedValue + ")";

            conecta Conecta = new conecta();
            string retorno = Conecta.executaComando(comando);

            if (retorno.Equals("Ok"))
            {
                lblMensagem.Text = "Cadastrado com Sucesso";
            }
            else
            {
                lblMensagem.Text = retorno;
            }



        }

        protected void btnSalvar_Click(object sender, EventArgs e)
        {
            string sal = txtSalario.Text.Trim();
            string salario = sal.Replace("R$ ", "").Replace(".", "").Replace(",", ".");

            string comando = @"update tblfuncionario set nome = '" + txtNome.Text + "', idade = " + txtIdade.Text.Trim() +
                ", salario = " + salario + ", idprofissao = " + ddlProf.SelectedValue + " where id = " + lbID.Text + "";

            conecta Conecta = new conecta();
            Conecta.executaComando(comando);

            lblMensagem.Text = "Alterado com Sucesso";


        }

        protected void btnLimpar_Click(object sender, EventArgs e)
        {
            btnCadastrar.Visible = true;
            txtNome.Text = "";
            txtIdade.Text = "";
            txtSalario.Text = "";
            ddlProf.Text = "Selecione uma profissão";
            lblMensagem.Text = "";
        }

        protected void deleteFunc(int id)
        {
            string comando = "delete from tblfuncionario where id = " + id + "";

            conecta Conecta = new conecta();
            Conecta.executaComando(comando);
        }

        private void populaDDl()
        {
            conecta Conecta = new conecta();


            string cmd = "select * from tblprofissao";

            DataTable dt = Conecta.retornaTabela(cmd);


            ddlProf.DataValueField = "id";
            ddlProf.DataTextField = "profissao";
            ddlProf.DataSource = dt;
            ddlProf.DataBind();
            ddlProf.Items.Insert(0, "Selecione uma profissão");



        }

        private void populaDataGridFunc()
        {
            conecta Conecta = new conecta();

            string cmd = "select * from tblfuncionario f inner join tblprofissao p on f.idprofissao = p.id";
            DataTable dt = Conecta.retornaTabela(cmd);

            dtFunc.DataSource = dt;
            dtFunc.DataBind();


        }

        protected void dtFunc_RowDataBound(object sender, GridViewRowEventArgs e)
        {
            e.Row.Cells[0].Visible = false; // id
            e.Row.Cells[1].Width = 300;     // Largura da Coluna
            e.Row.Cells[4].Visible = false; // idProfissao


        }

        protected void dtFunc_RowCommand(object sender, GridViewCommandEventArgs e)
        {
            // Captura Indiceda Linha Clicada do Grid
            int i = Convert.ToInt32(e.CommandArgument);
            // ObtemID do Func
            int idFunc = int.Parse(dtFunc.Rows[i].Cells[0].Text);

            if (e.CommandName.Equals("editar"))
            {
                btnCadastrar.Visible = false;
                btSalvar.Visible = true;
                btLimpar.Visible = true;
                txtNome.Text = dtFunc.Rows[i].Cells[1].Text;
                txtIdade.Text = dtFunc.Rows[i].Cells[2].Text;
                txtSalario.Text = dtFunc.Rows[i].Cells[3].Text;
                ddlProf.Text = dtFunc.Rows[i].Cells[4].Text;
                lbID.Text = dtFunc.Rows[i].Cells[0].Text;
                lblMensagem.Text = "Editando dados..." + idFunc;
            }
            else if (e.CommandName.Equals("excluir"))
            {
                lblMensagem.Text = "Excluindo Funcionário..." + idFunc;

                deleteFunc(idFunc);

                lblMensagem.Text = "Funcionário excluido com Sucesso!!";

            }
        }
    }
}
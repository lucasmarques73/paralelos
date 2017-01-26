using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace aula10_09
{
    public partial class inicio : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void Button1_Click(object sender, EventArgs e)
        {

            string nomeUsuario = txtUsuario.Text;
            //Verifica se o usuario é valido
            if (txtUsuario.Text.Equals(nomeUsuario))
            {
                //Criando sessão
                Session["usuario"] = nomeUsuario;
                //Definir tempo para sessao expirar
                Session.Timeout = 1;
                //Pega o valor da variavel sessao
                string usuario = Session["usuario"].ToString();

                lbMensagem.Text = "";
                //Usuario valido
                Response.Redirect("restrita.aspx");
            }
            else
            {
                //Usuario Invalido
                lbMensagem.Text = "Usuario Invalido";
            }
        }
    }
}
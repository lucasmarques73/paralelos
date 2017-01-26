using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace ExemploSessao
{
    public partial class PaginaRestrita : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            // Verifica se existe uma Sessão para o usuário
            if (Session["usuario"] != null)
            { // Se a sessão existir
                lblUsuario.Text = "Olá Sr. " + Session["usuario"].ToString();
            }
            else
            { // se a sessão não exisitir
                Response.Redirect("inicio.aspx");
            }
        }

        protected void btnSair_Click(object sender, EventArgs e)
        {
            // Remove a Sessão do Usuário
            Session.Remove("usuario");
            Session.Abandon();
            Response.Redirect("inicio.aspx");
        }
    }
}
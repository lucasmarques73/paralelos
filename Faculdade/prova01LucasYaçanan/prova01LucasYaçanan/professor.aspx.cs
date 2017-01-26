using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace prova01LucasYaçanan
{
    public partial class professor : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            // Verifica se existe uma Sessão para o usuário
            if (Session["usuario"] != null)
            { // Se a sessão existir
                if (Session["usuario"].ToString() == "jose@jose.com")
                {
                    lblUsuario.Text = "Seja Bem vindo Senhor(a) José da Silva";
                }
                if (Session["usuario"].ToString() == "maria@maria.com")
                {
                    lblUsuario.Text = "Seja Bem vindo Senhor(a) Maria do Carmo";
                }
            }
            else
            { // se a sessão não exisitir
                Response.Redirect("login.aspx");
            }
        }
    }
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace ExemploSessao
{
    public partial class inicio : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnValidar_Click(object sender, EventArgs e)
        {
            string nomeDoUsuario = "jose";
            if (txtUsuario.Text.Equals(nomeDoUsuario))
            {
                // Criando uma variável de Sessão
                Session["usuario"] = nomeDoUsuario;
                // Define o tempo para a sessão expirar
                Session.Timeout = 1; // Vai expirar em 1 minuto
                // Pega o valor da variável de Sessão
                // Verifica se o usuário é válido
                lblMensagem.Text = string.Empty;
                // Usuário Válido
                Response.Redirect("PaginaRestrita.aspx");
            }
            else
            {
                // Usuário Inválido
                lblMensagem.Text = "Usuário Inválido!!!";
            }
        }
    }
}
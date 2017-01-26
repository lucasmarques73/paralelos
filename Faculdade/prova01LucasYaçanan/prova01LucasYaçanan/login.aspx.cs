using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace prova01LucasYaçanan
{
    public partial class login : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnLogin_Click(object sender, EventArgs e)
        {
            string login1 = "jose@jose.com";
            string senha1 = "123";
            string login2 = "maria@maria.com";
            string senha2 = "456";

            if (((txtEmail.Text == login1) && (txtSenha.Text == senha1)) || ((txtEmail.Text == login2) && (txtSenha.Text == senha2)))
            {
                // Criando uma variável de Sessão
                Session["usuario"] = txtEmail.Text;
                // Define o tempo para a sessão expirar
                Session.Timeout = 1; // Vai expirar em 1 minuto
                                     // Pega o valor da variável de Sessão
                                     // Verifica se o usuário é válido
                                     //lblMensagem.Text = string.Empty;
                                     // Usuário Válido
                Response.Redirect("inicio.aspx");
            }

            else
            {
                // Usuário Inválido
                Response.Redirect("erro.aspx");
            }
        }
    }
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace prova01LucasYaçanan
{
    public partial class master : System.Web.UI.MasterPage
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnSair_Click(object sender, EventArgs e)
        {
            // Remove a Sessão do Usuário
            Session.Remove("usuario");
            Session.Abandon();
            Response.Redirect("login.aspx");
        }
    }
}
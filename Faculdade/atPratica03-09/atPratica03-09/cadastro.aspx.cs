using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace atPratica03_09
{
    public partial class cadastro : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }
        protected void btnCadastrar_Click(object sender, ImageClickEventArgs e)
        {
            LabelMensagem.Text = "Usuário Cadastrado com Sucesso!";
        }
    }
}
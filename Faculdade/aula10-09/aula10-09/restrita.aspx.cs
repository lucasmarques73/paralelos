using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace aula10_09
{
    public partial class restrita : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            //Verifica se existe sessão
            if (Session["usuario"] != null)
            {
                //Se sessão existir
                lbUsuario.Text = "Olá Sr." + Session["usuario"].ToString() + "";
            }
            else
            {
                Response.Redirect("inicio.aspx");
            }
        }

        protected void btSair_Click(object sender, EventArgs e)
        {
            //Remove sessão do usuario
            // Session.Abandon();
            Session.Remove("usuario");
            Response.Redirect("inicio.aspx");            
        }
    }
}
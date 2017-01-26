using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebApplication1
{
    public partial class abastecer : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btCalcular_Click(object sender, EventArgs e)
        {
            if (Convert.ToDouble(tbValorAlcool.Text) <= (Convert.ToDouble(tbValorGasolina.Text) * 0.7))
                lblConclusão.Text = "Abasteça com: Alcool";
            else
                lblConclusão.Text = "Abasteça com: Gasolina";
        }
    }
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebApplication1
{
    public partial class conversao : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btCalcular_Click(object sender, EventArgs e)
        {
            if (rbParaReal.Checked == true)
            {
                if (ddlTipoMoeda.Text.Equals("Dólar"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) * 2.27);
                else if (ddlTipoMoeda.Text.Equals("Euro"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) * 3.01);
                else if (ddlTipoMoeda.Text.Equals("Libra"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) * 3.78);
            }

            if (rbRealPara.Checked == true)
            {
                if (ddlTipoMoeda.Text.Equals("Dólar"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) / 2.27);
                else if (ddlTipoMoeda.Text.Equals("Euro"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) / 3.01);
                else if (ddlTipoMoeda.Text.Equals("Libra"))
                    lblResultado.Text = Convert.ToString(Convert.ToDouble(tbValor.Text) / 3.78);
            }
        }
    }
}
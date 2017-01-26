using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace exSlide01
{
    public partial class moedas : System.Web.UI.Page
    {
       

        protected void Page_Load(object sender, EventArgs e)
        {

        }
                
        protected void Button1_Click(object sender, EventArgs e)
        {
            double valor = Convert.ToDouble(tbReal.Text);
            double novoValor = 0;

            if (ddlMoeda.Text == "dolar")
            {
                if (rbReal.Checked)
                {
                    novoValor = valor * 2.27;
                }
                else
                {
                    novoValor = valor / 2.27;
                }
            }
            else if (ddlMoeda.Text == "euro")
            {
                if (rbReal.Checked)
                {
                    novoValor = valor * 3.01;
                }
                else
                {
                    novoValor = valor / 3.01;
                }
            }
            else if (ddlMoeda.Text == "libra")
            {
                if (rbReal.Checked)
                {
                    novoValor = valor * 3.78;
                }
                else
                {
                    novoValor = valor / 3.78;
                }
            }

            lbNovoValor.Text = String.Format("{0:0.00}",novoValor);
        }
    }
}
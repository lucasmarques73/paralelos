using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace exSlide01
{
    public partial class abastecer : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void Button1_Click(object sender, EventArgs e)
        {
            lbCalculado.Text = "";

            double alcool = 0;
            double gasol = 0;
            double result = 0;
            

            alcool = Convert.ToDouble(tbAlcool.Text);
            gasol = Convert.ToDouble(tbGasolina.Text);

            result = (alcool / gasol);

            if (result <= 0.7)
            {
                lbCalculado.Text = "Abastecer com Alcool.";
            }
            else
            {
                lbCalculado.Text = "Abastecer com Gasolina.";
            }
            
        }
    }
}
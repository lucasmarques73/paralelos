using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace aula13_08
{
    public partial class inicio : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {


        }

        protected void DropDownList1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (ddlTime.SelectedItem.Text.Equals("Corinthians"))
            {
                lbTime.Text = "Bando de Louco";
            }
            else if (ddlTime.SelectedItem.Text.Equals("São Paulo"))
            {
                lbTime.Text = "Bando de Viado";
            }
            else if (ddlTime.SelectedItem.Text.Equals("Flamengo"))
            {
                lbTime.Text = "Bando de Urubu";
            }
            else if (ddlTime.SelectedItem.Text.Equals("Atlético"))
            {
                lbTime.Text = "Bando de Galo";
            }
        }
    }
}
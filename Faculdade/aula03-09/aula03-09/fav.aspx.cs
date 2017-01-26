using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace aula03_09
{
    public partial class fav : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            HttpCookie cookie = Request.Cookies["time"];
            string valorCookie = cookie.Value;
            lbTime.Text = valorCookie;
        }
    }
}
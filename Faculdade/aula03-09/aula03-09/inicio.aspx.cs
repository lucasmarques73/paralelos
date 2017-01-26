using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace aula03_09
{
    public partial class inicio1 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btOk_Click(object sender, EventArgs e)
        {
            HttpCookie cookie = new HttpCookie("time");
            cookie.Value = txtTime.Text;
            TimeSpan tempoDuracao = new TimeSpan(30,12,5,30);
            cookie.Expires = DateTime.Now + tempoDuracao;
            Response.Cookies.Add(cookie);
        }
    }
}
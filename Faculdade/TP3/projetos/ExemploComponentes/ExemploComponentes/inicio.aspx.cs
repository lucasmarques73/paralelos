using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace ExemploComponentes
{
    public partial class inicio : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                ddlTime.Items.Add(new ListItem("Palmeiras", "6"));
            }
        }

        protected void btnOla_Click(object sender, EventArgs e)
        {
            lblNome.Text = "Olá " + txtNome.Text;
        }

        protected void ddlTime_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (ddlTime.SelectedItem.Text.Equals("Corinthians"))
                lblTime.Text = "Bando de Loucos!";
            else if (ddlTime.SelectedItem.Text.Equals("Atletico"))
                lblTime.Text = "Galo!";
            else if (ddlTime.SelectedItem.Text.Equals("São Paulo"))
                lblTime.Text = "Tricolor!";
            else if (ddlTime.SelectedItem.Text.Equals("Flamengo"))
                lblTime.Text = "Rubro Negro!";
            else if (ddlTime.SelectedItem.Text.Equals("Palmeiras"))
                lblTime.Text = "Verdão!";
            else
                lblTime.Text = "Nenhum Time!";

        }

        protected void rbMasculino_CheckedChanged(object sender, EventArgs e)
        {
            if (rbMasculino.Checked) {
                lblSexo.Text = "Sexo Selecionado: Masculino";
            }
        }

        protected void rbFeminino_CheckedChanged(object sender, EventArgs e)
        {
            if (rbFeminino.Checked)
            {
                lblSexo.Text = "Sexo Selecionado: Feminino";
            }
        }


    }
}
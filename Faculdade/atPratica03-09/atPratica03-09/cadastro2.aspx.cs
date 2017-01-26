using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace atPratica03_09
{
    public partial class cadastro2 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }
        public static bool validarEmail(string Email)
        {
            bool valEmail = false;
            int indexArr = Email.IndexOf("@");
            if (indexArr > 0)
            {
                if (Email.IndexOf("@", indexArr + 1) > 0)
                {
                    return valEmail;
                }
                int indexDot = Email.IndexOf(".", indexArr);
                if (indexDot - 1 > indexArr)
                {
                    if (indexDot + 1 < Email.Length)
                    {
                        string indexDot2 = Email.Substring(indexDot + 1, 1);
                        if (indexDot2 != ".")
                        {
                            valEmail = true;
                        }
                    }
                }
            }
            return valEmail;
        }
        public static bool validarEmail2 (string Email)
        {
            return System.Text.RegularExpressions.Regex.IsMatch(Email, ("(?<user>[^@]+)@(?<host>.+)"));
        }
        protected void btnCadastrar_Click(object sender, ImageClickEventArgs e)
        {
            string erro = "";
            bool verificaErro = false;
            erroNome.Text = "";
            erroIdade.Text = "";
            erroEmail.Text = "";
            erroLogin.Text = "";
            erroSenha.Text = "";
            erroConfirmaSenha.Text = "";

            if (txtNome.Text == "")
            {
                erroNome.Text = "Campo Obrigatório";
                erro = "Campo Nome é Obrigatório. ";
                verificaErro = true;
            }
            if (txtIdade.Text == "")
            {
                erroIdade.Text = "Campo Obrigatório";
                erro = erro + "Campo Idade é Obrigatório. ";
                verificaErro = true;
            }
            if ((int.Parse(txtIdade.Text) > 150) || (int.Parse(txtIdade.Text) <= 0))
            {
                erroIdade.Text = "Idade Inválida. Digite algo entre 0 e 150";
                verificaErro = true;
            }
            if (txtEmail.Text == "")
            {
                erroEmail.Text = "Campo Obrigatório";
                erro = erro + "Campo Email é Obrigatório. ";
                verificaErro = true;
            }
            if (validarEmail(txtEmail.Text) == false)
            {
                erroEmail.Text = "Email Inválido";
                verificaErro = true;
            }
            if (validarEmail2(txtEmail.Text) == false)
            {
                erroEmail.Text = "Email Inválido";
                verificaErro = true;
            }


            if (txtLogin.Text == "")
            {
                erroLogin.Text = "Campo Obrigatório";
                erro = erro + "Campo Login é Obrigatório. ";
                verificaErro = true;
            }
            if (txtSenha.Text == "")
            {
                erroSenha.Text = "Campo Obrigatório";
                erro = erro + "Campo Senha é Obrigatório. ";
                verificaErro = true;
            }
            if (txtConfirmaSenha.Text == "")
            {
                erroConfirmaSenha.Text = "Campo Obrigatório";
                erro = erro + "Campo Confirmar Senha é Obrigatório. ";
                verificaErro = true;
            }
            if (txtConfirmaSenha.Text != txtSenha.Text)
            {
                erroConfirmaSenha.Text = "Senhas Diferentes";
                verificaErro = true;
            }
            if (verificaErro)
            {
                LabelMensagem.Text = erro;
            }
            else
            {
                LabelMensagem.Text = "Cadastrado Com Sucesso!!";
                txtNome.Text = "";
                txtIdade.Text = "0";
                txtEmail.Text = "";
                txtLogin.Text = "";
                txtSenha.Text = "";
                txtConfirmaSenha.Text = "";
            }
        }
    }
}

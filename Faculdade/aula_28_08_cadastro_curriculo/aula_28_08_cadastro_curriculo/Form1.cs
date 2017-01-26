using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_28_08_cadastro_curriculo
{
    public partial class Form1 : Form


    {
        public Form1()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label1_Click_1(object sender, EventArgs e)
        {

        }

        private void tpFormacao_Click(object sender, EventArgs e)
        {

        }

        private void tpPessoal_Click(object sender, EventArgs e)
        {

        }

        private void lbDataNasc_Click(object sender, EventArgs e)
        {

        }

        private void mtbDtNasc_MaskInputRejected(object sender, MaskInputRejectedEventArgs e)
        {

        }

        private void label1lbCel_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            dgFormacao.Rows.Add(tbInstituicao.Text, cbNivel.Text , tbAno.Text, tbNomeCurso.Text);
        }

        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void cbNivel_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void button3_Click(object sender, EventArgs e)
        {
            dgProfisional.Rows.Add(tbFuncao.Text, tbEmpresa.Text, mtbInicio.Text, mtbFim.Text);
        }

        private void btSalvarPessoal_Click(object sender, EventArgs e)
        {

            if (validaCPF(mtbCPF.Text))
            {
                MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
            else
            {
                MessageBox.Show("CPF Inválido!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }

        }




        public bool validaCPF(string cpf)
        {
            int[] multiplicador1 = new int[9] { 10, 9, 8, 7, 6, 5, 4, 3, 2 };
            int[] multiplicador2 = new int[10] { 11, 10, 9, 8, 7, 6, 5, 4, 3, 2 };
            string tempCpf;
            string digito;
            int soma;
            int resto;

            cpf = cpf.Trim();
            cpf = cpf.Replace(".", "").Replace("-", "").Replace(",", "");

            if (cpf.Length != 11)
                return false;

            if ((cpf.Length != 11) || (cpf == "00000000000") || (cpf == "11111111111") || (cpf == "22222222222") || (cpf == "33333333333") || (cpf == "44444444444") || (cpf == "55555555555") || (cpf == "66666666666") || (cpf == "77777777777") || (cpf == "88888888888") || (cpf == "99999999999"))
            {
                return false;
            }

            tempCpf = cpf.Substring(0, 9);
            soma = 0;
            for (int i = 0; i < 9; i++)
                soma += int.Parse(tempCpf[i].ToString()) * multiplicador1[i];

            resto = soma % 11;
            if (resto < 2)
                resto = 0;
            else
                resto = 11 - resto;

            digito = resto.ToString();

            tempCpf = tempCpf + digito;

            soma = 0;
            for (int i = 0; i < 10; i++)
                soma += int.Parse(tempCpf[i].ToString()) * multiplicador2[i];

            resto = soma % 11;
            if (resto < 2)
                resto = 0;
            else
                resto = 11 - resto;

            digito = digito + resto.ToString();

            return cpf.EndsWith(digito);
        }
    }
}

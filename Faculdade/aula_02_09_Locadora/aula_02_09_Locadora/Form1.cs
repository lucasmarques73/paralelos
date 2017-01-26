using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace aula_02_09_Locadora
{
    public partial class Form1 : Form
    {
       public  struct tipoFilme
        {
            public int cod;
            public string titulo, genero, direcao, ator, sinopse;
        }

        tipoFilme[] filmes = new tipoFilme[100];
        int contf = 0;



        public Form1()
        {
            InitializeComponent();
        }

        private void lbEndereco_Click(object sender, EventArgs e)
        {

        }

        private void tabPage3_Click(object sender, EventArgs e)
        {

        }

        private void btSalvar_Click(object sender, EventArgs e)
        {
            if (contf < 100)
            {
                filmes[contf].cod = Convert.ToInt16(tbCodigo.Text);
                filmes[contf].titulo = tbTitulo.Text;
                filmes[contf].genero = cbGenero.Text;
                filmes[contf].direcao = tbDirecao.Text;
                filmes[contf].ator = tbAtores.Text;
                filmes[contf].sinopse = tbSinopse.Text;

                contf++;

                MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);

            }
            else {
                MessageBox.Show("Lista cheia", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }

        }

        private void btBuscar_Click(object sender, EventArgs e)
        {
            bool achou = false;

            for (int i = 0; i < contf; i++)
            {
                if (filmes[i].titulo.Equals(tbTitulo.Text))
                {
                    tbCodigo.Text = Convert.ToString(filmes[i].cod);
                    tbDirecao.Text = filmes[i].direcao;
                    tbAtores.Text = filmes[i].ator;
                    tbSinopse.Text = filmes[i].sinopse;
                    cbGenero.Text = filmes[i].genero;

                    achou = true;

                }
                
            }

            if (!achou)
            {
                MessageBox.Show("Não enconrtado!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
        }

        private void btSalvarLocacao_Click(object sender, EventArgs e)
        {

        }

        private void btLimpar_Click(object sender, EventArgs e)
        {
            tbTitulo.Text = "";
            tbCodigo.Text = "";
            tbDirecao.Text = "";
            tbAtores.Text = "";
            tbSinopse.Text = "";
            cbGenero.Text = "";
        }

        private void btExcluir_Click(object sender, EventArgs e)
        {

            for (int i = 0; i < contf; i++)
            {
                if ( tbCodigo.Text == Convert.ToString(filmes[i].cod))
                {
                        filmes[contf].cod = 0;
                        filmes[contf].titulo = "";
                        filmes[contf].genero = "";
                        filmes[contf].direcao = "";
                        filmes[contf].ator = "";
                        filmes[contf].sinopse = "";
                }
                
            }
            
        }

        private void btSalvarCliente_Click(object sender, EventArgs e)
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
